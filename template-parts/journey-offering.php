<?php $tabs = carbon_get_the_post_meta('page_tabs_section'); ?>
<?php if (!empty($tabs)): ?>
  <div class="light-wrapper">
    <div class="container inner">
      <div class="tabs services tab-container">
        <div class="panel-container">
          <?php foreach ($tabs as $tab): ?>
            <div class="tab-block" id="<?= esc_attr($tab['tab_id']); ?>">
              <h2 class="slab"><?= wp_kses_post($tab['block_title']); ?></h2>
              <p class="lead"><?= $tab['block_text']; ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <ul class="etabs row">
          <?php foreach ($tabs as $tab): ?>
            <li class="tab col-sm-3">
              <a href="#<?= esc_attr($tab['tab_id']); ?>">
                <div class="pin"></div>
                <div class="root"></div>
                <div class="icon"><i class="<?= esc_attr($tab['icon_class']); ?> icn"></i></div>
                <h4><?= esc_html($tab['tab_title']); ?></h4>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
<?php endif; ?>
