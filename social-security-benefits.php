<?php
// Social Security Benefits Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('social-security-benefits');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="social-security-benefits" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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
                <p class="lead-text"><?php echo editable($content['intro']['lead_text'] ?? '', 'intro.lead_text'); ?></p>
            </div>

            <div class="guide-sections">
                <?php if (isset($content['guide_sections']) && is_array($content['guide_sections'])): ?>
                    <?php foreach ($content['guide_sections'] as $index => $section): ?>
                <div class="info-card guide-section fade-in">
                    <h3><?php echo editable($section['title'] ?? '', "guide_sections.{$index}.title"); ?></h3>
                    <?php if (!empty($section['description'])): ?>
                    <p><?php echo editable($section['description'] ?? '', "guide_sections.{$index}.description"); ?></p>
                    <?php endif; ?>
                    <?php if (isset($section['points']) && is_array($section['points'])): ?>
                    <ul>
                        <?php foreach ($section['points'] as $pointIndex => $point): ?>
                        <li><?php echo editable($point ?? '', "guide_sections.{$index}.points.{$pointIndex}"); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="cta-section fade-in">
                <h3><?php echo editable($content['cta_section']['title'] ?? '', 'cta_section.title'); ?></h3>
                <p><?php echo editable($content['cta_section']['description'] ?? '', 'cta_section.description'); ?></p>
                <?php if (isset($content['cta_section']['contacts']) && is_array($content['cta_section']['contacts'])): ?>
                    <?php foreach ($content['cta_section']['contacts'] as $contactIndex => $contact): ?>
                <p><strong><?php echo editable($contact['name'] ?? '', "cta_section.contacts.{$contactIndex}.name"); ?>:</strong> <?php echo editable($contact['number'] ?? '', "cta_section.contacts.{$contactIndex}.number"); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
// Include footer
require_once 'includes/footer.php';
?>