<?php/*
  require_once('path.php');
  require_once('phpmailer/PHPMailer.php');
  require_once('phpmailer/SMTP.php');
  require_once('phpmailer/Exception.php');
  require_once('class/database.php');

  $db = new database();
  session_start();

  if (!empty($_SESSION['email'])) {
   $result = $db->getProfile($_SESSION['id']);
  }*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Profile - Elite Researcher</title>
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
  <style>
    .contact .php-email-form select:focus {
      border-color: #5fcf80;
    }
    .contact .php-email-form select {
      height: 44px; border-radius: 4px; box-shadow: none; font-size: 14px;
    }
    img {
      width: 100%; height: 100%;
    }
    .choose {
      background: #5fcf80;
      border: 0;
      padding: 10px 35px;
      color: #fff;
      transition: 0.4s;
      border-radius: 50px;
    }
    .choose:hover {
      background: #3ac162;
    }
  </style>
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
          <li><a href="index.php">Home</a></li>

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
          <li class="dropdown d-flex flex-row justify-content-center"><a class="active" href="#"><img class="mx-1" src="<?php// echo URL.IMAGE.$result['profile']; ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;"><span><?php// echo $_SESSION['name']; ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php// if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Super Admin') : ?>
                <li><a href="admin/index.php">Go to Dashboard</a></li>
                <li><a href="myprofile.php?id=<?php// echo $_SESSION['id'] ?>">My Profile</a></li>
                <li><a class="active" href="mydocuments.php">My Documents</a></li>
                <li><a href="mycitations.php">Saved Citations</a></li>
                <li><a href="mybookmarks.php">Bookmarked Documents</a></li>
                <li><a href="logout.php">Log Out</a></li>
              <?php// else: ?>
                <li><a href="myprofile.php?id=<?php// echo $_SESSION['id'] ?>">My Profile</a></li>
                <li><a class="active" href="mydocuments.php">My Documents</a></li>
                <li><a href="mycitations.php">Saved Citations</a></li>
                <li><a href="mybookmarks.php">Bookmarked Documents</a></li>
                <li><a href="logout.php">Log Out</a></li>
              <?php// endif ?>
            </ul>
          </li>
        </ul>
        <?php// endif ?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php// if(!isset($_SESSION['email'])) : ?>
        <a href="login.php" class="get-started-btn">Get Started</a>
      <?php// endif ?>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" >
      <div class="container">
        <h2>My Documents</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="contact" class="contact">
      <div class="container" >
        <div class="row mt-5">
          <div class="col-lg-12 mt-5 mt-lg-0">
            <h4>Add Material</h4>
            <?php/*
            if(isset($_POST['submit'])){

              $user_id = $_SESSION['id'];

              $title = $_POST['title'];
              $description = $_POST['description'];
              $authors = $_POST['authors'];
              $year = $_POST['year'];
              $pub = $_POST['publisher'];
              $doc_id = $_POST['doc_category'];
              $file_id = $_POST['file_category'];
              $status = $_POST['status'];
              $filename = $_FILES['file']['name'];
              $move = $_FILES['file']['tmp_name'];

              date_default_timezone_set('Asia/Manila');

              $uploaded = date("Y-m-d h:i:sa");
              $updated = date("Y-m-d h:i:sa");

              echo $db->userInsertDocument($move, $user_id, $title, $description, $authors, $year, $pub, $status, $filename, $doc_id, $file_id, $uploaded, $updated);
            }*/?>
            <form action="" method="post" class="col-lg-12 php-email-forms d-flex flex-column justify-content-center align-items-center" id="validate" enctype="multipart/form-data">
              <div class="row-lg-12 form-data d-flex flex-row justify-content-center align-items-between">
                <div class="left col-lg-12 m-0 p-4">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" id="description" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="authors">Author(s)</label>
                    <input type="text" class="form-control" name="authors" id="authors" placeholder="Bonifacio, Andres A. | Ibarra, Simon B.">
                  </div>
                  <div class="form-group">
                    <label for="year">Publication Date</label>
                    <input type="text" class="form-control" name="year" id="year" placeholder="Month Day, Year">
                  </div>
                </div>

                <div class="right col-lg-12 m-0 p-4">
                  <div class="form-group">
                      <label for="publisher">Publisher</label>
                      <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                  </div>
                  <div class="form-group">
                    <label for="file_category">Select Status</label>
                    <select class="form-control" id="status" name="status">
                        <?php /*
                          $states = $db->getStates();
                          foreach ($states as $state): ?>
                            <option value="<?php echo $state['id'];?>"><?php echo $state['state'];?></option>
                        <?php endforeach;*/ ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="file_category">Select Document</label>
                    <select class="form-control" id="doc_category" name="doc_category">
                        <?php /*
                          $categories = $db->getDocs();
                        
                          foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
                        <?php endforeach; */?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="doc_category">Select Category</label>
                    <select class="form-control" id="file_category" name="file_category">
                        <?php /*
                          $files = $db->getFiles();
                          foreach ($files as $file): ?>
                            <option value="<?php echo $file['id'];?>"><?php echo $file['file'];?></option>
                        <?php endforeach; */?>
                    </select>
                  </div>        
                </div>
              </div>
              <div class="form-group d-flex col-lg-10 flex-row align-items-center justify-content-between">
                <div class="left d-flex flex-row align-items-between justify-content-between">
                  <div class="fileInput">
                    <label class="choose font-weight-bold rounded p-2" for="file">Upload Documents</label>
                    <input style="display: none;" onchange="preview(event);" type="file" name="file" class="file" id="file">
                  </div>
                  <div class="fileName d-flex flex-row align-items-center border-bottom border-dark">
                      <p class="m-1">File Name:</p>
                      <p class="m-1" id="actual-file-name"></p>
                  </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Add Document">
              </div>
            </form>
          </div> <!-- col -->
        </div> <!-- row -->
      </div> <!-- container -->
    </section><!-- End About Section -->

    <!-- ======= About Section ======= -->
    <section id="contact" class="contact">
      <div class="container" >
          <?php// $results = $db->getDocuments();?>

        <div class="row mt-5">
          <div class="col-lg-12 mt-5 mt-lg-0">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th scope="col">Authors</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php /*
                    foreach ($results as $doc) : 
                      if($doc['user_id'] == $_SESSION['id']): ?>
                        <tr>
                          <td> <a href="preview-document.php?id=<?= $doc['id']; ?>"><?= $doc['title']; ?></a></td>
                          <td><?= $doc['authors']; ?></td>
                          <td><?= $doc['state']; ?></td>
                        </tr>
                      <?php endif */?>
                    <?php// endforeach ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>

    </section><!-- End About Section -->

    
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
            <?php //if(isset($_POST['sub'])){
             // $email = $_POST['email'];
             // $db->addSubscribers($email);
            //}?>
            <form action="" method="post">
              <input type="email" id="email" name="email">
              <input type="submit" id="sub" name="sub" value="Subscribe">
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

  <!-- Vendor JS Files -->
  <script src="./admin/assets/js/jquery.slim.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script>
         $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#actual-file-name').html(fileName);
        });
    });
</script>
</body>

</html>
