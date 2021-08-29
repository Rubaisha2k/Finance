<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrialBal extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        //$this->load->library('tcpdf_lib');
        $this->load->model('Report_model');
    }
    public function index(){
        $data['assets'] = $this->Report_model->getAssets();
        $data['Sassets'] = $this->Report_model->getSassets();
        $data['liabilities'] = $this->Report_model->getLiabilities();
        $data['OE'] = $this->Report_model->getOE();
        $data['OW'] = $this->Report_model->getOW();
        $data['expenses'] = $this->Report_model->getExpenses();
        $data['revenues'] = $this->Report_model->getRevenues();
        $this->load->view('trialBalance', $data);
    }
}

?>