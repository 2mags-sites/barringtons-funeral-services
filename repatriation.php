<?php
// Repatriation Services Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('repatriation');

// Set page meta from JSON
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="repatriation" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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
            <!-- Introduction Section -->
            <div class="intro-block fade-in">
                <h2><?php echo editable($content['intro']['title'] ?? '', 'intro.title'); ?></h2>
                <p class="lead-text"><?php echo editable($content['intro']['subtitle'] ?? '', 'intro.subtitle'); ?></p>
                <div class="intro-with-image">
                    <div class="intro-content">
                        <?php echo editable($content['intro']['description'] ?? '', 'intro.description'); ?>
                    </div>
                    <div class="intro-image">
                        <?php echo editableImage($content['intro']['image'] ?? '/assets/images/uploads/img_68cd78c7966ab_1758296263.jpg', 'intro.image', 'International repatriation support', 'Repatriation Services'); ?>
                    </div>
                </div>
            </div>

            <!-- Two Types of Repatriation -->
            <div class="repatriation-types fade-in">
                <h2><?php echo editable($content['types']['title'] ?? '', 'types.title'); ?></h2>

                <div class="type-grid">
                    <div class="type-card">
                        <h3><?php echo editable($content['types']['incoming']['title'] ?? '', 'types.incoming.title'); ?></h3>
                        <p><?php echo editable($content['types']['incoming']['description'] ?? '', 'types.incoming.description'); ?></p>
                        <h4>Our Service Includes:</h4>
                        <ul>
                            <?php foreach(($content['types']['incoming']['services'] ?? []) as $index => $service): ?>
                            <li><?php echo editable($service, "types.incoming.services.$index"); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="price-box">
                            <span class="price-label">Typical costs from</span>
                            <span class="price-amount"><?php echo editable($content['types']['incoming']['price'] ?? '', 'types.incoming.price'); ?></span>
                        </div>
                    </div>

                    <div class="type-card">
                        <h3><?php echo editable($content['types']['outgoing']['title'] ?? '', 'types.outgoing.title'); ?></h3>
                        <p><?php echo editable($content['types']['outgoing']['description'] ?? '', 'types.outgoing.description'); ?></p>
                        <h4>Our Service Includes:</h4>
                        <ul>
                            <?php foreach(($content['types']['outgoing']['services'] ?? []) as $index => $service): ?>
                            <li><?php echo editable($service, "types.outgoing.services.$index"); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="price-box">
                            <span class="price-label">Typical costs from</span>
                            <span class="price-amount"><?php echo editable($content['types']['outgoing']['price'] ?? '', 'types.outgoing.price'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Process Section -->
            <div class="process-section fade-in">
                <h2><?php echo editable($content['process']['title'] ?? '', 'process.title'); ?></h2>
                <p class="section-intro"><?php echo editable($content['process']['intro'] ?? '', 'process.intro'); ?></p>

                <div class="process-steps">
                    <?php foreach(($content['process']['steps'] ?? []) as $index => $step): ?>
                    <div class="process-step">
                        <div class="step-number"><?php echo $index + 1; ?></div>
                        <div class="step-content">
                            <h4><?php echo editable($step['title'] ?? '', "process.steps.$index.title"); ?></h4>
                            <p><?php echo editable($step['description'] ?? '', "process.steps.$index.description"); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Documentation Required -->
            <div class="documentation-section fade-in">
                <h2><?php echo editable($content['documentation']['title'] ?? '', 'documentation.title'); ?></h2>
                <p class="section-intro"><?php echo editable($content['documentation']['intro'] ?? '', 'documentation.intro'); ?></p>

                <div class="doc-grid">
                    <div class="doc-card">
                        <h3><?php echo editable($content['documentation']['uk']['title'] ?? '', 'documentation.uk.title'); ?></h3>
                        <ul>
                            <?php foreach(($content['documentation']['uk']['documents'] ?? []) as $index => $doc): ?>
                            <li><?php echo editable($doc, "documentation.uk.documents.$index"); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="doc-card">
                        <h3><?php echo editable($content['documentation']['international']['title'] ?? '', 'documentation.international.title'); ?></h3>
                        <ul>
                            <?php foreach(($content['documentation']['international']['documents'] ?? []) as $index => $doc): ?>
                            <li><?php echo editable($doc, "documentation.international.documents.$index"); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Countries We Serve -->
            <div class="countries-section fade-in">
                <h2><?php echo editable($content['countries']['title'] ?? '', 'countries.title'); ?></h2>
                <p class="section-intro"><?php echo editable($content['countries']['intro'] ?? '', 'countries.intro'); ?></p>

                <div class="countries-grid">
                    <?php foreach(($content['countries']['regions'] ?? []) as $key => $region): ?>
                    <div class="region-card">
                        <h4><?php echo editable($region['name'] ?? '', "countries.regions.$key.name"); ?></h4>
                        <p><?php echo editable($region['countries'] ?? '', "countries.regions.$key.countries"); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Special Considerations -->
            <div class="considerations-section fade-in">
                <h2><?php echo editable($content['considerations']['title'] ?? '', 'considerations.title'); ?></h2>

                <div class="consideration-cards">
                    <?php foreach(($content['considerations']['items'] ?? []) as $key => $item): ?>
                    <div class="consideration-card">
                        <h3><?php echo editable($item['title'] ?? '', "considerations.items.$key.title"); ?></h3>
                        <p><?php echo editable($item['description'] ?? '', "considerations.items.$key.description"); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Support Section -->
            <div class="support-section fade-in">
                <h2><?php echo editable($content['support']['title'] ?? '', 'support.title'); ?></h2>
                <div class="support-content">
                    <p><?php echo editable($content['support']['description'] ?? '', 'support.description'); ?></p>
                    <div class="support-features">
                        <?php foreach(($content['support']['features'] ?? []) as $index => $feature): ?>
                        <div class="support-feature">
                            <div class="feature-icon">✓</div>
                            <p><?php echo editable($feature, "support.features.$index"); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section fade-in">
                <h2><?php echo editable($content['faq']['title'] ?? '', 'faq.title'); ?></h2>

                <div class="faq-items">
                    <?php foreach(($content['faq']['items'] ?? []) as $index => $item): ?>
                    <div class="faq-item">
                        <h3 class="faq-question"><?php echo editable($item['question'] ?? '', "faq.items.$index.question"); ?></h3>
                        <div class="faq-answer">
                            <p><?php echo editable($item['answer'] ?? '', "faq.items.$index.answer"); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="cta-section fade-in">
                <h2><?php echo editable($content['cta']['title'] ?? '', 'cta.title'); ?></h2>
                <p><?php echo editable($content['cta']['description'] ?? '', 'cta.description'); ?></p>
                <div class="cta-buttons">
                    <a href="#contact" class="btn-primary">Get Emergency Assistance</a>
                    <a href="tel:<?php echo $business_info['phone']; ?>" class="btn-outline">Call Us Now</a>
                </div>
                <p class="helpline-text"><?php echo editable($content['cta']['helpline'] ?? '', 'cta.helpline'); ?></p>
            </div>
        </div>
    </section>

    <style>
    /* Repatriation Page Styles */
    .hero-subtitle {
        font-size: 1.2rem;
        margin-top: 1rem;
        opacity: 0.95;
    }

    .intro-with-image {
        display: grid;
        grid-template-columns: 3fr 2fr;
        gap: 3rem;
        align-items: center;
        margin-top: 2rem;
    }

    .intro-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        width: 100%;
    }

    .intro-content p {
        margin: 0;
        padding: 0;
    }

    /* Fix for editable content display */
    .intro-content .editable-field,
    .intro-content [contenteditable] {
        display: block;
        width: 100%;
        min-width: 100%;
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .intro-image img {
        width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .repatriation-types {
        margin-top: 3rem;
    }

    .type-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }

    .type-card {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }

    .type-card h3 {
        color: var(--primary-navy);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .type-card h4 {
        color: var(--primary-navy);
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .type-card ul {
        list-style: none;
        padding: 0;
    }

    .type-card li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
    }

    .type-card li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }

    .price-box {
        background: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
        margin-top: 1.5rem;
        text-align: center;
    }

    .price-label {
        display: block;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .price-amount {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--pink);
    }

    /* Process Section */
    .process-section {
        margin-top: 3rem;
        background: #fafafa;
        padding: 3rem;
        border-radius: 12px;
    }

    .section-intro {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 2rem;
    }

    .process-steps {
        margin-top: 2rem;
    }

    .process-step {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .step-number {
        width: 40px;
        height: 40px;
        background: var(--pink);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
        margin-right: 1.5rem;
    }

    .step-content h4 {
        color: var(--primary-navy);
        margin-bottom: 0.5rem;
    }

    /* Documentation Section */
    .documentation-section {
        margin-top: 3rem;
    }

    .doc-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }

    .doc-card {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .doc-card h3 {
        color: var(--primary-navy);
        margin-bottom: 1rem;
    }

    .doc-card ul {
        list-style: none;
        padding: 0;
    }

    .doc-card li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
        border-bottom: 1px solid #f5f5f5;
    }

    .doc-card li:before {
        content: "📄";
        position: absolute;
        left: 0;
    }

    /* Countries Section */
    .countries-section {
        margin-top: 3rem;
        background: #f9f9f9;
        padding: 3rem;
        border-radius: 12px;
    }

    .countries-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .region-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
    }

    .region-card h4 {
        color: var(--primary-navy);
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .region-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Considerations Section */
    .considerations-section {
        margin-top: 3rem;
    }

    .consideration-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    .consideration-card {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        border-left: 4px solid var(--pink);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .consideration-card h3 {
        color: var(--primary-navy);
        margin-bottom: 1rem;
    }

    /* Support Section */
    .support-section {
        margin-top: 3rem;
        background: #e8f4e8;
        padding: 3rem;
        border-radius: 12px;
    }

    .support-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .support-feature {
        display: flex;
        align-items: center;
    }

    .feature-icon {
        width: 30px;
        height: 30px;
        background: #28a745;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    /* FAQ Section */
    .faq-section {
        margin-top: 3rem;
    }

    .faq-items {
        margin-top: 2rem;
    }

    .faq-item {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .faq-question {
        color: #1a3a52 !important;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .faq-answer {
        color: #666;
        line-height: 1.8;
    }

    /* CTA Section */
    .cta-section {
        margin-top: 3rem;
        text-align: center;
        padding: 3rem;
        background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);
        border-radius: 12px;
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin: 2rem 0;
    }

    .helpline-text {
        font-size: 1.2rem;
        color: var(--pink);
        font-weight: 600;
        margin-top: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .intro-with-image {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .intro-image {
            order: -1; /* Show image first on mobile */
        }

        .type-grid,
        .doc-grid,
        .consideration-cards,
        .support-features {
            grid-template-columns: 1fr;
        }

        .countries-section {
            padding: 2rem 1rem;
        }

        .countries-grid {
            grid-template-columns: 1fr;
        }

        .region-card {
            padding: 1.5rem 1rem;
        }

        .process-section,
        .support-section {
            padding: 2rem 1rem;
        }

        .cta-section {
            padding: 2rem 1rem;
        }

        .faq-item {
            padding: 1.5rem 1rem;
        }

        .type-card,
        .doc-card,
        .consideration-card {
            padding: 1.5rem 1rem;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .process-step {
            flex-direction: column;
        }

        .step-number {
            margin-bottom: 1rem;
        }
    }
    </style>

<?php
// Include footer
require_once 'includes/footer.php';
?>