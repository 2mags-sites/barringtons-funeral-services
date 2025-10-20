<?php
// Comprehensive Services Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('services-overview');

// Set page meta from JSON
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="services-overview" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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
            <div class="intro-block fade-in">
                <h2><?php echo editable($content['intro']['title'] ?? '', 'intro.title'); ?></h2>
                <p class="lead-text"><?php echo editable($content['intro']['subtitle'] ?? '', 'intro.subtitle'); ?></p>
                <div class="credentials-section">
                    <p><?php echo editable($content['intro']['credentials'] ?? '', 'intro.credentials'); ?></p>
                </div>
            </div>

            <!-- Full-width service sections -->
            <div class="services-comprehensive">

                <!-- Traditional Funeral Service -->
                <div class="service-section fade-in" id="traditional-funeral">
                    <div class="service-content">
                        <div class="service-header">
                            <h2><?php echo editable($content['services']['traditional']['title'] ?? '', 'services.traditional.title'); ?></h2>
                            <div class="service-price">
                                <span class="from-text">From</span>
                                <span class="price-amount"><?php echo editable($content['services']['traditional']['price'] ?? '', 'services.traditional.price'); ?></span>
                            </div>
                        </div>

                        <div class="service-description-with-image">
                            <div class="service-description">
                                <?php echo editable($content['services']['traditional']['fullDescription'] ?? '', 'services.traditional.fullDescription'); ?>
                            </div>
                            <div class="service-description-image">
                                <?php echo editableImage($content['services']['traditional']['image'] ?? '', 'services.traditional.image', 'Traditional Funeral Service', 'Traditional Funeral'); ?>
                            </div>
                        </div>

                        <div class="service-details-grid">
                            <div class="service-included">
                                <h3>What's Included:</h3>
                                <ul>
                                    <?php foreach(($content['services']['traditional']['included'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item, "services.traditional.included.$index"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="service-optional">
                                <h3>Optional Extras:</h3>
                                <ul>
                                    <?php foreach(($content['services']['traditional']['optional'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item['name'] ?? '', "services.traditional.optional.$index.name"); ?> -
                                        <span class="price"><?php echo editable($item['price'] ?? '', "services.traditional.optional.$index.price"); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="service-cta">
                            <a href="immediate-need.php" class="btn-primary">Arrange This Service</a>
                            <a href="https://estimator.barringtonsfunerals.com/#/" class="btn-outline" target="_blank">Launch Funeral Cost Estimator</a>
                        </div>
                    </div>
                </div>

                <!-- Contemporary Celebration Service -->
                <div class="service-section fade-in" id="contemporary-celebration">
                    <div class="service-content">
                        <div class="service-header">
                            <h2><?php echo editable($content['services']['contemporary']['title'] ?? '', 'services.contemporary.title'); ?></h2>
                            <div class="service-price">
                                <span class="from-text">From</span>
                                <span class="price-amount"><?php echo editable($content['services']['contemporary']['price'] ?? '', 'services.contemporary.price'); ?></span>
                            </div>
                        </div>

                        <div class="service-description-with-image">
                            <div class="service-description">
                                <?php echo editable($content['services']['contemporary']['fullDescription'] ?? '', 'services.contemporary.fullDescription'); ?>
                            </div>
                            <div class="service-description-image">
                                <?php echo editableImage($content['services']['contemporary']['image'] ?? '', 'services.contemporary.image', 'Contemporary Celebration Service', 'Contemporary Celebration'); ?>
                            </div>
                        </div>

                        <div class="service-details-grid">
                            <div class="service-included">
                                <h3>What's Included:</h3>
                                <ul>
                                    <?php foreach(($content['services']['contemporary']['included'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item, "services.contemporary.included.$index"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="service-optional">
                                <h3>Personalisation Options:</h3>
                                <ul>
                                    <?php foreach(($content['services']['contemporary']['optional'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item['name'] ?? '', "services.contemporary.optional.$index.name"); ?> -
                                        <span class="price"><?php echo editable($item['price'] ?? '', "services.contemporary.optional.$index.price"); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="service-cta">
                            <a href="immediate-need.php" class="btn-primary">Arrange This Service</a>
                            <a href="https://estimator.barringtonsfunerals.com/#/" class="btn-outline" target="_blank">Launch Funeral Cost Estimator</a>
                        </div>
                    </div>
                </div>

                <!-- Green Funeral Service -->
                <div class="service-section fade-in" id="green-funeral">
                    <div class="service-content">
                        <div class="service-header">
                            <h2><?php echo editable($content['services']['green']['title'] ?? '', 'services.green.title'); ?></h2>
                            <div class="service-price">
                                <span class="from-text">From</span>
                                <span class="price-amount"><?php echo editable($content['services']['green']['price'] ?? '', 'services.green.price'); ?></span>
                            </div>
                        </div>

                        <div class="service-description-with-image">
                            <div class="service-description">
                                <?php echo editable($content['services']['green']['fullDescription'] ?? '', 'services.green.fullDescription'); ?>
                            </div>
                            <div class="service-description-image">
                                <?php echo editableImage($content['services']['green']['image'] ?? '', 'services.green.image', 'Green Funeral Service', 'Green Funeral'); ?>
                            </div>
                        </div>

                        <div class="service-details-grid">
                            <div class="service-included">
                                <h3>Eco-Friendly Features:</h3>
                                <ul>
                                    <?php foreach(($content['services']['green']['included'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item, "services.green.included.$index"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="service-optional">
                                <h3>Green Options:</h3>
                                <ul>
                                    <?php foreach(($content['services']['green']['optional'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item['name'] ?? '', "services.green.optional.$index.name"); ?> -
                                        <span class="price"><?php echo editable($item['price'] ?? '', "services.green.optional.$index.price"); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="green-certification">
                            <p><strong>Environmental Commitment:</strong> <?php echo editable($content['services']['green']['commitment'] ?? '', 'services.green.commitment'); ?></p>
                        </div>

                        <div class="service-cta">
                            <a href="immediate-need.php" class="btn-primary">Arrange Green Funeral</a>
                            <a href="https://estimator.barringtonsfunerals.com/#/" class="btn-outline" target="_blank">Launch Funeral Cost Estimator</a>
                        </div>
                    </div>
                </div>

                <!-- Religious Service -->
                <div class="service-section fade-in" id="religious-service">
                    <div class="service-content">
                        <div class="service-header">
                            <h2><?php echo editable($content['services']['religious']['title'] ?? '', 'services.religious.title'); ?></h2>
                            <div class="service-price">
                                <span class="from-text">From</span>
                                <span class="price-amount"><?php echo editable($content['services']['religious']['price'] ?? '', 'services.religious.price'); ?></span>
                            </div>
                        </div>

                        <div class="service-description-with-image">
                            <div class="service-description">
                                <?php echo editable($content['services']['religious']['fullDescription'] ?? '', 'services.religious.fullDescription'); ?>
                            </div>
                            <div class="service-description-image">
                                <?php echo editableImage($content['services']['religious']['image'] ?? '', 'services.religious.image', 'Religious Funeral Service', 'Religious Service'); ?>
                            </div>
                        </div>

                        <div class="service-details-grid">
                            <div class="service-included">
                                <h3>Service Includes:</h3>
                                <ul>
                                    <?php foreach(($content['services']['religious']['included'] ?? []) as $index => $item): ?>
                                    <li><?php echo editable($item, "services.religious.included.$index"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="service-optional">
                                <h3>Faith-Specific Options:</h3>
                                <ul>
                                    <?php foreach(($content['services']['religious']['faiths'] ?? []) as $index => $faith): ?>
                                    <li><?php echo editable($faith, "services.religious.faiths.$index"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="service-cta">
                            <a href="immediate-need.php" class="btn-primary">Arrange Religious Service</a>
                            <a href="https://estimator.barringtonsfunerals.com/#/" class="btn-outline" target="_blank">Launch Funeral Cost Estimator</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Additional Services Section -->
            <div class="additional-services-comprehensive fade-in">
                <h2><?php echo editable($content['additional']['title'] ?? '', 'additional.title'); ?></h2>
                <p class="section-subtitle"><?php echo editable($content['additional']['subtitle'] ?? '', 'additional.subtitle'); ?></p>

                <div class="additional-services-grid">
                    <?php foreach(($content['additional']['services'] ?? []) as $key => $service): ?>
                    <?php if (isset($service['link'])): ?>
                    <a href="<?php echo $service['link']; ?>" class="additional-service-card additional-service-link">
                        <h3><?php echo editable($service['title'] ?? '', "additional.services.$key.title"); ?></h3>
                        <p><?php echo editable($service['description'] ?? '', "additional.services.$key.description"); ?></p>
                        <p class="service-price"><?php echo editable($service['price'] ?? '', "additional.services.$key.price"); ?></p>
                    </a>
                    <?php else: ?>
                    <div class="additional-service-card">
                        <h3><?php echo editable($service['title'] ?? '', "additional.services.$key.title"); ?></h3>
                        <p><?php echo editable($service['description'] ?? '', "additional.services.$key.description"); ?></p>
                        <p class="service-price"><?php echo editable($service['price'] ?? '', "additional.services.$key.price"); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="payment-options fade-in">
                <h2><?php echo editable($content['payment']['title'] ?? '', 'payment.title'); ?></h2>
                <div class="payment-grid">
                    <div class="payment-option">
                        <h3><?php echo editable($content['payment']['options']['immediate']['title'] ?? '', 'payment.options.immediate.title'); ?></h3>
                        <p><?php echo editable($content['payment']['options']['immediate']['description'] ?? '', 'payment.options.immediate.description'); ?></p>
                    </div>
                    <div class="payment-option">
                        <h3><?php echo editable($content['payment']['options']['installment']['title'] ?? '', 'payment.options.installment.title'); ?></h3>
                        <p><?php echo editable($content['payment']['options']['installment']['description'] ?? '', 'payment.options.installment.description'); ?></p>
                    </div>
                    <div class="payment-option">
                        <h3><?php echo editable($content['payment']['options']['prepaid']['title'] ?? '', 'payment.options.prepaid.title'); ?></h3>
                        <p><?php echo editable($content['payment']['options']['prepaid']['description'] ?? '', 'payment.options.prepaid.description'); ?></p>
                    </div>
                </div>
                <p class="payment-note"><?php echo editable($content['payment']['note'] ?? '', 'payment.note'); ?></p>
            </div>
        </div>
    </section>

    <style>
    /* Comprehensive services page styles */
    .hero-subtitle {
        font-size: 1.2rem;
        margin-top: 1rem;
        opacity: 0.95;
    }

    .services-comprehensive {
        margin-top: 3rem;
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
        text-align: center;
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

    .green-certification {
        background: #f0f9f4;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border-left: 4px solid #28a745;
    }

    .additional-services-comprehensive {
        background: #fafafa;
        padding: 3rem;
        border-radius: 12px;
        margin-top: 3rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 2rem;
    }

    .additional-services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    .additional-service-card {
        background: white;
        padding: 1.5rem 1.25rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .additional-service-link {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .additional-service-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .additional-service-card h3 {
        color: var(--navy);
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
    }

    .additional-service-card .service-price {
        color: #666;
        font-weight: 700;
        margin-top: 0.75rem;
    }

    .payment-options {
        margin-top: 3rem;
        padding: 3rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .payment-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    .payment-option {
        padding: 1.5rem 1.25rem;
        background: #fafafa;
        border-radius: 8px;
    }

    .payment-option h3 {
        color: var(--navy);
        margin-bottom: 0.75rem;
    }

    .payment-note {
        margin-top: 2rem;
        padding: 1rem;
        background: #fff9e6;
        border-radius: 8px;
        color: #856404;
        text-align: center;
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
        .additional-services-grid,
        .payment-grid {
            grid-template-columns: 1fr;
        }

        .service-cta {
            flex-direction: column;
        }

        .service-section {
            padding: 2rem 1rem;
        }

        .additional-services-comprehensive {
            padding: 2rem 1rem;
        }

        .payment-options {
            padding: 2rem 1rem;
        }

        .additional-service-card,
        .payment-option {
            padding: 1.5rem 1rem;
        }
    }
    </style>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>