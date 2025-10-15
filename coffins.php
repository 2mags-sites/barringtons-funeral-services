<?php
// Coffins Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('coffins');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="coffins" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
        <?php if (IS_ADMIN): ?>
            <div class="hero-edit-overlay" onclick="editHeroImage(this)" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(37, 99, 235, 0.9); color: white; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: 500; display: none;">
                📷 Click to Change Hero Image
            </div>
        <?php endif; ?>
    </div>
        <div class="hero-overlay"></div>
        <div class="hero-content-single">
            <h1><?php echo editable($content['hero']['title'] ?? '', 'hero.title'); ?></h1>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="intro-block fade-in">
                <h2><?php echo editable($content['intro']['title'] ?? '', 'intro.title'); ?></h2>
                <p class="lead-text"><?php echo editable($content['intro']['subtitle'] ?? '', 'intro.subtitle'); ?></p>
            </div>

            <div class="coffins-grid">
                <?php
                // Map coffin types to their image directories
                $coffinTypes = [
                    'traditional' => [
                        'assets/images/coffins/traditional/light_oak_york_traditional_coffin.jpg',
                        'assets/images/coffins/traditional/mahogany_camberley_traditional_coffin-1.jpg',
                        'assets/images/coffins/traditional/medium_oak_hardwick_traditional_coffin.jpg'
                    ],
                    'eco' => [
                        'assets/images/coffins/ecological/Rattan-Coffin-02.jpg',
                        'assets/images/coffins/ecological/TRIBUTES_ENGLISH-TRADITIONAL-WILLOW-COFFIN-04.jpg',
                        'assets/images/coffins/ecological/Tributes-Ltd_bamboo-coffin-TEARDROP_02.jpg'
                    ],
                    'personalised' => [
                        'assets/images/coffins/personalised/Sweetpeas.jpg',
                        'assets/images/coffins/personalised/Horse Racing.jpg',
                        'assets/images/coffins/personalised/My Rosemary.jpg'
                    ]
                ];

                foreach(($content['options'] ?? []) as $index => $option):
                    // Determine which coffin type this is
                    $typeKey = $index === 0 ? 'traditional' : ($index === 1 ? 'eco' : 'personalised');
                ?>
                <div class="coffin-box fade-in">
                    <div class="coffin-image">
                        <?php echo editableImage($option['image'] ?? '', "options.$index.image", $option['title'] ?? 'Coffin type', 'Coffin Image'); ?>
                    </div>
                    <h3><?php echo editable($option['title'] ?? '', "options.$index.title"); ?></h3>
                    <p><?php echo editable($option['description'] ?? '', "options.$index.description"); ?></p>
                    <p class="price"><?php echo editable($option['price'] ?? '', "options.$index.price"); ?></p>
                    <button class="view-examples-btn" onclick="openLightbox('<?php echo $typeKey; ?>')">View Examples</button>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="coffins-cta fade-in">
                <p class="cta-text">
                    <?php echo editable($content['cta']['text'] ?? '', 'cta.text'); ?>
                    <a href="https://estimator.barringtonsfunerals.com/" target="_blank" class="estimator-link">
                        <?php echo editable($content['cta']['estimatorLinkText'] ?? '', 'cta.estimatorLinkText'); ?>
                    </a>
                    <?php echo editable($content['cta']['middleText'] ?? '', 'cta.middleText'); ?>
                    <a href="#contact" class="contact-link">
                        <?php echo editable($content['cta']['contactLinkText'] ?? '', 'cta.contactLinkText'); ?>
                    </a>
                    <?php echo editable($content['cta']['endText'] ?? '', 'cta.endText'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="coffinLightbox" class="lightbox-modal">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox()">&times;</button>

            <div class="lightbox-slider">
                <button class="slider-nav prev" onclick="changeSlide(-1)">&#10094;</button>

                <div class="slider-images">
                    <img id="lightboxImage" src="" alt="Coffin example">
                </div>

                <button class="slider-nav next" onclick="changeSlide(1)">&#10095;</button>
            </div>

            <div class="slider-dots" id="sliderDots"></div>

            <div class="lightbox-footer">
                <a href="https://estimator.barringtonsfunerals.com/" target="_blank" class="estimator-lightbox-link">
                    View full range in our Estimator
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Coffins Grid Styling */
        .coffins-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 3rem 0;
        }

        .coffin-box {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .coffin-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        .coffin-image {
            width: 100%;
            height: 250px;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
        }

        .coffin-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .coffin-box h3 {
            color: var(--dark-blue, #062159);
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .coffin-box p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .coffin-box .price {
            font-size: 1.2rem;
            color: var(--pink, #de3280);
            font-weight: 600;
            margin-top: 1rem;
        }

        .view-examples-btn {
            margin-top: 1rem;
            padding: 0.6rem 1.5rem;
            background: rgba(222, 50, 128, 0.1);
            color: var(--pink, #de3280);
            border: 2px solid var(--pink, #de3280);
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .view-examples-btn:hover {
            background: var(--pink, #de3280);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(222, 50, 128, 0.3);
        }

        /* CTA Section Styling */
        .coffins-cta {
            margin-top: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .cta-text {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.8;
        }

        .cta-text .estimator-link,
        .cta-text .contact-link {
            color: var(--pink, #de3280);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 0.25rem;
        }

        .cta-text .estimator-link:hover,
        .cta-text .contact-link:hover {
            color: #c02970;
            border-bottom-color: var(--pink, #de3280);
        }

        /* Lightbox Modal Styling */
        .lightbox-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            animation: fadeIn 0.3s ease;
        }

        .lightbox-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .lightbox-content {
            position: relative;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            max-width: 90%;
            max-height: 90vh;
            width: 800px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .lightbox-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2.5rem;
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .lightbox-close:hover {
            background: rgba(0, 0, 0, 0.1);
            color: var(--pink, #de3280);
        }

        .lightbox-slider {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .slider-images {
            width: 100%;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .slider-images img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            animation: imageSlide 0.3s ease;
        }

        @keyframes imageSlide {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            font-size: 2rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.3s ease;
            z-index: 10;
            color: #333;
        }

        .slider-nav:hover {
            background: var(--pink, #de3280);
            color: white;
        }

        .slider-nav.prev {
            left: 10px;
        }

        .slider-nav.next {
            right: 10px;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--pink, #de3280);
            width: 14px;
            height: 14px;
        }

        .dot:hover {
            background: #c02970;
        }

        .lightbox-footer {
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid #e0e0e0;
        }

        .estimator-lightbox-link {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: rgba(222, 50, 128, 0.1);
            color: var(--pink, #de3280);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            border: 2px solid var(--pink, #de3280);
            transition: all 0.3s ease;
        }

        .estimator-lightbox-link:hover {
            background: var(--pink, #de3280);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(222, 50, 128, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .coffins-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .coffins-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .coffin-image {
                height: 200px;
            }

            .coffins-cta {
                padding: 1.5rem;
            }

            .cta-text {
                font-size: 1rem;
            }

            .lightbox-content {
                padding: 1rem;
                max-width: 95%;
                width: 100%;
            }

            .slider-images {
                height: 300px;
            }

            .slider-nav {
                font-size: 1.5rem;
                padding: 0.3rem 0.7rem;
            }

            .slider-nav.prev {
                left: 5px;
            }

            .slider-nav.next {
                right: 5px;
            }

            .lightbox-close {
                font-size: 2rem;
                width: 35px;
                height: 35px;
                top: 0.5rem;
                right: 0.5rem;
            }

            .estimator-lightbox-link {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        // Coffin image collections
        const coffinImages = {
            traditional: [
                'assets/images/coffins/traditional/light_oak_york_traditional_coffin.jpg',
                'assets/images/coffins/traditional/mahogany_camberley_traditional_coffin-1.jpg',
                'assets/images/coffins/traditional/medium_oak_hardwick_traditional_coffin.jpg'
            ],
            eco: [
                'assets/images/coffins/ecological/Rattan-Coffin-02.jpg',
                'assets/images/coffins/ecological/TRIBUTES_ENGLISH-TRADITIONAL-WILLOW-COFFIN-04.jpg',
                'assets/images/coffins/ecological/Tributes-Ltd_bamboo-coffin-TEARDROP_02.jpg'
            ],
            personalised: [
                'assets/images/coffins/personalised/Sweetpeas.jpg',
                'assets/images/coffins/personalised/Horse Racing.jpg',
                'assets/images/coffins/personalised/My Rosemary.jpg'
            ]
        };

        let currentType = '';
        let currentIndex = 0;

        function openLightbox(type) {
            currentType = type;
            currentIndex = 0;
            const modal = document.getElementById('coffinLightbox');
            modal.classList.add('active');
            updateSlide();
            createDots();
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const modal = document.getElementById('coffinLightbox');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function changeSlide(direction) {
            const images = coffinImages[currentType];
            currentIndex += direction;

            // Loop around
            if (currentIndex < 0) {
                currentIndex = images.length - 1;
            } else if (currentIndex >= images.length) {
                currentIndex = 0;
            }

            updateSlide();
        }

        function goToSlide(index) {
            currentIndex = index;
            updateSlide();
        }

        function updateSlide() {
            const images = coffinImages[currentType];
            const img = document.getElementById('lightboxImage');
            img.src = images[currentIndex];

            // Update dots
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function createDots() {
            const images = coffinImages[currentType];
            const dotsContainer = document.getElementById('sliderDots');
            dotsContainer.innerHTML = '';

            images.forEach((_, index) => {
                const dot = document.createElement('span');
                dot.className = 'dot';
                if (index === 0) dot.classList.add('active');
                dot.onclick = () => goToSlide(index);
                dotsContainer.appendChild(dot);
            });
        }

        // Close modal when clicking outside the content
        document.getElementById('coffinLightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('coffinLightbox');
            if (modal.classList.contains('active')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeSlide(-1);
                } else if (e.key === 'ArrowRight') {
                    changeSlide(1);
                }
            }
        });

        // Touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.getElementById('coffinLightbox').addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.getElementById('coffinLightbox').addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                changeSlide(1); // Swipe left - next
            }
            if (touchEndX > touchStartX + swipeThreshold) {
                changeSlide(-1); // Swipe right - previous
            }
        }
    </script>

<?php
// Include footer
require_once 'includes/footer.php';
?>