<?php
$this->auth->set_logged_out();
$this->session->unset_userdata();
redirect('archive/index');

?>