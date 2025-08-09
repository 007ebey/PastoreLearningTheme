<?php

/**
 * Template Name: Portal Login
 * Template Post Type: page
 */

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
            <form class="forms" name="loginform" id="loginform" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>" method="post">
              <fieldset>
                <ol>
                  <li class="form-row text-input-row email-field">
                    <input type="text" name="log" class="text-input required" placeholder="Username or Email" required>
                  </li>
                  <li class="form-row text-input-row password-field">
                    <input type="password" name="pwd" class="text-input required" placeholder="Password" required>
                  </li>

                  <?php
                  // This adds all necessary Wordfence fields (2FA, CAPTCHA, token, etc)
                  do_action('login_form');
                  ?>

                  <li class="button-row">
                    <input type="submit" name="wp-submit" class="btn btn-submit" value="Login">
                  </li>
                </ol>

                <!-- Required hidden fields -->
                <input type="hidden" name="testcookie" value="1">
                <input type="hidden" name="wfls-nonce" value="<?php echo esc_attr(wp_create_nonce('wfls-nonce')); ?>" />
                <input type="hidden" name="redirect_to"  value="<?php echo esc_url( get_permalink() ); ?>">
              </fieldset>
            </form>
          <?php endif; ?>


        </div>

        <style>
          /* Make Wordfence 2FA and CAPTCHA match your form styling */
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

          /* Keep CAPTCHA full width and spaced nicely */
          .g-recaptcha {
            margin-top: 15px;
            transform: scale(1);
            transform-origin: 0 0;
          }

          /* For smaller screens, scale reCAPTCHA to fit */
          @media (max-width: 400px) {
            .g-recaptcha {
              transform: scale(0.9);
              transform-origin: 0 0;
            }
          }
        </style>
        <!-- /.form-container -->

      </div>
      <div class="col-sm-6">
        <h3>New User? Reach out!</h3>
        <p>Contact the admistrator for login access.</p>
        <div class="divide20"></div>
        <h3>Or connect with your social profile</h3>
        <p>Follow our posts and updates regarding our ministry</p>
        <div class="connect"> <a href="https://www.instagram.com/hisnearnessbangalore/" class="btn btn-large share-instagram"><i class="icon-s-instagram"></i> Connect with Instagram</a> <a href="https://www.threads.com/@hisnearnessbangalore" class="btn btn-large share-facebook"><i class="icon-s-facebook"></i> Connect with Threads</a> </div>
        <!-- /.connect -->

      </div>
    </div>
  </div>
  <!-- /.container -->
</div>

<?php get_template_part('template-parts/main-footer'); ?>

<?php get_footer(); ?>
