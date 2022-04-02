<?php $modal_id = []; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Saved Citations - Elite Researcher</title>
  <?php include('default/header.php'); ?>
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
    #options i {
      font-size: 18px;
      color: #37423b;
    }
    #options button {
      background-color: transparent;
      border: none;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="<?php echo site_url('nav/index'); ?>">Elite Researcher</a></h1>
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
              <li><a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>

              <?php if($this->session->userdata('user_email')) : ?> 
              <li class="dropdown d-flex flex-row justify-content-center">
                  <a href="#">
                      <img class="mx-1" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$this->session->userdata('user_profile'); ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;">
                      <span><?php echo $this->session->userdata('username'); ?></span> <i class="bi bi-chevron-down"></i>
                  </a>
                  <ul>
                      <?php if($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 2) : ?>
                          <li><a href="<?php echo site_url('nav/dashboard'); ?>">Go to Dashboard</a></li>
                          <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                          <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                          <li><a class="active" href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                          <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                          <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                          <?php else: ?>
                          <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                          <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                          <li><a class="active" href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
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
    <div class="breadcrumbs" >
      <div class="container">
        <h2>Save Citations</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">
        <h4>APA Format</h4><p id="message" class="text-secondary mr-3"></p>
          <div class="col-lg-12 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-row justify-content-center align-items-center">
                <div class="col-12 d-flex flex-column align-items-between justify-content-center">
                  <?php
                   foreach ($data as $cite) : $modal_id[] = ''.$cite['id']; ?>
                      <div class="d-flex flex-row justify-content-between align-items-between">
                        <div class="d-flex flex-column align-items-start justify-content-center mt-4 mt-xl-0">
                          <div class="d-flex flex-row justify-content-between align-items-between">
                            <div>
                              <p><a href="<?php echo site_url('nav/preview/'.encrypt_id($cite['id'])); ?>"><?= $cite['title']; ?></a></p>
                            </div>
                          </div>
                          <p class="mt-1" id="cite_apa_id<?php echo $cite['id']; ?>"></p>
                          <p class="mt-1" id="cite_mla_id<?php echo $cite['id']; ?>"></p>
                      </div>
                      <div id="options">
                        <form id="deleteform<?= $cite['id']; ?>" action="<?php echo site_url('cite/delete'); ?>" method="post" class="d-flex flex-row justify-content-between align-items-center p-0 m-0">
                          <input class="p-0 m-0" type="hidden" name="uid" id="uid<?= $cite['id']; ?>" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                          <input class="p-0 m-0" type="hidden" name="did" id="did<?= $cite['id']; ?>" value="<?= $cite['id']; ?>">
                          <button class="p-0 mb-3 d-inline-block" id="deletecite<?= $cite['id']; ?>" name="deletecite" type="submit"><i class="bi bi-trash" title="Delete Citation" data-toggle="modal"></i></button>
                        </form>
                      </div>
                      </div>
                      
                  <?php endforeach ?>
                </div>
            </div><!-- End .content-->
          </div>
        </div>
      </div>
    </section><!-- End About Section -->
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('default/footer.php'); ?>

  <!-- Modal -->  
    <?php foreach ($modal_id as $modal) :
      $id = $modal; ?>

      <script>
        $(document).ready(function () {
          $('#deleteform<?= $id; ?>').submit(function (e) {
            e.preventDefault();
            var uid = $('#uid<?= $id; ?>').val();
            var did = $('#did<?= $id; ?>').val();
            var form = $('#deleteform<?= $id; ?>');

            if(uid == ""){
              location.replace('http://localhost/archive/nav/login');
            }else{
              $.ajax({
                type: "POST",
                url: '<?php echo site_url('cite/delete'); ?>',
                data: form.serialize(),
                success: function (data) {
                  
                }
              });
            }
          });
        });

        $('#cite_apa_id<?= $id; ?>').load("<?php echo site_url('nav/get_apa_citations/'. encrypt_id($id)); ?>");
        $('#cite_mla_id<?= $id; ?>').load("<?php echo site_url('nav/get_mla_citations/'. encrypt_id($id)); ?>");
      </script>
    <?php endforeach ?>
</body>

</html>