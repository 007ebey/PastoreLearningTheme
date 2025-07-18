<?php

require_once __DIR__ . '/vendor/autoload.php';


use Carbon_Fields\Carbon_Fields;

add_theme_support('post-thumbnails');


function theme_enqueue_styles()
{
  $theme_uri = get_template_directory_uri();

  // Bootstrap (base dependency for many)
  wp_enqueue_style(
    'bootstrap',
    $theme_uri . '/style/css/bootstrap.css',
    [],
    null
  );

  // Owl Carousel (no clear dependency, but often styled after Bootstrap)
  wp_enqueue_style(
    'owl-carousel',
    $theme_uri . '/style/css/owl.carousel.css',
    ['bootstrap'],
    null
  );

  // Revolution Slider Settings (likely styled for Bootstrap)
  wp_enqueue_style(
    'rev-settings',
    $theme_uri . '/style/css/settings.css',
    ['bootstrap'],
    null
  );

  // Prettify (syntax highlighter, independent)
  wp_enqueue_style(
    'prettify',
    $theme_uri . '/style/js/google-code-prettify/prettify.css',
    [],
    null
  );

  // Fancybox (JS lightbox, independent, but could appear after Bootstrap)
  wp_enqueue_style(
    'fancybox',
    $theme_uri . '/style/js/fancybox/jquery.fancybox.css',
    ['bootstrap'],
    null
  );

  // Fancybox thumbs helper (dependent on fancybox)
  wp_enqueue_style(
    'fancybox-thumbs',
    $theme_uri . '/style/js/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.2',
    ['fancybox'],
    '1.0.2'
  );

  // Font files — safe to load independently
  wp_enqueue_style(
    'fontello',
    $theme_uri . '/style/type/fontello.css',
    [],
    null
  );

  wp_enqueue_style(
    'picons',
    $theme_uri . '/style/type/picons.css',
    [],
    null
  );

  wp_enqueue_style(
    'budicons',
    $theme_uri . '/style/type/budicons.css',
    [],
    null
  );

  // Google Fonts (load before custom fonts and theme styles)
  wp_enqueue_style(
    'raleway-font',
    'https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900',
    [],
    null
  );

  // Main style (depends on Bootstrap, Owl, Fonts, RevSlider, etc.)
  wp_enqueue_style(
    'main-style',
    $theme_uri . '/style.css',
    [
      'bootstrap',
      'owl-carousel',
      'rev-settings',
      'fancybox',
      'fontello',
      'raleway-font'
    ],
    null
  );

  // Theme color — overrides base styles, depends on main
  wp_enqueue_style(
    'theme-blue',
    $theme_uri . '/style/css/color/blue.css',
    ['main-style'],
    null
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_scripts()
{
  $theme_uri = get_template_directory_uri();

  // jQuery
  wp_enqueue_script(
    'jquery-custom',
    $theme_uri . '/style/js/jquery.min.js',
    [],
    null,
    true
  );

  // Bootstrap (requires jQuery)
  wp_enqueue_script(
    'bootstrap',
    $theme_uri . '/style/js/bootstrap.min.js',
    ['jquery-custom'],
    null,
    true
  );

  // Hover dropdown (requires Bootstrap)
  wp_enqueue_script(
    'bootstrap-hover-dropdown',
    $theme_uri . '/style/js/twitter-bootstrap-hover-dropdown.min.js',
    ['bootstrap'],
    null,
    true
  );

  // Revolution Slider plugins (require jQuery)
  wp_enqueue_script(
    'rev-plugins',
    $theme_uri . '/style/js/jquery.themepunch.plugins.min.js',
    ['jquery-custom'],
    null,
    true
  );

  wp_enqueue_script(
    'rev-main',
    $theme_uri . '/style/js/jquery.themepunch.revolution.min.js',
    ['rev-plugins'],
    null,
    true
  );

  // Fancybox (lightbox, requires jQuery)
  wp_enqueue_script(
    'fancybox',
    $theme_uri . '/style/js/jquery.fancybox.pack.js',
    ['jquery-custom'],
    null,
    true
  );

  wp_enqueue_script(
    'fancybox-thumbs',
    $theme_uri . '/style/js/fancybox/helpers/jquery.fancybox-thumbs.js',
    ['fancybox'],
    '1.0.2',
    true
  );

  wp_enqueue_script(
    'fancybox-media',
    $theme_uri . '/style/js/fancybox/helpers/jquery.fancybox-media.js',
    ['fancybox'],
    '1.0.0',
    true
  );

  // Isotope (grid layout)
  wp_enqueue_script(
    'isotope',
    $theme_uri . '/style/js/jquery.isotope.min.js',
    ['jquery-custom'],
    null,
    true
  );

  // Easytabs
  wp_enqueue_script(
    'easytabs',
    $theme_uri . '/style/js/jquery.easytabs.min.js',
    ['jquery-custom'],
    null,
    true
  );

  // Owl Carousel (requires jQuery)
  wp_enqueue_script(
    'owl-carousel',
    $theme_uri . '/style/js/owl.carousel.min.js',
    ['jquery-custom'],
    null,
    true
  );

  // FitVids (responsive video embeds)
  wp_enqueue_script(
    'fitvids',
    $theme_uri . '/style/js/jquery.fitvids.js',
    ['jquery-custom'],
    null,
    true
  );

  // Prettify (code syntax highlighter)
  wp_enqueue_script(
    'prettify',
    $theme_uri . '/style/js/google-code-prettify/prettify.js',
    [],
    null,
    true
  );

  // SlickForms (form styling)
  wp_enqueue_script(
    'slickforms',
    $theme_uri . '/style/js/jquery.slickforms.js',
    ['jquery-custom'],
    null,
    true
  );

  // Retina display support
  wp_enqueue_script(
    'retina',
    $theme_uri . '/style/js/retina.js',
    [],
    null,
    true
  );

  // Main theme script (depends on many)
  wp_enqueue_script(
    'theme-scripts',
    $theme_uri . '/style/js/scripts.js',
    [
      'jquery-custom',
      'bootstrap',
      'owl-carousel',
      'fancybox',
      'isotope',
      'easytabs',
      'fitvids',
      'prettify',
      'retina'
    ],
    null,
    true
  );

  wp_enqueue_script(
    'feather-icons',
    'https://unpkg.com/feather-icons',
    [],
    null,
    true // Load in footer
  );

  // Add inline script to run feather.replace() after script loads
  wp_add_inline_script(
    'feather-icons',
    'feather.replace();'
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


// Boot Carbon Fields after theme setup
add_action('after_setup_theme', function () {
  Carbon_Fields::boot();

  foreach (glob(get_template_directory() . '/carbon-fields/*.php') as $file) {
    require_once $file;
  }
});


function remove_block_library_css()
{
  wp_dequeue_style('wp-block-library'); // Global
  wp_dequeue_style('wp-block-library-theme'); // Theme-specific block styles
  wp_dequeue_style('wc-block-style'); // WooCommerce blocks (if installed)
  wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);

function disable_wp_emojicons()
{
  // Remove emoji styles
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

  // Remove from admin
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');

  // Remove from emails
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

  // Remove DNS prefetch for emoji CDN
  add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

add_action('after_setup_theme', function () {
  remove_action('wp_head', 'wp_enqueue_speculationrules', 1);
});

function register_project_post_type() {
    register_post_type('project', [
        'labels' => [
            'name' => 'Projects',
            'singular_name' => 'Project',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'projects'],
        'supports' => ['title', 'editor', 'thumbnail', 'comments'],
        'menu_icon' => 'dashicons-portfolio',
    ]);
}
add_action('init', function () {
    register_project_post_type(); // ensure it's defined before flushing
    // flush_rewrite_rules(); // expensive, avoid on production
});

add_action('comment_post', function($comment_id) {
  if (isset($_POST['comment_type'])) {
    $type = sanitize_text_field($_POST['comment_type']);
    add_comment_meta($comment_id, 'comment_type', $type, true);
  }
});


