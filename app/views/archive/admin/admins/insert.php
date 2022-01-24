<?php $message = false; ?>
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
                    <a class="nav-link active" href="<?php echo site_url('nav/admin'); ?>">
                        <i class="icon fa fa-user pr-1"></i>
                        Manage Admins
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/user'); ?>">
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
        <!-- end side bar -->

        <!-- topbar --> 
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
                    <li class="breadcrumb-item"><a href="<?php echo site_url('nav/admin'); ?>"><i class="fa fa-user"></i> Manage Admins</a></li>
                    <li class="breadcrumb-item"> Add Admin </li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0"> Form <small>Add Admin</small></h5>
                
            </div>
            <!-- end title -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-5">

                    <!-- Form -->
                    <form action="<?php echo site_url('nav/add_admin'); ?>" method="post" class="outer-form" id="validate" enctype="multipart/form-data">
                        <!-- col-12 -->
                        <div class="col-12 p-0 m-0 mt-0">
                            <!-- Card Deck -->
                            <div class="card-deck">
                                <!-- card -->
                                <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                    <!-- card header -->
                                    <div class="card-header p-0">
                                        <div class="card-icon"><i class="fa fa-file"></i></div>
                                        <div class="card-label">Admin Details</div>
                                    </div>
                                    <!-- End card header -->
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <?php echo alert_error('error'); ?>
                                       
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Juan Dela Cruz">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="sample@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="role">Assign Role</label>
                                            <select class="form-control" id="role" name="role">
                                                <?php 
                                                  foreach ($data['roles'] as $role): ?>
                                                    <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="campuses">Campus</label>
                                            <select class="form-control" id="campuses" name="campus">
                                                <?php 
                                                  foreach ($data['campuses'] as $campus): ?>
                                                    <option value="<?php echo $campus['id'];?>"><?php echo $campus['campus'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control" id="department" name="department">
                                                <?php 
                                                  foreach ($data['departments'] as $department): ?>
                                                    <option value="<?php echo $department['id'];?>"><?php echo $department['dep'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program</label>
                                            <select class="form-control" id="program" name="program">
                                                <?php 
                                                  foreach ($data['programs'] as $program): ?>
                                                    <option value="<?php echo $program['id'];?>"><?php echo $program['program'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-row align-items-center">
                                            <div class="fileInput">
                                                <label class="bg-info font-weight-bold rounded p-2" for="file">Profile Picture</label>
                                                <input style="display: none;" type="file" name="file" class="form-control file" id="file">
                                            </div>
                                            <div class="fileName d-flex flex-row align-items-center border-bottom border-dark">
                                                <p class="m-1">File Name:</p>
                                                <p class="m-1" id="actual-file-name"></p>
                                            </div>
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
                                    <input type="submit" id="submit" name="submit" value="Add Admin" class="btn btn-sm btn-primary px-2 rounded">
                                     <a class="btn btn-sm btn-dark px-2 rounded" role="button" href="<?php echo site_url('nav/admin'); ?>">Back</a>
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
              console.log(response);
            if(response == "error"){
                failed_alert();
            }else{
               success_alert();
            }
          }
        });
      });

      function success_alert(){
          <?php echo alert_success('success'); ?>
      }
      function failed_alert(){
          <?php echo alert_error('error'); ?>
      }
    </script>
   <script>
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#actual-file-name').html(fileName);
        });
    });
</script>
 </body> 
</html> 
