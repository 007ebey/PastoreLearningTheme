<div class="parallax contact">
  <div class="container inner">
    <div class="thin">
      <div class="section-title text-center">
        <h2>Post Your Question</h2>
        <span class="icon"><i class="icon-help"></i></span>
      </div>

      <div class="row">
        <div class="col-sm-8">
          <div class="form-container">
            <?php if (isset($_POST['submit_question'])): ?>
              <?php
                $name = sanitize_text_field($_POST['name']);
                $email = sanitize_email($_POST['email']);
                $subject = sanitize_text_field($_POST['subject']);
                $message = sanitize_textarea_field($_POST['message']);

                $post_id = wp_insert_post(array(
                  'post_title'   => wp_trim_words($message, 8, '...'),
                  'post_content' => $message,
                  'post_type'    => 'question',
                  'post_status'  => 'pending'
                ));

                if ($post_id && !is_wp_error($post_id)) {
                    carbon_set_post_meta($post_id, 'question_name', $name);
                    carbon_set_post_meta($post_id, 'question_email', $email);
                    carbon_set_post_meta($post_id, 'question_subject', $subject);
                    echo '<div class="alert alert-success">Thank you! Your question has been submitted.</div>';
                } else {
                    echo '<div class="alert alert-danger">There was an error. Please try again.</div>';
                }
              ?>
            <?php endif; ?>

            <form class="forms" method="post">
              <fieldset>
                <ol>
                  <li class="form-row text-input-row name-field">
                    <input type="text" name="name" class="text-input required" placeholder="Name (Required)" required />
                  </li>
                  <li class="form-row text-input-row email-field">
                    <input type="email" name="email" class="text-input required email" placeholder="Email (Required)" required />
                  </li>
                  <li class="form-row text-input-row subject-field">
                    <input type="text" name="subject" class="text-input" placeholder="Subject" />
                  </li>
                  <li class="form-row text-area-row">
                    <textarea name="message" class="text-area required" placeholder="Your Question..." required></textarea>
                  </li>
                  <li class="button-row">
                    <input type="submit" name="submit_question" value="Submit" class="btn btn-submit bm0" />
                  </li>
                </ol>
              </fieldset>
            </form>
          </div>
        </div>

        <aside class="col-sm-4 sidebar lp10">
          <div class="sidebox widget">
            <h4>Contact Details</h4>
            <p>You can also reach out through email or phone below.</p>
            <ul class="contact-info">
              <li><i class="icon-location"></i> Moon St. 14/05 Light, Jupiter</li>
              <li><i class="icon-phone"></i> 0247 541 65 87</li>
              <li><i class="icon-mail"></i> <a href="mailto:support@slowave.com">support@slowave.com</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</div>

