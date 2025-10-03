<?php
// Direct Cremation Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('direct-cremation');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="direct-cremation" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
        <?php if (IS_ADMIN): ?>
            <div class="hero-edit-overlay" onclick="editHeroImage(this)" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(37, 99, 235, 0.9); color: white; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: 500; display: none;">
                📷 Click to Change Hero Image
            </div>
        <?php endif; ?>
    </div>
        <div class="hero-overlay"></div>
        <div class="hero-content-single">
            <h1><?php echo editable($content['hero']['title'] ?? '', 'hero.title'); ?></h1>
            <p class="hero-subtitle"><?php echo editable($content['hero']['subtitle'] ?? '', 'hero.subtitle'); ?></p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <!-- Service Overview -->
            <div class="service-section fade-in">
                <div class="service-content">
                    <div class="service-header">
                        <h2><?php echo editable($content['service']['title'] ?? '', 'service.title'); ?></h2>
                        <div class="service-price">
                            <span class="from-text">From</span>
                            <span class="price-amount"><?php echo editable($content['service']['price'] ?? '', 'service.price'); ?></span>
                        </div>
                    </div>

                    <div class="service-description-with-image">
                        <div class="service-description">
                            <?php echo editable($content['service']['fullDescription'] ?? '', 'service.fullDescription'); ?>
                        </div>
                        <div class="service-description-image">
                            <?php echo editableImage($content['service']['image'] ?? '', 'service.image', 'Direct Cremation Service', 'Direct Cremation'); ?>
                        </div>
                    </div>

                    <div class="service-details-grid">
                        <div class="service-included">
                            <h3>What's Included:</h3>
                            <ul>
                                <?php foreach(($content['service']['included'] ?? []) as $index => $item): ?>
                                <li><?php echo editable($item, "service.included.$index"); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="service-optional">
                            <h3>Additional Options:</h3>
                            <ul>
                                <?php foreach(($content['service']['optional'] ?? []) as $index => $item): ?>
                                <li><?php echo editable($item['name'] ?? '', "service.optional.$index.name"); ?> -
                                    <span class="price"><?php echo editable($item['price'] ?? '', "service.optional.$index.price"); ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="service-cta">
                        <a href="immediate-need.php" class="btn-primary">Arrange Direct Cremation</a>
                        <a href="https://estimator.barringtonsfunerals.com/#/" class="btn-outline" target="_blank">Launch Funeral Cost Estimator</a>
                    </div>
                </div>
            </div>

            <!-- Why Choose Direct Cremation -->
            <div class="info-section fade-in">
                <h2><?php echo editable($content['why']['title'] ?? '', 'why.title'); ?></h2>
                <div class="reasons-grid">
                    <?php foreach(($content['why']['reasons'] ?? []) as $index => $reason): ?>
                    <div class="reason-card">
                        <h3><?php echo editable($reason['title'] ?? '', "why.reasons.$index.title"); ?></h3>
                        <p><?php echo editable($reason['description'] ?? '', "why.reasons.$index.description"); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section fade-in">
                <h2><?php echo editable($content['faq']['title'] ?? '', 'faq.title'); ?></h2>
                <?php foreach(($content['faq']['questions'] ?? []) as $index => $faq): ?>
                <div class="faq-item">
                    <h3><?php echo editable($faq['question'] ?? '', "faq.questions.$index.question"); ?></h3>
                    <p><?php echo editable($faq['answer'] ?? '', "faq.questions.$index.answer"); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Next Steps -->
            <div class="next-steps fade-in">
                <h2><?php echo editable($content['next_steps']['title'] ?? '', 'next_steps.title'); ?></h2>
                <p><?php echo editable($content['next_steps']['description'] ?? '', 'next_steps.description'); ?></p>
                <div class="cta-buttons">
                    <a href="immediate-need.php" class="btn-primary">Get Started</a>
                    <a href="tel:01519281625" class="btn-outline">Call Us 24/7</a>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Direct Cremation page styles */
    .hero-subtitle {
        font-size: 1.2rem;
        margin-top: 1rem;
        opacity: 0.95;
    }

    .service-section {
        background: #fff;
        border-radius: 12px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }

    .service-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f0f0f0;
    }

    .service-header h2 {
        color: var(--navy);
        font-size: 2rem;
        margin: 0;
    }

    .service-price {
        text-align: right;
    }

    .from-text {
        display: block;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .price-amount {
        font-size: 0.9rem;
        font-weight: 700;
        color: #666;
    }

    .service-description-with-image {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2.5rem;
        align-items: start;
    }

    .service-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .service-description-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        max-height: 300px;
    }

    .service-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 2.5rem;
    }

    .service-included h3,
    .service-optional h3 {
        color: var(--navy);
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .service-included ul,
    .service-optional ul {
        list-style: none;
        padding: 0;
    }

    .service-included li,
    .service-optional li {
        padding: 0.75rem 0;
        padding-left: 2rem;
        position: relative;
        border-bottom: 1px solid #f5f5f5;
    }

    .service-included li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }

    .service-optional li:before {
        content: "+";
        position: absolute;
        left: 0;
        color: var(--pink);
        font-weight: bold;
    }

    .service-optional .price {
        color: #666;
        font-weight: 700;
        font-size: 1rem;
    }

    .service-cta {
        display: flex;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .btn-primary,
    .btn-outline {
        padding: 0.875rem 2rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-primary {
        background: var(--pink);
        color: white;
        border: 2px solid var(--pink);
    }

    .btn-primary:hover {
        background: #d14872;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(226, 103, 138, 0.3);
    }

    .service-cta .btn-outline {
        background: white !important;
        color: var(--navy) !important;
        border: 2px solid var(--navy) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }

    .service-cta .btn-outline:hover {
        background: white !important;
        color: var(--navy) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 85, 48, 0.3) !important;
    }

    .info-section {
        background: #f8f9fa;
        padding: 3rem;
        border-radius: 12px;
        margin-bottom: 3rem;
    }

    .info-section h2 {
        text-align: center;
        color: var(--navy);
        margin-bottom: 2rem;
    }

    .reasons-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .reason-card {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .reason-card h3 {
        color: var(--navy);
        margin-bottom: 1rem;
    }

    .faq-section {
        background: white;
        padding: 3rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .faq-section h2 {
        color: var(--navy) !important;
        margin-bottom: 2rem;
    }

    .faq-item {
        border-bottom: 1px solid #f0f0f0;
        padding: 1.5rem 0;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    .faq-section .faq-item h3 {
        color: var(--navy) !important;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .faq-section .faq-item p {
        color: #555 !important;
        line-height: 1.7;
    }

    .next-steps {
        background: var(--soft-navy);
        color: white;
        padding: 3rem;
        border-radius: 12px;
        text-align: center;
    }

    .next-steps h2 {
        margin-bottom: 1rem;
    }

    .next-steps p {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
    }

    .cta-buttons .btn-primary {
        background: var(--pink);
        border-color: var(--pink);
    }

    .cta-buttons .btn-outline {
        background: transparent;
        color: white;
        border-color: white;
    }

    .cta-buttons .btn-outline:hover {
        background: white;
        color: var(--soft-navy);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .service-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .service-price {
            text-align: left;
            margin-top: 1rem;
        }

        .service-description-with-image,
        .service-details-grid,
        .reasons-grid {
            grid-template-columns: 1fr;
        }

        .service-cta,
        .cta-buttons {
            flex-direction: column;
        }

        .service-section,
        .info-section,
        .faq-section,
        .next-steps {
            padding: 2rem 1.5rem;
        }
    }
    </style>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>
