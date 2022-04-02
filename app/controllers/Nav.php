
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

use \iamdual\Uploader;

class Nav extends Controller {
	public function __construct() {
		parent::__construct();
		$this->call->library('auth');
		$this->call->helper(array('alert'));
	}

	public function last_id(){
		$this->call->model('User_model');

		echo $this->User_model->get_last_id('users');
	}

	public function index() {
		$this->call->model('Docs_model');

		$data['d_cat'] = $this->Docs_model->getDocCategories();
		$data['docs'] = $this->Docs_model->getPublishedDocuments();
		
		$this->call->view('archive/index', $data);
	}

	public function login() {
		$this->call->view('archive/login');
	}

	public function signup() {
		$this->call->view('archive/signup');
	}

	public function research() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getPublishedDocuments();

		$this->call->view('archive/research', $data);
	}

	public function thesis() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getPublishedDocuments();

		$this->call->view('archive/thesis', $data);
	}

	public function dissertation() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getPublishedDocuments();
		$this->call->view('archive/dissertation', $data);
	}

	public function capstone() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getPublishedDocuments();

		$this->call->view('archive/capstone', $data);
	}
	
	public function about() {
		$this->call->model('Docs_model');

		$data['d_cat'] = $this->Docs_model->getDocCategories();
		$data['docs'] = $this->Docs_model->getPublishedDocuments();
		$this->call->view('archive/about', $data);
	}

	public function contact() {
		$this->call->view('archive/contact');
	}

	public function myprofile() {
		$this->call->model('Drop_model');
		$this->call->view('archive/myprofile');
	}

	public function mydocuments($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');
		$this->call->model('Drop_model');

		$data['categories'] = $this->Drop_model->getCategories();
		$data['docs'] = $this->Docs_model->getUserDocuments($dec);

		$this->call->view('archive/mydocuments', $data);
	}

	public function mybookmarks($id) {
		$dec = decrypt_id($id);
		$this->call->model('Book_model');

		$data['docs'] = $this->Book_model->mybookmarks($dec);
		$this->call->view('archive/mybookmarks', $data);
	}

	public function mycitations($id) {
		$dec = decrypt_id($id);
		$this->call->model('Cite_model');

		$data = $this->Cite_model->mycitations($dec);

		$this->call->view('archive/mycitations', $data);
	}

	public function get_apa_citations($id){
		$this->call->model('Cite_model');

		$apa = $this->Cite_model->generateAPA(decrypt_id($id));
		echo $apa;
	}

	public function get_mla_citations($id){
		$this->call->model('Cite_model');

		$mla = $this->Cite_model->generateMLA(decrypt_id($id));
		echo $mla;
	}

	public function count_citations($id) {
		$this->call->model('Docs_model');
		$data = $this->Docs_model->countCitations(decrypt_id($id));

		foreach($data as $datum){
			echo $datum['count'];
		}
	}

	public function preview($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');
		$this->call->model('Cite_model');

		$data['preview'] = $this->Docs_model->getDocument($dec);
		$data['related'] = $this->Docs_model->getPublishedDocuments();
		$data['apa'] = $this->Cite_model->generateAPA($dec);
		$data['mla'] = $this->Cite_model->generateMLA($dec);
		$this->call->view('archive/preview-document', $data);
	}

	public function fullview($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');

		$data = $this->Docs_model->getDocument($dec);
		$this->call->view('archive/view-document', $data);
	}
	// ------------------------------------- Admin Side --------------------------------------------
	public function dashboard() {
		$this->call->model('Docs_model');
		$this->call->model('User_model');
		$data['admin'] = $this->User_model->count_admin();
		$data['user'] = $this->User_model->count_user();
		$data['research'] = $this->Docs_model->count_research();
		$data['thesis'] = $this->Docs_model->count_thesis();
		$data['dissertation'] = $this->Docs_model->count_dissertation();
		$data['capstone'] = $this->Docs_model->count_capstone();
		$data['admins'] = $this->User_model->getAdmins();
		$data['users'] = $this->User_model->getUsers();
		$this->call->view('archive/admin/index', $data);
	}
	//----------------------------------------------------------------------------------------------------------
	public function admin() {
		$this->call->model('User_model');
		$this->call->model('Drop_model');
		$data['admins'] = $this->User_model->getAdmins();
		$data['archive'] = $this->User_model->getArchiveAdmins();
		$data['roles'] = $this->Drop_model->getRoles();
		$this->call->view('archive/admin/admins/index', $data);
	}

	public function send_code($email, $code) {
		$content = "You are selected to handle document management by the admin. Please verify your account in order to login!\nUse this code to verify your account." . $code;
		$this->email->subject('Account Validation');
		$this->email->sender('eliteresearcher2021@gmail.com');
		$this->email->recipient($email);
		$this->email->email_content($content);
		$this->email->send();
	}

	public function add_admin() {
		$this->call->model('User_model');

		$email = $this->io->post('email');
		$uname = $this->io->post('uname');
		$lname = $this->io->post('lname');
		$fname = $this->io->post('fname');
		$pass = $this->io->post('pass');
		$conpass = $this->io->post('conpass');
		$role = $this->io->post('role');

		$code = mt_rand(11111, 99999);
		if($pass == $conpass){
			$pass = $this->auth->passwordhash($password);

			if (isset($_FILES["file"])) {
				$upload = new Uploader($_FILES['file']);
				$upload->allowed_extensions(array("png", "jpg", "jpeg", "JPG", "PNG", "JPEG"));
				$upload->must_be_image();
				$upload->max_size(5); // in MB
				$upload->path("profile_pictures/");
			
				if (!$upload->upload()) {
					if($this->User_model->insert($uname, $email, $pass, $role)){
						$this->send_code($email, $code);
						$msg['msg'] = 'Admin added successfully!';
						$msg['status'] = true;
						echo json_encode($msg);
					}
				} else {
					$profile = $upload->get_name();
					if($this->User_model->insert_profile($profile, $uname, $email, $pass, $role)){
						$this->send_code($email, $code);
						$msg['msg'] = 'Admin added successfully!';
						$msg['status'] = true;
						echo json_encode($msg);
					}
				}
			}
		}else {
			$msg['msg'] = 'Something went wrong, please try to check the details you entered. Make sure that the password matched!';
			$msg['status'] = true;
			echo json_encode($msg);
		}
	}

	public function update_admin() {
		$this->call->model('User_model');

		$id = $this->io->post('u_uid');
		$email = $this->io->post('u_email');
		$uname = $this->io->post('u_uname');
		$lname = $this->io->post('u_lname');
		$fname = $this->io->post('u_fname');
		$role = $this->io->post('u_role');
		$prevfile = $this->io->post('u_prevfile');

		$msg['status'] = false;

		$directory = "profile_pictures/";
		if(($email == "" || $uname == "" || $lname == "" || $fname == "") && $prevfile != "") {
			$msg['msg'] = 'Please fill in all the fields!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}

		if(isset($_FILES['u_file'])){
			if($_FILES['u_file']['name'] == "") {
				if(file_exists($directory . $prevfile)) {
					if($this->User_model->update($id, $uname, $fname, $lname, $email)){
						$msg['msg'] = "Details updated successfully.";
						$msg['status'] = true;
						echo json_encode($msg);
					} else {
						$msg['msg'] = "Seems like there's nothing to update here.";
						$msg['status'] = false;
						echo json_encode($msg);
					}
				}
			}else {
				$filename = $_FILES['u_file']['name'];

				if(file_exists($directory . $filename)) {
					if($this->User_model->profile_update($id, $filename, $uname, $fname, $lname, $email)){
						$msg['msg'] = "Details updated successfully.";
						$msg['status'] = true;
						echo json_encode($msg);
						exit;
					} else {
						$msg['msg'] = "File already exists!";
						$msg['status'] = false;
						echo json_encode($msg);
						exit;
					}
				} else {
					if (move_uploaded_file($_FILES['u_file']['tmp_name'], $directory . $filename)) {
						if($this->User_model->profile_update($id, $filename, $uname, $fname, $lname, $email)){
							if(unlink($directory.$prevfile)) {
								$msg['msg'] = "Details updated successfully.";
								$msg['status'] = false;
								echo json_encode($msg);
								exit;
							}
						}
					} else {
						$msg['msg'] = 'Sorry, there was an error updating admin details.';
						$msg['status'] = false;
	
						echo json_encode($msg);
						exit;
					}
				}
			}
		}
	}

	public function print($table){
		$this->call->model('User_model');
		if($table == 'active') {
			$data['admins'] = $this->User_model->getAdmins();

			$data['title'] = 'Admin '; 
		}
		else {
			$data['admins'] = $this->User_model->getArchiveAdmins();
			$data['title'] = 'Archived Admin'; 
		}
		$this->call->view('archive/admin/admins/print', $data);
	}

	public function activate_admin($id) {
		$this->call->model('User_model');
		$this->User_model->updateStatus(decrypt_id($id), 1, 'users');

		redirect('nav/admin');
	}

	public function archive_admin($id) {
		$this->call->model('User_model');
		$this->User_model->updateStatus(decrypt_id($id), 0, 'users');

		redirect('nav/admin');
	}//---------------------------------------------------------------------------------------------------------

	public function user() {
		$this->call->model('User_model');
		$data['users'] = $this->User_model->getUsers();
		$data['archive'] = $this->User_model->getUsersArchive();
		$this->call->view('archive/admin/users/index', $data);
	}

	public function activate_user($id) {
		$this->call->model('User_model');
		$this->User_model->updateStatus(decrypt_id($id), 1, 'users');

		redirect('nav/user');
	}

	public function archive_user($id) {
		$this->call->model('User_model');
		$this->User_model->updateStatus(decrypt_id($id), 0, 'users');

		redirect('nav/user');
	}
	
	public function print_user($table){
		$this->call->model('User_model');
		if($table == 'active') {
			$data['users'] = $this->User_model->getUsers();

			$data['title'] = 'User'; 
		}
		else {
			$data['users'] = $this->User_model->getUsersArchive();
			$data['title'] = 'Archived User'; 
		}
		$this->call->view('archive/admin/users/print', $data);
	}//---------------------------------------------------------------------------------------------------------

	public function category() {
		$this->call->model('Drop_model');

		$data['category'] = ['id' => 0, 'category' => 'Type Here'];
		$data['categories'] = $this->Drop_model->getCategories();
		$data['archives'] = $this->Drop_model->getArchiveCategories();
		$this->call->view('archive/admin/categories/index', $data);
	}

	public function update_category($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['category'] = $this->Drop_model->getCategory($dec);
		$data['categories'] = $this->Drop_model->getCategories();
		$data['archives'] = $this->Drop_model->getArchiveCategories();
		$this->call->view('archive/admin/categories/index', $data);
	}

	public function category_insert() {
		$this->call->model('Drop_model');

		$category = $this->io->post('category');
		$this->Drop_model->insert_category($category);
		redirect('nav/category');
	}

	public function category_update() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$category = $this->io->post('category');
		$this->Drop_model->update_category($id, $category);
		redirect('nav/category');
	}

	public function activate_category($id) {
		$this->call->model('User_model');
		$this->User_model->updateStatus(decrypt_id($id), 1, 'document_categories');

		redirect('nav/category');
	}

	public function print_category(){
		$this->call->model('Drop_model');

		$data['categories'] = $this->Drop_model->getCategories();
		$data['title'] = 'Category';
		$this->call->view('archive/admin/categories/print', $data);
	}//------------------------------------------------------------------------------------------

	public function print_document() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getDocuments();
		$data['title'] = 'Documents';

		$this->call->view('archive/admin/documents/print', $data);
	}
	public function user_notify_upload($email, $username, $msg) {
		$content = $username. ' with the email ' . $email . ' just '. $msg . ' his own source material. <br>'.
					'<a href="http://localhost/archive/nav/login">Log In</a> now to verify the material.';
		$this->email->subject('User Source Material.');
		$this->email->sender($email);
		$this->email->email_content($content, 'html');
		$this->email->recipient('eliteresearcher2021@gmail.com');
		$this->email->send();
	}

	public function user_notify_publish($username, $email) {
		$content = 'Hi, '. $username. ' with the email ' . $email . '. Your source material have been published. <br>'.
					'<a href="http://localhost/archive/nav/login">Log In</a> now to check the changes.';
		$this->email->subject('Publish Source Material.');
		$this->email->sender('eliteresearcher2021@gmail.com');
		$this->email->email_content($content, 'html');
		$this->email->recipient($email);
		$this->email->send();
	}

	public function document() {
		$this->call->model('Docs_model');
		$this->call->model('Docs_model');
		$this->call->model('User_model');

		$data['docs'] = $this->Docs_model->getDocuments();
		$data['research'] = $this->Docs_model->count_research();
		$data['thesis'] = $this->Docs_model->count_thesis();
		$data['dissertation'] = $this->Docs_model->count_dissertation();
		$data['capstone'] = $this->Docs_model->count_capstone();
		$data['active'] = $this->Docs_model->count_active();
		$data['pending'] = $this->Docs_model->count_pending();
		$data['archive'] = $this->Docs_model->count_archive();
		$this->call->view('archive/admin/documents/index', $data);
	}

	public function manage() {
		$this->call->model('Docs_model');
		$this->call->model('Drop_model');
		$data['docs'] = $this->Docs_model->getActiveDocuments();
		$data['categories'] = $this->Drop_model->getCategories();
		$this->call->view('archive/admin/documents/manage', $data);
	}

	public function archive_document($id) {
		$this->call->model('Docs_model');

		if($this->Docs_model->archive(decrypt_id($id)))
			redirect('nav/manage');
	}

	public function pending() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getPendingDocuments();
		$this->call->view('archive/admin/documents/pending', $data);
	}

	public function publish($id, $username, $email) {
		$this->call->model('Docs_model');

		if($this->Docs_model->publish(decrypt_id($id))){
			$this->user_notify_publish($username, $email);
			redirect('nav/manage');
		}
	}

	public function republish($id) {
		$this->call->model('Docs_model');

		if($this->Docs_model->republish(decrypt_id($id)))
			redirect('nav/manage');
	}

	public function archive() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getArchiveDocuments();
		$this->call->view('archive/admin/documents/archive', $data);
	}

	public function preview_document($id) {
		$this->call->model('Docs_model');
		$dec = decrypt_id($id);
		$data = $this->Docs_model->getFilename($dec);
		$this->call->view('archive/admin/documents/preview-document', $data);
	}
	
	public function document_insert() {
		$this->call->model('Docs_model');

		$title = $this->io->post('title');
		$desc = $this->io->post('description');
		$author = $this->io->post('authors');
		$year = $this->io->post('year');
		$publisher = $this->io->post('publisher');
		$category = $this->io->post('category');
		date_default_timezone_set('Asia/Manila');
		$uploaded = date("Y-m-d h:i:sa");
		$status = 2;
		$updated = date("Y-m-d h:i:sa");
		$id = 0;

		$msg['status'] = false;

		$directory = "documents/";
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(($title == "" || $author == "" || $desc == "" || $publisher == "") && $filename != "") {
			$msg['msg'] = 'Please fill in all the fields!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}

		if($filename == "") {
			$msg['msg'] = 'Please select a valid PDF file first!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}
		if($ext != 'pdf') {
			$msg['msg'] = 'Sorry, file is not a valid PDF file.';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}
		
		if (file_exists($directory . $filename)) {
			$msg['msg'] = 'Sorry, file already exists.';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}else {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $directory . $filename)) {
				if($this->Docs_model->insert_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $uploaded, $updated)){
					$msg['msg'] = 'Study added successfully!';
					$msg['status'] = true;
					echo json_encode($msg);
					exit;
				}
			} else {
				$msg['msg'] = 'Sorry, there was an error uploading your study.';
				$msg['status'] = false;

				echo json_encode($msg);
				exit;
			}
		}
	}

	public function document_update_admin() {
		$this->call->model('Docs_model');

		$id = $this->io->post('u_did');
		$title = $this->io->post('u_title');
		$desc = $this->io->post('u_description');
		$author = $this->io->post('u_authors');
		$year = $this->io->post('u_year');
		$publisher = $this->io->post('u_publisher');
		$category = $this->io->post('u_category');
		$prev_filename = $this->io->post('u_filename');
		date_default_timezone_set('Asia/Manila');
		$updated = date("Y-m-d h:i:sa");
		$status = 2;

		$msg['status'] = false;

		$directory = "documents/";

		if(($title == "" || $author == "" || $desc == "" || $publisher == "") && $prev_filename != "") {
			$msg['msg'] = 'Please fill in all the fields!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}

		if(isset($_FILES['u_file'])){
			if($_FILES['u_file']['name'] == "") {
				if(file_exists($directory . $prev_filename)) {
					if($this->Docs_model->update_document($id, $title, $desc, $author, $year, $publisher, $status, $prev_filename, $category, $updated)){
						$msg['msg'] = 'Study updated successfully!';
						$msg['status'] = true;
						echo json_encode($msg);
						exit;
					}
				}
			}else {
				$filename = $_FILES['u_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
				if($ext != 'pdf') {
					$msg['msg'] = 'Sorry, file is not a valid PDF file.';
					$msg['status'] = false;
	
					echo json_encode($msg);
					exit;
				}
	
				if(file_exists($directory . $filename)) {
					$msg['msg'] = 'Sorry, file already exists.';
					$msg['status'] = false;
	
					echo json_encode($msg);
					exit;
				} else {
					if (move_uploaded_file($_FILES['u_file']['tmp_name'], $directory . $filename)) {
						if($this->Docs_model->update_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $updated)){
							if(unlink($directory.$prev_filename)){
								$msg['msg'] = 'Study updated successfully!';
								$msg['status'] = true;
								echo json_encode($msg);
								exit;
							}
						}
					} else {
						$msg['msg'] = 'Sorry, there was an error updating your study.';
						$msg['status'] = false;
	
						echo json_encode($msg);
						exit;
					}
				}
			}
		}
	}

	public function user_document_insert() {
		$this->call->model('Docs_model');

		$id = decrypt_id($this->io->post('id'));
		$title = $this->io->post('title');
		$desc = $this->io->post('description');
		$author = $this->io->post('authors');
		$year = $this->io->post('year');
		$publisher = $this->io->post('publisher');
		$category = $this->io->post('category');
		$name = $this->io->post('name');
		$email = $this->io->post('email');
		date_default_timezone_set('Asia/Manila');
		$uploaded = date("Y-m-d h:i:sa");
		$status = 1;
		$updated = NULL;

		$msg['status'] = false;

		$directory = "documents/";
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(($title == "" || $author == "" || $desc == "" || $publisher == "") && $filename != "") {
			$msg['msg'] = 'Please fill in all the fields!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}

		if($filename == "") {
			$msg['msg'] = 'Please select a valid PDF file first!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}
		if($ext != 'pdf') {
			$msg['msg'] = 'Sorry, file is not a valid PDF file.';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}
		
		if (file_exists($directory . $filename)) {
			$msg['msg'] = 'Sorry, file already exists.';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}else {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $directory . $filename)) {
				if($this->Docs_model->insert_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $uploaded, $updated)){
					$msg['msg'] = 'Study added successfully! Wait for the admin to confirm it.';
					$msg['status'] = true;

					$this->user_notify_upload($email, $name, 'uploaded');
					echo json_encode($msg);
					exit;
				}
			} else {
				$msg['msg'] = 'Sorry, there was an error uploading your study.';
				$msg['status'] = false;

				echo json_encode($msg);
				exit;
			}
		}
	}

	public function document_update() {
		$this->call->model('Docs_model');

		$id = $this->io->post('u_did');
		$title = $this->io->post('u_title');
		$desc = $this->io->post('u_description');
		$author = $this->io->post('u_authors');
		$year = $this->io->post('u_year');
		$publisher = $this->io->post('u_publisher');
		$category = $this->io->post('u_category');
		$prev_filename = $this->io->post('u_filename');
		$role = $this->io->post('u_role');
		$name = $this->io->post('u_name');
		$email = $this->io->post('u_email');
		date_default_timezone_set('Asia/Manila');
		$updated = null;
		$status = 1;

		$msg['status'] = false;

		$directory = "documents/";

		if(($title == "" || $author == "" || $desc == "" || $publisher == "") && $prev_filename != "") {
			$msg['msg'] = 'Please fill in all the fields!';
			$msg['status'] = false;

			echo json_encode($msg);
			exit;
		}

		if(!isset($_FILES['file'])){
			if(file_exists($directory . $prev_filename)) {
				if($role == 2) $status = 2; else $status = 1;
				if($this->Docs_model->update_document($id, $title, $desc, $author, $year, $publisher, $status, $prev_filename, $category, $updated)){
					$msg['msg'] = 'Study updated successfully! Wait for the admin to confirm it.';
					$msg['status'] = true;

					$this->user_notify_upload($email, $name, 'updated');
					echo json_encode($msg);
					exit;
				}
			}
		}
		else {
			$filename = $_FILES['u_file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if($ext != 'pdf') {
				$msg['msg'] = 'Sorry, file is not a valid PDF file.';
				$msg['status'] = false;

				echo json_encode($msg);
				exit;
			}

			if(file_exists($directory . $filename)) {
				$msg['msg'] = 'Sorry, file already exists.';
				$msg['status'] = false;

				echo json_encode($msg);
				exit;
			} else {
				if (move_uploaded_file($_FILES['u_file']['tmp_name'], $directory . $filename)) {
					if($role == 2) $status = 2; else{ $status = 1; $updated = null; }
					if($this->Docs_model->update_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $updated)){
						if(unlink($directory.$prev_filename)){
							$msg['msg'] = 'Study updated successfully! Wait for the admin to confirm it.';
							$msg['status'] = true;

							$this->user_notify_upload($email, $name, 'updated');
							echo json_encode($msg);
							exit;
						}
					}
				} else {
					$msg['msg'] = 'Sorry, there was an error updating your study.';
					$msg['status'] = false;

					echo json_encode($msg);
					exit;
				}
			}
		}
	}

	public function delete_document($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');
		$this->call->model('Drop_model');

		$data['docs'] = $this->Docs_model->getDocument($dec);
		$data['states'] = $this->Drop_model->getStates();
		$data['categories'] = $this->Drop_model->getCategories();
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/documents/delete', $data);
	}

	public function document_delete() {
		$this->call->model('Docs_model');

		$id = $this->io->post('id');
		$filename = $this->io->post('filename');

		if($this->Docs_model->document_delete($id)){
			redirect('nav/document');
		}
	}//------------------------------------------------------------------------------------------

	public function logout() {
		$userdata = array(
			'user_id',
			'user_profile',
			'user_role',
			'user_email',
			'username',
			'firstname',
			'lastname',
			'campus',
			'dep',
			'program',
		);

		$this->session->unset_userdata($userdata);
		$this->auth->set_logged_out();

		redirect('nav/index');
	}	
}
?>
