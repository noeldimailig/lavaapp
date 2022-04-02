<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PDF Viewer - Elite Researcher</title> 

    <?php include('default/header.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css" integrity="sha512-I8lSB676wT2jGSNnvIhbYGqHMiZOc0+cl18soJSWPvJCkGm8xnTcXZafn2xTf1woMXz1AY3Z1Vd/qAPvjXB4Kw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php echo load_css(array('assets/css/pdf_viewer')); ?>
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
                            <a class="active" href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                              <?php if($data['category'] == 'Researches') : ?>
                                <li><a class="active" href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                              <?php endif ?>
                              <?php if($data['category'] == 'Thesis') : ?>
                                <li><a href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a class="active" href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                              <?php endif ?>
                              <?php if($data['category'] == 'Dissertations') : ?>
                                <li><a href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a class="active" href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                              <?php endif ?>
                              <?php if($data['category'] == 'Capstones') : ?>
                                <li><a href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                                <li><a class="active" href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
                              <?php endif ?>
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
                                <?php if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3) : ?>
                                    <li><a href="<?php echo site_url('nav/dashboard'); ?>">Go to Dashboard</a></li>
                                    <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
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
        </header><!-- End Header -->

    <p id="fileName" style="color: transparent;"><?php echo $data['filename']; ?></p>
    <main id="main">
      <div class="main-body">
      <div class="pdf-body">
        <div class="top-bar">
          <div class="title">
            <?php
              $sub_title = "";
                $t_length = strip_tags($data['title']);
                if(strlen($t_length) > 50){
                  $shorten_t = substr($t_length, 0, 40);
                  $sub_title = substr($shorten_t, 0, strrpos($shorten_t, ' ')).'...';
                  echo $sub_title;
                }  
                else echo $data['title']; ?>
          </div>
            <div>
              <i id="prev-page" class="btns fa fa-arrow-circle-left"></i> <span>Prev</span>
              <span>Next</span> <i id="next-page" class="btns fa fa-arrow-circle-right"></i>
              <span id="page-count-container" class="page-info">Page <span id="page-num"></span> of <span id="page-count"></span></span>
          </div>
        </div>
        <div id="pdf-container">
          <canvas id="pdf-render" width="600"></canvas>
          <div id="text-layer"></div>
        </div>
      </div>   
      <div class="search-text">
        <div class="pdf-info">
          <div class="info">
            <div class="title-cite d-flex flex-row justify-content-between align-items-between">
              <h4><?php echo $data['title']; ?></h4>
            </div>
            <h6><?php echo $data['authors']; ?> <span><?php echo date('M d, Y', strtotime($data['pub_year'])); ?></span></h6>
            <p><?php echo $data['description'];?></p>
          </div>
        </div>
      </div>     
    </div>
    </main>

    <!-- ======= Footer ======= -->
    <?php include('default/footer.php'); ?>

    <?php echo load_js(array('assets/js/pdf')); ?>
    <?php echo load_js(array('assets/js/pdf.worker')); ?>
    <?php echo load_js(array('assets/js/pdf_viewer2')); ?>
    <?php echo load_js(array('assets/js/preventSS')); ?>
   </body>
</html>
