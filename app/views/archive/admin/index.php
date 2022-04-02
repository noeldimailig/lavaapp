<?php
// require_once('./../path.php');
//   require_once('../class/database.php');

//   $db = new database();
//   session_start();

//   if (empty($_SESSION['email'])) {
//     header('location:'.URL.'index.php');
//   }

?>
<!DOCTYPE html> 

<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Elite Researcher</title> 
      <?php include('default/header.php'); ?>
   </head> 
  
   <body> 

   <!-- Container - Fluid -->
   <div class="container-fluid">
      <!-- Row -->
      <div class="row">

        <!-- sidebar -->
        <nav id="sidebarToggler" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse pt-0 pb-5">
            <div class="side-logo pb-3 pt-3 pl-2 pr-2">
              <a href=""><img src="<?php echo BASE_URL.PUBLIC_DIR.'/admin/img/logo.png'; ?>" height="auto" width="100%" alt=""></a>
            </div>
            <div class="side-slide-down pb-5">
              
              <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('nav/dashboard'); ?>">
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
                    <a class="nav-link" href="<?php echo site_url('nav/user'); ?>">
                        <i class="icon fa fa-users pr-1"></i>
                        Manage Users
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('nav/category'); ?>">
                        <i class="icon fa fa-book pr-1"></i>
                        Manage Category
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
            <div class="hide-div-brand">
                <a class="navbar-brand mr-auto mr-lg-0 brand" href="#">
                    <a href="<?php echo site_url('nav/dashboard'); ?>" class="topbar-brand"><img src="<?php echo BASE_URL.PUBLIC_DIR.'/admin/img/brand.png'; ?>" width="auto" alt=""></a>
                </a>
            </div>

            <!-- collapse Toggle Nav -->
            <button class="navbar-toggler d-md-none btn btn-primary mr-4 pl-2 pr-2 mt-1" type="button" data-toggle="collapse" data-target="#navbarTogglerTop" aria-controls="navbarTogglerTop" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <!-- <div class="menu-scroll"> -->
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
        <!-- end topbar -->

        <!-- Main -->
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('nav/dashboard'); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"> index </li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0"> Home <small>Dashboard</small></h5>
                
            </div>
            <!-- end title -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-3">


                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-0 mb-3">
                        <!-- Card Deck -->
                        <div class="card-deck">

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-primary stat">
                                <h3 class="pl-2"><strong><?php foreach($data['admin'] as $admin){
                                    echo $admin;
                                } ?></strong></h3>
                                <span class="stat-icon"><i class="fa fa-users"></i></span>
                                <div class="pl-2">
                                    <p>Documents Admin</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-info stat">
                                <h3 class="pl-2"><strong><?php foreach($data['user'] as $user){
                                    echo $user;
                                } ?></strong></h3>
                                <span class="stat-icon"><i class="fa fa-users"></i></span>
                                <div class="pl-2">
                                    <p>Users</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-secondary stat">
                                <h3 class="pl-2">
                                    <strong>
                                    <?php foreach($data['research'] as $research){
                                    echo $research;
                                } ?>
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-file"></i></span>
                                <div class="pl-2">
                                    <p>Researches</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-warning stat">
                                <h3 class="pl-2">
                                    <strong>
                                    <?php foreach($data['thesis'] as $thesis){
                                    echo $thesis;
                                } ?>
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-file"></i></span>
                                <div class="pl-2">
                                    <p>Thesis</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-success stat">
                                <h3 class="pl-2">
                                    <strong>
                                    <?php foreach($data['dissertation'] as $dissert){
                                    echo $dissert;
                                } ?>    
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-file"></i></span>
                                <div class="pl-2">
                                    <p>Disertations</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->

                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-dark stat">
                                <h3 class="pl-2">
                                    <strong>
                                    <?php foreach($data['capstone'] as $capstone){
                                    echo $capstone;
                                } ?></strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-file"></i></span>
                                <div class="pl-2">
                                    <p>Capstones</p>
                                </div>
                                <div class="stat-footer">
                                    <p class="stat-footer">As of <?= date("Y-m-d"); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->
                        </div>
                        <!-- End Card Deck -->
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End container-fluid -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-4">

                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-0">
                        <!-- Card Deck -->
                        <div class="card-deck">
                            <!-- card -->
                            <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                <!-- card header -->
                                <div class="card-header p-0">
                                    <div class="card-icon "><i class="fa fa-users"></i></div>
                                    <div class="card-label ">Administrators</div>
                                </div>
                                <!-- End card header -->
                                <!-- Card Body -->
                                <div class="card-body p-4">

                                    <!-- Table Div -->
                        <div class="table-responsive">

                            <!-- Table -->
                            <table id="admins" class="table table-bordered table-hover table-sm mb-0">
                            
                             <thead>
                                            <tr>
                                                <td>ID</td>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                
                                        <tbody>
                                            <?php foreach ($data['admins'] as $result) : ?>
                                                <tr>
                                                    <td><?php echo $result['id']; ?></td>
                                                    <td><?php echo $result['username']; ?></td>
                                                    <td><?php echo $result['email']; ?></td>
                                                    <td><?php echo $result['role']; ?></td>
                                                    <td><?php echo '<p class="text-success">Active</p>';?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                
                                        <tfoot>
                                        <tr></tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Table -->

                        </div>
                        <!-- End Table Div -->
                
                                </div>
                                <!-- End Card Body -->
                            </div>
                            <!-- End card -->
                        </div>
                    <!-- End Card Deck -->
                    </div>
                    <!-- end col-12 -->
                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-5">
                        <!-- Card Deck -->
                        <div class="card-deck">
                            <!-- card -->
                            <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                <!-- card header -->
                                <div class="card-header p-0">
                                    <div class="card-icon "><i class="fa fa-table"></i></div>
                                    <div class="card-label ">Users</div>
                                </div>
                                <!-- End card header -->             
                                <!-- Card Body -->
                                <div class="card-body p-4">
                        <!-- Table Div -->
                        <div class="table-responsive">

                            <!-- Table -->
                            <table id="users" class="table table-bordered table-hover table-sm mb-0">
                            
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                
                                <tbody>
                                    <?php foreach ($data['users'] as $result) : ?>
                                        <tr>
                                            <td><?php echo $result['id']; ?></td>
                                            <td><?php echo $result['username']; ?></td>
                                            <td><?php echo $result['email']; ?></td>
                                            <td><?php echo '<p class="text-success">Active</p>';?></td>
                                        </tr>
                                     <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                        <tr></tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Table -->
                        </div>
                        <!-- End Table Div -->
                                </div>
                                <!-- End Card Body -->
                            </div>
                            <!-- End card -->
                            </div>
                    <!-- End Card Deck -->
                    </div>
                    <!-- end col-12 -->
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

  <?php include('default/footer.php'); ?>
  <script>
      $(document).ready( function () {
        $('#admins').DataTable();
        $('#users').DataTable();
        });
  </script>
 </body> 
</html> 
