<?php
// Transport Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('transport');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="transport" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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

            <div class="services-list-grid">
                <?php foreach(($content['vehicles'] ?? []) as $index => $vehicle): ?>
                <div class="service-box fade-in">
                    <div class="service-icon">
                        <?php echo editableImage($vehicle['image'] ?? '', "vehicles.$index.image", $vehicle['name'] ?? '', $vehicle['name'] ?? ''); ?>
                    </div>
                    <h3><?php echo editable($vehicle['name'] ?? '', "vehicles.$index.name"); ?></h3>
                    <p><?php echo editable($vehicle['description'] ?? '', "vehicles.$index.description"); ?></p>
                    <p class="transport-price"><?php echo editable($vehicle['price'] ?? '', "vehicles.$index.price"); ?></p>
                </div>
                <?php endforeach; ?>

            </div>

            <div class="info-card fade-in">
                <h3><?php echo editable($content['special']['title'] ?? '', 'special.title'); ?></h3>
                <p><?php echo editable($content['special']['description'] ?? '', 'special.description'); ?></p>
            </div>
        </div>
    </section>

<?php
// Include footer
require_once 'includes/footer.php';
?>