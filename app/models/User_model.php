<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model{
    public function __construct() {
        parent::__construct();
        $this->call->database();
    }

    public function get_last_id() {
        return $this->db->last_id();
    }

    public function checksubs($uid, $email){
        $condition = [
            'user_id' => $uid,
            'email' => $email,
        ];

        $result = $this->db->table('subscribers')
                        ->select('user_id, email')
                        ->where($condition)
                        ->get();

        if($result)
            return true;
    }

    public function addsubs($uid, $email){
        $data = [
            'user_id' => $uid,
            'email' => $email
        ];

        $result = $this->db->table('subscribers')->insert($data)->exec();

        if($result) return true;
    }

    public function insert($uname, $email, $pass, $role) {
        $data = [
            'username' => $uname,
            'password' => $pass,
            'email' => $email,
            'role_id' => $role
        ];

        $result = $this->db->table('users')->insert($data)->exec();
        if($result) return true;
    }

    public function insert_profile($profile, $uname, $email, $pass, $role) {
        $data = [
            'username' => $uname,
            'profile' => $profile,
            'password' => $pass,
            'email' => $email,
            'role_id' => $role
        ];

        $result = $this->db->table('users')->insert($data)->exec();
        if($result) return true;
    }

    public function update_just_text($id, $uname, $email, $pass, $role) {
        $data = [
            'username' => $uname,
            'password' => $pass,
            'email' => $email,
            'role_id' => $role
        ];
        $result = $this->db->table('users')->update($data)->where('id',$id)->exec();
        if($result) return true;
    }

    public function update_profile($id, $profile, $uname, $email, $pass, $role) {
        $data = [
            'username' => $uname,
            'profile' => $profile,
            'password' => $pass,
            'email' => $email,
            'role_id' => $role
        ];

        $result = $this->db->table('users')->update($data)->where('id',$id)->exec();
        if($result) return true;
    }

    public function update($id, $uname, $fname, $lname, $email) {
        $data = [
            'username' => $uname,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
        ];

        $result = $this->db->table('users')->update($data)->where('id', $id)->exec();
        if($result) return true;
    }

    public function profile_update($id, $profile, $uname, $fname, $lname, $email) {
        $data = [
            'profile' => $profile,
            'username' => $uname,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
        ];

        $cond = [
            'id' => $id,
        ];

        $result = $this->db->table('users')->update($data)->where($cond)->exec();
        if($result) return true;
    }

    public function count_admin() {
		return $this->db->table('users as u')
						->select_count('u.id')
						->inner_join('roles as r', 'u.role_id=r.id')
						->where('r.role = ? or r.role = ?', ['Admin', 'Document Admin'])
                        ->get();
	}

	public function count_user() {
		$con = [
			'r.role' => 'User'
		];
		return $this->db->table('users as u')
						->select_count('u.id')
						->inner_join('roles as r', 'u.role_id=r.id')
						->where($con)->get();
	}

    public function getAdmins() {
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.email, u.password, u.lastname, u.firstname, u.status, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where('r.role != ? and status = ?', ['User', 1])
                        ->get_all();
    }

    public function getArchiveAdmins() {
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.email, u.password, u.lastname, u.firstname, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where('r.role != ? and status = ?', ['User', 0])
                        ->get_all();
    }

    public function getAdmin($id) {
        $condition = [
            'r.role' => 'Admin',
            'u.id' => $id
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.profile, u.lastname, u.firstname, u.password, u.email, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function updateStatus($id, $status, $table) {
        $data = [ 'status' => $status ];
        return $this->db->table($table)->update($data)->where('id', $id)->exec();
    }

    public function getUsers() {
        $condition = [
            'r.role' => 'User',
            'u.status' => 1
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.lastname, u.firstname, u.password, u.email, u.status, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function getUsersArchive() {
        $condition = [
            'r.role' => 'User',
            'u.status' => 0
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.email, u.lastname, u.firstname, u.password, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function getUser($id) {
        $condition = [
            'r.role' => 'User',
            'u.id' => $id
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.profile, u.username, u.lastname, u.firstname, u.password, u.email, r.role')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function verify($email, $code) {
        $condition = [
            'u.email' => $email,
            'u.validation_code' => $code
        ];

        $result = $this->db->table('users as u')
                 ->select('u.id, u.username, u.firstname, u.lastname, u.profile, u.email, r.id as role_id')
                 ->inner_join('roles as r', 'u.role_id=r.id')
                 ->where($condition)
                 ->get();

        $status = ['status' => 1];
        if($result){
            $verify = $this->db->table('users as u')->update($status)->where($condition)->exec();
            if($verify)
                return $result;
            else
                return false;    
        }
    }

    public function forgot($email, $newpass, $code) {
        $result = $this->db->table('users as u')
            ->select('u.id, u.username, u.firstname, u.lastname, u.profile, u.email, r.id as role_id')
            ->inner_join('roles as r', 'u.role_id=r.id')
            ->where('u.email', $email)
            ->get();
        
        $data = [
            'validation_code' => $code,
            'status' => 0,
            'password' => $newpass
        ];
        if($result){
            $verify = $this->db->table('users as u')->update($data)->where('u.email', $email)->exec();
            if($verify)
                return $result;
            else
                return false;    
        }
    }
}
?>