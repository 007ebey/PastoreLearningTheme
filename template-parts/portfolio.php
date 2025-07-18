<div class="black-wrapper">
  <div class="container inner">
    <div class="section-title text-center">
      <h2>Our Recent Projects</h2>
      <span class="icon"><i class="icon-picture"></i></span>
    </div>

    <div class="owl-portfolio owlcarousel carousel-th">
      <?php
      $project_query = new WP_Query([
          'post_type' => 'project',
          'posts_per_page' => 6,
      ]);

      if ($project_query->have_posts()):
          while ($project_query->have_posts()): $project_query->the_post();
              $project_meta = carbon_get_the_post_meta('project_meta');
              $permalink = get_permalink();
              $thumbnail_url = get_the_post_thumbnail_url(null, 'medium'); // or custom size
      ?>
          <div class="item">
            <figure class="icon-overlay medium icn-link">
              <a href="<?php echo esc_url($permalink); ?>">
                <?php if ($thumbnail_url): ?>
                  <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                <?php else: ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/style/images/default-thumb.jpg" alt="No Image">
                <?php endif; ?>
              </a>
            </figure>
            <div class="image-caption">
              <h3><a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h3>
              <span class="meta"><?php echo esc_html($project_meta); ?></span>
            </div>
          </div>
      <?php
          endwhile;
          wp_reset_postdata();
      endif;
      ?>
    </div>

    <div class="divide50"></div>
    <div class="text-center">
      <a class="btn btn-border-light" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>">
        See All Work
      </a>
    </div>
  </div>
</div>
