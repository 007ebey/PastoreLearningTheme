<div class="parallax contact">
  <div class="container inner">
    <div class="thin">
      <div class="section-title text-center">
        <h2>post Your Question</h2>
        <span class="icon"><i class="icon-help"></i></span>
      </div>

      <div class="row">
        <div class="col-sm-8">
          <div class="form-container">
            <form class="forms" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
              <input type="hidden" name="action" value="submit_question">
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
            <p><?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'contact_message'));   ?></p>
            <ul class="contact-info">
              <li>
                <i class="icon-location"></i>
                <?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'contact_address')); ?>
              </li>
              <li>
                <i class="icon-phone"></i>
                <?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'contact_phone')); ?>
              </li>
              <li>
                <i class="icon-mail"></i>
                <a href="mailto:<?php echo antispambot(carbon_get_post_meta(get_the_ID(), 'contact_email')); ?>">
                  <?php echo antispambot(carbon_get_post_meta(get_the_ID(), 'contact_email')); ?>
                </a>
              </li>
            </ul>
          </div>
        </aside>

      </div>
    </div>
  </div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form.forms");

    if (form) {
        form.addEventListener("submit", function (e) {
            // Optional: prevent instant submit to show something before sending
            // e.preventDefault();

            // Show a loader or message before submission if you want
            alert("Qyestion submitted...");

            // Let the form POST normally, but listen for redirect success with hash
        });
    }

    // If redirected with success=1 in URL, show alert
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("success") === "1") {
        alert("Your question has been submitted successfully!");
    }
});
</script>