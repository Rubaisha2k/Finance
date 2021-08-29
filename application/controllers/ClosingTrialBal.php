<?php

class ClosingTrialBal extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Closing_model');
    }

    public function index(){
        $data = $this->input->post('cloData');
        $result = $this->Closing_model->ClosingBalance($data);
        echo $result;
    }
}

?>