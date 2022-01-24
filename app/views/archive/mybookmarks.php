<?php
  require_once('class/DBConnection.php');

  $db = new DBConnection();
/*
  if (!empty($_SESSION['email'])) {
   $result = $db->getProfile($_SESSION['id']);
  }*/
  $modal_id = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Bookmarks - Elite Researcher</title>
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
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a class="active" href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a class="active" href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
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
        <h2>My Bookmarks</h2>
      </div>
    </div><!-- End Breadcrumbs -->

   <!-- ======= Features Section ======= -->
    <section id="features" class="features mt-5">
      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-12">
             <?php
               foreach ($data['docs'] as $doc) :  $modal_id[] = ''.$doc['id']; ?>
                    <div class="col-lg-12 mb-3" id="main-div<?= $doc['id']; ?>">
                      <div class="icon-box">
                        <div class="col-lg-12 d-flex flex-column">
                        	<div id="options" class="title-cite d-flex flex-row justify-content-between align-items-between">
                        		<h6><a href="<?php echo site_url('nav/preview/'.encrypt_id($doc['id'])); ?>"><?php echo $doc['title']; ?></a></h6>
                        		<div class="d-flex flex-row justify-content-between align-items-between">
                              <a href="<?php echo site_url('nav/preview/'.encrypt_id($doc['id'])); ?>"><i class="bi bi-link" title="Cite"></i></a>
                              <div id="options">
                        <form id="deleteform<?= $doc['id']; ?>" action="" method="post" class="d-flex flex-row justify-content-between align-items-center p-0 m-0">
                          <input class="p-0 m-0" type="hidden" name="uid" id="uid<?= $doc['id']; ?>" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                          <input class="p-0 m-0" type="hidden" name="did" id="did<?= $doc['id']; ?>" value="<?= $doc['id']; ?>">
                          <button class="p-0 mb-3 d-inline-block" id="deletecite<?= $doc['id']; ?>" name="deletecite" type="submit"><i class="bi bi-trash" title="Delete Citation" data-toggle="modal"></i></button>
                        </form>
                      </div>
                            </div> 
                        	</div>
                          
                          <p class="text-secondary"><?php echo $doc['authors']; ?></p>
                        </div>
                        
                      </div>
                    </div>

                <?php endforeach ?>
          </div>
        </div>
    </section><!-- End Features Section -->
  </main><!-- End #main -->
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

            $.ajax({
              type: "POST",
              url: '<?php echo site_url('book/delete'); ?>',
              data: form.serialize(),
              success: function (res) {
                
              }
            });
          });
        });
      </script>
    <?php endforeach ?>
    <script>
      $('search-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            $('#search').val("");
          }
        });
      });
    </script>
</body>

</html>
