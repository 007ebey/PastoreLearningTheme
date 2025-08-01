<?php get_header(); ?>

<?php get_template_part('template-parts/nav'); ?>

<?php
// Previous and Next portfolio posts
$prev_post = get_previous_post(true, '', 'category');
$next_post = get_next_post(true, '', 'category');

// Custom fields
$video_url = carbon_get_post_meta(get_the_ID(), 'video_url');
?>

<div class="light-wrapper page-title">
  <div class="container inner">
    <h1 class="pull-left"><?php the_title(); ?></h1>
    <div class="navigation pull-right">
      <?php if ($prev_post): ?>
        <a href="<?php echo get_permalink($prev_post->ID); ?>" title="Previous">
          <i class='icon-left-open-1'></i>
        </a>
      <?php endif; ?>
      <?php if ($next_post): ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>" title="Next">
          <i class='icon-right-open-1'></i>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="dark-wrapper">
  <div class="container inner">

    <?php if ($video_url): ?>
      <figure class="player">
        <iframe src="<?php echo esc_url($video_url); ?>" width="1170" height="658" frameborder="0" allowfullscreen></iframe>
      </figure>
    <?php endif; ?>

    <div class="divide30"></div>
    <h3>Project Details</h3>
    <div class="row">
      <div class="col-sm-8">
        <?php the_content(); ?>
      </div>
      <div class="col-sm-4 lp30">
        <ul class="item-details">
          <li><span>Date:</span> <?php echo get_the_date(); ?></li>
          <li><span>Categories:</span>
            <?php
              $terms = get_the_terms(get_the_ID(), 'category');
              if ($terms && !is_wp_error($terms)) {
                  echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
              }
            ?>
          </li>
          <li><span>Client:</span> <?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'client_name')); ?></li>
          <li><span>Link:</span>
            <a href="<?php echo esc_url(carbon_get_post_meta(get_the_ID(), 'project_link')); ?>">
              <?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'project_link')); ?>
            </a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>
