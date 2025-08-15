<?php

get_header();

?>

<body class="full-layout">
  <div class="body-wrapper">

  <?php get_template_part('template-parts/nav'); ?>

  <div class="offset"></div>

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
      <div class="container">
        <div class="row">
          <div class="col-sm-16">
            <div class="video-wrapper" style="position: relative; width: 100%; max-width: 100%;">
              <figure class="player">
                <div id="youtube-player"></div>
                <!-- FULL BLOCKING OVERLAY -->
                <div id="video-block-overlay" style="
                      position: absolute;
                      top: 0; left: 0;
                      width: 100%;
                      height: 100%;
                      background: rgba(0,0,0,0.3);
                      z-index: 2;
                      pointer-events: auto;
                      cursor: not-allowed;
                "></div>
            </div>
            </figure>

            <button id="toggle-video-button" type="button" class="btn btn-primary" style="margin-top: 1rem;">▶ Play Video</button>

            <input type="range" id="video-slider" min="0" value="0" step="1" style="width:100%; margin-top: 1rem;">
          </div>
        </div>
      </div>


      <div class="dark-wrapper">
        <div class="container">
          <!-- /.row -->
          <div class="row">
            <div class="divide30"></div>
            <!-- /.col-sm-8 -->
            <div class="col-sm-8 lp30">
              <h3>Sermon Details</h3>
              <p> <?php the_content(); ?></p>
              <div class="divide5"></div>
            </div>

            <div class="col-sm-4">
              <ul class="item-details">
                <li><span>Date:</span> <?php echo esc_html(carbon_get_the_post_meta('project_date')); ?></li>
                <li>
                  <span>Categories:</span>
                  <?php
                  $cats = get_the_category();
                  if (! empty($cats)) {
                    echo esc_html(implode(', ', wp_list_pluck($cats, 'name')));
                  } else {
                    echo 'Uncategorized';
                  }
                  ?>
                </li>
                <li><span>Speaker:</span> <?php echo esc_html(carbon_get_the_post_meta('project_client')); ?></li>
              </ul>
            </div>
            <!-- /.col-sm-4 -->
          </div>
        </div>
      </div>

    </div>
    <!-- /.container -->
  </div>

  <div class="light-wrapper">
    <div class="container">
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
                    <li id="comment-<?php comment_ID(); ?>">
                      <div class="user">
                        <?php echo get_avatar($comment, 64); ?>
                      </div>
                      <div class="message">
                        <div class="image-caption">
                          <div class="info">
                            <h2><?php echo esc_html($comment->comment_author); ?></h2>
                            <div class="meta">
                              <div class="date"><?php echo get_comment_date('', $comment); ?></div>
                            </div>
                          </div>
                          <p>
                            <?php
                            // Show "In reply to" if comment has a parent
                            if ($comment->comment_parent) {
                              $parent_comment = get_comment($comment->comment_parent);
                              if ($parent_comment) {
                                echo '<small class="in-reply-to">In reply to ' . esc_html($parent_comment->comment_author) . '</small><br>';
                              }
                            }

                            // Show comment type if set
                            if (! empty($comment_type)) {
                              echo '<b>' . esc_html($comment_type) . '</b> ';
                            }

                            // Show comment content
                            echo esc_html($comment->comment_content);
                            ?>
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
                  <label>
                    <input type="radio" name="comment_type" value="Prayer_Point">
                    <span>Prayer Point</span>
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


  <!-- Related Projects Placeholder -->
  <div class="dark-wrapper">
    <div class="container inner">
      <div class="section-title text-center">
        <h2>Related Works</h2>
        <span class="icon"><i class="icon-picture"></i></span>
      </div>

      <?php
      $current_id = get_the_ID();
      $categories = wp_get_post_terms($current_id, 'category', ['fields' => 'ids']); // Get category IDs

      if (!empty($categories)) {
        $related = new WP_Query([
          'post_type'      => 'project',
          'posts_per_page' => 6,
          'post__not_in'   => [$current_id],
          'tax_query'      => [
            [
              'taxonomy' => 'category',
              'field'    => 'term_id',
              'terms'    => $categories,
            ],
          ],
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
                    <?php
                    // Display category names as comma-separated
                    $cats = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'names']);
                    echo esc_html(implode(', ', $cats));
                    ?>
                  </span>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <?php wp_reset_postdata(); ?>
      <?php endif;
      }
      ?>
    </div>
  </div>



  <?php get_footer(); ?>
  <?php
  $video_url = carbon_get_the_post_meta('project_video_url');

  // Extract YouTube Video ID from URL (works with youtube.com/live or embed)
  preg_match('/(?:\/|v=|be\/|embed\/|shorts\/|live\/)([-\w]{11})/', $video_url, $matches);
  $video_id = $matches[1] ?? '';
  ?>
  <script type="text/javascript">
    let player;
    let duration = 0;
    const youtubeVideoId = "<?php echo esc_js($video_id); ?>";

    function onYouTubeIframeAPIReady() {
      player = new YT.Player('youtube-player', {
        height: '658',
        width: '1170',
        videoId: youtubeVideoId,
        events: {
          'onReady': onPlayerReady
        }
      });
    }

    function onPlayerReady(event) {
      duration = player.getDuration();
      let isPlaying = false;

      const toggleButton = document.getElementById('toggle-video-button');
      const slider = document.getElementById('video-slider');

      if (toggleButton) {
        toggleButton.addEventListener('click', function() {
          if (!isPlaying) {
            player.mute(); // Autoplay workaround
            player.playVideo();
            setTimeout(() => {
              player.unMute();
            }, 500); // Unmute after it starts

            toggleButton.innerText = '⏸ Pause';
            isPlaying = true;
          } else {
            player.pauseVideo();
            toggleButton.innerText = '▶ Play';
            isPlaying = false;
          }
        });
      }

      if (slider) {
        slider.max = duration;

        slider.addEventListener('input', function() {
          const time = parseInt(this.value);
          player.seekTo(time, true);
        });

        setInterval(() => {
          if (player && player.getCurrentTime && player.getPlayerState() === YT.PlayerState.PLAYING) {
            slider.value = Math.floor(player.getCurrentTime());
          }
        }, 1000);
      }
    }
    onYouTubeIframeAPIReady()
  </script>

  </div>
</body>