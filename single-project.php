<?php

get_header();

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$is_admin = current_user_can('administrator');

$comments = get_comments([
  'status'  => 'approve',
  'post_id' => get_the_ID(),
]);

?>

<body class="full-layout">
  <div class="body-wrapper">

    <!-- Your full navigation HTML here (from your static code) -->

    <div class="light-wrapper page-title">
      <div class="container inner">
        <h1 class="pull-left"><?php the_title(); ?></h1>
        <div class="navigation pull-right">
          <?php previous_post_link('%link', '<i class="icon-left-open-1"></i>'); ?>
          <?php next_post_link('%link', '<i class="icon-right-open-1"></i>'); ?>
        </div>
      </div>
    </div>

    <div class="dark-wrapper">
      <div class="container inner">
        <!-- Slider -->
        <div class="owl-slider-wrapper">
          <div class="owl-portfolio-slider owl-carousel">
            <?php
            $images = carbon_get_the_post_meta('project_images');
            foreach ($images as $img) {
              echo '<div class="item"><img src="' . esc_url(wp_get_attachment_image_url($img['image'], 'large')) . '" alt="" /></div>';
            }
            ?>
          </div>
          <div class="owl-custom-nav"><a class="slider-prev"></a> <a class="slider-next"></a></div>
        </div>

        <div class="divide15"></div>
        <h3>Project Details</h3>

        <div class="row">
          <div class="col-sm-8">
            <?php the_content(); ?>
          </div>
          <div class="col-sm-4 lp30">
            <ul class="item-details">
              <li><span>Date:</span> <?php echo esc_html(carbon_get_the_post_meta('project_date')); ?></li>
              <li><span>Categories:</span> <?php echo esc_html(carbon_get_the_post_meta('project_categories')); ?></li>
              <li><span>Client:</span> <?php echo esc_html(carbon_get_the_post_meta('project_client')); ?></li>
              <li><span>Link:</span> <a href="<?php echo esc_url(carbon_get_the_post_meta('project_link')); ?>"><?php echo esc_html(carbon_get_the_post_meta('project_link')); ?></a></li>
            </ul>
          </div>
        </div>
        <div class="row" id="test">
          <?php if (comments_open()) : ?>
            <?php if (is_user_logged_in()) : ?>
              <div class="divide50"></div>
              <?php
              $current_user = wp_get_current_user();
              $user_id = $current_user->ID;
              $is_admin = current_user_can('administrator');

              // Get all approved comments for this post
              $comments = get_comments([
                'status'  => 'approve',
                'post_id' => get_the_ID(),
              ]);
              $comment_count = count($comments);
              ?>

              <div id="comments">
                <h3><?php echo $comment_count; ?> Comment<?php echo $comment_count === 1 ? '' : 's'; ?></h3>

                <ol id="singlecomments" class="commentlist">
                  <?php

                  foreach ($comments as $comment) {
                    // Show only user's own comments unless admin
                    if ($is_admin || $comment->user_id == $user_id) {
                      $comment_type = get_comment_meta($comment->comment_ID, 'comment_type', true);
                  ?>
                      <li>
                        <div class="user">
                          <?php echo get_avatar($comment, 64); ?>
                        </div>
                        <div class="message">
                          <div class="image-caption">
                            <div class="info">
                              <h2><?php echo esc_html($comment->comment_author); ?></h2>
                              <div class="meta">
                                <div class="date"><?php echo get_comment_date('', $comment); ?></div>
                                <a class="reply-link" href="#">Reply</a>
                              </div>
                            </div>
                            <p>
                              <?php if ($comment_type): ?>
                                <b><?php echo esc_html($comment_type); ?></b>
                              <?php endif; ?>
                              <?php echo esc_html($comment->comment_content); ?>
                            </p>
                          </div>
                        </div>
                      </li>
                  <?php
                    }
                  }
                  ?>

                </ol>
              </div>
              <div class="comment-form-wrapper">
                <h3>Would you like to share your thoughts?</h3>
                <p>Your email address will not be published. Required fields are marked *</p>

                <form class="comment-form" name="commentform" action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform">
                  <div class="name-field">
                    <input type="text" name="author" id="author" title="Name*" value="<?php echo esc_attr(wp_get_current_user()->display_name); ?>" required readonly />
                  </div>

                  <div class="email-field">
                    <input type="email" name="email" id="email" title="Email*" value="<?php echo esc_attr(wp_get_current_user()->user_email); ?>" required readonly />
                  </div>

                  <fieldset class="comment-type-field fancy-radio-group">
                    <legend>Comment Type</legend>
                    <label>
                      <input type="radio" name="comment_type" value="Learning" required>
                      <span>Learning</span>
                    </label>
                    <label>
                      <input type="radio" name="comment_type" value="Note">
                      <span>Note</span>
                    </label>
                    <label>
                      <input type="radio" name="comment_type" value="Action">
                      <span>Action</span>
                    </label>
                  </fieldset>



                  <div class="message-field">
                    <textarea name="comment" id="comment" rows="5" cols="30" title="Enter your comment here..." required></textarea>
                  </div>

                  <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
                  <input type="hidden" name="comment_parent" id="comment_parent" value="0" />

                  <input type="submit" value="Submit" name="submit" class="btn btn-submit" />
                </form>
              </div>
            <?php else : ?>
              <p>You must <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>">log in</a> to post a comment.</p>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="light-wrapper">

    </div>


    <!-- Related Projects Placeholder -->
    <div class="dark-wrapper">
      <div class="container inner">
        <div class="section-title text-center">
          <h2>Related Works</h2>
          <span class="icon"><i class="icon-picture"></i></span>
        </div>
        <?php
        $current_id = get_the_ID();
        $current_categories = carbon_get_the_post_meta('project_categories'); // e.g., "healing,growth,charm"

        if (!empty($current_categories)) {
          $category_terms = array_map('trim', explode(',', $current_categories)); // ['healing', 'growth', 'charm']

          $meta_query = ['relation' => 'OR'];
          foreach ($category_terms as $term) {
            $meta_query[] = [
              'key'     => 'project_categories',
              'value'   => $term,
              'compare' => 'LIKE', // partial match
            ];
          }

          $related = new WP_Query([
            'post_type'      => 'project',
            'posts_per_page' => 6,
            'post__not_in'   => [$current_id],
            'meta_query'     => $meta_query,
          ]);

          if ($related->have_posts()) : ?>
            <div class="owl-portfolio owlcarousel carousel-th">
              <?php while ($related->have_posts()) : $related->the_post(); ?>
                <div class="item">
                  <figure class="icon-overlay medium icn-link">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                  </figure>
                  <div class="image-caption">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <span class="meta">
                      <?php echo esc_html(carbon_get_the_post_meta('project_categories')); ?>
                    </span>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
        <?php
            wp_reset_postdata();
          endif;
        }
        ?>

      </div>
    </div>




    <?php get_footer(); ?>
  </div>
</body>