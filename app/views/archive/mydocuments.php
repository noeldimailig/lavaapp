<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Documents - Elite Researcher</title>
  <?php include('default/header.php'); ?>
  <style>
    .contact .php-email-form select:focus {
      border-color: #5fcf80;
    }
    .contact .php-email-form select {
      height: 44px; border-radius: 4px; box-shadow: none; font-size: 14px;
    }
    img {
      width: 100%; height: 100%;
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
                  </li>
                  <li><a href="<?php echo site_url('nav/about'); ?>">About</a></li>
                  <li><a href="<?php echo site_url('nav/contact'); ?>">Contact</a></li>

                  <?php if($this->session->userdata('user_email')) : ?> 
                  <li class="dropdown d-flex flex-row justify-content-center">
                      <a href="#">
                          <img class="mx-1" src="<?php echo BASE_URL . PUBLIC_DIR.'/profile_pictures/'.$this->session->userdata('user_profile'); ?>" alt="" style="width: 20px; height: 20px; border-radius: 50%;">
                          <span><?php echo $this->session->userdata('username'); ?></span> <i class="bi bi-chevron-down"></i>
                      </a>
                      <ul>
                          <?php if($_SESSION['user_role'] == 2 || $_SESSION['user_role'] == 3) : ?>
                              <li><a href="<?php echo site_url('nav/dashboard'); ?>">Go to Dashboard</a></li>
                              <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                              <li><a class="active" href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
                              <li><a href="<?php echo site_url('nav/mycitations/'. encrypt_id($_SESSION['user_id'])); ?>">Saved Citations</a></li>
                              <li><a href="<?php echo site_url('nav/mybookmarks/'. encrypt_id($_SESSION['user_id'])); ?>">Bookmarked Documents</a></li>
                              <li><a href="<?php echo site_url('nav/logout'); ?>">Log Out</a></li>
                              <?php else: ?>
                              <li><a href="<?php echo site_url("nav/myprofile/". encrypt_id($_SESSION['user_id'])); ?>">My Profile</a></li>
                              <li><a class="active" href="<?php echo site_url("nav/mydocuments/". encrypt_id($_SESSION['user_id'])); ?>">My Documents</a></li>
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
        <h2>My Documents</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <div class="container">
      <div class="row-6 bg-secondary p-3 rounded-top mt-4 d-flex justify-content-between align-items-between">
        <h4 class="text-white">Add Material</h4>
        <button class="btn btn-sm btn-light" type="submit" data-bs-toggle="modal" data-bs-target="#upload">Upload Material</button>
      </div>
      <div class="row-12 mb-5 p-4 border rounded-bottom">
        <table id="mydocs" class="table table-light table-borderless table-hover">
          <thead>
            <tr>
              <th style="display: none;">ID</th>
              <th>Title</th>
              <th>Author(s)</th>
              <th style="display: none;">Description</th>
              <th style="display: none;">Year Published</th>
              <th style="display: none;">Publisher</th>
              <th style="display: none;">Filename</th>
              <th>Status</th>
              <th style="display: none;">Category</th>
              <th>Date Uploaded</th>
              <th>Date Approved</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['docs'] as $doc) : ?>
              <tr>
                <td style="display: none;" class="t_id"><?php echo $doc['id']; ?></td>
                <td class="t_title"><a href="<?php echo site_url('nav/preview/'. encrypt_id($doc['id'])); ?>"><?php echo $doc['title']; ?></a></td>
                <td class="t_author"><?php echo $doc['authors']; ?></td>
                <td style="display: none;" class="t_desc"><?php echo $doc['description']; ?></td>
                <td style="display: none;" class="t_year"><?php echo $doc['pub_year']; ?></td>
                <td style="display: none;" class="t_pub"><?php echo $doc['publisher']; ?></td>
                <td style="display: none;" class="t_file"><?php echo $doc['filename']; ?></td>
                <td class="t_state"><?php echo $doc['state']; ?></td>
                <td style="display: none;" class="t_cat"><?php echo $doc['category']; ?></td>
                <td class="t_upload"><?php echo $doc['uploaded_at']; ?></td>
                <td class="t_update"><?php echo $doc['updated_at']; ?></td>
                <td>
                  <a href="<?php echo site_url('nav/preview/'. encrypt_id($doc['id'])); ?>" data-bs-toggle="modal" data-bs-target="#update">
                    <i class="edit fs-5 material-icons text-secondary">&#xE254</i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </main><!-- End #main -->

  <!-- Upload document modal -->
  <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="upload" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="<?php echo site_url('nav/user_document_insert'); ?>" method="post" id="uploadDoc" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="upload">Upload Document</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="message"></div>
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo encrypt_id($_SESSION['user_id']); ?>">
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="submit" id="submit">Save</button>
          </div> 
        </form>
      </div>
    </div>
  </div>

  <!-- Upload document modal -->
  <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="<?php echo site_url('nav/user_document_insert'); ?>" method="post" id="updateDoc" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="update">Update Document</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="u-message"></div>
            <input type="hidden" class="form-control" name="u_did" id="u_did">
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="u_submit" id="u_submit">Save</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  <?php include('default/footer.php'); ?>
  
</body>

</html>
