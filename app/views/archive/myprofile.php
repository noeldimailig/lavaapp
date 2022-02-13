<?php
  require_once('class/DBConnection.php');

  $db = new DBConnection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Profile - Elite Researcher</title>
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
    .image-container {
      max-width: 200px;
      max-height: 200px;
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
                                    <li><a class="active" href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                                    <li><a href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                                    <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                                    <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                                    <?php else: ?>
                                    <li><a class="active" href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
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

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" >
      <div class="container">
        <h2>My Profile</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="contact" class="contact">
      <div class="container" >

        <div class="row mt-5">
          <div class="col-lg-12 mt-5 mt-lg-0">
          <?php echo alert_success('success'); ?>
            <form action="<?php echo site_url('user/update'); ?>" method="post" class="col-lg-12 php-email-forms d-flex flex-row justify-content-center align-items-between" id="validate" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="prev_filename" class="form-control" id="prev_filename" value="<?php echo $_SESSION['user_profile']; ?>">
                <div class="profile-pic col-lg-4 d-flex flex-column align-items-center justify-content-center">
                  <div class="image-container p-3 d-flex flex-column justify-content-around align-items-between">
                    <img id="images" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$_SESSION['user_profile']; ?>" alt="">
                  </div>
                  <div class="form-group d-flex flex-column align-items-center justify-content-center">
                    <div class="fileInput">
                      <label class="choose font-weight-bold rounded p-2" for="file">Choose Photo</label>
                      <input style="display: none;" onchange="preview(event);" type="file" name="file" class="file" id="file">
                    </div>
                    <!-- <div class="fileName d-flex flex-row align-items-center">
                      <p class="m-1">File Name:</p>
                      <p class="m-1" id="actual-file-name"></p>
                    </div> -->
                  </div> 
                </div>
              <div class="col-lg-8 form-data d-flex flex-row justify-content-center align-items-between">
                <div class="left col-lg-6 m-0 p-4">
                  <div class="col-12 form-group">
                    <label for="uname">Username</label>
                    <input type="text" name="uname" class="form-control" id="uname" value="<?= $_SESSION['username']; ?>" placeholder="Username" required>
                  </div>
                  <div class="col-12 form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" id="lname" value="<?= $_SESSION['lastname']; ?>" placeholder="Last Name" required>
                  </div>
                  <div class="col-12 form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" id="fname" value="<?= $_SESSION['firstname']; ?>" placeholder="First Name" required>
                  </div>
                  <div class="col-12 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $_SESSION['user_email']; ?>" placeholder="Your Email" required>
                  </div>
                </div>

                <div class="right col-lg-6 m-0 p-4 d-flex flex-column align-items-center justify-content-center">
                  <div class="form-group col-12">
                      <label for="campus">Campus</label>
                      <select class="form-control" id="campus" name="campus">
                          <?php
                            foreach ($data['campuses'] as $campus): ?>
                              <?php if($campus['campus'] == $_SESSION['campus']) { ?>
                                      <option value="<?php echo $campus['id'];?>" selected="selected"><?php echo $campus['campus'];?></option>
                              <?php } else { ?>
                                      <option value="<?php echo $campus['id'];?>"><?php echo $campus['campus'];?></option>
                              <?php } ?>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group col-12">
                      <label for="department">Department</label>
                      <select class="form-control" id="department" name="department">
                          <?php
                            foreach ($data['departments'] as $department): ?>
                              <?php if($department['dep'] == $_SESSION['dep']) { ?>
                                      <option value="<?php echo $department['id'];?>" selected="selected"><?php echo $department['dep'];?></option>
                              <?php } else { ?>
                                      <option value="<?php echo $department['id'];?>"><?php echo $department['dep'];?></option>
                              <?php } ?>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group col-12">
                      <label for="program">Program</label>
                      <select class="form-control" id="program" name="program">
                          <?php
                            foreach ($data['programs'] as $program): ?>
                             <?php if($program['program'] == $_SESSION['program']) { ?>
                                      <option value="<?php echo $program['id'];?>" selected="selected"><?php echo $program['program'];?></option>
                              <?php } else { ?>
                                      <option value="<?php echo $program['id'];?>"><?php echo $program['program'];?></option>
                              <?php } ?>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <!-- <div class="text-center mt-3"> --><input type="submit" name="submit" id="submit" value="Update Profile"><!-- </div> -->
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('default/footer.php'); ?>
  <script>
      $('#validate').submit(function(e) {
        //e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            
          }
        });
      });
    </script>
<script>
        function preview(event){
            var reader = new FileReader();
            reader.onload = function(){
              var image = document.getElementById('images')
              image.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
          
        }
</script>
</body>

</html>
