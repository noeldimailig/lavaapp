<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Book extends Controller {
	public function save() {
        $this->call->model('Book_model');

        $uid = $this->io->post('uid');
		$did = $this->io->post('did');

        if($this->Book_model->checkBookmark($uid, $did) == false) {
            if($this->Book_model->save($uid, $did)) {
                echo 'Bookmark saved!';
            }
            else {
                echo 'Bookmark already exists!';
            }
        }else echo 'Bookmark already exists!';
	}

    public function delete() {
        $this->call->model('Book_model');

        $uid = $this->io->post('uid');
		$did = $this->io->post('did');

        if($this->Book_model->delete($uid, $did) == true){
            // $data['docs'] = $this->Book_model->mybookmarks($uid);
            // $this->call->view('archive/mybookmarks', $data);
            echo "success";
        }
    }
}
?>