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

        if($this->db->table('citationscopy')
                    ->select('id, user_id, doc_id, cited')
                    ->where($cond)
                    ->get() == false)
        {
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

    public function generateAPA($id) {
        $result = $this->db->table('documents as d')
                    ->select('d.id, d.title, d.description, d.authors, d.pub_year, d.publisher,
                    s.state, d.filename, dc.category, d.uploaded_at , d.updated_at')
                    ->inner_join('states as s','s.id = d.stat_id')
                    ->inner_join('document_categories as dc', 'dc.id = d.doc_id')
                    ->where('d.id', $id)
                    ->get(); 

        if($result){
            $title = $result['title'];
            $str = $result['authors'];
            $year = date('Y', strtotime($result['pub_year']));
            $publisher = $result['publisher'];

            $words = str_word_count($str, 1, 'àáãç3');

            $count = count($words);

            if($publisher == "NONE"){
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.substr($words[1],0,1).'., & '.$words[2].', '.substr($words[3],0,1).'. ('.$year.'). '.$title.'.';
                            break;
                        }else{
                            return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., & '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'. ('.$year.'). '.$title.'.';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., & '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., & '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                    case 15: // Five Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'., & '.$words[12].', '.substr($words[13],0,1).'. '.substr($words[14], 0, 1).'.  ('.$year.'). '.$title.'.';
                        break;
                    default: // One Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'. ('.$year.'). '.$title.'.';
                        break;
                }
            }
            else{
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.substr($words[1],0,1).'., & '.$words[2].', '.substr($words[3],0,1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                            break;
                        }else{
                            return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., & '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., & '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., & '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    case 15: // Five Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'., '.$words[3].', '.substr($words[4],0,1).'. '.substr($words[5], 0, 1).'., '.$words[6].', '.substr($words[7],0,1).'. '.substr($words[8], 0, 1).'., '.$words[9].', '.substr($words[10],0,1).'. '.substr($words[11], 0, 1).'., & '.$words[12].', '.substr($words[13],0,1).'. '.substr($words[14], 0, 1).'.  ('.$year.'). '.$title.'. <i>'.$publisher.'</i>';
                        break;
                    default: // One Author
                        return $words[0].', '.substr($words[1],0,1).'. '.substr($words[2], 0, 1).'. ('.$year.'). '.$title.'. <i>'.$publisher.'.</i>';
                        break;
                }
            }
        } else{
            return false;
        }
    }

    public function generateMLA($id) {
        $result = $this->db->table('documents as d')
                    ->select('d.id, d.title, d.description, d.authors, d.pub_year, d.publisher,
                    s.state, d.filename, dc.category, d.uploaded_at , d.updated_at')
                    ->inner_join('states as s','s.id = d.stat_id')
                    ->inner_join('document_categories as dc', 'dc.id = d.doc_id')
                    ->where('d.id', $id)
                    ->get(); 

        if($result){
            $title = $result['title'];
            $str = $result['authors'];
            $year = date('Y', strtotime($result['pub_year']));
            $publisher = $result['publisher'];

            $words = str_word_count($str, 1, 'àáãç3');

            $count = count($words);

            if($publisher == "NONE"){
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.$words[1].', and '.$words[3].', '.$words[2].'. "'.$title.'". '.$year.'.';
                            break;
                        }else{
                            return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'., and '.$words[4].' '.substr($words[5],0,1).'. '.$words[3].'. "'.$title.'". '.$year.'.';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.$words[1].'. '.substr($words[2], 0, 1).'., et. al. "'.$title.'". '.$year.'.';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.$words[1].'. '.substr($words[2], 0, 1).'., et. al. "'.$title.'". '.$year.'.';                        
                        break;
                    case 15: // Five Author
                        return $words[0].', '.$words[1].'. '.substr($words[2], 0, 1).'., et. al. "'.$title.'". '.$year.'.';                        
                        break;
                    default: // One Author
                        return $words[0].', '.$words[1].'. '.substr($words[2], 0, 1).'. "'.$title.'". '.$year.'.';
                        break;
                }
            }
            else{
                switch ($count) {
                    case 6: // Two Author
                        if(strlen($words[2]) != 1){
                            return $words[0].', '.$words[1].', and '.$words[3].', '.$words[2].'. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';
                            break;
                        }else{
                            return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'., and '.$words[4].' '.substr($words[5],0,1).'. '.$words[3].'. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';
                            break;
                        }
                    case 9: // Three Author
                        return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'., et. al. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';
                        break;
                    case 12: // Four Author
                        return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'., et. al. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';                        
                        break;
                    case 15: // Five Author
                        return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'., et. al. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';                        
                        break;
                    default: // One Author
                        return $words[0].', '.$words[1].' '.substr($words[2], 0, 1).'. "'.$title.'". <i>'.$publisher.'</i>, '.$year.'.';
                        break;
                }
            }
        } else{
            return false;
        }
    }
}
?>