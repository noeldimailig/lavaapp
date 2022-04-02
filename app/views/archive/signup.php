
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sign Up - Elite Researcher</title>
    <?php include('default/header.php'); ?>
    <?php echo load_css(array('css/login')); ?>
  </head>

  <body>
  <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="index.php">Elite Researcher</a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="<?php echo site_url('nav/index'); ?>">Home</a></li>

            <li class="dropdown"><a href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="<?php echo site_url('nav/research');?>">Research</a></li>
                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('nav/about'); ?>">About</a></li>
            <li><a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>
            <li><a href="<?php echo site_url('nav/login'); ?>">Log In</a></li>
            <li><a class="active" href="<?php echo site_url('nav/signup'); ?>">Sign Up</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <!-- <a href="courses.html" class="get-started-btn">Get Started</a> -->

      </div>
    </header><!-- End Header -->

    <main id="main">
      <div class="main-body">
        <div class="image-box">
          <img src="<?php echo BASE_URL . PUBLIC_DIR . '/img/sign_up.png'; ?>" >
        </div>
        <div class="signup-form">
          <?php
            echo alert_error('error');
          ?>
          <div class="form-group col-8">
            <h1>Sign Up</h1>
              <form id="signup-form" action="<?php echo site_url('user/register'); ?>" method="post">
                <div class="form-group col-12">
                  <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Username</label>
                  <input type="text" id="sname" name="sname" class="login-text mb-2 form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group col-12">
                  <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                  <input type="email" id="semail" name="semail" class="login-text mb-2 form-control" placeholder="Email address" required>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
                  <input type="password" id="spassword" name="spassword" class="login-text mb-3 form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <label for="confirm" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
                  <input type="password" id="sconfirm" name="sconfirm" class="login-text mb-3 form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-lg btn-block form-control" value="Sign Up" id="signup" name="signup">
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
      $('#signup-form').submit(function(e) {
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            $('#username').val("");
            $('#email').val("");
            $('#password').val("");
            $('#confirm').val("");
          }
        });
      });
    </script>
   </body>
</html>
