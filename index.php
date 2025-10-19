<?php
// Homepage
require_once 'includes/admin-config.php';

// Load content from JSON
$content = loadContent('index');

// Business info for schema markup from JSON
$business_info = $content['business_info'] ?? [];

// Set page meta from JSON
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="hero">
        <div class="hero-image"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-card">
                <h2><?php echo editable($content['hero']['card1']['title'] ?? '', 'hero.card1.title'); ?></h2>
                <p><?php echo editable($content['hero']['card1']['description'] ?? '', 'hero.card1.description'); ?></p>
                <button class="hero-btn" onclick="window.location.href='immediate-need.php'"><?php echo $content['hero']['card1']['buttonText'] ?? ''; ?></button>
            </div>
            <div class="hero-card">
                <h2><?php echo editable($content['hero']['card2']['title'] ?? '', 'hero.card2.title'); ?></h2>
                <p><?php echo editable($content['hero']['card2']['description'] ?? '', 'hero.card2.description'); ?></p>
                <button class="hero-btn" onclick="window.location.href='planning-ahead.php'"><?php echo $content['hero']['card2']['buttonText'] ?? ''; ?></button>
            </div>
        </div>
    </section>

    <section class="reviews-section">
        <h2><?php echo editable($content['reviews']['title'] ?? '', 'reviews.title'); ?></h2>
        <div class="reviews-carousel">
            <button class="carousel-btn carousel-btn-left" onclick="scrollReviews(-1)">‹</button>
            <div class="reviews-container">
                <div class="reviews-track">
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text"><?php echo editable($content['reviews']['review1']['text'] ?? '', 'reviews.review1.text'); ?></p>
                        <p class="review-author"><?php echo editable($content['reviews']['review1']['author'] ?? '', 'reviews.review1.author'); ?></p>
                        <p class="review-source"><?php echo $content['reviews']['review1']['source'] ?? ''; ?></p>
                    </div>
                    <div class="review-card">
                        <div class="stars">★★★★★</div>
                        <p class="review-text"><?php echo editable($content['reviews']['review2']['text'] ?? '', 'reviews.review2.text'); ?></p>
                        <p class="review-author"><?php echo editable($content['reviews']['review2']['author'] ?? '', 'reviews.review2.author'); ?></p>
                        <p class="review-source"><?php echo $content['reviews']['review2']['source'] ?? ''; ?></p>
                    </div>
                </div>
            </div>
            <button class="carousel-btn carousel-btn-right" onclick="scrollReviews(1)">›</button>
        </div>
    </section>

    <section class="family-section">
        <div class="family-content">
            <div class="family-text">
                <h2><?php echo editable($content['family']['title'] ?? '', 'family.title'); ?></h2>
                <p><?php echo editable($content['family']['description1'] ?? '', 'family.description1'); ?></p>
                <p><?php echo editable($content['family']['description2'] ?? '', 'family.description2'); ?></p>
                <div class="accreditation-logos">
                    <img src="assets/images/pers_nafd.png" alt="NAFD Member" />
                    <img src="assets/images/pers_SAIF.png" alt="SAIF Member" />
                    <img src="assets/images/pers_agfd-logo.jpg" alt="Association of Green Funeral Directors" />
                    <img src="assets/images/pers_good-funeral-guide.jpg" alt="Good Funeral Guide Recommended" />
                    <img src="assets/images/pers_green.jpg" alt="Green Funeral Provider" />
                </div>
            </div>
            <div class="family-image">
                <div id="youtube-placeholder" style="width: 100%; height: 100%; border-radius: 15px; background: #000; position: relative; cursor: pointer; overflow: hidden;">
                    <!-- YouTube thumbnail -->
                    <img src="https://img.youtube.com/vi/wvL8x-ny-1g/maxresdefault.jpg"
                         alt="Barrington Family Video Thumbnail"
                         style="width: 100%; height: 100%; object-fit: cover;">
                    <!-- Play button overlay -->
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80px; height: 80px; background: rgba(0,0,0,0.8); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 40px; height: 40px; fill: white; margin-left: 5px;" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <!-- Click to play text -->
                    <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: white; background: rgba(0,0,0,0.7); padding: 8px 16px; border-radius: 20px; font-size: 14px;">
                        <?php echo $content['video']['click_to_play'] ?? ''; ?>
                    </div>
                </div>
                <!-- Hidden iframe to be loaded on click -->
                <iframe
                    id="youtube-iframe"
                    data-src="https://www.youtube.com/embed/wvL8x-ny-1g?autoplay=1"
                    style="width: 100%; height: 100%; border-radius: 15px; border: none; display: none;"
                    title="<?php echo htmlspecialchars($content['video']['title'] ?? ''); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <section class="services-section" id="services">
        <div class="container">
            <h2><?php echo editable($content['services']['title'] ?? '', 'services.title'); ?></h2>
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-image">
                        <?php
                        $img = editableImage($content['services']['service1']['image'] ?? '', 'services.service1.image', 'Funeral arrangement consultation', 'Arrange a Funeral');
                        echo str_replace('<img ', '<img style="width: 100%; height: 100%; object-fit: cover;" ', $img);
                        ?>
                    </div>
                    <div class="service-content">
                        <h3><?php echo editable($content['services']['service1']['title'] ?? '', 'services.service1.title'); ?></h3>
                        <p><?php echo editable($content['services']['service1']['description'] ?? '', 'services.service1.description'); ?></p>
                    </div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-image">
                        <?php
                        $img = editableImage($content['services']['service2']['image'] ?? '', 'services.service2.image', 'Funeral cost estimation', 'Funeral Estimator');
                        echo str_replace('<img ', '<img style="width: 100%; height: 100%; object-fit: cover;" ', $img);
                        ?>
                    </div>
                    <div class="service-content">
                        <h3><?php echo editable($content['services']['service2']['title'] ?? '', 'services.service2.title'); ?></h3>
                        <p><?php echo editable($content['services']['service2']['description'] ?? '', 'services.service2.description'); ?></p>
                    </div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-image">
                        <?php
                        $img = editableImage($content['services']['service3']['image'] ?? '', 'services.service3.image', 'Funeral pre-planning consultation', 'Plan Ahead');
                        echo str_replace('<img ', '<img style="width: 100%; height: 100%; object-fit: cover;" ', $img);
                        ?>
                    </div>
                    <div class="service-content">
                        <h3><?php echo editable($content['services']['service3']['title'] ?? '', 'services.service3.title'); ?></h3>
                        <p><?php echo editable($content['services']['service3']['description'] ?? '', 'services.service3.description'); ?></p>
                    </div>
                </div>
                <div class="service-card fade-in">
                    <div class="service-image">
                        <?php
                        $img = editableImage($content['services']['service4']['image'] ?? '', 'services.service4.image', 'Memorial masonry services', 'Memorial Masonry');
                        echo str_replace('<img ', '<img style="width: 100%; height: 100%; object-fit: cover;" ', $img);
                        ?>
                    </div>
                    <div class="service-content">
                        <h3><?php echo editable($content['services']['service4']['title'] ?? '', 'services.service4.title'); ?></h3>
                        <p><?php echo editable($content['services']['service4']['description'] ?? '', 'services.service4.description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="branches-section">
        <div class="container">
            <h2><?php echo editable($content['branches']['title'] ?? '', 'branches.title'); ?></h2>
            <p><?php echo editable($content['branches']['subtitle'] ?? '', 'branches.subtitle'); ?></p>
            <div class="branches-grid">
                <?php foreach(($content['branches']['locations'] ?? []) as $index => $branch): ?>
                <div class="branch-card fade-in">
                    <div class="branch-image">
                        <?php
                        $img = editableImage($branch['image'] ?? '', "branches.locations.$index.image", $branch['name'] . ' branch exterior', $branch['name'] . ' Branch');
                        // Add style attribute to the image
                        echo str_replace('<img ', '<img style="width: 100%; height: 200px; object-fit: cover;" ', $img);
                        ?>
                    </div>
                    <div class="branch-info">
                        <h3><?php echo editable($branch['name'] ?? '', "branches.locations.$index.name"); ?></h3>
                        <p><strong><?php echo $content['branches']['labels']['address'] ?? ''; ?></strong> <?php echo editable($branch['address'] ?? '', "branches.locations.$index.address"); ?></p>
                        <p><strong><?php echo $content['branches']['labels']['phone'] ?? ''; ?></strong> <?php echo editable($branch['phone'] ?? '', "branches.locations.$index.phone"); ?></p>
                        <p><strong><?php echo $content['branches']['labels']['hours'] ?? ''; ?></strong> <?php echo editable($branch['hours'] ?? '', "branches.locations.$index.hours"); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-preview-section">
        <div class="container">
            <h2><?php echo editable($content['blog']['title'] ?? '', 'blog.title'); ?></h2>
            <p class="blog-subtitle"><?php echo editable($content['blog']['subtitle'] ?? '', 'blog.subtitle'); ?></p>

            <?php
            // Include blog fetcher
            require_once 'includes/blog-fetcher.php';

            // Fetch latest 3 posts
            $latest_posts = fetchLatestBlogPosts(3);

            if ($latest_posts && count($latest_posts) > 0): ?>
                <div class="blog-preview-grid">
                    <?php foreach ($latest_posts as $post): ?>
                        <div class="blog-preview-card fade-in">
                            <?php if ($post['featured_image']): ?>
                                <div class="blog-preview-image">
                                    <img src="<?php echo $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="blog-preview-content">
                                <h3><?php echo $post['title']; ?></h3>
                                <a href="<?php echo $post['link']; ?>" class="read-post-btn">Read Post</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="blog-view-all">
                    <a href="blog-news.php" class="btn-primary"><?php echo editable($content['blog']['view_all'] ?? '', 'blog.view_all'); ?></a>
                </div>
            <?php else: ?>
                <div class="blog-coming-soon">
                    <p><?php echo editable($content['blog']['coming_soon'] ?? '', 'blog.coming_soon'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <style>
        .blog-preview-section {
            padding: 60px 0;
            background: white;
        }

        .blog-preview-section h2 {
            text-align: center;
            color: var(--text-dark);
            font-size: 36px;
            margin-bottom: 10px;
        }

        .blog-subtitle {
            text-align: center;
            color: var(--text-body);
            font-size: 18px;
            margin-bottom: 40px;
        }

        .blog-preview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 40px;
        }

        .blog-preview-card {
            background: var(--cream);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .blog-preview-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .blog-preview-image {
            height: 200px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--soft-navy), var(--navy));
        }

        .blog-preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-preview-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .blog-preview-content h3 {
            color: var(--text-dark);
            font-size: 18px;
            margin: 0;
            line-height: 1.3;
            font-weight: normal;
            flex-grow: 1;
        }

        .read-post-btn {
            display: inline-block;
            background: var(--navy);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }

        .read-post-btn:hover {
            background: var(--soft-navy);
            transform: translateY(-2px);
        }

        .blog-view-all {
            text-align: center;
        }

        .btn-primary {
            display: inline-block;
            background: var(--navy);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--soft-navy);
        }

        .blog-coming-soon {
            text-align: center;
            padding: 40px;
            background: var(--cream);
            border-radius: 15px;
            color: var(--text-body);
        }

        @media (max-width: 768px) {
            .blog-preview-grid {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

    <script>
    // Lazy load YouTube video
    document.addEventListener('DOMContentLoaded', function() {
        const placeholder = document.getElementById('youtube-placeholder');
        const iframe = document.getElementById('youtube-iframe');

        if (placeholder && iframe) {
            placeholder.addEventListener('click', function() {
                // Set the iframe src from data-src
                iframe.src = iframe.dataset.src;
                // Hide placeholder and show iframe
                placeholder.style.display = 'none';
                iframe.style.display = 'block';
            });
        }
    });
    </script>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>