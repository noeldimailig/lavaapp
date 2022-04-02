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
                        <a class="nav-link active" href="<?php echo site_url('nav/document'); ?>">
                            <i class="icon fa fa-tachometer pr-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('nav/manage'); ?>">
                            <i class="icon fa fa-file pr-1"></i>
                            Manage Active Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('nav/pending'); ?>">
                            <i class="icon fa fa-spinner pr-1"></i>
                            Manage Pending Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('nav/archive'); ?>">
                            <i class="icon fa fa-archive pr-1"></i>
                            Manage Archive Documents
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
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-3">
                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-5 mb-3">
                        <!-- Card Deck -->
                        <div class="card-deck">

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
                            <div class="text-white bg-danger stat">
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
                        <!-- card -->
                        <div class="card stat-panel"> 
                            <div class="text-white bg-info stat">
                                <h3 class="pl-2">
                                    <strong>
                                    <?php foreach($data['pending'] as $pending){
                                    echo $pending;
                                } ?>
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-spinner"></i></span>
                                <div class="pl-2">
                                    <p>Pending</p>
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
                                    <?php foreach($data['archive'] as $archive){
                                    echo $archive;
                                } ?>
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-archive"></i></span>
                                <div class="pl-2">
                                    <p>Archive</p>
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
                                    <?php foreach($data['active'] as $active){
                                    echo $active;
                                } ?>
                                    </strong>
                                </h3>
                                <span class="stat-icon"><i class="fa fa-file"></i></span>
                                <div class="pl-2">
                                    <p>Active</p>
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
      $(document).ready( function () {
        $('#documents').DataTable();
        });
  </script>
  
 </body> 
</html> 
