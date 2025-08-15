<div class="offset"></div>
<?php $slides = carbon_get_the_post_meta('page_slider_slides'); ?>
<?php if (!empty($slides)): ?>
  <div class="fullwidthbanner-container revolution" id="announcements">
    <div class="fullwidthbanner">
      <ul>
        <?php foreach ($slides as $slide): ?>
          <li data-transition="fade">
            <?php if (!empty($slide['background'])): ?>
              <img src="<?= wp_get_attachment_image_url($slide['background'], 'full'); ?>" alt="" />
            <?php endif; ?>

            <?php if (! empty($slide['video_elements'])) : ?>
              <?php foreach ($slide['video_elements'] as $caption) : ?>
                <?php
                // Detect platform and set autoplay params
                $video_url = esc_url($caption['video_url']);
                if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                  $video_url .= '?autoplay=1&mute=1&controls=1&showinfo=0&rel=0&hd=1&wmode=opaque';
                } elseif (strpos($video_url, 'vimeo.com') !== false) {
                  $video_url .= '?autoplay=1&muted=1&title=0&byline=0&portrait=0';
                }
                ?>
                <div class="caption <?= esc_attr($caption['title_incoming_animation_class']); ?> fullscreenvideo"
                  data-autoplay="true"
                  data-autoplayonlyfirsttime="true"
                  data-thumbimage="<?= esc_url($caption['thumb_nail_url']); ?>"
                  data-nextslideatend="true"
                  data-x="<?= esc_attr($caption['title_data_x']); ?>"
                  data-y="<?= esc_attr($caption['title_data_y']); ?>"
                  data-speed="<?= esc_attr($caption['title_data_speed']); ?>"
                  data-start="<?= esc_attr($caption['title_data_start']); ?>"
                  data-easing="<?= esc_attr($caption['title_data_easing']); ?>">

                  <iframe
                    src="<?= $video_url; ?>"
                    width="460" 
                    height="259"
                    frameborder="0"
                    allowfullscreen
                    allow="autoplay; encrypted-media">
                  </iframe>

                  <!-- Learn More Button -->
                  <?php if (! empty($caption['learn_more_url'])) : ?>
                    <a href="<?= esc_url($caption['learn_more_url']); ?>" class="tp-button orange large" style="margin-top: 20px;">
                      Learn More
                    </a>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>



            <?php if (!empty($slide['text_elements'])): ?>
              <?php foreach ($slide['text_elements'] as $caption): ?>
                <div class="caption <?= esc_attr($caption['title_incoming_animation_class']) . ' ' . esc_attr($caption['title_outgoing_animation_class']) . ' ' . esc_attr($caption['title_style_class']); ?>"
                  data-x="<?= esc_attr($caption['title_data_x']); ?>"
                  data-y="<?= esc_attr($caption['title_data_y']); ?>"
                  data-speed="<?= esc_attr($caption['title_data_speed']); ?>"
                  data-start="<?= esc_attr($caption['title_data_start']); ?>"
                  data-easing="<?= esc_attr($caption['title_data_easing']); ?>">
                  <?= wp_kses_post($caption['title']); ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($slide['image_elements'])): ?>
              <?php foreach ($slide['image_elements'] as $caption): ?>
                <div class="caption <?= esc_attr($caption['title_incoming_animation_class']) . ' ' . esc_attr($caption['title_outgoing_animation_class']) . ' ' . esc_attr($caption['title_style_class']); ?>"
                  data-x="<?= esc_attr($caption['title_data_x']); ?>"
                  data-y="<?= esc_attr($caption['title_data_y']); ?>"
                  data-speed="<?= esc_attr($caption['title_data_speed']); ?>"
                  data-start="<?= esc_attr($caption['title_data_start']); ?>"
                  data-easing="<?= esc_attr($caption['title_data_easing']); ?>">
                  <img src="<?= wp_get_attachment_image_url($caption['slide_image'], 'full');  ?>" alt=""></img>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($slide['show_button']) && $slide['show_button'] && !empty($slide['button_text']) && !empty($slide['button_url'])): ?>
              <div class="caption <?= esc_attr($slide['button_animation_class']); ?>"
                data-x="<?= esc_attr($slide['button_data_x']); ?>"
                data-y="<?= esc_attr($slide['button_data_y']); ?>"
                data-speed="<?= esc_attr($slide['button_data_speed']); ?>"
                data-start="<?= esc_attr($slide['button_data_start']); ?>"
                data-easing="<?= esc_attr($slide['button_data_easing']); ?>">
                <a href="<?= esc_url($slide['button_url']); ?>" class="btn btn-large"><?= esc_html($slide['button_text']); ?></a>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="tp-bannertimer tp-bottom"></div>
    </div>
  </div>
<?php endif; ?>
