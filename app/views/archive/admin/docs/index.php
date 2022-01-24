
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
                    <a class="nav-link active" href="<?php echo site_url('nav/category'); ?>">
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
        <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <nav aria-label="breadcrumb" class="mb-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('nav/category'); ?>"><i class="fa fa-paste"></i> Manage File Category</a></li>
                    <li class="breadcrumb-item"> Categories </li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <div class="row d-flex flex-row px-3 mb-4">
                <div class="col-3 p-0 mx-auto">
                    <div class="card-header">Add File Category</div>
                    <div class="card p-3 border-top-bottom-blue">
                        <form action="<?php echo site_url('nav/category_insert'); ?>" method="post" class="outer-form" id="add-category">
                            <div class="form-group">
                                <label for="dept">File Category</label>
                                <input type="text" class="form-control" name="category" id="category" placeholder="File Category">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" value="Add File Category" class="btn btn-sm btn-primary px-2 rounded">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-3 p-0 mx-auto">
                    <div class="card-header">Update File Category</div>
                    <div class="card p-3 border-top-bottom-blue">
                        <form action="<?php echo site_url('nav/category_update'); ?>" method="post" class="outer-form" id="validate">
                            <input type="hidden" class="form-control" id="id" value="<?php echo $data['category']['id'];?>"  name="id">
                            <div class="form-group">
                                <label for="dept">File Category</label>
                                <input type="text" class="form-control" name="category" id="category" placeholder="File Category" value="<?php echo $data['category']['category'];?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update" id="update" value="Update File Category" class="btn btn-sm btn-warning px-2 rounded">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-3 p-0 mx-auto">
                    <div class="card-header">Delete File Category</div>
                    <div class="card p-3 border-top-bottom-blue">
                        <form action="<?php echo site_url('nav/category_delete'); ?>" method="post" class="outer-form" id="validate">
                            <input type="hidden" class="form-control" id="id" value="<?php echo $data['category']['id'];?>"  name="id">
                            <div class="form-group">
                                <label for="dept">File Category</label>
                                <input type="text" class="form-control" name="category" id="category" placeholder="File Category" value="<?php echo $data['category']['category'];?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="delete" id="delete" value="Delete File Category" class="btn btn-sm btn-danger px-2 rounded">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0">File Category Lists</h5>
            </div>
            <!-- end title -->


            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-3">

                    <!-- Col-12 -->
                    <div class="col-12 p-0 mt-2">
                    <!-- card -->
                    <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                        <!-- card header -->
                        <div class="card-header p-0">
                            <div class="card-icon">
                                <i class="fa fa-th"></i>
                            </div>
                            <div class="card-label">Lists</div> 
                        </div>
                        <!-- End card header -->
                        <!-- Card Body -->
                        <div class="card-body p-0">
                        <!-- Table Div -->
                        <div class="table-responsive">

                            <!-- Table -->
                            <table class="table table-bordered table-hover table-sm mb-0">
                            
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>File Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                
                                <tbody>
                                    <?php 
                                        foreach ($data['categories'] as $result) : ?>
                                        <?php if($result['id'] != 1) { ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['category']; ?></td>
                                                <td>
                                                  <a class="btn btn-sm btn-primary px-2 rounded" role="button" href="<?php echo site_url('nav/update_category/'.encrypt_id($result['id']));?>">Update</a>
                                                  <a class="btn btn-sm btn-danger px-2 rounded" role="button" href="<?php echo site_url('nav/update_category/'.encrypt_id($result['id']));?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
                    <!-- End Col-12 -->


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
  
 </body> 
</html> 
