<?php /*
  require_once('path.php');
  require_once('phpmailer/PHPMailer.php');
  require_once('phpmailer/SMTP.php');
  require_once('phpmailer/Exception.php');*/
  include('class/DBConnection.php');

  $db = new DBConnection();
  /*session_start();

  if (!empty($_SESSION['email'])) {
   $result = $db->getProfile($_SESSION['id']);
  }
  $data = $db->getDocument();*/
  $datas = $db->getDocuments();

?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PDF Preview - Elite Researcher</title> 

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php include('default/header.php'); ?>
    <?php echo load_css(array('assets/css/pdf_preview')); ?>
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

    <p id="fileName" style="color: transparent;"><?php echo $data['filename']; ?></p>
    <p id="doc_id" style="color: transparent;"><?php echo $data['id']; ?></p>

    <main id="main">
      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-8 d-flex flex-column align-items-center justify-content-center">
            <div id="pdf-container">
              <canvas id="pdf-render" width="400"></canvas>
            </div>

            <div class="pdf-info">
              <div class="info border">
                <h4><?php echo $data['title']; ?></h4>
                <h6><?php echo $data['authors']; ?> <span><?php echo date('M d, Y', strtotime($data['uploaded_at'])); ?></span></h6>
                <p><?php echo $data['description'];?></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="about border-bottom mb-3">
              <div class="content">
                <?php /*
                  if(isset($_POST['bookmark'])){
                    $uid = $_POST['uid'];
                    $did = $_POST['did'];

                    $db->addBookmark($did,$uid);
                  }*/
                ?>
                
                  <h2>What to do next?</h2>
                  <ul>
                    <li class="d-flex flex-row justify-content-between align-items-center"><div><i class="bi bi-check-circle"></i> View the full document?</div> <a href="<?php echo site_url('nav/fullview/'.encrypt_id($data['id'])); ?>">Click here</a></li>
                    <li class="d-flex flex-row justify-content-between align-items-center">
                      <div><i class="bi bi-check-circle"></i> Cite document?</div> 
                      <button id="cite" name="cite" type="submit" data-toggle="modal" data-target="#exampleModalCenter">Cite</button>
                    </li>
                    <li class="d-flex flex-row justify-content-between align-items-center"><div><i class="bi bi-check-circle"></i> <p id="bookmarks" class="d-inline-block"> Bookmark document?</p></div>
                      <form id="savebook" action="<?php echo site_url('book/save'); ?>" method="post" class="d-flex flex-row justify-content-center align-items-center p-0 m-0">
                        <input class="p-0 m-0" type="hidden" name="uid" id="uid" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                        <input class="p-0 m-0" type="hidden" name="did" id="did" value="<?php echo $data['id']; ?>">
                        <button class="p-0 mb-3" id="bookmark" name="bookmark" type="submit">Bookmark</button>
                      </form>
                      
                    </li>
                  </ul>
                
              </div>
            </div>
            
            <!-- <div class="col-12 mb-3 contact border-bottom">
              <h5>Looking for something?</h5>
              <form action="" class="php-email-forms mb-3">
                <div class="form-group col-12 p-2">
                  <div class="d-flex flex-row justify-content-center">
                    <input type="text" class="form-control mr-1" id="search" name="search" value="Search here">
                    <input type="submit" id="submit" name="submit" value="Search">
                  </div>
                </div>
              </form>
            </div> -->
            
            <div class="col-12 mb-3 contact border-bottom">
              <h5>Related Documents</h5>
              <?php foreach ($datas as $datum) : ?>
                <div class="col-lg-12 mb-3  p-0 m-0">
                  <p><a href="<?php echo site_url('nav/preview/'.encrypt_id($datum['id'])); ?>"><?php echo $datum['title']; ?></a></p>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </div>
    </main>
  
    <!-- ======= Footer ======= -->
    <?php include('default/footer.php'); ?>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php echo load_js(array('assets/js/pdf')); ?>
    <?php echo load_js(array('assets/js/pdf.worker')); ?>
    <?php echo load_js(array('assets/js/preview')); ?>
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
              <p id="citation">
                <?php
                  echo $db->generateCitation($data['id']); 
                ?>
              </p>
          </div>
          <div class="modal-footer d-flex flex-row align-items-center justify-content-between">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-secondary" onclick="copyText('citation');">Copy</button>
            <p id="message" class="text-success">Citation copied.</p>
            <form action="<?php echo site_url('cite/save'); ?>" method="post" id="saveform">
              Cited? <input type="checkbox" class="mr-3" name="cited" id="cited">
              <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
              <input type="hidden" name="docid" id="docid" value="<?php echo $data['id']; ?>">
              <button type="submit" class="btn btn-success" name="save" id="save">Save</button>
            </form>
            
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#message').hide();
      function copyText(id) {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        $('#message').html('Citation copied');
        $('#message').show();
        setTimeout(function(){
          $('#message').hide();
        },3000);
      }
    </script>

    <script>
      $(document).ready(function () {
    // var cited = $('#cited').prop('checked');
        $('#saveform').submit(function (e) {
          e.preventDefault();
          var form = $('#saveform');
          var url = form.attr('action');
          var uid = $('#userid').val();
          var did = $('#docid').val();
          var checked = $('#cited').is(':checked');

          var cited = 0;
          if(checked == true) cited = 1;
          else cited = 0;
          $.ajax({
              type: "POST",
              url: url,
              data: { userid: uid, docid: did, cited: cited},
              success: function (data) {
                if(data){
                  $('#message').html(data);
                  $('#message').show();
                  $('#saveform')[0].reset();
                  setTimeout(function(){
                    $('#message').hide();
                  },3000);
                }
              }
            });
        });

        $('#savebook').submit(function (e) {
          e.preventDefault();
          var uid = $('#uid').val();
          var did = $('#did').val();
          var form = $('#savebook');
          var url = form.attr('action');

          $.ajax({
            type: "POST",
            url: url,
            data: { uid: uid, did: did },
            success: function (data) {
              if(data){
                $('#bookmarks').html(data);
                $('#bookmarks').show();
                $('#saveform')[0].reset();
                setTimeout(function(){
                  $('#bookmarks').html(' Bookmark document?');
                },3000);
              }
            }
          });
        });
      });
    </script>
   </body>
</html>
