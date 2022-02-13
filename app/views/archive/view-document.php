<?php
  require_once('class/DBConnection.php');

  $db = new DBConnection();
/*
  if (!empty($_SESSION['email'])) {
   $result = $db->getProfile($_SESSION['id']);
  }
 */
?>

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
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

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
              <!-- <button class="btns" id="prev-page"> --><i id="prev-page" class="btns fa fa-arrow-circle-left"></i> <span>Prev</span><!-- </button> -->
              <!-- <button class="btns" id="next-page"> --><span>Next</span> <i id="next-page" class="btns fa fa-arrow-circle-right"></i><!-- </button> -->
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
              <p style="font-size: 20px;font-weight: bold"><i class="bi bi-link" title="Cite" data-toggle="modal" data-target="#exampleModalCenter"></i></p>
            </div>
            <h6><?php echo $data['authors']; ?> <span><?php echo date('M d, Y', strtotime($data['uploaded_at'])); ?></span></h6>
            <p><?php echo $data['description'];?></p>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="search" class="form-label col-lg fs-4">Text to be cited here</label>
          <textarea name="search" id="search" cols="45" rows="5" class="form-control text-wrap" style="resize:none;"></textarea>
          <div class="d-flex flex-row align-items-end justify-content-end p-3">
            <button type="submit" id="generate" name="generate" class="btn btn-success px-2 py-1">Generate Reference</button>
          </div>
          <label for="reference" class="form-label col-lg fs-4">Generated Reference</label> -->
          <!-- <textarea name="reference" id="reference" cols="45" rows="5" class="form-control text-wrap" style="resize:none;"></textarea> -->
          <!-- <div class="d-flex flex-row align-items-end justify-content-end p-3">
            <input type="submit" id="save" name="save" class="btn btn-success px-2 py-1 mx-2" value="Save">
            <input type="submit" id="copy" name="copy" class="btn btn-secondary px-2 py-1" value="Copy">
          </div>
        </div>  -->
      </div>     
    </div>
    </main>

    <!-- Vendor JS Files -->
    <!-- ======= Footer ======= -->
    <?php include('default/footer.php'); ?>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php echo load_js(array('assets/js/pdf')); ?>
    <?php echo load_js(array('assets/js/pdf.worker')); ?>
    <?php echo load_js(array('assets/js/pdf_viewer2')); ?>
    <?php echo load_js(array('assets/js/preventSS')); ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cite this document?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="border-0" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p id="citation"><?php echo $db->generateCitation($data['id']); ?></p>

          </div>
          <div class="modal-footer">
            <p id="message" class="text-success">Citation copied.</p>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="copyText('citation');">Copy</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#message').hide();
function copyText(id)
{
var r = document.createRange();
r.selectNode(document.getElementById(id));
window.getSelection().removeAllRanges();
window.getSelection().addRange(r);
document.execCommand('copy');
window.getSelection().removeAllRanges();
$('#message').show();
}
  
    </script>
   </body>
</html>
