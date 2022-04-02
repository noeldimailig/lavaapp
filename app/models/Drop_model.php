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

    public function getCategories() {
        return $this->db->table('document_categories')
                        ->select('id, category')
                        ->where('status', 1)
                        ->get_all();
    }

    public function getArchiveCategories() {
        return $this->db->table('document_categories')
                        ->select('id, category')
                        ->where('status', 0)
                        ->get_all();
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
}

?>