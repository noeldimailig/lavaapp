
<!DOCTYPE html> 

<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Elite Researcher</title> 
      <?php include(ROOT_DIR.'app\views\archive\admin\default\header.php'); ?>
   </head> 
  
   <body> 

   <!-- Container - Fluid -->
   <div class="container-fluid">
      <!-- Row -->
      <div class="row">

        <!-- sidebar -->
        <nav id="sidebarToggler" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse pt-0 pb-5">
            <div class="side-logo pb-3 pt-3 pl-2 pr-2">
            <a href="<?php echo site_url('nav/dashboard'); ?>"><img src="<?php echo BASE_URL.PUBLIC_DIR.'/admin/img/logo.png'; ?>" height="auto" width="100%" alt=""></a>
            </div>
            <div class="side-slide-down pb-5">
              
            <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/dashboard'); ?>">
                        <i class="icon fa fa-tachometer pr-1"></i>
                        Dashboard
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/admin'); ?>">
                        <i class="icon fa fa-user pr-1"></i>
                        Manage Admins
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('nav/user'); ?>">
                        <i class="icon fa fa-users pr-1"></i>
                        Manage Users
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/document'); ?>">
                        <i class="icon fa fa-archive pr-1"></i>
                        Manage Document
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/campus'); ?>">
                        <i class="icon fa fa-home pr-1"></i>
                        Manage Campus
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/department'); ?>">
                        <i class="icon fa fa-list-ul pr-1"></i>
                        Manage Department
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/program'); ?>">
                        <i class="icon fa fa-graduation-cap pr-1"></i>
                        Manage Programs
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/category'); ?>">
                        <i class="icon fa fa-book pr-1"></i>
                        Manage Document Category
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/file'); ?>">
                        <i class="icon fa fa-paste pr-1"></i>
                        Manage File Category
                    </a>
                  </li>
              </ul>
                    </div>
                </nav>
            <!-- </div> -->
            <!-- bg-dark shadow -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top flex-md-nowrap p-0 custom-grid">
            <div class="collapse navbar-collapse"></div>

            <!-- collapse Toggle Nav -->
            <button class="navbar-toggler d-md-none btn btn-primary mr-4 pl-2 pr-2 mt-1" type="button" data-toggle="collapse" data-target="#navbarTogglerTop" aria-controls="navbarTogglerTop" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <nav class="nav"> 
                    <div class="collapse navbar-collapse" id="navbarTogglerTop">
                        <ul class="navbar-nav px-0">
                            <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <?php if(isset($_SESSION['user_email'])) echo 'Welcome '.$_SESSION['username'];?>
                                    <!-- Welcome User -->
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item pl-2" href="<?php echo site_url('nav/index'); ?>"> <i class="fa fa-home"></i> Home</a>
                                    <a class="dropdown-item pl-2" href="<?php echo site_url('nav/logout'); ?>"> <i class="fa fa-key"></i> Logout</a>
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
        <!-- Main -->
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="i<?php echo site_url('nav/user'); ?>"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li class="breadcrumb-item">Delete User</li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0"> Form <small>Delete User</small></h5>
                
            </div>
            <!-- end title -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-5">

                    <!-- Form -->
                    <form action="<?php echo site_url('nav/delete_user_data'); ?>" method="post" class="outer-form" id="validate">
                        <!-- col-12 -->
                        <div class="col-12 p-0 m-0 mt-0">
                            <!-- Card Deck -->
                            <div class="card-deck">
                                <!-- card -->
                                <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                    <!-- card header -->
                                    <div class="card-header p-0">
                                        <div class="card-icon"><i class="fa fa-file"></i></div>
                                        <div class="card-label">User Details</div>
                                    </div>
                                    <!-- End card header -->
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" id="id" value="<?php foreach($data['user'] as $results){ echo $results['id'];}?>"  name="id">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php foreach($data['user'] as $results){ echo $results['username'];}?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?php foreach($data['user'] as $results){ echo $results['email'];}?>">
                                        </div>
                                         <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <input type="text" class="form-control" name="campus" id="campus" value="<?php foreach($data['user'] as $results){ echo $results['campus'];}?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input type="text" class="form-control" name="department" id="department" value="<?php foreach($data['user'] as $results){ echo $results['dep'];}?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program</label>
                                            <input type="text" class="form-control" name="program" id="program" value="<?php foreach($data['user'] as $results){ echo $results['program'];}?>">
                                        </div>
                                    
                                    </div>
                                    <!-- End Card Body -->
                                </div>
                                <!-- End card -->

                            </div>
                            <!-- End Card Deck -->
                        </div>
                        <!-- end col-12 -->


                        <!-- col-12 -->
                        <div class="col-12 p-0 m-0 mt-4">
                            <!-- card -->
                            <div class="card button-card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                <!-- Card Body -->
                                <div class="card-body button-card-body">
                                    <input type="submit" value="Delete User" name="submit" class="btn btn-sm btn-primary px-2 rounded">
                                    <a class="btn btn-sm btn-dark px-2 rounded" role="button" href="<?php echo site_url('nav/user'); ?>">Back</a>
                                </div>
                                <!-- End Card Body -->
                            </div>
                            <!-- End card -->
                        </div>
                        <!-- end col-12 -->


                    </form>
                    <!-- End Form -->


                </div>
                <!-- End Row -->
            </div>
            <!-- End container-fluid -->


             <!-- Footer -->
            <footer class="footer mt-auto px-5 py-2 bg-white border-top footer" >
                <div class="container d-flex flex-row align-items-start justify-content-center">
                    <span class="text-muted"> &copy; 2021 | </span> <p class="ml-2">Dimailig | Pine | Cabello</p>
                </div>
            </footer>
            <!-- End Footer -->

        </main>
        <!-- End Main -->
    </div>
    <!-- End Row -->
  </div>
  <!-- End Container - Fluid -->
  <?php include(ROOT_DIR.'app\views\archive\admin\default\footer.php'); ?>
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
 </body> 
</html> 
