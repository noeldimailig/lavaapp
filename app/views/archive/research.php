<?php $modal_id = []; ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Research - Elite Researcher</title>
    <?php include('default/header.php'); ?>
    <style>
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
    <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="<?php echo site_url('nav/index'); ?>">Elite Researcher</a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a href="<?php echo site_url('nav/index'); ?>">Home</a></li>
            <li class="dropdown">
              <a class="active" href="#"><span>Documents</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a class="active" href="<?php echo site_url('nav/research'); ?>">Research</a></li>
                <li><a href="<?php echo site_url('nav/thesis'); ?>">Thesis</a></li>
                <li><a href="<?php echo site_url('nav/dissertation'); ?>">Dissertation</a></li>
                <li><a href="<?php echo site_url('nav/capstone'); ?>">Capstone</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('nav/about'); ?>">About</a></li>
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

    <main id="main" class="mt-5">
      <!-- ======= Breadcrumbs ======= -->
      <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
          <h3>Researches</h3>
        </div>
      </div><!-- End Breadcrumbs -->

      <!-- ======= Features Section ======= -->
      <section id="features" class="features mt-5">
        <div class="container" data-aos="fade-up">
          <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-lg-8">
              <?php 
                  foreach ($data['docs'] as $doc) : 
                    if($doc['category'] == 'Researches'): $modal_id[] = ''.$doc['id']; ?>
                      <div class="col-lg-12 mb-3">
                        <div class="icon-box">
                          <div class="col-lg-12">
                            <div class="title-cite d-flex flex-row justify-content-between align-items-between">
                              <h6><a href="<?php 
                                if(isset($_SESSION['user_id'])){
                                  echo site_url('nav/preview/'.encrypt_id($doc['id']));
                                }
                                else {
                                  echo site_url('nav/login');
                                }
                              ?>"><?php echo $doc['title']; ?></a></h6>
                            </div>
                            <div>
                              <p class="text-secondary"><?php echo $doc['authors']; ?></p>
                            <p>
                              <?php 
                                $sub_desc = "" ;
                                $desc_length = strip_tags($doc['description']);
                                if(strlen($desc_length) > 1000){
                                  $shorten = substr($desc_length, 0, 100);
                                  $sub_desc = substr($shorten, 0, strrpos($shorten, ' ')).'...';
                                  echo $sub_desc;
                                }  
                                else echo $sub_desc; 
                              ?>
                            </p>
                            </div>
                          
                            <div class="d-flex flex-row justify-content-between align-items-between border-top" id="options">
                              <div class="d-flex align-items-start justify-content-start">
                                <p class="mt-1" id="count_id<?php echo $doc['id']; ?>"></p> <span class="mt-1" style="margin-left: 10px;">cite(s)</span>
                              </div>  
                              <div class="mt-2 d-flex flex-row justify-content-between align-items-between">
                                <p id="message<?php echo $doc['id']; ?>" class="text-secondary mr-3"></p>
                                <a href="<?php 
                                  if(isset($_SESSION['user_id'])){
                                    echo site_url('nav/preview/'.encrypt_id($doc['id']));
                                  }
                                  else {
                                    echo site_url('nav/login');
                                  }
                                ?>"><i class="bi bi-link" title="Cite"></i></a>
                                <form id="saveform<?php echo $doc['id']; ?>" action="<?php echo site_url('book/save'); ?>" method="post" class="d-flex flex-row justify-content-between align-items-center p-0 m-0">
                                  <input class="p-0 m-0" type="hidden" name="uid" id="uid<?php echo $doc['id']; ?>" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                                  <input class="p-0 m-0" type="hidden" name="did" id="did<?php echo $doc['id']; ?>" value="<?php echo $doc['id']; ?>">
                                  <button class="p-0 mb-3 d-inline-block" id="bookmark<?php echo $doc['id']; ?>" name="bookmark" type="submit"><i class="bi bi-bookmark-fill" title="Bookmark"></i></button>
                                </form>
                                
                              </div>
                                
                              </div> 
                          </div>
                        </div>
                      </div>
                    <?php endif ?>
                  <?php endforeach ?>
            </div>
            <div class="col-lg-4">
              <div class="col-12 mb-3 contact">
                <form id="search-form" action="<?php echo site_url('search/research'); ?>" class="php-email-forms" method="post">
                  <div class="form-group col-12 p-2">
                    <div class="d-flex flex-row justify-content-center">
                      <input type="text" class="form-control mr-1" id="search" name="search" value="Looking for something">
                      <input type="submit" id="submit" name="submit" value="Search">
                    </div>
                  </div>
                </form>
              </div>
              <h5>Related Documents</h5>
              <div class="col">
                <?php foreach ($data['docs'] as $doc) : ?>
                  <div class="col-lg-12 mb-3  p-0 m-0">
                    <p><a href="<?php 
                        if(isset($_SESSION['user_id'])){
                          echo site_url('nav/preview/'.encrypt_id($doc['id']));
                        }
                        else {
                          echo site_url('nav/login');
                        }
                      ?>"><?php echo $doc['title']; ?></a></p>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
      </section><!-- End Features Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('default/footer.php'); ?>

    <!-- Modal -->  
    <?php foreach ($modal_id as $modal) : $id = $modal; ?>
      <script>
        $(document).ready(function () {
          $('#saveform<?= $id; ?>').submit(function (e) {
            e.preventDefault();
            var uid = $('#uid<?= $id; ?>').val();
            var did = $('#did<?= $id; ?>').val();
            var form = $('#saveform<?= $id; ?>');

            if(uid === ""){
              location.replace('http://localhost/archive/nav/login');
            }else{
              $.ajax({
              type: "POST",
              url: '<?php echo site_url('book/save'); ?>',
              data: form.serialize(),
              success: function (data) {
                  if(data){
                    $('#message<?= $id; ?>').html(data);
                    $('#message<?= $id; ?>').show();
                    $('#saveform<?= $id; ?>')[0].reset();
                    setTimeout(function(){
                      $('#message<?= $id; ?>').hide();
                    },3000);
                  }
                }
              });
            }
          });
        });

        $('#count_id<?= $id; ?>').load("<?php echo site_url('nav/count_citations/'. encrypt_id($id)); ?>");
      </script>
    <?php endforeach ?>
  </body>
</html>
