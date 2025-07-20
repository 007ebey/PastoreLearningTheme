<div class="container inner">
  <div class="row">

    <div class="divide60"></div>


    <!-- SIDEBAR WITH CATEGORY FILTERS -->
    <aside class="col-sm-4 sidebar lp30">
      <div class="sidebox widget">
        <h3>Categories</h3>
        <ul class="circled project-category-filter">
          <?php
          $projects = get_posts([
            'post_type' => 'project',
            'posts_per_page' => -1,
          ]);

          $category_counts = [];

          foreach ($projects as $project) {
            $categories = carbon_get_post_meta($project->ID, 'project_categories');
            if ($categories) {
              $cat_list = explode(',', $categories); // Assuming comma-separated string
              foreach ($cat_list as $cat) {
                $cat = trim($cat);
                if ($cat) {
                  $category_counts[$cat] = ($category_counts[$cat] ?? 0) + 1;
                }
              }
            }
          }

          foreach ($category_counts as $cat => $count) {
            echo '<li><a href="#" class="category-link" data-category="' . esc_attr($cat) . '">' . esc_html($cat) . ' (' . $count . ')</a></li>';
          }
          ?>
        </ul>
      </div>
    </aside>

    <!-- PROJECT GRID -->
    <div class="col-sm-8">
      <div class="row" id="project-grid">
        <?php
        $query = new WP_Query([
          'post_type' => 'project',
          'post_status' => 'publish',
          'posts_per_page' => -1,
        ]);

        if ($query->have_posts()):
          while ($query->have_posts()): $query->the_post();
        ?>
            <div class="col-sm-6 mb-4 project-item">
              <div class="project-box">
                <h4><?php the_title(); ?></h4>
                <figure class="icon-overlay medium icn-link">
                  <a href="<?php the_permalink(); ?>">
                    <?php
                    if (has_post_thumbnail()) {
                      the_post_thumbnail('medium'); // Adjust size if needed
                    } else {
                      echo '<img src="' . get_template_directory_uri() . '/style/images/art/gb1.jpg" alt="' . get_the_title() . '" />';
                    }
                    ?>
                  </a>
                </figure>
                <p><?php the_excerpt(); ?></p>
              </div>
            </div>
        <?php
          endwhile;
          wp_reset_postdata();
        else:
          echo '<p>No projects found.</p>';
        endif;
        ?>
      </div>
    </div>
  </div>
</div>

<!-- JS FOR AJAX CATEGORY FILTER -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.category-link');

    links.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const category = this.dataset.category;

        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=filter_projects_by_category&category=' + encodeURIComponent(category))
          .then(response => response.text())
          .then(html => {
            document.querySelector('#project-grid').innerHTML = html;
          });
      });
    });
  });
</script>

<?php get_footer(); ?>