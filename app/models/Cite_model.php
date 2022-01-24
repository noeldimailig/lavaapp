<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Cite_model extends Model{
    public function __construct() {
        parent::__construct();
        $this->call->database();
    }

    public function mycitations($uid) {
        $condition = [
            'c.user_id' => $uid
        ];

        return $this->db->table('citations as c')
                        ->inner_join('users as u', 'c.user_id = u.id')
                        ->inner_join('documents as d', 'c.doc_id = d.id')
                        ->where($condition)
                        ->get_all();
    }

    public function delete($uid, $did) {
        $condition = [
            'user_id' => $uid,
            'doc_id' => $did,
        ];

        $result = $this->db->table('citations')
                        ->where($condition)
                        ->delete()
                        ->exec();

        if($result)
            return true;
    }

    public function checkCitation($uid, $did){
        $condition = [
            'c.user_id' => $uid,
            'c.doc_id' => $did,
        ];

        $result = $this->db->table('citations as c')
                        ->select('c.user_id, c.doc_id, c.cited')
                        ->inner_join('users as u', 'c.user_id = u.id')
                        ->inner_join('documents as d', 'c.doc_id = d.id')
                        ->where($condition)
                        ->get();

        if($result)
            return true;
    }

    public function save($uid, $did, $cited) {

            $data = [
                'user_id' => $uid,
                'doc_id' => $did,
                'cited' => $cited
            ];
    
            $result = $this->db->table('citations')->insert($data)->exec();        
    
            if($result)
                return true;
    }

    public function update($uid, $did, $cited) {
        $data = [
            'user_id' => $uid,
            'doc_id' => $did,
            'cited' => $cited
        ];

        $cond = [
            'user_id' => $uid,
            'doc_id' => $did
        ];

        $this->db->table('citations')->update($data)->where($cond)->exec();

        if($this->db->table('citationscopy')->select('id, user_id, doc_id, cited')->where($cond)->get() == false){
            $citecopy = [
                'user_id' => $uid,
                'doc_id' => $did,
                'cited' => $cited
            ];
            $result = $this->db->table('citationscopy')->insert($citecopy)->exec();
    
            if($result)
                return true;
        }else {
            return false;
        }
        
    }
}
?>