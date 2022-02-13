<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forgot Password - Elite Researcher</title>
    
    <?php include('default/header.php'); ?>
    <?php echo load_css(array('css/login')); ?>
  </head>

  <body>
    <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="index.php">Elite Researcher</a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="<?php echo site_url('user/verify'); ?>">Verify Account</a></li>
            <li><a class="active" href="<?php echo site_url('user/forgot'); ?>">Forgot Password</a></li>
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
          <img src="<?php echo BASE_URL . PUBLIC_DIR . '/assets/img/forgot_password.png'; ?>" >
        </div>
        <div class="login-form">
          <?php echo alert_error('forgot'); ?>
          <div class="form-group col-8">
            <h1>Forgot Password</h1>
              <form id="forgot-form" action="<?php echo site_url('user/forgot_password'); ?>" method="post">
                <div class="form-group col-12">
                  <label for="forgot_email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                  <input type="forgot_email" id="forgot_email" name="forgot_email" class="login-text mb-2 form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group col-12">
                  <label for="forgot_pass" class="col-form-label col-form-label-lg">New Password</label>
                  <input type="forgot_pass" id="forgot_pass" name="forgot_pass" class="login-text mb-3 form-control" placeholder="New Password" required>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-lg btn-success btn-block form-control" value="Confirm" id="signin" name="signin">
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
      $('forgot-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            $('#forgot_email').val("");
            $('#forgot_pass').val("");
          }
        });
      });
    </script>
  </body>
</html>
