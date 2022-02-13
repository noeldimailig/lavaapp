
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact - Elite Researcher</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include('default/header.php'); ?>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center">
                <h1 class="logo me-auto"><a href="<?php echo site_url('nav/index'); ?>">Elite Researcher</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><a href="<?php echo site_url('nav/index'); ?>">Home</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                            </ul>
                        </li><a href="<?php echo site_url('nav/about'); ?>">About</a></li>
                        <li><a class="active" href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>

                        <?php if($this->session->userdata('user_email')) : ?> 
                        <li class="dropdown d-flex flex-row justify-content-center">
                            <a href="#">
                                <img class="mx-1" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$this->session->userdata('user_profile'); ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;">
                                <span><?php echo $this->session->userdata('username'); ?></span> <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul>
                                <?php if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3) : ?>
                                    <li><a href="<?php echo site_url('nav/dashboard'); ?>">Go to Dashboard</a></li>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li><li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                    </ul>
                <?php endif ?>
                </nav><!-- .navbar -->
                <?php if(!isset($_SESSION['user_email'])) : ?>
                <a href="<?php echo site_url('nav/login'); ?>" class="get-started-btn">Get Started</a>
                <?php endif ?>
            </div>
        </header><!-- End Header --><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Contact Us</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact mt-4">
      <div class="mapouter mx-auto"><div class="gmap_canvas"><iframe width="1300" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Mindoro%20State%20University%20Victoria%20oriental%20mindoro&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:1110px; }</style><a href="https://www.embedgooglemap.net">google maps insert</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:1110px;}</style></div></div>
      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Oriental Mndoro, Philippines</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>eliteresearcher@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+6391234567899</p>
              </div>
            </div>
          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            <form action="<?php echo site_url('user/message'); ?>" method="post" role="form" id="contact-form" class="php-email-forms">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <!-- <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div> -->
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message">Something went wrong! Please</div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><input type="submit" id="submit" name="submit" value="Send Message"></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include('default/footer.php'); ?>

  <script>
      $('#contact-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            $('#email').val("");
            $('#name').val("");
            $('#message').val("");
          }
        });
      });
    </script>
</body>

</html>
