<?php
// Single blog post page (headless WordPress)
require_once 'includes/admin-config.php';
require_once 'includes/blog-fetcher.php';

// Get post slug from URL
$post_slug = $_GET['slug'] ?? '';

if (empty($post_slug)) {
    header('Location: /blog-news.php');
    exit;
}

// Fetch the post from WordPress API
$post = fetchBlogPostBySlug($post_slug);

if (!$post) {
    header('Location: /blog-news.php');
    exit;
}

// Set page meta from post
$page_title = $post['title'] . ' | Barrington\'s Funeral Services';
$page_description = $post['excerpt'];
$page_keywords = '';

// Include header
require_once 'includes/header.php';
?>

    <!-- Blog Post Hero -->
    <section class="post-hero">
        <?php if ($post['featured_image']): ?>
            <div class="post-hero-image" style="background-image: url('<?php echo $post['featured_image']; ?>');"></div>
        <?php else: ?>
            <div class="post-hero-image" style="background: linear-gradient(135deg, var(--soft-navy), var(--navy));"></div>
        <?php endif; ?>
        <div class="hero-overlay"></div>
        <div class="post-hero-content">
            <div class="container">
                <div class="post-meta">
                    <span class="post-date"><?php echo $post['date']; ?></span>
                </div>
                <h1><?php echo $post['title']; ?></h1>
            </div>
        </div>
    </section>

    <!-- Blog Post Content -->
    <article class="post-content-section section-padding">
        <div class="container">
            <div class="post-content-wrapper">
                <div class="post-content">
                    <?php echo $post['content']; ?>
                </div>

                <div class="post-navigation">
                    <a href="/blog-news.php" class="back-to-blog">← Back to All Articles</a>
                </div>
            </div>
        </div>
    </article>

    <style>
        .post-hero {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .post-hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .post-hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            width: 100%;
            padding: 0 20px;
        }

        .post-meta {
            margin-bottom: 15px;
        }

        .post-date {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
        }

        .post-hero-content h1 {
            font-size: 48px;
            margin: 0;
            font-weight: normal;
            line-height: 1.2;
            max-width: 900px;
            margin: 0 auto;
        }

        .post-content-section {
            padding: 60px 0;
        }

        .post-content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .post-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            line-height: 1.8;
            color: var(--text-body);
        }

        .post-content h2 {
            color: var(--text-dark);
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: normal;
        }

        .post-content h3 {
            color: var(--text-dark);
            margin-top: 25px;
            margin-bottom: 12px;
            font-weight: normal;
        }

        .post-content p {
            margin-bottom: 20px;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 25px 0;
        }

        .post-content ul,
        .post-content ol {
            margin: 20px 0;
            padding-left: 30px;
        }

        .post-content li {
            margin-bottom: 10px;
        }

        .post-content a {
            color: var(--navy);
            text-decoration: underline;
        }

        .post-content a:hover {
            color: var(--soft-navy);
        }

        .post-content blockquote {
            border-left: 4px solid var(--navy);
            padding-left: 20px;
            margin: 25px 0;
            font-style: italic;
            color: var(--text-body);
        }

        .post-navigation {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }

        .back-to-blog {
            display: inline-block;
            background: var(--navy);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-to-blog:hover {
            background: var(--soft-navy);
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .post-hero {
                height: 300px;
            }

            .post-hero-content h1 {
                font-size: 32px;
            }

            .post-content {
                padding: 25px;
            }
        }
    </style>

<?php
// Include footer
require_once 'includes/footer.php';
?>
