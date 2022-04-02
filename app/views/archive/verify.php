<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Verify Account - Elite Researcher</title>
    
    <?php include('default/header.php'); ?>
    <?php echo load_css(array('css/login')); ?>
  </head>

  <body>
    <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="index.php">Elite Researcher</a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a class="active" href="<?php echo site_url('user/verify'); ?>">Verify Account</a></li>
            <li><a href="<?php echo site_url('user/forgot'); ?>">Forgot Password</a></li>
            <li><a href="<?php echo site_url('nav/login'); ?>">Log In</a></li>
            <li><a href="<?php echo site_url('nav/signup'); ?>">Sign Up</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
      </div>
    </header><!-- End Header -->

    <main id="main">
      <div class="main-body">
        <div class="image-box">
          <img src="<?php echo BASE_URL . PUBLIC_DIR . '/assets/img/verify.png'; ?>" >
        </div>
        <div class="login-form">
          <div id="message"></div>
          <div class="form-group col-8">
            <h1>Verify Account</h1>
              <form id="verify-form" action="<?php echo site_url('user/verify_account'); ?>" method="post">
                <div class="form-group col-12">
                  <label for="verify_email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                  <input type="verify_email" id="verify_email" name="verify_email" class="login-text mb-2 form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group col-12">
                  <label for="verify_code" class="col-form-label col-form-label-lg">Verification Code</label>
                  <input type="verify_code" id="verify_code" name="verify_code" class="login-text mb-3 form-control" placeholder="Verification Code" required>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-lg btn-success btn-block form-control" value="Verify" id="signin" name="signin">
                </div>
              </form>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php echo load_js(array('assets/vendor/swiper/swiper-bundle.min')); ?>
    <?php echo load_js(array('assets/vendor/aos/aos')); ?>
    <?php echo load_js(array('assets/vendor/bootstrap/js/bootstrap.bundle.min')); ?>
    <!-- Template Main JS File -->
    <?php echo load_js(array('assets/js/main')); ?>

    <script>
      $('#verify-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            var res = JSON.parse(response);
            if(res.error == false) {
              $('#message').show();
              alertSuccess(res.msg);
              setTimeout(function(){
                $('#message-content').remove();
                $('#message').hide();

                location.replace('<?php echo "http://localhost/archive/nav/login"; ?>');
              }, 3000);
              $('#verify_email').val("");
              $('#verify_code').val("");
            } else {
              $('#message').show();
              alertError(res.msg);
              setTimeout(function(){
                $('#message-content').remove();
                $('#message').hide();
              }, 3000);
            }
          }
        });
      });

      function alertSuccess(message) {
        $('#message').append(
          '<div id="message-content">' +
            '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">' +
              '<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">' +
                '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>' +
              '</symbol>' +
            '</svg>' +
            '<div id="notify" style="display:none;" class="alert alert-success fade show d-flex align-items-center" role="alert">' +
              '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>' +
              '<div>' + message + '</div>' +
            '</div>' +
          '</div>');
      }

      function alertError(message) {
        $('#message').append(
          '<div id="message-content">' +
            '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">' +
              '<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">' +
                '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>' +
              '</symbol>' +
            '</svg>' +
            '<div class="alert alert-danger fade show d-flex align-items-center" role="alert">' +
              '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>' +
                '<div>' + message + '</div>' +
            '</div>' +
          '</div>');
      }
    </script>
  </body>
</html>
