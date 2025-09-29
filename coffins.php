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
                <?php foreach(($content['options'] ?? []) as $index => $option): ?>
                <div class="coffin-box fade-in">
                    <div class="coffin-image">
                        <?php echo editableImage($option['image'] ?? '', "options.$index.image", $option['title'] ?? 'Coffin type', 'Coffin Image'); ?>
                    </div>
                    <h3><?php echo editable($option['title'] ?? '', "options.$index.title"); ?></h3>
                    <p><?php echo editable($option['description'] ?? '', "options.$index.description"); ?></p>
                    <p class="price"><?php echo editable($option['price'] ?? '', "options.$index.price"); ?></p>
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
        }
    </style>

<?php
// Include footer
require_once 'includes/footer.php';
?>