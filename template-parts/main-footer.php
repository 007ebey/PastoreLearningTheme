<?php
$logo_1x_id = carbon_get_theme_option('footer_logo_1x');
$logo_2x_id = carbon_get_theme_option('footer_logo_2x');

$logo_1x_url = $logo_1x_id ? wp_get_attachment_image_url($logo_1x_id, 'full') : '';
$logo_2x_url = $logo_2x_id ? wp_get_attachment_image_url($logo_2x_id, 'full') : '';
?>

<footer class="black-wrapper">
  <div class="container inner">
    <div class="row">
      <div class="col-sm-6">
        <div class="widget">
          <?php if ($logo_1x_url): ?>
            <img src="<?php echo esc_url($logo_1x_url); ?>"
              <?php if ($logo_2x_url): ?>
              data-at2x="<?php echo esc_url($logo_2x_url); ?>"
              <?php endif; ?>
              alt="Footer Logo" />
          <?php endif; ?>
          <div class="divide20"></div>
          <p><?php echo esc_html(carbon_get_theme_option('footer_description')); ?></p>
          <p><?php echo esc_html(carbon_get_theme_option('footer_secondary_description')); ?></p>
          <div class="divide5"></div>
          <ul class="social">
            <?php foreach (carbon_get_theme_option('footer_socials') as $social): ?>
              <li><a href="<?php echo esc_url($social['url']); ?>"><i class="<?php echo esc_attr($social['icon_class']); ?>"></i></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="widget">
          <h3 class="section-title widget-title upper">Get In Touch</h3>
          <p><?php echo esc_html(carbon_get_theme_option('footer_secondary_description')); ?></p>
          <div class="divide10"></div>
          <div class="contact-info">
            <i class="icon-location"></i> <?php echo esc_html(carbon_get_theme_option('footer_address')); ?><br />
            <i class="icon-phone"></i> <?php echo esc_html(carbon_get_theme_option('footer_phone')); ?><br />
            <i class="icon-mail"></i>
            <a href="mailto:<?php echo esc_attr(carbon_get_theme_option('footer_email')); ?>">
              <?php echo esc_html(carbon_get_theme_option('footer_email')); ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

 <div class="sub-footer">
  <div class="container">
    <p class="pull-left">
      <?php echo esc_html(carbon_get_theme_option('footer_copyright')); ?>
    </p>
    <?php
    $footer_menu = carbon_get_theme_option('footer_menu');
    if (!empty($footer_menu) && is_array($footer_menu)) :
    ?>
      <ul class="footer-menu pull-right">
        <?php foreach ($footer_menu as $item) : ?>
          <li>
            <a href="<?php echo esc_url($item['link']); ?>">
              <?php echo esc_html($item['label']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

</footer>