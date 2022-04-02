
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

use \iamdual\Uploader;
class User extends Controller {
	public function __construct() {
		parent::__construct();
		$this->call->library('auth');
		$this->call->helper(array('alert'));
	}

	public function register() {
		$this->call->model('User_model');

		$username = $this->io->post('sname');
		$password = $this->io->post('spassword');
		$confirm = $this->io->post('sconfirm');
		$email = $this->io->post('semail');

		$hash = $this->auth->passwordhash($password);

		$code = mt_rand(11111, 99999);

		if(password_verify($confirm, $hash) == true){
			$this->auth->register($username, $password, $email, $code);
			$this->auth->set_logged_in($username);

			$id = $this->User_model->get_last_id();

			$userdata = array(
				'user_id' => $id,
				'username' => $username,
				'firstname' => 'NONE',
				'lastname' => 'NONE',
				'user_profile' => 'profile.png',
				'user_role' => 'user',
				'user_email' => $email
			);
			$this->session->set_userdata($userdata);
			$this->send_code($email, $code);
			redirect('user/verify');
		}else {
			$this->session->set_flashdata(array('signup_error' => 'Password do not match!!'));
			redirect('nav/signup');
		}
	}

	public function verify() {
		$this->call->view('archive/verify');
	}

	public function verify_account() {
		$this->call->model('User_model');

		$email = $this->io->post('verify_email');
		$code = $this->io->post('verify_code');

		$result = $this->User_model->verify($email, $code);

		if($result){
			$userdata = array(
				'user_id' => $result['id'],
				'username' => $result['username'],
				'firstname' => $result['firstname'],
				'lastname' => $result['lastname'],
				'user_profile' => $result['profile'],
				'user_role' => $result['role_id'],
				'user_email' => $result['email'],
			);

			$this->session->set_userdata($userdata);
			$this->auth->set_logged_in($result['username']);
			$msg['msg'] = "Verification successful, please proceed to logging your account.";
			$msg['error'] = false;
			echo json_encode($msg);
		}else {
			$msg['msg'] = "Something went wrong, please try to check the email or code you entered.";
			$msg['error'] = true;
			echo json_encode($msg);
		}
	}

	public function send_code($email, $code) {
		$content = "You sign up in our website. Please verify your account in order to login!\nUse this code to verify your account." . $code;
		$this->email->subject('Account Validation');
		$this->email->sender('eliteresearcher2021@gmail.com');
		$this->email->recipient($email);
		$this->email->email_content($content);
		$this->email->send();
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
				'user_profile' => $result['profile'],
				'user_role' => $result['role_id'],
				'user_email' => $result['email'],
			);

			$role = $result['role_id'];
			if($role == 2 || $role == 3){
				$this->session->set_userdata($userdata);
				$msg['msg'] = "Logging your account.";
				$msg['error'] = false;
				$msg['role'] = $role;
				echo json_encode($msg);
			}else {
				$this->session->set_userdata($userdata);
				$this->auth->set_logged_in($result['username']);
				$msg['msg'] = "Logging your account.";
				$msg['error'] = false;
				$msg['role'] = $role;
				echo json_encode($msg);
			}
			
		}else {
			$msg['msg'] = "Something went wrong, please try to check the email or password you entered.";
			$msg['error'] = true;
			echo json_encode($msg);
		}
	}

	public function forgot(){
		$this->call->view('archive/forgot');
	}

	public function forgot_password() {
		$this->call->model('User_model');

		$email = $this->io->post('forgot_email');
		$pass = $this->io->post('forgot_pass');

		$hash = $this->auth->passwordhash($pass);
		$code = mt_rand(11111, 99999);

		$result = $this->User_model->forgot($email, $hash, $code);

		if($result){
			$this->send_code($email, $code);
			$msg['msg'] = "Password successfully changed, please proceed to verifying your account.";
			$msg['error'] = false;
			echo json_encode($msg);
		} else {
			$msg['msg'] = "Something went wrong, please try to check the email you entered.";
			$msg['error'] = true;
			echo json_encode($msg);
		}
	}

	public function update() {
		$this->call->model('User_model');

		$id = $this->io->post('id');
		$email = $this->io->post('email');
		$uname = $this->io->post('uname');
		$fname = $this->io->post('fname');
		$lname = $this->io->post('lname');
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
					'user_email' => $email
				);
	
				if($this->User_model->update($id, $uname, $fname, $lname, $email)){
					$this->session->unset_userdata($userdata);
					$this->session->set_userdata($userdata);
					$msg['msg'] = "Profile details updated successfully.";
					$msg['error'] = false;
					echo json_encode($msg);
				}
			} else {
				$profile = $upload->get_name();
				$userdata = array(
					'username' => $uname,
					'firstname' => $fname,
					'lastname' => $lname,
					'user_email' => $email,
					'user_profile' => $profile
				);
				if($this->User_model->profile_update($id, $profile, $uname, $fname, $lname, $email)){
					if(file_exists("profile_pictures/" . $profile)){
						unlink("profile_pictures/".$prev);
						$this->session->unset_userdata($userdata);
						$this->session->set_userdata($userdata);
						$msg['msg'] = "Profile details updated successfully.";
						$msg['error'] = false;
						echo json_encode($msg);
					}
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
