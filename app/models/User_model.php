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

    public function insert($uname, $email, $pass, $program, $campus, $dep, $role) {
        $data = [
            'username' => $uname,
            'password' => $pass,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep,
            'role_id' => $role
        ];

        $result = $this->db->table('users')->insert($data)->exec();
        if($result) return true;
    }

    public function insert_profile($profile, $uname, $email, $pass, $program, $campus, $dep, $role) {
        $data = [
            'username' => $uname,
            'profile' => $profile,
            'password' => $pass,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep,
            'role_id' => $role
        ];

        $result = $this->db->table('users')->insert($data)->exec();
        if($result) return true;
    }

    public function update_just_text($id, $uname, $email, $pass, $program, $campus, $dep, $role) {
        $data = [
            'username' => $uname,
            'password' => $pass,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep,
            'role_id' => $role
        ];
        $con = [
            'id' => $id
        ];

        $result = $this->db->table('users')->update($data)->where($con)->exec();
        if($result) return true;
    }

    public function update_profile($id, $profile, $uname, $email, $pass, $program, $campus, $dep, $role) {
        $data = [
            'username' => $uname,
            'profile' => $profile,
            'password' => $pass,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep,
            'role_id' => $role
        ];

        $con = [
            'id' => $id
        ];

        $result = $this->db->table('users')->update($data)->where($con)->exec();
        if($result) return true;
    }

    public function update($id, $uname, $fname, $lname, $email, $program, $campus, $dep) {
        $data = [
            'username' => $uname,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep
        ];

        $cond = [
            'id' => $id,
        ];

        $result = $this->db->table('users')->update($data)->where($cond)->exec();
        if($result) return true;
    }

    public function profile_update($id, $profile, $uname, $fname, $lname, $email, $program, $campus, $dep) {
        $data = [
            'profile' => $profile,
            'username' => $uname,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
            'program_id' => $program,
            'campus_id' => $campus,
            'dep_id' => $dep
        ];

        $cond = [
            'id' => $id,
        ];

        $result = $this->db->table('users')->update($data)->where($cond)->exec();
        if($result) return true;
    }

    public function count_admin() {
		$con = [
			'r.role' => 'Admin'
		];
		return $this->db->table('users as u')
						->select_count('u.id')
						->inner_join('roles as r', 'u.role_id=r.id')
						->where($con)->get();
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
        $condition = [
            'r.role' => 'Admin'
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.username, u.email, r.role, c.campus, d.dep, p.program')
                        ->inner_join('campuses as c', 'u.campus_id=c.id')
                        ->inner_join('departments as d', 'u.dep_id=d.id')
                        ->inner_join('programs as p', 'u.program_id=p.id')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function getAdmin($id) {
        $condition = [
            'r.role' => 'Admin',
            'u.id' => $id
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.username, u.profile, u.password, u.email, r.role, c.campus, d.dep, p.program')
                        ->inner_join('campuses as c', 'u.campus_id=c.id')
                        ->inner_join('departments as d', 'u.dep_id=d.id')
                        ->inner_join('programs as p', 'u.program_id=p.id')
                        ->inner_join('roles as r', 'u.role_id=r.id')
                        ->where($condition)
                        ->get_all();
    }

    public function deleteAdmin($id) {
        $con = [
            'id' => $id
        ];

        return $this->db->table('users')->delete()->where($con)->exec();
    }

    public function getUsers() {
        $condition = [
            'r.role' => 'User'
        ];
        return $this->db->table('users as u')
                        ->select('u.id, u.username, u.email, r.role, c.campus, d.dep, p.program')
                        ->inner_join('campuses as c', 'u.campus_id=c.id')
                        ->inner_join('departments as d', 'u.dep_id=d.id')
                        ->inner_join('programs as p', 'u.program_id=p.id')
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
                        ->select('u.id, u.username, u.profile, u.email, r.role, c.campus, d.dep, p.program')
                        ->inner_join('campuses as c', 'u.campus_id=c.id')
                        ->inner_join('departments as d', 'u.dep_id=d.id')
                        ->inner_join('programs as p', 'u.program_id=p.id')
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
                 ->select('u.id, u.username, u.firstname, u.lastname, u.profile, u.email, r.id as role_id, c.campus, d.dep, p.program')
                 ->inner_join('campuses as c', 'u.campus_id=c.id')
                 ->inner_join('departments as d', 'u.dep_id=d.id')
                 ->inner_join('programs as p', 'u.program_id=p.id')
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
            ->select('u.id, u.username, u.firstname, u.lastname, u.profile, u.email, r.id as role_id, c.campus, d.dep, p.program')
            ->inner_join('campuses as c', 'u.campus_id=c.id')
            ->inner_join('departments as d', 'u.dep_id=d.id')
            ->inner_join('programs as p', 'u.program_id=p.id')
            ->inner_join('roles as r', 'u.role_id=r.id')
            ->where('u.email', $email)
            ->get();
        
        $data = [
            'validation_code' => $code,
            'status' => 0
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