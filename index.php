<?php/*
  require_once('path.php');
  require_once('phpmailer/PHPMailer.php');
  require_once('phpmailer/SMTP.php');
  require_once('phpmailer/Exception.php');
  require_once('class/database.php');

  $con = new database();
  session_start();

  if (!empty($_SESSION['email'])) {
   $result = $con->getProfile($_SESSION['id']);
  }

  $recent = $con->getDocuments();*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home - Elite Researcher</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./admin/assets/img/icon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v4.6.1
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Elite Researcher</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="index.php">Home</a></li>

          <li class="dropdown"><a href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="research.php">Research</a></li>
              <li><a href="thesis.php">Thesis</a></li>
              <li><a href="dissertation.php">Dissertation</a></li>
              <li><a href="capstone.php">Capstone</a></li>
            </ul>
          </li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        <?php// if(isset($_SESSION['email'])) : ?> 
          <li class="dropdown d-flex flex-row justify-content-center"><a href="#"><img class="mx-1" src="<?php// echo URL.IMAGE.$result['profile']; ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;"><span><?php// echo $_SESSION['name']; ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php// if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Super Admin') : ?>
                <li><a href="admin/index.php">Go to Dashboard</a></li>
                <li><a href="myprofile.php?id=<?php// echo $_SESSION['id'] ?>">My Profile</a></li>
                <li><a href="mydocuments.php">My Documents</a></li>
                <li><a href="mycitations.php">Saved Citations</a></li>
                <li><a href="mybookmarks.php">Bookmarked Documents</a></li>
                <li><a href="logout.php">Log Out</a></li>
              <?php// else: ?>
                <li><a href="myprofile.php?id=<?php// echo $_SESSION['id'] ?>">My Profile</a></li>
                <li><a href="mydocuments.php">My Documents</a></li>
                <li><a href="mycitations.php">Saved Citations</a></li>
                <li><a href="mybookmarks.php">Bookmarked Documents</a></li>
                <li><a href="logout.php">Log Out</a></li>
              <?php// endif ?>
            </ul>
          </li>
        </ul>
        <?php// endif ?>
      </nav><!-- .navbar -->
      <?php// if(!isset($_SESSION['email'])) : ?>
        <a href="login.php" class="get-started-btn">Get Started</a>
      <?php// endif ?>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2><q>Don't look for facts and research to fit your narative: build a story out of what you find</q></h2>
      <h4 style="color: #c4c4c4;"><i>-Brendan Wolfe</i></h4>
      <a href="login.php" class="btn-get-started">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

   <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
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
          <?php/*
          $result = $con->get_category();
          foreach($result as $file) : ?>
            <?php if($file['id'] != 1) :
              $res = $con->get_cat_id($file['id']);
              $rec = (int)$res;*/
              ?>

            <div class="col-lg-3 col-6 text-center">
              <span data-purecounter-start="0" data-purecounter-end="<?// echo $rec;?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php// echo $file['category'];?></p>
            </div>
          <?php// endif?>
        <?php// endforeach ?>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Elite Researcher?</h3>
              <p>
                Administrators of the site are staffs of the institution to assure the integrity and credibility of documents being provided.
              </p>
              <div class="text-center">
                <a href="about.php" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-file"></i>
                    <h4>Source Materials</h4>
                    <p>All the documents provided are in PDF format.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-calendar"></i>
                    <h4>Up to Date</h4>
                    <p>All the documents are up to date.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-lock"></i>
                    <h4>Authenticity</h4>
                    <p>All the documents provided are original and with full consent of the author(s).</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-links-line" style="color: #ffbb2c;"></i>
              <h3><a href="research.php">Generate References</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-archive-line" style="color: #5578ff;"></i>
              <h3><a href="mydocuments.php">Upload Your Own Study</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4  mt-md-0">
            <div class="icon-box">
              <i class="ri-bookmark-3-line" style="color: #11dbcf;"></i>
              <h3><a href="mybookmarks.php">Bookmark Studies</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4  mt-md-0">
            <div class="icon-box">
              <i class="ri-search-line" style="color: #29cc61;"></i>
              <h3><a href="research.php">Search Specific Documents</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Studies</h2>
          <p>Recent Uploads</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <?php// foreach($recent as $doc) : 
             // if($doc['state'] == 'Published'):?>
            <div class="swiper-slide">
              <div class="courses">
                <div class="col-lg-12 d-flex align-items-stretch">
                  <div class="course-item">
                    <!-- <img src="assets/img/course-1.jpg" class="img-fluid" alt="..."> -->
                    <div class="course-content">
                      <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Web Development</h4>
                        <p class="price">$169</p>
                      </div> -->
                      <?php/*
                      	$link = "";
                      	if(isset($_SESSION['email']))
                      		$link = "preview-document.php?id=".$doc['id'];
                      	else $link = "login.php";*/
                      ?>
                      <h6><a href="<?php// echo $link; ?>"><?php// echo $doc['title'];?></a></h6>
                      <p><?php/*
                          $sub_desc = "" ;
                        $desc_length = strip_tags($doc['description']);
                        if(strlen($desc_length) > 500){
                          $shorten = substr($desc_length, 0, 100);
                          $sub_desc = substr($shorten, 0, strrpos($shorten, ' ')).'...';
                          echo $sub_desc;
                        }  
                        else echo $sub_desc;*/
                        ?></p>
                      <div class="trainer d-flex justify-content-between align-items-center">
                        <div class="trainer-profile d-flex align-items-center">
                          <!-- <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""> -->
                          <span><?php// echo $doc['authors']; ?></span>
                        </div>
                        <!-- <div class="trainer-rank d-flex align-items-center">
                          <i class="bx bx-link"></i>&nbsp;50
                          &nbsp;&nbsp;
                          <i class="bx bx-bookmark"></i>&nbsp;65
                        </div> -->
                      </div>
                    </div>
                  </div> <!-- End Course Item-->
                </div> <!-- End Col -->
              </div> <!-- End Courses -->
            </div><!-- End testimonial item -->
            <?php// endif ?>
            <?php //endforeach ?>



          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->
   
    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Developers</h2>
        </div>
        <div class="row d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/noeldimailig-removebg.png" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Noel M. Dimailig</h4>
                <span>Developer</span>
                <p>
                  You know research is good when it is back up by other related studies.
                </p>
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                  <a href="https://web.facebook.com/noeldimail" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/no.el7729/" target="_blank"><i class="bi bi-instagram"></i></a>
                  <a href="https://github.com/noeldimailig" target="_blank"><i class="bi bi-github"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/lilethpine-removebg.png" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Lileth V. Pine</h4>
                <span>Developer</span>
                <p>
                 Finding related studies is really hard when you don't know where to start.
                </p>
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a> -->
                  <a href="https://web.facebook.com/lilethpine" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/lethpine/" target="_blank"><i class="bi bi-instagram"></i></a>
                  <a href="https://github.com/lilethpine" target="_blank"><i class="bi bi-github"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Elite Researcher</h3>
            <p>
            Mindoro State University<br>
            Oriental, Mindoro<br>
            Philippines <br><br>
            <strong>Phone:</strong> +6391234567899<br>
            <strong>Email:</strong> eliteresearcher2021@gmail.com<br>
            </p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contact</a></li>
           
            </ul>
        </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="research.php">Cite References</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="mybookmarks.php">Bookmark Studies</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="mydocuments.php">Upload Your Own Study</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Be notified when there is something new in our site.</p>
            <?php// if(isset($_POST['submit']) && isset($_SESSION['id'])){
              //$email = $_POST['email'];
              //$con->addSubscribers($email);
            //}?>
            <form action="" method="post">
              <input type="email" id="email" name="email">
              <input type="submit" id="submit" name="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Elite Researcher</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
       Designed by <a href="index.php">Dimailig | Pine</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/ResearcherElite" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://web.facebook.com/Elite-Researcher-109216054929284" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/eliteresearcher2021/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="border-0" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
 
</body>

</html>
