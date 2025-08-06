<?php 
get_header();
 ?>
<?php get_template_part('template-parts/nav'); ?>
<div class="light-wrapper page-title">
  <div class="container inner">
    <h1>Check out our video catalog</h1>
  </div>
</div>
<div class="dark-wrapper">
  <div class="container inner">
    <div class="portfolio">
      <?php
      $categories = get_categories(array(
        'taxonomy' => 'category',
        'hide_empty' => true,
      ));

      echo '<ul class="filter">';
      echo '<li><a class="active" href="#" data-filter="*">All</a></li>';
      foreach ($categories as $category) {
        echo '<li><a href="#" data-filter=".' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a></li>';
      }
      echo '</ul>';
      ?>
      <!-- /.filter -->
      <ul class="items col3">
        <?php
        $args = array(
          'post_type' => 'portfolio',
          'posts_per_page' => -1,
        );
        $portfolio_query = new WP_Query($args);

        if ($portfolio_query->have_posts()):
          while ($portfolio_query->have_posts()): $portfolio_query->the_post();
            $terms = get_the_terms(get_the_ID(), 'category');
            $term_slugs = '';
            if ($terms && !is_wp_error($terms)) {
              foreach ($terms as $term) {
                $term_slugs .= ' ' . $term->slug;
              }
            }

            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $link = get_permalink();
        ?>
            <li class="item<?php echo esc_attr($term_slugs); ?>">
              <figure class="icon-overlay medium icn-more">
                <a href="<?php echo esc_url($thumb); ?>" class="fancybox-media" data-rel="portfolio">
                  <img src="<?php echo esc_url($thumb); ?>" alt="">
                </a>
              </figure>
              <div class="image-caption">
                <h3><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h3>
                <span class="meta">
                  <?php
                  $cats = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'names'));
                  echo implode(', ', $cats);
                  ?>
                </span>
              </div>
            </li>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </ul>
    </div>
    <!-- /.portfolio -->
  </div>
  <!-- /.container -->
</div>

<?php get_template_part('template-parts/main-footer'); ?>

<?php get_footer(); ?>