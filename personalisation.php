<?php
// Personalisation Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('personalisation');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="personalisation" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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

            <div class="personalisation-grid">
                <?php foreach(($content['options'] ?? []) as $index => $option): ?>
                <div class="personalisation-card fade-in">
                    <div class="card-content">
                        <h3><?php echo editable($option['title'] ?? '', "options.$index.title"); ?></h3>
                        <ul>
                            <?php foreach(($option['items'] ?? []) as $itemIndex => $item): ?>
                            <li><?php echo editable($item, "options.$index.items.$itemIndex"); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-image">
                        <?php echo editableImage($option['image'] ?? '', "options.$index.image", $option['title'] ?? 'Personalisation option', 'Add Image'); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="cta-section fade-in">
                <h2><?php echo editable($content['cta']['title'] ?? "", 'cta.title'); ?></h2>
                <p><?php echo editable($content['cta']['subtitle'] ?? '', 'cta.subtitle'); ?></p>
                <a href="#contact" class="btn-primary"><?php echo editable($content['cta']['buttonText'] ?? '', 'cta.buttonText'); ?></a>
            </div>
        </div>
    </section>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>