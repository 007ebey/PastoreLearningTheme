<div class="light-wrapper">
  <div class="container inner">
    <div class="section-title text-center bm20">
      <h2>From the Latest Articles</h2>
      <span class="icon"><i class="icon-pencil"></i></span>
    </div>
    <div class="thin text-center">
      <p class="lead">
        Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum consectetur...
      </p>
    </div>
    <div class="divide30"></div>
    

    <div class="latest-blog-wrapper">
      <div class="latest-blog">
        <?php
        $latest_posts = new WP_Query([
          'post_type'      => 'post',
          'posts_per_page' => 4,
          'ignore_sticky_posts' => true,
        ]);

        if ($latest_posts->have_posts()):
          while ($latest_posts->have_posts()): $latest_posts->the_post();
        ?>
          <div class="post">
            <figure class="icon-overlay medium icn-link">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/style/images/default-thumb.jpg" alt="<?php the_title_attribute(); ?>" />
                <?php endif; ?>
              </a>
            </figure>
            <div class="post-content">
              <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="meta">
                <span class="date"><?php echo get_the_date('d M, Y'); ?></span>
                <span class="comments">
                  <a href="<?php comments_link(); ?>">
                    <?php
                      $comments_number = get_comments_number();
                      echo sprintf(
                        _n('%s Comment', '%s Comments', $comments_number, 'textdomain'),
                        number_format_i18n($comments_number)
                      );
                    ?>
                  </a>
                </span>
              </div>
              <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
            </div>
          </div>
        <?php
          endwhile;
          wp_reset_postdata();
        else:
          echo '<p class="text-center">No recent articles found.</p>';
        endif;
        ?>
      </div>
    </div>
  </div>
</div>
