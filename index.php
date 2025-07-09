<?php
get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <hr>
            <?php
        endwhile;

        the_posts_navigation();
    else :
        ?>
        <p><?php esc_html_e('Sorry, no content available.', 'your-textdomain'); ?></p>
    <?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();
