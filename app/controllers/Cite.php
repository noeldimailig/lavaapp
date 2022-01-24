<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Cite extends Controller {
	public function save() {

        $this->call->model('Cite_model');

        $uid = $this->io->post('userid');
		$did = $this->io->post('docid');
        $cited = $this->io->post('cited');
        //$this->Cite_model->save($uid, $did, $cited);
        $res = $this->Cite_model->checkCitation($uid, $did);
        if(($res == 0 && $cited == 0)  || ($res == 0 && $cited == 1)) {
            if($this->Cite_model->save($uid, $did, $cited)) {
                echo 'Citation saved!';
            }
        }
        else if($res == 1 && $cited == 1) {
            if($this->Cite_model->update($uid, $did, $cited)) {
                echo 'Citation saved and cited!';
            }else{
                echo 'Citation already exists!';
            }
        }else echo 'Citation already exists!';
	}

    public function delete() {
        $this->call->model('Cite_model');

        $uid = $this->io->post('uid');
		$did = $this->io->post('did');

        if($this->Cite_model->delete($uid, $did)){
            echo "success";
        }
    }
}
?>