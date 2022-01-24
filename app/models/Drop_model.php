<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Drop_model extends Model{

    public function __construct() {
        parent::__construct();
        $this->call->database();
    }

    public function getRoles() {
        return $this->db->table('roles')->select('id, role')->get_all();
    }

    public function getRole($id) {
        $con = ['u.id'=> $id];
        return $this->db->table('roles as r')
                        ->select('r.id, r.role')
                        ->inner_join('users as u', 'r.id=u.role_id')
                        ->where($con)->get();
    }

    public function getStates() {
        return $this->db->table('states')->select('id, state')->get_all();
    }

    public function getState($id) {
        $con = ['id'=> $id];
        return $this->db->table('states')
                        ->select('id, state')
                        ->where($con)->get();
    }

    public function getPrograms() {
        return $this->db->table('programs')->select('id, program')->get_all();
    }

    public function getProgram($id) {
        $con = ['p.id'=> $id];
        return $this->db->table('programs as p')
                        ->select('p.id, p.program')
                        ->where($con)->get();
    }

    public function insert_program($program) {
        $data = ['program' => $program];
        $result = $this->db->table('programs')->select('program')->where('program', $program)->get();

        if($result == false)
            return $this->db->table('programs')->insert($data)->exec();
    }

    public function update_program($id, $program) {
        $data = ['program' => $program];
        $con = ['id' => $id];
        return $this->db->table('programs')->update($data)->where($con)->exec();
    }

    public function delete_program($id) {
        $con = ['id' => $id];
        return $this->db->table('programs')->delete()->where($con)->exec();
    }

    public function getCampuses() {
        return $this->db->table('campuses')->select('id, campus')->get_all();
    }

    public function getCampus($id) {
        $con = ['c.id'=> $id];
        return $this->db->table('campuses as c')
                        ->select('c.id, c.campus')
                        ->where($con)->get();
    }

    public function insert_campus($campus) {
        $data = ['campus' => $campus];
        $result = $this->db->table('campuses')->select('campus')->where('campus', $campus)->get();

        if($result == false)
            return $this->db->table('campuses')->insert($data)->exec();
    }

    public function update_campus($id, $campus) {
        $data = ['campus' => $campus];
        $con = ['id' => $id];
        return $this->db->table('campuses')->update($data)->where($con)->exec();
    }

    public function delete_campus($id) {
        $con = ['id' => $id];
        return $this->db->table('campuses')->delete()->where($con)->exec();
    }

    public function getDepartments() {
        return $this->db->table('departments')->select('id, dep')->get_all();
    }

    public function getDepartment($id) {
        $con = ['d.id'=> $id];
        return $this->db->table('departments as d')
                        ->select('d.id, d.dep')
                        ->where($con)->get();
    }

    public function insert_department($dep) {
        $data = ['dep' => $dep];
        $result = $this->db->table('departments')->select('dep')->where('dep', $dep)->get();

        if($result == false)
            return $this->db->table('departments')->insert($data)->exec();
    }

    public function update_department($id, $dep) {
        $data = ['dep' => $dep];
        $con = ['id' => $id];
        return $this->db->table('departments')->update($data)->where($con)->exec();
    }

    public function delete_department($id) {
        $con = ['id' => $id];
        return $this->db->table('departments')->delete()->where($con)->exec();
    }

    public function getFiles() {
        return $this->db->table('file_categories')->select('id, file')->get_all();
    }

    public function getFile($id) {
        $con = ['f.id'=> $id];
        return $this->db->table('file_categories as f')
                        ->select('f.id, f.file')
                        ->where($con)->get();
    }

    public function insert_file($file) {
        $data = ['file' => $file];
        $result = $this->db->table('file_categories')->select('file')->where('file', $file)->get();

        if($result == false)
            return $this->db->table('file_categories')->insert($data)->exec();
    }

    public function update_file($id, $file) {
        $data = ['file' => $file];
        $con = ['id' => $id];
        return $this->db->table('file_categories')->update($data)->where($con)->exec();
    }

    public function delete_file($id) {
        $con = ['id' => $id];
        return $this->db->table('file_categories')->delete()->where($con)->exec();
    }

    public function getCategories() {
        return $this->db->table('document_categories')->select('id, category')->get_all();
    }

    public function getCategory($id) {
        $con = ['c.id'=> $id];
        return $this->db->table('document_categories as c')
                        ->select('c.id, c.category')
                        ->where($con)->get();
    }

    public function insert_category($category) {
        $data = ['category' => $category];
        $result = $this->db->table('document_categories')->select('category')->where('category', $category)->get();

        if($result == false)
            return $this->db->table('document_categories')->insert($data)->exec();
    }

    public function update_category($id, $category) {
        $data = ['category' => $category];
        $con = ['id' => $id];
        return $this->db->table('document_categories')->update($data)->where($con)->exec();
    }

    public function delete_category($id) {
        $con = ['id' => $id];
        return $this->db->table('document_categories')->delete()->where($con)->exec();
    }
}

?>