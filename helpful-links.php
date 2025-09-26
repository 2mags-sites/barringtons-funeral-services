<?php
// Helpful Links Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('helpful-links');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="helpful-links" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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

            <div class="resources-grid">
                <?php foreach(($content['resources'] ?? []) as $index => $resource): ?>
                <div class="resource-card fade-in">
                    <h3><?php echo editable($resource['title'] ?? '', "resources.$index.title"); ?></h3>
                    <ul>
                        <?php if(!empty($resource['links'])): ?>
                            <?php foreach($resource['links'] as $linkIndex => $link): ?>
                            <li><a href="<?php echo $link['url'] ?? '#'; ?>" target="_blank"><?php echo editable($link['name'] ?? '', "resources.$index.links.$linkIndex.name"); ?></a> - <?php echo editable($link['description'] ?? '', "resources.$index.links.$linkIndex.description"); ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if(!empty($resource['contacts'])): ?>
                            <?php foreach($resource['contacts'] as $contactIndex => $contact): ?>
                            <li><strong><?php echo editable($contact['name'] ?? '', "resources.$index.contacts.$contactIndex.name"); ?></strong><?php echo !empty($contact['phone']) ? ' - ' . editable($contact['phone'], "resources.$index.contacts.$contactIndex.phone") : ''; ?><?php echo !empty($contact['description']) ? ' - ' . editable($contact['description'], "resources.$index.contacts.$contactIndex.description") : ''; ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>