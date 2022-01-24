<!DOCTYPE html> 

<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="Wilfred V. Pine">
      <meta name="description" content="ConfiRed">
      <title>Elite Researcher</title> 
      <link rel="icon" href="assets/img/icon.png">
      <!-- Bootstrap core CSS -->
      <link href="assets/bootstrap-4.5/css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
      <link href="assets/custom-css/navbar.css" rel="stylesheet">
      <link href="assets/custom-css/sidebar.css" rel="stylesheet">
      <link href="assets/custom-css/skin.css" rel="stylesheet">
      <link href="assets/custom-css/content.css" rel="stylesheet">
      <link href="assets/custom-css/notification.css" rel="stylesheet">
      <link href="assets/custom-css/message.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   </head> 
  
   <body> 

   <!-- Container - Fluid -->
   <div class="container-fluid">
      <!-- Row -->
      <div class="row">

        <!-- sidebar -->
        <nav id="sidebarToggler" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse pt-0 pb-5">
            <div class="side-logo pb-3 pt-3 pl-2 pr-2">
              <a href=""><img src="assets/img/logo.png" height="auto" width="100%" alt=""></a>
            </div>
            <div class="side-slide-down pb-5">
              
              <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="icon fa fa-tachometer pr-1"></i>
                        Dashboard
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./admins/index.php">
                        <i class="icon fa fa-users pr-1"></i>
                        Manage Admins
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./users/index.php">
                        <i class="icon fa fa-users pr-1"></i>
                        Manage Users
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./documents/index.php">
                        <i class="icon fa fa-folder pr-1"></i>
                        Manage Documents
                    </a>
                  </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="../login.php">
                        <i class="icon fa fa-key pr-1"></i>
                        Sign-in | Sign-up
                    </a>
                </li> -->
              </ul>
            </div>
        </nav>
        <!-- end side bar -->

        <!-- topbar --> 
        <!-- bg-dark shadow -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top flex-md-nowrap p-0 custom-grid">
            <div class="collapse navbar-collapse"></div>
            
            <!-- Brand Name -->
            <!-- <a class="navbar-brand mr-auto mr-lg-0 px-3 brand" href="#">
                <b class="color-blue lab">Red Dashboard</b> <b class="color-white lab">1.0.0</b>
                <a href="" class="topbar-brand"><img src="assets/img/brand.png" width="auto" alt=""></a>
            </a> -->
            <div class="hide-div-brand">
                <a class="navbar-brand mr-auto mr-lg-0 brand" href="#">
                    <a href="" class="topbar-brand"><img src="assets/img/brand.png" width="auto" alt=""></a>
                </a>
            </div>

            <!-- collapse Toggle Nav -->
            <button class="navbar-toggler d-md-none btn btn-primary mr-4 pl-2 pr-2 mt-1" type="button" data-toggle="collapse" data-target="#navbarTogglerTop" aria-controls="navbarTogglerTop" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <!-- <div class="menu-scroll"> -->
                <nav class="nav">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown notifications-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                Notifications
                            </a>
                            <div class="dropdown-menu" id="custom-dropdown" aria-labelledby="navbarDropdown">
                                <div class="dropdown-menu-header">
                                    Notifications
                                </div>
                                <div class="dropdown-item">
                                    <div class="row">
                                        <div class="col-md-2 profile-img">
                                            <img src="./assets/img/icon.png" />
                                        </div>
                                        <div class="col-md-10">
                                            <a href="">
                                                <b>Axel</b> commented on your photo.
                                                <br>
                                                <small>10 minutes ago</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="notifications-dropdown-footer">
                                    <a href="notifications.php">See All Notifications</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown notifications-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                Messages
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" id="custom-dropdown" aria-labelledby="navbarDropdown">
                                <div class="dropdown-menu-header">
                                    Messages
                                </div>
                                <div class="dropdown-item">
                                    <div class="row">
                                        <div class="col-md-2 profile-img">
                                            <img src="./assets/img/icon.png" />
                                        </div>
                                        <div class="col-md-10">
                                            <a href="">
                                                <b>Axel</b> commented on your photo.
                                                <br>
                                                <small>10 minutes ago</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="notifications-dropdown-footer">
                                    <a href="messages.php">See All Messages</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                    <!-- <a class="nav-link" href="#"> <i class="fa fa-cogs"></i> Settings</a> -->

                    
                    <div class="collapse navbar-collapse" id="navbarTogglerTop">
                        <ul class="navbar-nav px-0">
                            <li class="nav-item active dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    Welcome User
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item pl-2" href="../index.php"> <i class="fa fa-home"></i> Home</a>
                                    <a class="dropdown-item pl-2" href="../login.php"> <i class="fa fa-key"></i> Logout</a>
                                </div>
                            </li>                   
                        </ul>
                    </div>
                </nav>
            <!-- </div> -->
            
            <!-- sidebar toogle button -->
            <div class="navbar-toggler d-md-none sidebar-toggle px-3 bg-dark text-left" >
                <a href="#" data-toggle="collapse" data-target="#sidebarToggler" aria-controls="sidebarToggler" aria-expanded="false" aria-label="Toggle navigation" class="togs"> <i class="fa fa-bars"></i> Menu</a>
            </div>
        </nav>
        <!-- end topbar -->

        <!-- Main -->
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i class="fa fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"> Messages </li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0"> Home <small>Messages</small></h5>               
            </div>
            <!-- end title -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-3">
                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-0 mb-3">
                        <div class="card-body bg-white active rounded p-0 d-flex flex-row">
                            <div class="search-message">
                                <div class="search-box">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <button class="btn btn-outline-dark rounded-left" type="button"><i class="fa fa-search"></i></button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="basic-addon2">
                                    </div>
                                    <!-- <button class="btn btn-primary" type="submit" id="search" name="search">
                                        <i class="fa fa-search"></i>
                                    </button> -->
                                </div>
                                <div class="messages">
                                    <div class="message">
                                        <img src="./assets/img/icon.png" />
                                        <div class="d-flex flex-column" id="message-details">
                                            <p>Noel Dimailig</p>
                                            <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                              Praeterea iter est quasdam res quas ex communi.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="message">
                                        <img src="./assets/img/icon.png" />
                                        <div class="d-flex flex-column" id="message-details">
                                            <p>Jhon Doe</p>
                                            <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                              Lorem, ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, in cupiditate eligendi ipsa vero, perferendis soluta, aliquam blanditiis repudiandae reiciendis minus sapiente optio. Minus voluptates illum totam exercitationem, earum sit.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="message-area">
                                <div class="user-details">
                                    <div class="user-detail">
                                        <img src="./assets/img/icon.png" />
                                        <div class="d-flex flex-column" id="message-details">
                                            <p>Noel Dimailig</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation"></div>
                                <div id="ajaxForm">
                                  <textarea id="chatInput"></textarea>
                                  <button class="btn btn-primary" id="submit" name="submit" type="submit">Send <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div> <!-- card body end -->
                    </div> <!-- end col-12 -->
                </div> <!-- End Row -->
            </div> <!-- End container-fluid -->

        <!-- Footer -->
        <footer class="footer mt-auto px-5 py-2 bg-white border-top footer" >
            <div class="container">
            <span class="text-muted"> &copy; 2021 | </span> <a target="_blank" href="https://confired.com/">Dimailig & Pine</a>
            <br>
            <a href="">Terms & Condition</a> | <a href="">Data Privacy</a> | <a href="">Disclaimer</a> | <a href="">Developers</a>
            </div>
        </footer>
        <!-- End Footer -->

        </main>
        <!-- End Main -->     
    </div>
    <!-- End Row -->
  </div>
  <!-- End Container - Fluid -->

<!-- https://code.jquery.com/jquery-3.5.1.min.js -->
<script src="assets/js/jquery.slim.min.js"></script>
  <script src="assets/bootstrap-4.5/js/bootstrap.bundle.js"></script>

  <script src="assets/js/Chart.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/Statistics.js"></script>
  
 </body> 
</html> 