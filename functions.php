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

  wp_enqueue_script(
    'youtube-iframe-api',
    'https://www.youtube.com/iframe_api',
    array(), // No dependencies
    null,    // No version needed
    true     // Load in footer
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
      'name'          => 'Projects',
      'singular_name' => 'Project',
    ],
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => ['slug' => 'projects'],
    'supports'     => ['title', 'editor', 'thumbnail', 'comments'],
    'taxonomies'   => ['category'], // ✅ Enable default categories
    'menu_icon'    => 'dashicons-portfolio',
  ]);
}
add_action('init', 'register_project_post_type');

add_action('init', function () {
  register_project_post_type(); // ensure it's defined before flushing
  // flush_rewrite_rules(); // expensive, avoid on production
});

add_action('comment_post', function ($comment_id) {
  if (isset($_POST['comment_type'])) {
    $type = sanitize_text_field($_POST['comment_type']);
    add_comment_meta($comment_id, 'comment_type', $type, true);
  }
});

add_action('init', function () {
  register_post_type('testimonial', [
    'labels' => [
      'name' => 'Testimonials',
      'singular_name' => 'Testimonial',
    ],
    'public' => true,
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => ['title', 'editor', 'custom-fields'],
    'menu_icon' => 'dashicons-testimonial',
  ]);
});

// Handle form submission
add_action('admin_post_nopriv_submit_testimonial', 'render_testimonial_confession_form');
add_action('admin_post_submit_testimonial', 'render_testimonial_confession_form');

function render_testimonial_confession_form()
{
  handle_testimonial_submission();
}

function handle_testimonial_submission()
{
  if (
    isset($_POST['name'], $_POST['email'], $_POST['message']) &&
    !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])
  ) {
    $post_id = wp_insert_post([
      'post_type' => 'testimonial',
      'post_title' => sanitize_text_field($_POST['name']),
      'post_content' => sanitize_textarea_field($_POST['message']),
      'post_status' => 'pending',
    ]);

    if ($post_id && !is_wp_error($post_id)) {
      update_post_meta($post_id, 'email', sanitize_email($_POST['email']));
      // Carbon Field is false by default (unchecked)
    }
  }
  wp_redirect(home_url('/thank-you/'));
  exit;
}

function register_portfolio_post_type()
{
  register_post_type('portfolio', array(
    'labels' => array(
      'name' => 'Portfolios',
      'singular_name' => 'Portfolio',
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'portfolio'),
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array('title', 'editor', 'thumbnail'),
    'taxonomies' => array('category'), // ✅ Adds built-in category support

  ));
}
add_action('init', 'register_portfolio_post_type');

function register_question_post_type()
{
  register_post_type('question', array(
    'labels' => array(
      'name' => 'Questions',
      'singular_name' => 'Question',
      'add_new_item' => 'Post a Question',
    ),
    'public' => true,
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'menu_icon' => 'dashicons-format-chat',
  ));
}
add_action('init', 'register_question_post_type');


add_action('wp_enqueue_scripts', function () {
  if (is_page_template('portal-login.php')) {

    // 1. Enqueue Wordfence Login Security JS
    wp_enqueue_script(
      'wordfenceLS-login',
      plugins_url(
        'js/login.1736959993.js',
        WP_PLUGIN_DIR . '/wordfence-login-security/wordfence-login-security.php'
      ),
      ['jquery'],
      null,
      true
    );

    // Localize translations for the Wordfence login script
    wp_localize_script('wordfenceLS-login', 'WFLS_LOGIN_TRANSLATIONS', [
      'MessageToSupport'                                 => __('Message to Support', 'wordfence'),
      'Send'                                            => __('Send', 'wordfence'),
      'ErrorSendingMessage'                             => __('An error was encountered while trying to send the message. Please try again.', 'wordfence'),
      'ErrorSendingMessageStrong'                       => __('<strong>ERROR</strong>: An error was encountered while trying to send the message. Please try again.', 'wordfence'),
      'LoginFailed403'                                  => __('Login failed with status code 403. Please contact the site administrator.', 'wordfence'),
      'LoginFailed403Strong'                            => __('<strong>ERROR</strong>: Login failed with status code 403. Please contact the site administrator.', 'wordfence'),
      'LoginFailed503'                                  => __('Login failed with status code 503. Please contact the site administrator.', 'wordfence'),
      'LoginFailed503Strong'                            => __('<strong>ERROR</strong>: Login failed with status code 503. Please contact the site administrator.', 'wordfence'),
      'Wordfence2FACode'                                => __('Wordfence 2FA Code', 'wordfence'),
      'RememberFor30Days'                               => __('Remember for 30 days', 'wordfence'),
      'LogIn'                                           => __('Log In', 'wordfence'),
      'ErrorAuth'                                       => __('<strong>ERROR</strong>: An error was encountered while trying to authenticate. Please try again.', 'wordfence'),
      'Wordfence2FAInstructions'                        => __('The Wordfence 2FA Code can be found within the authenticator app you used when first activating two-factor authentication. You may also use one of your recovery codes.', 'wordfence'),
    ]);

    // 3. Localize WFLSVars with the same handle
    wp_localize_script('wordfenceLS-login', 'WFLSVars', [
      'loginPage'       => true,
      'ajaxurl'         => admin_url('admin-ajax.php'),
      'nonce'           => wp_create_nonce('wfls-nonce'),
      'recaptchasitekey' => '',
      'useCAPTCHA'      => '',
      'allowremember'   => '',
      'verification'    => '',
      'siteURL'         => site_url(),
    ]);


    // 4. Add the hidden token field in your form (required for OTP/captcha)
    add_action('wp_footer', function () {
      if (is_page_template('portal-login.php')) {
        echo '<input type="hidden" name="wfls-token" value="' . esc_attr(wp_create_nonce('wfls-token')) . '">';
      }
    });
  }
});

add_action('after_setup_theme', function () {
  if (is_page_template('portal-login.php')) {
    if (!defined('WP_LOGIN')) {
      define('WP_LOGIN', true);
    }
  }
});

add_action('wp_footer', function () {
  if (is_page_template('portal-login.php')) {
    echo "<script>if(window.WFLSVars){WFLSVars.loginPage = true;}</script>";
  }
}, 100);

// In wp-config.php or functions.php
add_filter('wordfence_is_firewall_enabled', '__return_false');

function mytheme_enqueue_comment_delete_script() {
    wp_enqueue_script(
        'comment-delete',
        get_template_directory_uri() . '/style/js/comment-delete.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('comment-delete', 'commentDelete', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('delete_comment_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_comment_delete_script');

// Handle AJAX delete comment
add_action('wp_ajax_delete_comment', 'handle_delete_comment');
function handle_delete_comment() {
    // Verify nonce
    check_ajax_referer('delete_comment_nonce', 'nonce');

    if (empty($_POST['comment_id'])) {
        wp_send_json_error('No comment ID provided.');
    }

    $comment_id = intval($_POST['comment_id']);

    // Try to delete comment
    if (wp_delete_comment($comment_id, true)) {
        wp_send_json_success(array('comment_id' => $comment_id));
    } else {
        wp_send_json_error('Failed to delete comment.');
    }
}

