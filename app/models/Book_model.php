<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Book_model extends Model{
    public function __construct() {
        parent::__construct();
        $this->call->database();
    }

    public function mybookmarks($uid) {
        $condition = [
            'b.user_id' => $uid
        ];

        return $this->db->table('bookmarks as b')
                        ->inner_join('users as u', 'b.user_id = u.id')
                        ->inner_join('documents as d', 'b.doc_id = d.id')
                        ->where($condition)
                        ->get_all();
    }

    public function delete($uid, $did) {
        $condition = [
            'user_id' => $uid,
            'doc_id' => $did,
        ];

        $result = $this->db->table('bookmarks')
                        ->where($condition)
                        ->delete()
                        ->exec();

        if($result)
            return true;
    }

    public function checkBookmark($uid, $did){
        $condition = [
            'b.user_id' => $uid,
            'b.doc_id' => $did
        ];

        $result = $this->db->table('bookmarks as b')
                        ->inner_join('users as u', 'b.user_id = u.id')
                        ->inner_join('documents as d', 'b.doc_id = d.id')
                        ->where($condition)
                        ->get();

        if($result)
            return true;
    }

    public function save($uid, $did) {
        $data = [
            'user_id' => $uid,
            'doc_id' => $did
        ];

        $result = $this->db->table('bookmarks')->insert($data)->exec();        

        if($result)
            return true;
    }
}
?>