
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
use \iamdual\Uploader;
class Nav extends Controller {
	public function __construct() {
		parent::__construct();
		$this->call->library('auth');
		$this->call->helper(array('alert'));
	}

	public function index() {
		$this->call->model('Docs_model');

		$data['d_cat'] = $this->Docs_model->getDocCategories();
		$data['docs'] = $this->Docs_model->getDocuments();
		
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
		$data['docs'] = $this->Docs_model->getDocuments();

		$this->call->view('archive/research', $data);
	}

	public function countCitation($id){
		$this->call->model('Docs_model');
		$data['count'] = $this->Docs_model->countCitations($id);

		$this->call->view('archive/research', $data);
	}

	public function thesis() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getDocuments();

		$this->call->view('archive/thesis', $data);
	}

	public function dissertation() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getDocuments();
		$this->call->view('archive/dissertation', $data);
	}

	public function capstone() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->getDocuments();

		$this->call->view('archive/capstone', $data);
	}
	
	public function about() {
		$this->call->model('Docs_model');

		$data['d_cat'] = $this->Docs_model->getDocCategories();
		$data['docs'] = $this->Docs_model->getDocuments();
		$this->call->view('archive/about', $data);
	}

	public function contact() {
		$this->call->view('archive/contact');
	}

	public function myprofile() {
		$this->call->model('Drop_model');

		$data['programs'] = $this->Drop_model->getPrograms();
		$data['campuses'] = $this->Drop_model->getCampuses();
		$data['departments'] = $this->Drop_model->getDepartments();

		$this->call->view('archive/myprofile', $data);
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

	public function preview($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');

		$data = $this->Docs_model->getDocument($dec);
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
		$data['admins'] = $this->User_model->getAdmins();
		$this->call->view('archive/admin/admins/index', $data);
	}

	public function insert_admin() {
		$this->call->model('Drop_model');
		$data['roles'] = $this->Drop_model->getRoles();
		$data['programs'] = $this->Drop_model->getPrograms();
		$data['campuses'] = $this->Drop_model->getCampuses();
		$data['departments'] = $this->Drop_model->getDepartments();
		$this->call->view('archive/admin/admins/insert', $data);
	}

	public function add_admin() {
		$this->call->model('User_model');

		$email = $this->io->post('email');
		$uname = $this->io->post('name');
		$pass = $this->io->post('password');
		$conpass = $this->io->post('confirm_password');
		$program = $this->io->post('program');
		$campus = $this->io->post('campus');
		$dep = $this->io->post('department');
		$role = $this->io->post('role');

		$options = array(
			'cost' => 4,
		);

		if($pass == $conpass){
			$pass = password_hash($pass, PASSWORD_BCRYPT, $options);

			if (isset($_FILES["file"])) {
				$upload = new Uploader($_FILES['file']);
				$upload->allowed_extensions(array("png", "jpg", "jpeg", "JPG", "PNG", "JPEG"));
				$upload->must_be_image();
				$upload->max_size(5); // in MB
				$upload->path("profile_pictures/");
			
				if (!$upload->upload()) {
					if($this->User_model->insert($uname, $email, $pass, $program, $campus, $dep, $role)){
						$this->session->set_flashdata(array('success' => 'Admin added successfully!'));
	
						redirect('nav/admin');
					}
				} else {
					$profile = $upload->get_name();
					if($this->User_model->insert_profile($profile, $uname, $email, $pass, $program, $campus, $dep, $role)){
						$this->session->set_flashdata(array('success' => 'Admin added successfully!'));
	
						redirect('nav/admin');
					}
				}
			}
		}else {
			$this->session->set_flashdata(array('error' => 'Password do not matched!'));
			redirect('nav/insert_admin');
		}
	}

	public function update_admin($id) {
		$dec = decrypt_id($id);
		$this->call->model('User_model');
		$this->call->model('Drop_model');

		$data['roles'] = $this->Drop_model->getRoles();
		$data['programs'] = $this->Drop_model->getPrograms();
		$data['campuses'] = $this->Drop_model->getCampuses();
		$data['departments'] = $this->Drop_model->getDepartments();
		$data['admin'] = $this->User_model->getAdmin($dec);
		$this->call->view('archive/admin/admins/update', $data);
	}

	public function update_admin_data() {
		$this->call->model('User_model');

		$id = $this->io->post('id');
		$email = $this->io->post('email');
		$pass = $this->io->post('password');
		$passc = $this->io->post('passwords');
		$conpass = $this->io->post('confirm_password');
		$uname = $this->io->post('name');
		$program = $this->io->post('program');
		$campus = $this->io->post('campus');
		$dep = $this->io->post('department');
		$role = $this->io->post('role');
		$options = array(
			'cost' => 4,
		);

		if($pass == $passc && $conpass == $passc){
			$pass == $passc;
		}else{
			if($pass == $conpass){
				$pass = password_hash($pass, PASSWORD_BCRYPT, $options);
			}
		}

		if (isset($_FILES["file"])) {
			$upload = new Uploader($_FILES['file']);
			$upload->allowed_extensions(array("png", "jpg", "jpeg", "JPG", "PNG", "JPEG"));
			$upload->must_be_image();
			$upload->max_size(5); // in MB
			$upload->path("profile_pictures/");
		
			if (!$upload->upload()) {
				if($this->User_model->update_just_text($id, $uname, $email, $pass, $program, $campus, $dep, $role)){
					$this->session->set_flashdata(array('success' => 'Admin update successful!'));

					redirect('nav/admin');
				}
			} else {
				$profile = $upload->get_name();
				if($this->User_model->profile_update($id, $profile, $uname, $email, $pass, $program, $campus, $dep, $role)){
					$this->session->set_flashdata(array('success' => 'Admin updated successfully!'));

					redirect('nav/admin');
				}
			}
		}else{
			redirect('nav/update_admin/'.$id);
		}
	}

	public function delete_admin($id) {
		$dec = decrypt_id($id);
		$this->call->model('User_model');
		$this->call->model('Drop_model');

		$data['roles'] = $this->Drop_model->getRoles();
		$data['programs'] = $this->Drop_model->getPrograms();
		$data['campuses'] = $this->Drop_model->getCampuses();
		$data['departments'] = $this->Drop_model->getDepartments();
		$data['admin'] = $this->User_model->getAdmin($dec);
		$this->call->view('archive/admin/admins/delete', $data);
	}

	public function delete_admin_data() {
		$this->call->model('User_model');

		$id = $this->io->post('id');

		$this->User_model->deleteAdmin($id);

		redirect('nav/admin');
	}
	//---------------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------------
	public function user() {
		$this->call->model('User_model');
		$data['users'] = $this->User_model->getUsers();
		$this->call->view('archive/admin/users/index', $data);
	}

	public function delete_user($id) {
		$dec = decrypt_id($id);
		$this->call->model('User_model');

		$data['user'] = $this->User_model->getUser($dec);
		$this->call->view('archive/admin/users/delete', $data);
	}

	public function delete_user_data() {
		$this->call->model('User_model');

		$id = $this->io->post('id');

		$this->User_model->deleteAdmin($id);

		redirect('nav/user');;
	}//---------------------------------------------------------------------------------------------------------

	public function document() {
		$this->call->model('Docs_model');
		$data['docs'] = $this->Docs_model->get_documents();
		$this->call->view('archive/admin/documents/index', $data);
	}

	public function preview_document($id) {
		$this->call->model('Docs_model');
		$dec = decrypt_id($id);
		$data = $this->Docs_model->getFilename($dec);
		$this->call->view('archive/admin/preview-document', $data);
	}

	public function insert_document() {
		$this->call->model('Drop_model');

		$data['states'] = $this->Drop_model->getStates();
		$data['categories'] = $this->Drop_model->getCategories();
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/documents/insert', $data);
	}
	
	public function document_insert() {
		$this->call->model('Docs_model');

		$title = $this->io->post('title');
		$desc = $this->io->post('description');
		$author = $this->io->post('authors');
		$year = $this->io->post('year');
		$publisher = $this->io->post('publisher');
		$status = $this->io->post('status');
		$category = $this->io->post('doc_category');
		$file = $this->io->post('file_category');
		date_default_timezone_set('Asia/Manila');

		$uploaded = date("Y-m-d h:i:sa");
		$updated = date("Y-m-d h:i:sa");

		if (isset($_FILES["file"])) {
			$upload = new Uploader($_FILES['file']);
			$upload->allowed_extensions(array("pdf"));
			$upload->path("documents/");
		
			if (!$upload->upload()) {
				redirect('nav/insert_document');
			} else {
				$filename = $upload->get_name();
				if($this->Docs_model->check_document($filename) == false){
					if($this->Docs_model->insert_document($title, $desc, $author, $year, $publisher, $status, $filename, $category, $file, $uploaded, $updated)){
						$this->session->set_flashdata(array('success' => 'Document added successfully!'));
	
						redirect('nav/document');
					}
				}else {
					$this->session->set_flashdata(array('error' => 'Document already exists!'));
					echo "error";
					redirect('nav/insert_document');
				}
			}
		}
	}
	
	public function update_document($id) {
		$dec = decrypt_id($id);
		$this->call->model('Docs_model');
		$this->call->model('Drop_model');

		$data['docs'] = $this->Docs_model->getDocument($dec);
		$data['states'] = $this->Drop_model->getStates();
		$data['categories'] = $this->Drop_model->getCategories();
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/documents/update', $data);
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
			unlink(PUBLIC_DIR.'/public/documents/'.$filename);
			redirect('nav/document');
		}
	}

	public function document_update() {
		$this->call->model('Docs_model');

		$id = $this->io->post('id');
		$title = $this->io->post('title');
		$desc = $this->io->post('description');
		$author = $this->io->post('authors');
		$year = $this->io->post('year');
		$publisher = $this->io->post('publisher');
		$status = $this->io->post('status');
		$category = $this->io->post('doc_category');
		$file = $this->io->post('file_category');
		date_default_timezone_set('Asia/Manila');

		$updated = date("Y-m-d h:i:sa");

		if (isset($_FILES["file"])) {
			$upload = new Uploader($_FILES['file']);
			$upload->allowed_extensions(array("pdf"));
			$upload->path("documents/");
		
			if (!$upload->upload()) {
				if($this->Docs_model->update_document_text($id, $title, $desc, $author, $year, $publisher, $status, $category, $file, $updated)){
					$this->session->set_flashdata(array('success' => 'Document added successfully!'));

					redirect('nav/document');
				}
			} else {
				$filename = $upload->get_name();
				if($this->Docs_model->update_document($id, $title, $desc, $author, $year, $publisher, $status, $filename, $category, $file, $updated)){
					$this->session->set_flashdata(array('success' => 'Document added successfully!'));

					redirect('nav/document');
				}
				else {
					$this->session->set_flashdata(array('error' => 'Document already exists!'));
					echo "error";
					redirect('nav/insert_document');
				}
			}
		}
	}
	//---------------------------------------------------------------------------------------------------------

	public function campus() {
		$this->call->model('Drop_model');

		$data['campus'] = ['id' => 0, 'campus' => 'Type Here'];
		$data['campuses'] = $this->Drop_model->getCampuses();
		$this->call->view('archive/admin/campuses/index', $data);
	}

	public function update_campus($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['campus'] = $this->Drop_model->getCampus($dec);
		$data['campuses'] = $this->Drop_model->getCampuses();
		$this->call->view('archive/admin/campuses/index', $data);
	}

	public function campus_insert() {
		$this->call->model('Drop_model');

		$campus = $this->io->post('campus');
		$this->Drop_model->insert_campus($campus);
		redirect('nav/campus');
	}

	public function campus_update() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$campus = $this->io->post('campus');
		$this->Drop_model->update_campus($id, $campus);
		redirect('nav/campus');
	}

	public function delete_campus($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['campus'] = $this->Drop_model->getCampus($dec);
		$data['campuses'] = $this->Drop_model->getCampuses();
		$this->call->view('archive/admin/campuses/index', $data);
	}

	public function campus_delete() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$this->Drop_model->delete_campus($id);
		redirect('nav/campus');
	}

	// --------------------------------------------------------------------------------------------
	public function department() {
		$this->call->model('Drop_model');

		$data['department'] = ['id' => 0, 'dep' => 'Type Here'];
		$data['departments'] = $this->Drop_model->getDepartments();
		$this->call->view('archive/admin/departments/index', $data);
	}

	public function update_department($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['department'] = $this->Drop_model->getDepartment($dec);
		$data['departments'] = $this->Drop_model->getDepartments();
		$this->call->view('archive/admin/departments/index', $data);
	}

	public function department_insert() {
		$this->call->model('Drop_model');

		$dep = $this->io->post('department');
		$this->Drop_model->insert_department($dep);
		redirect('nav/department');
	}

	public function department_update() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$dep = $this->io->post('department');
		$this->Drop_model->update_department($id, $dep);
		redirect('nav/department');
	}

	public function delete_department($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['department'] = $this->Drop_model->getDepartment($dec);
		$data['departments'] = $this->Drop_model->getDepartments();
		$this->call->view('archive/admin/departments/index', $data);
	}

	public function department_delete() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$this->Drop_model->delete_department($id);
		redirect('nav/department');
	}//------------------------------------------------------------------------------------------

	public function program() {
		$this->call->model('Drop_model');

		$data['program'] = ['id' => 0, 'program' => 'Type Here'];
		$data['programs'] = $this->Drop_model->getPrograms();
		$this->call->view('archive/admin/programs/index', $data);
	}

	public function update_program($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['program'] = $this->Drop_model->getProgram($dec);
		$data['programs'] = $this->Drop_model->getPrograms();
		$this->call->view('archive/admin/programs/index', $data);
	}

	public function program_insert() {
		$this->call->model('Drop_model');

		$program = $this->io->post('program');
		$this->Drop_model->insert_program($program);
		redirect('nav/program');
	}

	public function program_update() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$program = $this->io->post('program');
		$this->Drop_model->update_program($id, $program);
		redirect('nav/program');
	}

	public function delete_program($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['program'] = $this->Drop_model->getProgram($dec);
		$data['programs'] = $this->Drop_model->getPrograms();
		$this->call->view('archive/admin/programs/index', $data);
	}

	public function program_delete() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$this->Drop_model->delete_program($id);
		redirect('nav/program');
	}//------------------------------------------------------------------------------------------

	public function file() {
		$this->call->model('Drop_model');

		$data['file'] = ['id' => 0, 'file' => 'Type Here'];
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/files/index', $data);
	}

	public function update_file($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['file'] = $this->Drop_model->getFile($dec);
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/files/index', $data);
	}

	public function file_insert() {
		$this->call->model('Drop_model');

		$file = $this->io->post('file');
		$this->Drop_model->insert_file($file);
		redirect('nav/file');
	}

	public function file_update() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$file = $this->io->post('file');
		$this->Drop_model->update_file($id, $file);
		redirect('nav/file');
	}

	public function delete_file($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['file'] = $this->Drop_model->getFile($dec);
		$data['files'] = $this->Drop_model->getFiles();
		$this->call->view('archive/admin/files/index', $data);
	}

	public function file_delete() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$this->Drop_model->delete_file($id);
		redirect('nav/file');
	}//------------------------------------------------------------------------------------------

	public function category() {
		$this->call->model('Drop_model');

		$data['category'] = ['id' => 0, 'category' => 'Type Here'];
		$data['categories'] = $this->Drop_model->getCategories();
		$this->call->view('archive/admin/docs/index', $data);
	}

	public function update_category($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['category'] = $this->Drop_model->getCategory($dec);
		$data['categories'] = $this->Drop_model->getCategories();
		$this->call->view('archive/admin/docs/index', $data);
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

	public function delete_category($id) {
		$this->call->model('Drop_model');
		$dec = decrypt_id($id);

		$data['category'] = $this->Drop_model->getCategory($dec);
		$data['categories'] = $this->Drop_model->getCategories();
		$this->call->view('archive/admin/docs/index', $data);
	}

	public function category_delete() {
		$this->call->model('Drop_model');

		$id = $this->io->post('id');
		$this->Drop_model->delete_category($id);
		redirect('nav/category');
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
