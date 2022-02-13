<?php/*

  require_once('class/database.php');

  $con = new database();
  session_start();

  // if (empty($_SESSION['email'])) {
  //   header('location:index.php');
  // }*/

?>

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
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

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
                  <input type="text" id="name" name="name" class="login-text mb-2 form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group col-12">
                  <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                  <input type="email" id="email" name="email" class="login-text mb-2 form-control" placeholder="Email address" required>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
                  <input type="password" id="password" name="password" class="login-text mb-3 form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <label for="confirm" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
                  <input type="password" id="confirm" name="confirm" class="login-text mb-3 form-control" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-lg btn-block form-control" value="Sign Up" id="signup" name="signup">
                </div>
              </form>
          </div>
        </div>
      </div>
    </main>
  
    <?php include('default/footer.php'); ?>
    <script>
      $('signup-form').submit(function(e) {
        e.preventDefault();
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
