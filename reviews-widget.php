<?php
/**
 * Barringtons Google Reviews Widget
 * Secure version using environment variables
 */

// Load environment variables
require_once __DIR__ . '/includes/env-loader.php';

/**
 * Get reviews from WordPress database
 */
function get_google_reviews($limit = 10) {
    try {
        $pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                EnvLoader::get('DB_HOST', 'localhost'),
                EnvLoader::get('DB_NAME')
            ),
            EnvLoader::get('DB_USER'),
            EnvLoader::get('DB_PASSWORD'),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        );

        $prefix = EnvLoader::get('DB_PREFIX', 'wp_');
        $table = $prefix . 'mgpf_reviews_import';
        $sql = "SELECT * FROM {$table} WHERE trash = 0 ORDER BY time DESC LIMIT :limit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

    } catch (PDOException $e) {
        error_log('Review Widget Error: ' . $e->getMessage());
        return [];
    }
}

/**
 * Display the reviews carousel
 */
function display_reviews_carousel($options = []) {
    // Default options
    $defaults = [
        'limit' => 10,
        'title' => 'Our Family Caring for Your Family',
        'slides_to_show' => 3,
        'autoplay' => true,
        'autoplay_speed' => 5000,
    ];

    $options = array_merge($defaults, $options);
    $reviews = get_google_reviews($options['limit']);

    if (empty($reviews)) {
        return '';
    }

    // Get WordPress path from environment
    $wp_path = EnvLoader::get('WP_PATH', '/news');
    $plugin_url = $wp_path . '/wp-content/plugins/get-great-google-reviews/public/';
    $widget_id = 'reviews-' . uniqid();

    ob_start();
    ?>

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">

    <!-- Custom Barringtons Reviews Styling -->
    <style>
        .barringtons-reviews {
            max-width: 1400px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .barringtons-reviews h2 {
            font-size: 36px;
            font-weight: 400;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 50px;
            font-family: Georgia, serif;
        }

        .barringtons-reviews .review-carousel {
            padding: 0 40px;
        }

        .barringtons-reviews .review-item {
            padding: 0 15px;
            box-sizing: border-box;
        }

        .barringtons-reviews .review-card {
            background: #f8f9fa;
            padding: 40px 30px;
            border-radius: 8px;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .barringtons-reviews .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .barringtons-reviews .star-rating {
            text-align: center;
            margin-bottom: 25px;
            font-size: 18px;
            color: #ffc107;
        }

        .barringtons-reviews .star-rating .star {
            display: inline-block;
            margin: 0 2px;
        }

        .barringtons-reviews .review-text {
            font-style: italic;
            color: #555;
            line-height: 1.8;
            font-size: 15px;
            flex-grow: 1;
            text-align: center;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .barringtons-reviews .review-text.expanded {
            -webkit-line-clamp: unset;
            overflow: visible;
        }

        .barringtons-reviews .review-author {
            text-align: center;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }

        .barringtons-reviews .review-date {
            text-align: center;
            color: #999;
            font-size: 12px;
            margin-top: 5px;
        }

        .barringtons-reviews .read-more-btn {
            background: none;
            border: none;
            color: #4a5f7f;
            font-size: 13px;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 10px;
            padding: 0;
            display: none;
        }

        .barringtons-reviews .read-more-btn:hover {
            color: #2c3e50;
        }

        /* Slick Carousel Arrows */
        .barringtons-reviews .slick-prev,
        .barringtons-reviews .slick-next {
            width: 40px;
            height: 40px;
            background: #4a5f7f;
            border-radius: 50%;
            z-index: 1;
        }

        .barringtons-reviews .slick-prev:hover,
        .barringtons-reviews .slick-next:hover {
            background: #2c3e50;
        }

        .barringtons-reviews .slick-prev {
            left: 0;
        }

        .barringtons-reviews .slick-next {
            right: 0;
        }

        .barringtons-reviews .slick-prev:before,
        .barringtons-reviews .slick-next:before {
            font-size: 20px;
            color: white;
        }

        @media (max-width: 768px) {
            .barringtons-reviews h2 {
                font-size: 28px;
                margin-bottom: 30px;
            }

            .barringtons-reviews .review-card {
                padding: 30px 20px;
                min-height: 250px;
            }

            .barringtons-reviews .review-carousel {
                padding: 0 20px;
            }
        }
    </style>

    <div class="barringtons-reviews">
        <?php if (!empty($options['title'])): ?>
            <h2><?php echo htmlspecialchars($options['title']); ?></h2>
        <?php endif; ?>

        <div class="review-carousel" id="<?php echo $widget_id; ?>">
            <?php foreach ($reviews as $review): ?>
                <div class="review-item">
                    <div class="review-card">
                        <div class="star-rating">
                            <?php for ($i = 1; $i <= $review->rating; $i++): ?>
                                <span class="star">⭐</span>
                            <?php endfor; ?>
                        </div>

                        <div class="review-text"><?php echo htmlspecialchars($review->text); ?></div>
                        <button class="read-more-btn" type="button">Read More</button>

                        <div class="review-author"><?php echo htmlspecialchars($review->author); ?></div>
                        <?php if (!empty($review->time)): ?>
                            <div class="review-date"><?php echo date("F Y", strtotime($review->time)); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- jQuery (required for Slick Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Slick Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Reviews Widget JS -->
    <script>
    (function($) {
        'use strict';

        $(document).ready(function() {
            // Initialize Slick Carousel
            $("#<?php echo $widget_id; ?>").slick({
                slidesToShow: <?php echo (int)$options['slides_to_show']; ?>,
                slidesToScroll: 1,
                autoplay: <?php echo $options['autoplay'] ? 'true' : 'false'; ?>,
                autoplaySpeed: <?php echo (int)$options['autoplay_speed']; ?>,
                dots: false,
                arrows: true,
                infinite: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });

            // Read More/Less functionality
            $("#<?php echo $widget_id; ?> .review-card").each(function() {
                var $card = $(this);
                var $text = $card.find(".review-text");
                var $readMoreBtn = $card.find(".read-more-btn");

                // Check if text is truncated
                if ($text[0].scrollHeight > $text.outerHeight()) {
                    $readMoreBtn.show();
                }

                // Toggle read more/less
                $readMoreBtn.on("click", function(e) {
                    e.preventDefault();
                    if ($text.hasClass("expanded")) {
                        $text.removeClass("expanded");
                        $readMoreBtn.text("Read More");
                    } else {
                        $text.addClass("expanded");
                        $readMoreBtn.text("Show Less");
                    }
                });
            });
        });
    })(jQuery);
    </script>

    <?php
    return ob_get_clean();
}

// Auto-display reviews
echo display_reviews_carousel();
?>
