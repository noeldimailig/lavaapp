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
                    <a class="nav-link active" href="<?php echo site_url('nav/document'); ?>">
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
                    <li class="breadcrumb-item"><a href="<?php echo site_url('nav/document'); ?>"><i class="fa fa-file"></i> Manage Documents</a></li>
                    <li class="breadcrumb-item">Add Document</li>
                </ul>
            </nav>
            <!-- End BreadCrumb -->

            <!-- title -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                <h5 class="h3 color-darkgray mt-0 mb-0"> Form <small>Add Document</small></h5> 
            </div>
            <!-- end title -->

            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row pb-5">
                    
                    <!-- col-12 -->
                    <div class="col-12 p-0 m-0 mt-0">
                        
                        <!-- Card Deck -->
                        <div class="card-deck">
                            <!-- card -->
                            <div class="card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                <!-- card header -->
                                <div class="card-header p-0">
                                    <div class="card-icon"><i class="fa fa-file"></i></div>
                                    <div class="card-label">Document Details</div>
                                </div>
                                <!-- End card header -->
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                    //   if(isset($_POST['submit'])){

                                    //     $title = $_POST['title'];
                                    //     $description = $_POST['description'];
                                    //     $authors = $_POST['authors'];
                                    //     $year = $_POST['year'];
                                    //     $pub = $_POST['publisher'];
                                    //     $doc_id = $_POST['doc_category'];
                                    //     $file_id = $_POST['file_category'];
                                    //     $status = $_POST['status'];
                                    //     $filename = $_FILES['file']['name'];
                                    //     $move = $_FILES['file']['tmp_name'];

                                    //     date_default_timezone_set('Asia/Manila');

                                    //     $uploaded = date("Y-m-d h:i:sa");
                                    //     $updated = date("Y-m-d h:i:sa");

                                    //     echo $db->insertDocument($move, $title, $description, $authors, $year, $pub, $status, $filename, $doc_id, $file_id, $uploaded, $updated);
                                    //   }?>
                                       
                                                
                                <!-- Form -->
                                <form action="<?php echo site_url('nav/document_insert'); ?>" method="post" class="outer-form" id="validate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" id="description" name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="authors">Author(s)</label>
                                            <input type="text" class="form-control" name="authors" id="authors" placeholder="Bonifacio, Andres | Ibarra, Simon">
                                        </div>
                                        <div class="form-group">
                                            <label for="year">Publication Date</label>
                                            <input type="text" class="form-control" name="year" id="year" placeholder="Month Day, Year">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher">Publisher</label>
                                            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                                        </div>
                                        <div class="form-group">
                                            <label for="file_category">Select Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <?php 
                                                  foreach ($data['states'] as $state): ?>
                                                    <option value="<?php echo $state['id'];?>"><?php echo $state['state'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="file_category">Select Document</label>
                                            <select class="form-control" id="doc_category" name="doc_category">
                                                <?php foreach ($data['categories'] as $category): ?>
                                                    <option value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="doc_category">Select Category</label>
                                            <select class="form-control" id="file_category" name="file_category">
                                                <?php foreach ($data['files'] as $file): ?>
                                                    <option value="<?php echo $file['id'];?>"><?php echo $file['file'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div id="dragndrop" ondrop="upload_file(event)" ondragover="return false">
                                            <p class="mr-2">Drop file here or</p>
                                            <p><input class="btn btn-info btn-sm px-2 rounded" type="button" value="Select File" onclick="file_explorer();" /></p>
                                            <input style="display: none;" type="file" name="file" class="form-control file" id="file">
                                            <p>File Name:</p>
                                            <p id="actual-file-name"></p>
                                        </div>                                    
                                    
                                    <!-- col-12 -->
                                    <div class="col-12 p-0 m-0 mt-4">
                                        <!-- card -->
                                        <div class="card button-card border-top-bottom-blue">  <!-- <div class="card text-white bg-dark"> -->
                                            <!-- Card Body -->
                                            <div class="card-body button-card-body">
                                                <input type="submit" id="submit" value="Add Document" name="submit" class="btn btn-sm btn-primary px-2 rounded">
                                                <a class="btn btn-sm btn-dark px-2 rounded" role="button" href="<?php echo site_url('nav/document'); ?>">Back</a>
                                            </div>
                                            <!-- End Card Body -->
                                        </div>
                                        <!-- End card -->
                                    </div>
                                    <!-- end col-12 -->
                                    </form>
                                    <!-- End Form -->
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

  <?php include(ROOT_DIR.'app\views\archive\admin\default\footer.php'); ?>
  <script>
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('#actual-file-name').html(fileName);
        });
    });

    
function success_alert(){
    <?php echo alert_success('success'); ?>
}
function failed_alert(){
    <?php echo alert_error('error'); ?>
}
</script>
 </body> 
</html> 
