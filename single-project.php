<?php

get_header();

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
      <!-- /.row -->
       <div class="row">
        <div class="divide30"></div>
        <!-- /.col-sm-8 -->
        <div class="col-sm-8 lp30">
          <h3>Project Details</h3>
          <p> <?php the_content(); ?></p>
          <div class="divide5"></div>
        </div>

        <div class="col-sm-4">
          <ul class="item-details">
            <li><span>Date:</span> <?php echo esc_html(carbon_get_the_post_meta('project_date')); ?></li>
            <li><span>Categories:</span> <?php echo esc_html(carbon_get_the_post_meta('project_categories')); ?></li>
            <li><span>Client:</span> <?php echo esc_html(carbon_get_the_post_meta('project_client')); ?></li>
            <li><span>Link:</span> <a href="<?php echo esc_url(carbon_get_the_post_meta('project_link')); ?>"><?php echo esc_html(carbon_get_the_post_meta('project_link')); ?></a></li>
          </ul>
        </div>
        <!-- /.col-sm-4 -->
       </div>

    </div>
    <!-- /.container -->
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