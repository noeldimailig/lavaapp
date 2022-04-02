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
                                <a class="nav-link" href="<?php echo site_url('nav/category'); ?>">
                                    <i class="icon fa fa-book pr-1"></i>
                                    Manage Category
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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('nav/admin'); ?>"><i class="fa fa-user"></i> Manage Admins</a></li>
                            <li class="breadcrumb-item"> Administrator Lists </li>
                        </ul>
                    </nav>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                        <h5 class="h3 color-darkgray mt-0 mb-0">Administrator Lists</h5>
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
                                            <a href=""
                                            class="btn btn-sm btn-primary p-0 rounded" role="button"
                                            data-toggle="modal" data-target="#add-admin">
                                                Add New
                                            </a>
                                            <a href="<?php echo site_url('nav/print/active'); ?>"
                                            class="btn btn-sm btn-secondary p-0 rounded" role="button">
                                                Print Record
                                            </a>
                                        </div> 
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="table-responsive">
                                            <table id="admins" class="table table-bordered table-hover table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>ID</td>
                                                        <th>Username</th>
                                                        <th style="display: none;">Firstname</th>
                                                        <th style="display: none;">Lastname</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th style="display: none;">Profile</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['admins'] as $result) : ?>
                                                        <tr>
                                                            <td class="t_id"><?php echo $result['id']; ?></td>
                                                            <td class="t_uname"><?php echo $result['username']; ?></td>
                                                            <td class="t_fname" style="display: none;"><?php echo $result['firstname']; ?></td>
                                                            <td class="t_lname" style="display: none;"><?php echo $result['lastname']; ?></td>
                                                            <td class="t_email"><?php echo $result['email']; ?></td>
                                                            <td class="t_role"><?php echo $result['role']; ?></td>
                                                            <td class="t_file" style="display: none;"><?php echo $result['profile']; ?></td>
                                                            <td>
                                                            <a  
                                                                <?php 
                                                                    if($_SESSION['username'] != $result['username']) 
                                                                        echo 'data-toggle="modal" data-target="#update-admin"';
                                                                    else echo 'data-toggle="modal" data-target=""'; ?> href="#">
                                                                <i class="edit fs-5 material-icons text-info" data-bs-toggle="tooltip" title="Update Admin Details">&#xE254</i>
                                                                </a>
                                                            <a 
                                                                <?php 
                                                                    if($_SESSION['username'] != $result['username']) 
                                                                        echo 'href="'.BASE_URL.'nav/archive_admin/'.encrypt_id($result["id"]).'"';
                                                                    else echo 'href="#"'; ?>
                                                            >
                                                                <i class="fs-5 material-icons text-warning" data-bs-toggle="tooltip" title="Archive Admin">&#xe149</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
                        <h5 class="h3 color-darkgray mt-0 mb-0">Archive Administrator Lists</h5>
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
                                            <a href="<?php echo site_url('nav/print/archive'); ?>"
                                            class="btn btn-sm btn-secondary p-0 rounded" role="button">
                                                Print Record
                                            </a>
                                        </div> 
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="table-responsive">
                                            <table id="admins-archive" class="table table-bordered table-hover table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>ID</td>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['archive'] as $result) : ?>
                                                            <tr>
                                                                <td><?php echo $result['id']; ?></td>
                                                                <td><?php echo $result['username']; ?></td>
                                                                <td><?php echo $result['email']; ?></td>
                                                                <td><?php echo $result['role']; ?></td>
                                                                <td>
                                                                    <a href="<?php echo site_url('nav/activate_admin/'. encrypt_id($result['id']));?>">
                                                                        <i class="fs-5 material-icons text-info" data-bs-toggle="tooltip" title="Activate Admin">&#xe627</i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr></tr>
                                                </tfoot>
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
        
        <div class="modal fade" id="add-admin" tabindex="-1" role="dialog" aria-labelledby="add-admin" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">   
                    <form action="<?php echo site_url('nav/add_admin'); ?>" method="post" id="insert" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add-admin">Create Document Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="message"></div>
                            <div class="form-group">
                                <label for="uname">Username</label>
                                <input type="text" class="form-control" name="uname" id="uname" placeholder="Username">
                            </div>    
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name">
                            </div>
                            <div class="form-group">
                                <label for="fname">First name</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="sample@email.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Password</label>
                                <input type="password" class="form-control" name="conpass" id="conpass" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="role">Assign Role</label>
                                <select class="form-control" id="role" name="role">
                                    <?php foreach ($data['roles'] as $role) {
                                        if($role['role'] == 'Document Admin') { ?>
                                            <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div id="drag-area" class="form-group p-2 mt-2 mb-3 d-flex flex-column align-items-center justify-content-center">
                                <label for="file" id="drop-text">Drop Profile Picture Here</label>
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

        <div class="modal fade" id="update-admin" tabindex="-1" role="dialog" aria-labelledby="update-admin" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo site_url('nav/update_admin'); ?>" method="post" id="update" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="update-admin">Update Document Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">    
                            <div id="u-message"></div>
                            <input type="hidden" class="form-control" name="u_uid" id="u_uid">    
                            <input type="hidden" class="form-control" name="u_prevfile" id="u_prevfile"> 
                            <div class="form-group">
                                <label for="u_uname">Username</label>
                                <input type="text" class="form-control" name="u_uname" id="u_uname" placeholder="Username">
                            </div>    
                            <div class="form-group">
                                <label for="u_lname">Last name</label>
                                <input type="text" class="form-control" name="u_lname" id="u_lname" placeholder="Last name">
                            </div>
                            <div class="form-group">
                                <label for="u_fname">First name</label>
                                <input type="text" class="form-control" name="u_fname" id="u_fname" placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="u_email">Email</label>
                                <input type="email" class="form-control" name="u_email" id="u_email" placeholder="sample@email.com">
                            </div>
                            <div class="form-group">
                                <label for="u_role">Assign Role</label>
                                <select class="form-control" id="u_role" name="u_role">
                                    <?php foreach ($data['roles'] as $role) {
                                        if($role['role'] == 'Document Admin') { ?>
                                            <option value="<?php echo $role['id'];?>"><?php echo $role['role'];?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div id="u-drag-area" class="form-group p-2 mt-2 mb-3 d-flex flex-column align-items-center justify-content-center">
                                <label for="u_file" id="u-drop-text">Drop Profile Picture Here</label>
                                <input type="file" name="u_file" id="u_file">
                            </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success rounded" name="submit" id="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include(ROOT_DIR.'app\views\archive\admin\default\footer.php'); ?>
    </body> 
</html> 
