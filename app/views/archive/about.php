<?php /*
  require_once('path.php');
  require_once('phpmailer/PHPMailer.php');
  require_once('phpmailer/SMTP.php');
  require_once('phpmailer/Exception.php');*/
  include('class/DBConnection.php');

  $db = new DBConnection();
  // session_start();

  // if (!empty($_SESSION['email'])) {
  //  $result = $con->getProfile($_SESSION['id']);
  // }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>About - Elite Researcher</title>
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
                        </li>
                        <li><a class="active" href="<?php echo site_url('nav/about'); ?>">About</a></li>
                        <li><a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>

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
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
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
        </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>About Us</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/about.jpg'; ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Elite Researcher: An Archive for Mindoro State University Research, Thesis, and Dissertation</h3>
            <p class="fst-italic">
              Just two years ago, everything seems to be alright. We are fine doing what we usually do until the pandemic caused by Covid-19 hits us all.
              <!-- At the blink of an eye everything we used to do suddenly changed, several restrictions are issued to prevent further spreading of the virus. -->
              Classes are now done remotely either online or via modular learning. Gathering resources became hard for those students who has research subjects like us due to non availability of physical libraries. With this, we became eager to developed an online archive for our institution that will cater all viable resources available during face-to-face classes. The developers aims:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> To create an archive of all the past and present studies conducted by the students, faculty and staffs.</li>
              <li><i class="bi bi-check-circle"></i> To generate automatic citation of the study selected in APA format.</li>
            </ul>
            <p>
              We hope that other researchers like us will be greatly benefited by using this site.
            </p>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">
            <div class="row counters">
                <?php
                    foreach($data['d_cat'] as $file) : ?>
                        <?php if($file['id'] != 1) :
                        $res = $db->get_cat_id($file['id']);
                        $rec = (int)$res;
                ?>
                        <div class="col-lg-3 col-8 text-center">
                            <span data-purecounter-start="0" data-purecounter-end="<?php echo $rec;?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p><?php echo $file['category'];?></p>
                        </div>
                    <?php endif?>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Developers</h2>
          <p>What are they saying</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/noeldimailig-removebg.png'; ?>" class="testimonial-img" alt="">
                  <h3>Noel M. Dimailig</h3>
                  <h4>Developer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    You know research is good when it is back up by other related studies.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/lilethpine-removebg.png'; ?>" class="testimonial-img" alt="">
                  <h3>Lileth V. Pine</h3>
                  <h4>Developer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Finding related studies is really hard when you don't know where to start.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="<?php echo BASE_URL . PUBLIC_DIR.'/assets/img/trainers/ed.png'; ?>" class="testimonial-img" alt="">
                  <h3>Eduardo M. Cabello</h3>
                  <h4>Developer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Research is the stepping stone to unfold the answers and good foundation of information is the key to open the opportunities.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <?php include('default/footer.php'); ?>

</body>

</html>
