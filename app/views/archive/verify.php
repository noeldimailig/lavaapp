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
          <?php echo alert_error('verify'); ?>
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

    <script>
      $('verify-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            $('#verify_email').val("");
            $('#verify_code').val("");
          }
        });
      });
    </script>
  </body>
</html>
