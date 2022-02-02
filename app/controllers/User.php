
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

use \iamdual\Uploader;

class User extends Controller {
	public function __construct() {
		parent::__construct();
		$this->call->library('auth');
		$this->call->helper(array('alert'));
	}

	public function login() {
		$this->call->view('archive/login');
	}

	public function signup() {
		$this->call->view('archive/signup');
	}

	public function register() {
		$this->call->model('User_model');

		$username = $this->io->post('name');
		$password = $this->io->post('password');
		$confirm = $this->io->post('confirm');
		$email = $this->io->post('email');

		$hash = $this->auth->passwordhash($password);

		if(password_verify($confirm, $hash) == true){
			$this->auth->register($username, $password, $email);
			$this->auth->set_logged_in($username);

			$id = $this->User_model->get_last_id();

			$userdata = array(
				'user_id' => $id,
				'username' => $username,
				'campus' => 'NONE',
				'dep' => 'NONE',
				'firstname' => 'NONE',
				'lastname' => 'NONE',
				'program' => 'NONE',
				'user_profile' => 'profile.png',
				'user_role' => 'user',
				'user_email' => $email
			);
			$this->session->set_userdata($userdata);
			redirect('nav/index');
		}else {
			$this->session->set_flashdata(array('error' => 'Password do not match!!'));
			$this->call->view('archive/signup');
		}
	}

	public function signin() {
		$email = $this->io->post('email');
		$pass = $this->io->post('password');

		$result = $this->auth->login($email, $pass);

		if($result){
			$userdata = array(
				'user_id' => $result['id'],
				'username' => $result['username'],
				'firstname' => $result['firstname'],
				'lastname' => $result['lastname'],
				'campus' => $result['campus'],
				'dep' => $result['dep'],
				'program' => $result['program'],
				'user_profile' => $result['profile'],
				'user_role' => $result['role_id'],
				'user_email' => $result['email'],
			);
			if($result['role_id'] == 2 || $result['role_id'] == 3){
				$this->session->set_userdata($userdata);
				$this->auth->set_logged_in($result['username']);
				redirect('nav/dashboard');
			}else {
				$this->session->set_userdata($userdata);
				$this->auth->set_logged_in($result['username']);
				redirect('nav/index');
			}
			
		}else {
			$this->session->set_flashdata(array('error' => 'Username or password do not match. Please try again.'));
			$this->call->view('archive/login');
		}
	}

	public function update() {
		$this->call->model('User_model');

		$id = $this->io->post('id');
		$email = $this->io->post('email');
		$uname = $this->io->post('uname');
		$fname = $this->io->post('fname');
		$lname = $this->io->post('lname');
		$program = $this->io->post('program');
		$campus = $this->io->post('campus');
		$dep = $this->io->post('department');
		$prev = $this->io->post('prev_filename');

		if (isset($_FILES["file"])) {
			$upload = new Uploader($_FILES['file']);
			$upload->allowed_extensions(array("png", "jpg", "jpeg", "JPG", "PNG", "JPEG"));
			$upload->must_be_image();
			$upload->max_size(5); // in MB
			$upload->path("profile_pictures/");
		
			if (!$upload->upload()) {

				$userdata = array(
					'username' => $uname,
					'firstname' => $fname,
					'lastname' => $lname,
					'campus' => $campus,
					'dep' => $dep,
					'program' => $program,
					'user_email' => $email
				);
	
				if($this->User_model->update($id, $uname, $fname, $lname, $email, $program, $campus, $dep)){
					$this->session->unset_userdata($userdata);
					$this->session->set_userdata($userdata);
					$this->session->set_flashdata(array('success' => 'Profile update successful!'));

					redirect('nav/myprofile');
				}
			} else {
				$profile = $upload->get_name();
				$userdata = array(
					'username' => $uname,
					'firstname' => $fname,
					'lastname' => $lname,
					'campus' => $campus,
					'dep' => $dep,
					'program' => $program,
					'user_email' => $email,
					'user_profile' => $profile
				);
				if($this->User_model->profile_update($id, $profile, $uname, $fname, $lname, $email, $program, $campus, $dep)){
					$this->session->unset_userdata($userdata);
					$this->session->set_userdata($userdata);
					$this->session->set_flashdata(array('success' => 'Profile updated successfully!'));

					redirect('nav/myprofile');
				}
			}
		}
	}

	public function subscribe(){
		$this->call->model('User_model');

		$uid = $this->io->post('uid');
		$email = $this->io->post('email');

		if($this->User_model->checksubs($uid, $email) == false) {
			if($this->User_model->addsubs($uid, $email)) {
				$content = '
				<h1>You are now entitled to recieve news from us.</h1>
				<a href="http://localhost/archive/nav/login">Log In</a>
				';

				$this->email->subject('Subscribe to newsletter');
				$this->email->sender('eliteresearcher2021@gmail.com');
				$this->email->email_content($content, 'html');
				$this->email->recipient($email);
				$this->email->send();

				echo "Subscription added";
			}
		}
	}

	public function message() {
		$uemail = $this->io->post('email');
		$name = $this->io->post('name');
		$content = $this->io->post('message');

		$this->email->subject('Comments');
		$this->email->sender($uemail);
		$this->email->email_content($content);
		$this->email->recipient('eliteresearcher2021@gmail.com');
		$this->email->send();
	}
}
?>
