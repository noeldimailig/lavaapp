<!DOCTYPE html> 

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Elite Researcher</title> 
        <?php include(ROOT_DIR.'app\views\archive\admin\default\header.php'); ?>
        <style>
            #drag-area, #u-drag-area {
             border: 2px dashed #dee2e6;
            }
            .file_drag_over {
                border-color: #585858!important;
            }
            #file, #u_file {
                display: none;
            }
        </style>
   </head> 
  
   <body> 
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarToggler" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse pt-0 pb-5">
                    <div class="side-logo pb-3 pt-3 pl-2 pr-2">
                        <a href="<?php echo site_url('nav/dashboard'); ?>"><img src="<?php echo BASE_URL.PUBLIC_DIR.'/admin/img/logo.png'; ?>" height="auto" width="100%" alt=""></a>
                    </div>
                    <div class="side-slide-down pb-5">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('nav/document'); ?>">
                                    <i class="icon fa fa-tachometer pr-1"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo site_url('nav/manage'); ?>">
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
                <nav class="navbar navbar-expand-lg navbar-dark fixed-top flex-md-nowrap p-0 custom-grid">
                    <div class="collapse navbar-collapse"></div>
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
                    <div class="navbar-toggler d-md-none sidebar-toggle px-3 bg-dark text-left" >
                        <a href="#" data-toggle="collapse" data-target="#sidebarToggler" aria-controls="sidebarToggler" aria-expanded="false" aria-label="Toggle navigation" class="togs"> <i class="fa fa-bars"></i> Menu</a>
                    </div> 
                </nav>
                <main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('nav/manage'); ?>"><i class="fa fa-file"></i> Manage Documents</a></li>
                            <li class="breadcrumb-item"> Document Lists </li>
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                        <h5 class="h3 color-darkgray mt-0 mb-0">Active Document Lists</h5>
                    </div>
                    <div class="container-fluid">
                        <div class="row pb-3">
                            <div class="col-12 p-0 mt-2">
                                <div class="card border-top-bottom-blue">
                                    <div class="card-header p-0">
                                        <div class="card-icon">
                                            <i class="fa fa-th"></i>
                                        </div>
                                        <div class="card-label">Lists 
                                            <a href="" data-toggle="modal" data-target="#upload" class="btn btn-sm btn-primary p-0 rounded" role="button">Add New</a>
                                            <a href="<?php echo site_url('nav/print_document'); ?>"
                                            class="btn btn-sm btn-secondary p-0 rounded" role="button">
                                                Print Record
                                            </a>
                                        </div> 
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="table-responsive">
                                            <table id="documents" class="table table-hover table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Authors</th>
                                                        <th style="display: none;">Description</th>
                                                        <th style="display: none;">Year Published</th>
                                                        <th style="display: none;">Publisher</th>
                                                        <th style="display: none;">Category</th>
                                                        <th>File Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['docs'] as $result) : ?>
                                                        <tr>
                                                            <td class="t_id"><?php echo $result['id']; ?></td>
                                                            <td class="t_title"><?php echo $result['title']; ?></td>
                                                            <td class="t_author"><?php echo $result['authors']; ?></td>
                                                            <td style="display: none;" class="t_desc"><?php echo $result['description']; ?></td>
                                                            <td style="display: none;" class="t_year"><?php echo $result['pub_year']; ?></td>
                                                            <td style="display: none;" class="t_pub"><?php echo $result['publisher']; ?></td>
                                                            <td style="display: none;" class="t_cat"><?php echo $result['category']; ?></td>
                                                            <td class="t_file"><a href="<?php echo site_url('nav/preview_document/'.encrypt_id($result['id'])); ?>"><?php echo $result['filename']; ?></a></td>
                                                            <td>
                                                                <a data-toggle="modal" data-target="#update" href="">
                                                                    <i class="edit fs-5 material-icons text-info" data-bs-toggle="tooltip" title="Update Document Details">&#xE254</i>
                                                                </a>
                                                                <a href="<?php echo site_url('nav/archive_document/'.encrypt_id($result['id'])); ?>">
                                                                    <i class="fs-5 material-icons text-warning" data-bs-toggle="tooltip" title="Archive Document">&#xe149</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="footer mt-auto px-5 py-2 bg-white border-top footer" >
                        <div class="container d-flex flex-row align-items-start justify-content-center">
                            <span class="text-muted"> &copy; 2021 | </span> <p class="ml-2">Dimailig | Pine | Cabello</p>
                        </div>
                    </footer>
                </main>
            </div>
        </div>
        <?php include(ROOT_DIR.'app\views\archive\admin\default\footer.php'); ?>
        <!-- Upload document modal -->
        <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="upload" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo site_url('nav/document_insert'); ?>" method="post" id="uploadDoc" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="upload">Upload Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="message"></div>
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
                    <input type="text" class="form-control" name="authors" id="authors" placeholder="Bonifacio, Andres A. | Ibarra, Simon B.">
                    </div>
                    <div class="form-group">
                    <label for="year">Publication Date</label>
                    <input type="date" class="form-control" name="year" id="year" value="" placeholder="" min="1997-01-01" max="2022-12-31">
                    </div>

                    <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                    </div>
                    <div class="form-group">
                    <label for="doc_category">Select Category</label>
                    <select class="form-control" id="category" name="category">
                        <?php foreach($data['categories'] as $category): ?>
                        <option value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>     
                    <div id="drag-area" class="form-group p-2 mt-2 mb-3 d-flex flex-column align-items-center justify-content-center">
                    <label for="file" id="drop-text">Drop Files Here</label>
                    <input type="file" name="file" id="file">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded" name="submit" id="submit">Save</button>
                </div> 
                </form>
            </div>
            </div>
        </div>

        <!-- Upload document modal -->
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo site_url('nav/document_update_admin'); ?>" method="post" id="updateDoc" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="update">Update Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="u-message"></div>
                    <input type="hidden" class="form-control" name="u_did" id="u_did">
                    <input type="hidden" class="form-control" name="u_filename" id="u_filename">
                    <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="u_title" id="u_title" placeholder="Title">
                    </div>
                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="u_description" name="u_description"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="authors">Author(s)</label>
                    <input type="text" class="form-control" name="u_authors" id="u_authors" placeholder="Bonifacio, Andres A. | Ibarra, Simon B.">
                    </div>
                    <div class="form-group">
                    <label for="year">Publication Date</label>
                    <input type="date" class="form-control" name="u_year" id="u_year" placeholder="" min="1997-01-01" max="2022-12-31">
                    </div>

                    <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" name="u_publisher" id="u_publisher" placeholder="Publisher">
                    </div>
                    <div class="form-group">
                    <label for="doc_category">Select Category</label>
                    <select class="form-control" id="u_category" name="u_category">
                        <?php foreach($data['categories'] as $category): ?>
                        <option value="<?php echo $category['id'];?>"><?php echo $category['category'];?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>     
                    <div id="u-drag-area" class="form-group p-2 mt-2 mb-3 d-flex flex-column align-items-center justify-content-center">
                    <label for="u_file" id="u-drop-text">Drop Files Here</label>
                    <input type="file" name="u_file" id="u_file">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success rounded" name="u_submit" id="u_submit">Update</button>
                </div> 
                </form>
            </div>
            </div>
        </div>
        <?php echo load_js(array('admin/js/dragndropdoc')); ?>
        <script>
            $(document).ready( function () {
                $('#documents').DataTable();
                $('#pending').DataTable();
            });
        </script>
    </body> 
</html> 
