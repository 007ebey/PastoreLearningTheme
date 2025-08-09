<div class="black-wrapper" id="catalog">
  <div class="container inner">
    <div class="section-title text-center">
      <h2>Our Public catalog</h2>
      <span class="icon"><i class="icon-picture"></i></span>
    </div>

    <div class="owl-portfolio owlcarousel carousel-th">
      <?php
      $portfolio_query = new WP_Query(array(
          'post_type' => 'portfolio',
          'posts_per_page' => 8,
      ));

      if ($portfolio_query->have_posts()) :
          while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
              // $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $image_url = carbon_get_post_meta(get_the_ID(), 'thumb_nail_url');
              ?>
              <div class="item">
                <figure class="icon-overlay medium icn-link">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" />
                  </a>
                </figure>
                <div class="image-caption">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <span class="meta">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'category');
                    if ($categories && !is_wp_error($categories)) {
                      $names = wp_list_pluck($categories, 'name');
                      echo esc_html(implode(', ', $names));
                    }
                    ?>
                  </span>
                </div>
              </div>
              <?php
          endwhile;
          wp_reset_postdata();
      else :
          echo '<p>No portfolio items found.</p>';
      endif;
      ?>
    </div>
    <div class="divide50"></div>
    <div class="text-center">
      <a class="btn btn-border-light" href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>">See All Work</a>
    </div>
  </div>
</div>
