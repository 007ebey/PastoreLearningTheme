<?php
$section_title = carbon_get_the_post_meta('services_section_title');
$section_icon = carbon_get_the_post_meta('services_section_icon');
$services = carbon_get_the_post_meta('services_items');
?>

<?php if (!empty($services)): ?>
<div class="dark-wrapper">
  <div class="container inner">
    <div class="section-title text-center">
      <h2><?= esc_html($section_title); ?></h2>
      <span class="icon"><i class="<?= esc_attr($section_icon); ?>"></i></span>
    </div>
    <div class="col-services">
      <?php foreach (array_chunk($services, 3) as $row): ?>
        <div class="row">
          <?php foreach ($row as $service): ?>
            <div class="col-sm-4">
              <div class="icon">
                <i class="<?= esc_attr($service['icon_class']); ?> icn"></i>
              </div>
              <div class="text">
                <h5 class="upper"><?= esc_html($service['title']); ?></h5>
                <p><?= esc_html($service['description']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="divide30"></div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>
