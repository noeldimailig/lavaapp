<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Profile - Elite Researcher</title>
  <?php include('default/header.php'); ?>
  <style>
    h5 {
      color: #5fcf80;
    }
    span {
      color: #333;
      text-align: right;
    }
    .contact .php-email-form select:focus {
      border-color: #5fcf80;
    }
    .contact .php-email-form select {
      height: 44px; border-radius: 4px; box-shadow: none; font-size: 14px;
    }
    img {
      width: 100%; height: 100%;
      border: 5px solid #ccc;
      border-radius: 50%;
    }
    #image {
      width: 100px; height: 100px;
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
      border: 5px solid #5fcf80;
      border-radius: 50%;
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

    <section id="contact" class="contact">
      <div class="container" >
        <div class="row mt-5">
          <div class="col-lg-5 bg-light p-4 d-flex flex-column align-items-center justify-content-start">
            <h2>My Details</h2>  
            <div class="image-container mb-3 d-flex flex-column align-items-center justify-content-center">  
              <img id="image" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$_SESSION['user_profile']; ?>" alt="Profile">
            </div>
            <h5>Username: <span><?php echo $_SESSION['username']; ?></span></h5>
            <h5>Email: <span><?php echo $_SESSION['user_email']; ?></span></h5>
            <h5>Lastname: <span><?php echo $_SESSION['lastname']; ?></span></h5>
            <h5>Firstname: <span><?php echo $_SESSION['firstname']; ?></span></h5>
          </div>
          <div class="col-lg-7 border border-light p-3">
            <h2>Update Details</h2>
            <form action="<?php echo site_url('user/update'); ?>" method="post" class="col-lg-12 php-email-forms d-flex flex-row justify-content-center align-items-between" id="validate" enctype="multipart/form-data">
              <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_SESSION['user_id']; ?>">
              <input type="hidden" name="prev_filename" class="form-control" id="prev_filename" value="<?php echo $_SESSION['user_profile']; ?>">
              <div class="profile-pic col-lg-4 d-flex flex-column align-items-center justify-content-center">
                <div class="image-container mb-3 d-flex flex-column justify-content-around align-items-between">
                  <img id="images" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$_SESSION['user_profile']; ?>" alt="">
                </div>
                <div class="form-group d-flex flex-column align-items-center justify-content-center">
                  <div class="fileInput">
                    <label class="choose font-weight-bold rounded p-2" for="file">Choose Photo</label>
                    <input style="display: none;" onchange="preview(event);" type="file" name="file" class="file" id="file">
                  </div>
                </div> 
              </div>
              <div class="col-lg-8 form-data d-flex flex-column justify-content-center align-items-center">
                <div id="message"></div>
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
                <input type="submit" name="submit" id="submit" value="Update Profile">
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
        e.preventDefault();
        var form = $(this)[0];
        var url = form.getAttribute('action');
        var formData = new FormData(form);
        var file = document.getElementById('file').files;
        formData.append('file', file);

        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(response) {
            var res = JSON.parse(response);
            if(res.error == false) {
              $('#message').show();
              alertSuccess(res.msg);
              setTimeout(function(){
                $('#message-content').remove();
                $('#message').hide();

                location.reload();
              }, 3000);
              $('#verify_email').val("");
              $('#verify_code').val("");
            } else {
              $('#message').show();
              alertError(res.msg);
              setTimeout(function(){
                $('#message-content').remove();
                $('#message').hide();
              }, 3000);
            }
          }
        });
      });
      function preview(event){
          var reader = new FileReader();
          reader.onload = function(){
            var image = document.getElementById('images')
            image.src = reader.result;
          }
          reader.readAsDataURL(event.target.files[0]);
      }

      function alertSuccess(message) {
        $('#message').append(
          '<div id="message-content">' +
            '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">' +
              '<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">' +
                '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>' +
              '</symbol>' +
            '</svg>' +
            '<div id="notify" style="display:none;" class="alert alert-success fade show d-flex align-items-center" role="alert">' +
              '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>' +
              '<div>' + message + '</div>' +
            '</div>' +
          '</div>');
      }

      function alertError(message) {
        $('#message').append(
          '<div id="message-content">' +
            '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">' +
              '<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">' +
                '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>' +
              '</symbol>' +
            '</svg>' +
            '<div class="alert alert-danger fade show d-flex align-items-center" role="alert">' +
              '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>' +
                '<div>' + message + '</div>' +
            '</div>' +
          '</div>');
      }
    </script>
  </body>
</html>
