<?php
// Standardised Price List Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('standardised-price-list');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="standardised-price-list" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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
            <div class="intro-section fade-in">
                <h2><?php echo editable($content['intro']['title'] ?? '', 'intro.title'); ?></h2>
                <p><?php echo editable($content['intro']['paragraphs'][0] ?? '', 'intro.paragraphs.0'); ?></p>

                <p><?php echo editable($content['intro']['paragraphs'][1] ?? '', 'intro.paragraphs.1'); ?></p>

                <p><?php echo editable($content['intro']['paragraphs'][2] ?? '', 'intro.paragraphs.2'); ?></p>
            </div>

            <div class="price-notice fade-in">
                <p class="date-notice"><?php echo editable($content['price_notice']['date'] ?? '', 'price_notice.date'); ?></p>
                <h2><?php echo editable($content['price_notice']['title'] ?? '', 'price_notice.title'); ?></h2>
                <p><?php echo editable($content['price_notice']['description'] ?? '', 'price_notice.description'); ?></p>
            </div>

            <div class="price-section fade-in">
                <h2><?php echo editable($content['attended_funeral']['title'] ?? '', 'attended_funeral.title'); ?> <span class="subtitle"><?php echo editable($content['attended_funeral']['subtitle'] ?? '', 'attended_funeral.subtitle'); ?></span></h2>
                <p class="section-description"><?php echo editable($content['attended_funeral']['description'] ?? '', 'attended_funeral.description'); ?></p>

                <table class="price-table">
                    <tbody>
                        <?php if (isset($content['attended_funeral']['items']) && is_array($content['attended_funeral']['items'])): ?>
                            <?php foreach ($content['attended_funeral']['items'] as $index => $item): ?>
                        <tr>
                            <td class="service-description"><?php echo editable($item['description'] ?? '', "attended_funeral.items.{$index}.description"); ?></td>
                            <td class="price"><?php echo editable($item['price'] ?? '', "attended_funeral.items.{$index}.price"); ?></td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr class="total-row">
                            <td class="service-description total"></td>
                            <td class="price total"><?php echo editable($content['attended_funeral']['total'] ?? '', 'attended_funeral.total'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="price-section fade-in">
                <h2><?php echo editable($content['unattended_funeral']['title'] ?? '', 'unattended_funeral.title'); ?></h2>
                <p class="section-description"><?php echo editable($content['unattended_funeral']['description'] ?? '', 'unattended_funeral.description'); ?></p>

                <table class="price-table">
                    <tbody>
                        <?php if (isset($content['unattended_funeral']['items']) && is_array($content['unattended_funeral']['items'])): ?>
                            <?php foreach ($content['unattended_funeral']['items'] as $index => $item): ?>
                        <tr>
                            <td class="service-description"><?php echo editable($item['description'] ?? '', "unattended_funeral.items.{$index}.description"); ?></td>
                            <td class="price"><?php echo editable($item['price'] ?? '', "unattended_funeral.items.{$index}.price"); ?></td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="fees-section fade-in">
                <h2><?php echo editable($content['fees']['title'] ?? '', 'fees.title'); ?></h2>

                <div class="fee-item">
                    <p><strong><?php echo editable($content['fees']['burial']['title'] ?? '', 'fees.burial.title'); ?><sup>1</sup></strong><br>
                    In this local area, the typical cost of the burial fee is: <strong><?php echo editable($content['fees']['burial']['cost_range'] ?? '', 'fees.burial.cost_range'); ?></strong></p>

                    <p class="fee-note"><?php echo editable($content['fees']['burial']['note'] ?? '', 'fees.burial.note'); ?></p>
                </div>

                <div class="fee-item">
                    <p><strong><?php echo editable($content['fees']['cremation']['title'] ?? '', 'fees.cremation.title'); ?></strong><br>
                    In this local area, the typical cost of a cremation is: <strong><?php echo editable($content['fees']['cremation']['cost_range'] ?? '', 'fees.cremation.cost_range'); ?></strong></p>
                </div>

                <p class="notice"><?php echo editable($content['fees']['notice'] ?? '', 'fees.notice'); ?></p>
            </div>

            <div class="price-section fade-in">
                <h2><?php echo editable($content['additional_services']['title'] ?? '', 'additional_services.title'); ?></h2>
                <p class="section-description"><?php echo editable($content['additional_services']['description'] ?? '', 'additional_services.description'); ?></p>

                <table class="price-table">
                    <tbody>
                        <?php if (isset($content['additional_services']['items']) && is_array($content['additional_services']['items'])): ?>
                            <?php foreach ($content['additional_services']['items'] as $index => $item): ?>
                        <tr>
                            <td class="service-description"><?php echo editable($item['description'] ?? '', "additional_services.items.{$index}.description"); ?></td>
                            <td class="price"><?php echo editable($item['price'] ?? '', "additional_services.items.{$index}.price"); ?></td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <p class="additional-note"><?php echo editable($content['additional_services']['note'] ?? '', 'additional_services.note'); ?></p>
            </div>

            <div class="footnotes fade-in">
                <p><sup>1</sup> <?php echo editable($content['footnotes']['1'] ?? '', 'footnotes.1'); ?></p>
            </div>
        </div>
    </section>

<?php
// Include footer
require_once 'includes/footer.php';
?>