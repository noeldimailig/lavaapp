<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Search extends Controller {

    public function research() {
        $this->call->model('Docs_model');

        $search = $this->io->post('search');

        $data['docs'] = $this->Docs_model->search($search);
        $this->call->view('archive/research', $data);
    }

    public function thesis() {
        $this->call->model('Docs_model');

        $search = $this->io->post('search');

        $data['docs'] = $this->Docs_model->search($search);
        $this->call->view('archive/thesis', $data);
    }

    public function dissertation() {
        $this->call->model('Docs_model');

        $search = $this->io->post('search');

        $data['docs'] = $this->Docs_model->search($search);
        $this->call->view('archive/dissertation', $data);
    }

    public function capstone() {
        $this->call->model('Docs_model');

        $search = $this->io->post('search');

        $data['docs'] = $this->Docs_model->search($search);
        $this->call->view('archive/capstone', $data);
    }

    public function bookmark() {
        $this->call->model('Docs_model');

        $search = $this->io->post('search');
        $uid = $this->io->post('uid');

        $data['docs'] = $this->Docs_model->search($search);
        $this->call->view('archive/mybookmarks', $data);
    }
}
?>