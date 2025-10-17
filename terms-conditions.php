<?php
// Terms and Conditions Page
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('terms-conditions');

// Set page meta from JSON
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero legal-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content-single">
            <h1><?php echo $content['hero']['title'] ?? 'Terms and Conditions'; ?></h1>
            <p class="hero-subtitle"><?php echo $content['hero']['subtitle'] ?? ''; ?></p>
        </div>
    </section>

    <section class="content-section legal-content">
        <div class="container">
            <div class="legal-document fade-in">
                <div class="legal-header">
                    <p class="last-updated"><strong>Last Updated:</strong> <?php echo $content['lastUpdated'] ?? ''; ?></p>
                </div>

                <?php if (!empty($content['introduction']['text'])): ?>
                <div class="legal-intro">
                    <p><?php echo $content['introduction']['text']; ?></p>
                </div>
                <?php endif; ?>

                <div class="legal-sections">
                    <?php foreach(($content['sections'] ?? []) as $section): ?>
                    <div class="legal-section">
                        <h2><?php echo $section['title'] ?? ''; ?></h2>
                        <div class="legal-section-content">
                            <?php echo $section['content'] ?? ''; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <style>
    .legal-hero {
        height: 300px;
        background: linear-gradient(135deg, var(--soft-navy), var(--navy));
        position: relative;
    }

    .legal-content {
        padding: 4rem 0;
    }

    .legal-document {
        background: white;
        padding: 3rem;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        max-width: 900px;
        margin: 0 auto;
    }

    .legal-header {
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 2rem;
    }

    .last-updated {
        color: #666;
        font-size: 0.95rem;
    }

    .legal-intro {
        background: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2.5rem;
        border-left: 4px solid var(--soft-navy);
    }

    .legal-intro p {
        margin: 0;
        line-height: 1.8;
        color: #555;
    }

    .legal-sections {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }

    .legal-section h2 {
        color: var(--navy);
        font-size: 1.6rem;
        margin-bottom: 1rem;
        font-weight: 400;
    }

    .legal-section-content {
        color: #555;
        line-height: 1.8;
    }

    .legal-section-content h4 {
        color: var(--soft-navy);
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .legal-section-content ul,
    .legal-section-content ol {
        margin: 1rem 0;
        padding-left: 2rem;
    }

    .legal-section-content li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
    }

    .legal-section-content p {
        margin-bottom: 1rem;
    }

    .legal-section-content strong {
        color: var(--text-dark);
    }

    .legal-section-content a {
        color: var(--soft-navy);
        text-decoration: underline;
    }

    .legal-section-content a:hover {
        color: var(--navy);
    }

    @media (max-width: 768px) {
        .legal-hero {
            height: 250px;
        }

        .legal-document {
            padding: 2rem 1.5rem;
        }

        .legal-section h2 {
            font-size: 1.4rem;
        }
    }
    </style>

<?php
// Include footer
require_once 'includes/footer.php';
?>
