<?php

class PostClosingTrial extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Report_model');
    }

    public function index(){
        $data['expenses'] = $this->Report_model->getExpenses();
        $data['revenues'] = $this->Report_model->getRevenues();
        $data['OE'] = $this->Report_model->getOE();
        $data['OW'] = $this->Report_model->getOW();
        $data['assets'] = $this->Report_model->getAssets();
        $data['Sassets'] = $this->Report_model->getSassets();
        $data['liabilities'] = $this->Report_model->getLiabilities();
        $this->load->view('postClosing', $data);
    }
}
?>