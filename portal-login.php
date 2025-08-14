<?php

/**
 * Template Name: Portal Login
 * Template Post Type: page
 */

// Allow Wordfence to accept this as a valid login form
add_filter('wfls_custom_login_form', '__return_true');

// Set WordPress test cookie for login validation
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);

get_header();
?>

<?php get_template_part('template-parts/nav'); ?>

<div class="offset"></div>
<div class="light-wrapper page-title">
  <div class="container inner">
    <h1>Login Page</h1>
  </div>
</div>
<div class="dark-wrapper">
  <div class="container inner">
    <div class="row">
      <div class="col-sm-6">
        <h3>Registered Customers</h3>
        <p>Login to access our private video catalog and access other features (coming soon!).</p>
        <div class="divide15"></div>
        <div class="form-container" style="max-width: 400px; margin: 50px auto;">
          <h2>Login</h2>

          <?php if (is_user_logged_in()) :
            $current_user = wp_get_current_user();
          ?>
            <p>Welcome, <strong><?php echo esc_html($current_user->display_name); ?></strong>! You are logged in.</p>
            <p><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Log out</a></p>
          <?php else : ?>

            <?php
            // Output default WP login form but keep Wordfence hooks working
            ob_start();
            do_action('login_form'); // Wordfence captcha / 2FA
            $extra_fields = ob_get_clean();

            wp_login_form([
              'redirect'       => home_url('/projects/'),
              'remember'       => false,
              'label_username' => 'Username or Email',
              'label_password' => 'Password',
              'label_log_in'   => 'Login',
              'form_id'        => 'loginform',
              'id_username'    => 'user_login',
              'id_password'    => 'user_pass',
              'id_remember'    => 'rememberme',
              'id_submit'      => 'wp-submit',
              'value_remember' => true,
            ]);

            // Inject Wordfence's HTML inside the form (after password field)
            ?>
            <script>
              (function() {
                let pwdField = document.querySelector('#user_pass');
                if (pwdField && <?php echo json_encode(trim($extra_fields) !== ''); ?>) {
                  pwdField.insertAdjacentHTML('afterend', <?php echo json_encode($extra_fields); ?>);
                }
              })();
            </script>

          <?php endif; ?>
        </div>

        <style>
          #authcode {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            background-color: #fff;
            color: #7a7a7a;
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            font-weight: 500;
            transition: border-color 0.2s ease-in, box-shadow 0.2s ease-in;
            box-sizing: border-box;
          }

          #authcode:focus {
            border-color: #3f8dbf;
            box-shadow: 0 0 4px rgba(63, 141, 191, 0.3);
            outline: none;
          }

          label[for="authcode"] {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #616161;
            font-size: 14px;
          }

          .g-recaptcha {
            margin-top: 15px;
            transform: scale(1);
            transform-origin: 0 0;
          }

          @media (max-width: 400px) {
            .g-recaptcha {
              transform: scale(0.9);
              transform-origin: 0 0;
            }
          }
        </style>
      </div>

      <div class="col-sm-6">
        <h3>New User? Reach out!</h3>
        <p>Contact the administrator for login access.</p>
        <div class="divide20"></div>
        <h3>Or connect with your social profile</h3>
        <p>Follow our posts and updates regarding our ministry</p>
        <div class="connect">
          <a href="https://www.instagram.com/hisnearnessbangalore/" class="btn btn-large share-instagram"><i class="icon-s-instagram"></i> Connect with Instagram</a>
          <a href="https://www.threads.com/@hisnearnessbangalore" class="btn btn-large share-facebook"><i class="icon-s-facebook"></i> Connect with Threads</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/main-footer'); ?>

<?php get_footer(); ?>
