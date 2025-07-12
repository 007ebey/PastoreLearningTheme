<?php
$logo        = wp_get_attachment_image_url(carbon_get_theme_option('navbar_logo'), 'full');
$logo_retina = wp_get_attachment_image_url(carbon_get_theme_option('navbar_logo_retina'), 'full');
$menu_items  = carbon_get_theme_option('navbar_menu');
?>

<div class="yamm navbar basic default">
  <div class="navbar-header">
    <div class="container">
      <div class="basic-wrapper">
        <a class="btn responsive-menu pull-right" data-toggle="collapse" data-target=".navbar-collapse"><i class='icon-menu-1'></i></a>
        <a class="navbar-brand" href="<?= esc_url(home_url()) ?>">
          <img src="<?= esc_url($logo) ?>" data-at2x="<?= esc_url($logo_retina) ?>" alt="Logo" />
        </a>
      </div>
      <div class="collapse navbar-collapse pull-right">
        <ul class="nav navbar-nav">
          <?php foreach ($menu_items as $item): ?>
            <li class="<?= !empty($item['is_dropdown']) ? 'dropdown' : '' ?>">
              <a href="<?= esc_url($item['url'] ?: '#') ?>" class="<?= !empty($item['is_dropdown']) ? 'dropdown-toggle js-activated' : '' ?>">
                <?= esc_html($item['label']) ?>
              </a>
              <?php if (!empty($item['is_dropdown']) && !empty($item['submenu'])): ?>
                <ul class="dropdown-menu">
                  <?php foreach ($item['submenu'] as $sub): ?>
                    <li><a href="<?= esc_url($sub['url']) ?>"><?= esc_html($sub['label']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
