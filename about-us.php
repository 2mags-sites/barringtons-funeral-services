<?php
// About Us Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('about-us');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="about-us" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
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
            <div class="content-full">
                <div class="content-main">
                    <div class="intro-block fade-in">
                        <div class="intro-content">
                            <div class="intro-text">
                                <h2><?php echo editable($content['about']['intro']['title'] ?? '', 'about.intro.title'); ?></h2>
                                <p class="lead-text"><?php echo editable($content['about']['intro']['subtitle'] ?? '', 'about.intro.subtitle'); ?></p>
                                <p><?php echo editable($content['about']['intro']['description1'] ?? '', 'about.intro.description1'); ?></p>
                                <p><?php echo editable($content['about']['intro']['description2'] ?? '', 'about.intro.description2'); ?></p>
                                <p><strong>Company Number:</strong> <span><?php echo editable($content['about']['company']['number'] ?? '', 'about.company.number'); ?></span></p>
                            </div>
                            <div class="intro-image">
                                <?php echo editableImage($content['about']['intro']['image'] ?? '', 'about.intro.image', 'Team Photo Barrington Family', 'Barrington Family Team'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- David Barrington -->
                    <div class="info-card fade-in">
                        <div class="card-content">
                            <div class="card-image">
                                <?php echo editableImage($content['about']['david']['image'] ?? '', 'about.david.image', 'David Barrington Director', 'David Barrington - Director'); ?>
                            </div>
                            <div class="card-text">
                                <h3><?php echo editable($content['about']['david']['name'] ?? '', 'about.david.name'); ?></h3>
                                <p><strong><?php echo editable($content['about']['david']['title'] ?? '', 'about.david.title'); ?></strong></p>
                                <p><?php echo editable($content['about']['david']['description'] ?? '', 'about.david.description'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Claire Barrington -->
                    <div class="info-card fade-in">
                        <div class="card-content card-content-reverse">
                            <div class="card-text">
                                <h3><?php echo editable($content['about']['claire']['name'] ?? '', 'about.claire.name'); ?></h3>
                                <p><strong><?php echo editable($content['about']['claire']['title'] ?? '', 'about.claire.title'); ?></strong></p>
                                <p><?php echo editable($content['about']['claire']['description'] ?? '', 'about.claire.description'); ?></p>
                            </div>
                            <div class="card-image">
                                <?php echo editableImage($content['about']['claire']['image'] ?? '', 'about.claire.image', 'Claire Barrington Director', 'Claire Barrington - Director'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Members -->
                    <?php
                    $staff_members = $content['about']['staff'] ?? [];
                    foreach ($staff_members as $index => $staff):
                        $is_reverse = ($index % 2 !== 0);
                    ?>
                    <div class="info-card fade-in">
                        <div class="card-content <?php echo $is_reverse ? 'card-content-reverse' : ''; ?>">
                            <?php if (!$is_reverse): ?>
                            <div class="card-image">
                                <?php echo editableImage($staff['image'] ?? '', "about.staff.$index.image", $staff['name'] ?? 'Staff Member', $staff['name'] ?? 'Staff Member'); ?>
                            </div>
                            <?php endif; ?>
                            <div class="card-text">
                                <h3><?php echo editable($staff['name'] ?? '', "about.staff.$index.name"); ?></h3>
                                <p><strong><?php echo editable($staff['title'] ?? '', "about.staff.$index.title"); ?></strong></p>
                                <p><?php echo editable($staff['description'] ?? '', "about.staff.$index.description"); ?></p>
                            </div>
                            <?php if ($is_reverse): ?>
                            <div class="card-image">
                                <?php echo editableImage($staff['image'] ?? '', "about.staff.$index.image", $staff['name'] ?? 'Staff Member', $staff['name'] ?? 'Staff Member'); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="promise-section fade-in">
                        <h2><?php echo editable($content['about']['promise']['title'] ?? '', 'about.promise.title'); ?></h2>
                        <p><?php echo editable($content['about']['promise']['description'] ?? '', 'about.promise.description'); ?></p>

                        <h3><?php echo editable($content['about']['promise']['trusted_title'] ?? '', 'about.promise.trusted_title'); ?></h3>
                        <p><?php echo editable($content['about']['promise']['trusted_description'] ?? '', 'about.promise.trusted_description'); ?></p>

                        <h3><?php echo editable($content['about']['promise']['growing_title'] ?? '', 'about.promise.growing_title'); ?></h3>
                        <div class="feature-with-image">
                            <div class="feature-text">
                                <p><?php echo editable($content['about']['promise']['growing_description'] ?? '', 'about.promise.growing_description'); ?></p>
                            </div>
                            <div class="feature-image">
                                <?php echo editableImage($content['about']['promise']['growing_image'] ?? '', 'about.promise.growing_image', 'Memorial Trees Over 3000 Planted', 'Memorial Trees'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="locations-section fade-in">
                        <h2><?php echo editable($content['about']['locations']['title'] ?? '', 'about.locations.title'); ?></h2>
                        <p class="lead-text"><?php echo editable($content['about']['locations']['subtitle'] ?? '', 'about.locations.subtitle'); ?></p>

                        <div class="locations-grid">
                            <div class="location-card">
                                <div class="location-content">
                                    <div class="location-text">
                                        <h3><?php echo editable($content['about']['locations']['waterloo']['name'] ?? '', 'about.locations.waterloo.name'); ?></h3>
                                        <p class="location-tag"><?php echo editable($content['about']['locations']['waterloo']['tag'] ?? '', 'about.locations.waterloo.tag'); ?></p>
                                        <p><strong>Address:</strong><br><?php echo editable($content['about']['locations']['waterloo']['address'] ?? '', 'about.locations.waterloo.address'); ?></p>
                                        <p><strong>Opening Hours:</strong><br><?php echo editable($content['about']['locations']['waterloo']['hours'] ?? '', 'about.locations.waterloo.hours'); ?></p>
                                        <p class="location-note"><?php echo editable($content['about']['locations']['waterloo']['note'] ?? '', 'about.locations.waterloo.note'); ?></p>
                                    </div>
                                    <div class="location-images">
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['waterloo']['exterior_image'] ?? 'assets/images/Waterloo Exterior (1).jpg', 'about.locations.waterloo.exterior_image', 'Waterloo Office Exterior', 'Waterloo Office - Exterior'); ?>
                                        </div>
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['waterloo']['interior_image'] ?? 'assets/images/waterloo_interior_s.jpg', 'about.locations.waterloo.interior_image', 'Waterloo Office Interior', 'Waterloo Office - Interior'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="location-card">
                                <div class="location-content">
                                    <div class="location-text">
                                        <h3><?php echo editable($content['about']['locations']['formby']['name'] ?? '', 'about.locations.formby.name'); ?></h3>
                                        <p class="location-tag"><?php echo editable($content['about']['locations']['formby']['tag'] ?? '', 'about.locations.formby.tag'); ?></p>
                                        <p><strong>Address:</strong><br><?php echo editable($content['about']['locations']['formby']['address'] ?? '', 'about.locations.formby.address'); ?></p>
                                        <p><strong>Opening Hours:</strong><br><?php echo editable($content['about']['locations']['formby']['hours'] ?? '', 'about.locations.formby.hours'); ?></p>
                                        <p class="location-note"><?php echo editable($content['about']['locations']['formby']['note'] ?? '', 'about.locations.formby.note'); ?></p>
                                    </div>
                                    <div class="location-images">
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['formby']['exterior_image'] ?? 'assets/images/FormbyExterior2025.jpg', 'about.locations.formby.exterior_image', 'Formby Office Exterior', 'Formby Office - Exterior'); ?>
                                        </div>
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['formby']['interior_image'] ?? 'assets/images/Formby interior (1).jpg', 'about.locations.formby.interior_image', 'Formby Office Interior', 'Formby Office - Interior'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="location-card">
                                <div class="location-content">
                                    <div class="location-text">
                                        <h3><?php echo editable($content['about']['locations']['netherton']['name'] ?? '', 'about.locations.netherton.name'); ?></h3>
                                        <p class="location-tag"><?php echo editable($content['about']['locations']['netherton']['tag'] ?? '', 'about.locations.netherton.tag'); ?></p>
                                        <p><strong>Address:</strong><br><?php echo editable($content['about']['locations']['netherton']['address'] ?? '', 'about.locations.netherton.address'); ?></p>
                                        <p><strong>Opening Hours:</strong><br><?php echo editable($content['about']['locations']['netherton']['hours'] ?? '', 'about.locations.netherton.hours'); ?></p>
                                        <p class="location-note"><?php echo editable($content['about']['locations']['netherton']['note'] ?? '', 'about.locations.netherton.note'); ?></p>
                                    </div>
                                    <div class="location-images">
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['netherton']['exterior_image'] ?? 'assets/images/Netherton_Exterior_s.jpg', 'about.locations.netherton.exterior_image', 'Netherton Office Exterior', 'Netherton Office - Exterior'); ?>
                                        </div>
                                        <div class="location-image">
                                            <?php echo editableImage($content['about']['locations']['netherton']['interior_image'] ?? 'assets/images/Netherton_Interior_s.jpg', 'about.locations.netherton.interior_image', 'Netherton Office Interior', 'Netherton Office - Interior'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="contact-banner">
                            <p><?php echo editable($content['about']['locations']['contact_banner']['text'] ?? '', 'about.locations.contact_banner.text'); ?></p>
                            <h3><?php echo editable($content['about']['locations']['contact_banner']['phone'] ?? '', 'about.locations.contact_banner.phone'); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Include footer (which now includes the contact form)
require_once 'includes/footer.php';
?>