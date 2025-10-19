<?php
// Blog/News listing page
require_once 'includes/admin-config.php';

// Load content from JSON
$content = loadContent('blog-news');

// Set page meta
$page_title = $content['meta']['title'] ?? '';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';

// Include blog fetcher
require_once 'includes/blog-fetcher.php';

// Get current page from URL
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Fetch blog posts with pagination (9 per page)
$result = fetchBlogPostsPaginated($current_page, 9);
$blog_posts = $result['posts'];
$total_pages = $result['total_pages'];
?>

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="hero-image" style="background-image: url('<?php echo $content['hero']['image'] ?? ''; ?>');">
            <?php if (IS_ADMIN): ?>
                <div class="hero-edit-overlay" onclick="editHeroImage('blog-news', 'hero.image')" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(37, 99, 235, 0.9); color: white; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: 500; display: none;">
                    📷 Click to Change Hero Image
                </div>
            <?php endif; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content-single">
            <h1><?php echo editable($content['hero']['title'] ?? '', 'hero.title'); ?></h1>
            <p><?php echo editable($content['hero']['subtitle'] ?? '', 'hero.subtitle'); ?></p>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog-section section-padding">
        <div class="container">
            <?php if ($blog_posts && count($blog_posts) > 0): ?>
                <div class="blog-grid">
                    <?php foreach ($blog_posts as $post): ?>
                        <div class="blog-card">
                            <?php if ($post['featured_image']): ?>
                                <div class="blog-image">
                                    <img src="<?php echo $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                </div>
                            <?php else: ?>
                                <div class="blog-image">
                                    <img src="assets/images/blog-placeholder.jpg" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="blog-content">
                                <div class="blog-date"><?php echo $post['date']; ?></div>
                                <h3><?php echo $post['title']; ?></h3>
                                <p><?php echo $post['excerpt']; ?></p>
                                <a href="<?php echo $post['link']; ?>" class="read-more">Read More →</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($total_pages > 1): ?>
                    <div class="pagination">
                        <?php if ($current_page > 1): ?>
                            <a href="?page=<?php echo $current_page - 1; ?>" class="pagination-btn">← Previous</a>
                        <?php endif; ?>

                        <div class="pagination-numbers">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <?php if ($i == $current_page): ?>
                                    <span class="pagination-current"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-number"><?php echo $i; ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>

                        <?php if ($current_page < $total_pages): ?>
                            <a href="?page=<?php echo $current_page + 1; ?>" class="pagination-btn">Next →</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="no-posts">
                    <h2><?php echo editable($content['noPosts']['title'] ?? '', 'noPosts.title'); ?></h2>
                    <p><?php echo editable($content['noPosts']['message'] ?? '', 'noPosts.message'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <style>
        .blog-section {
            padding: 60px 0;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .blog-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .blog-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-content {
            padding: 25px;
        }

        .blog-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .blog-content h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .blog-content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .read-more:hover {
            color: var(--primary-hover);
        }

        .no-posts {
            text-align: center;
            padding: 60px 20px;
            background: #f9f9f9;
            border-radius: 10px;
        }

        .no-posts h2 {
            color: #333;
            margin-bottom: 15px;
        }

        .no-posts p {
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .pagination-btn {
            background: var(--navy);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover {
            background: var(--soft-navy);
            transform: translateY(-2px);
        }

        .pagination-numbers {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination-number,
        .pagination-current {
            display: inline-block;
            min-width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination-number {
            background: var(--cream);
            color: var(--text-dark);
            border: 2px solid transparent;
        }

        .pagination-number:hover {
            border-color: var(--navy);
            background: white;
        }

        .pagination-current {
            background: var(--navy);
            color: white;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .pagination {
                gap: 10px;
            }

            .pagination-btn {
                padding: 8px 15px;
                font-size: 14px;
            }
        }
    </style>

<?php
// Include footer
require_once 'includes/footer.php';
?>