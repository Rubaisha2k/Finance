<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct(){
    parent :: __construct();
    $this->load->helper('text');
    $this->load->model('Entry_model');
  }
  public function index(){
    $data['entry_date'] = $this->input->post('date');
    $data['debit_info'] = json_encode($this->input->post('debit'));
    $data['credit_info'] = json_encode($this->input->post('credit'));
    $data['credit_amount'] = $this->input->post('credit_amount');
    $data['debit_amount'] = $this->input->post('debit_amount');
    $data['typeD_id'] = $this->input->post('typeD');
    $data['typeC_id'] = $this->input->post('typeC');
    $data['description'] = $this->input->post('desc');
    $debit = 0;
    $credit = 0;
  
    for($i =0; $i<count($data['debit_amount']); $i++){
      $debit += $data['debit_amount'][$i];
    }
    for($i =0; $i<count($data['credit_amount']); $i++){
      $credit += $data['credit_amount'][$i];
    }
    $type['type_name'];
    if($credit == $debit){
    $data['debit_amount'] = json_encode($this->input->post('debit_amount'));
    $data['credit_amount'] = json_encode($this->input->post('credit_amount'));
    if($data['typeD_id'] == 7){
      $type['type_name'] = 'Depreciation of '.$this->input->post('debit')[0];
  }
  else{}
    $response = $this->Entry_model->add_data($data);
    if($response >= 1 ){
      if(!empty($type['type_name'])){
        $this->Entry_model->add_type($type);
      }
      $this->session->set_flashdata('response', "Data entered Successfully");
      $this->create($data);
    }
    else {
      $this->session->set_flashdata('response', "Data not Entered");
    }
  }
  if($credit != $debit)
  {
    $error = "Debit and Credit amount unequal";
    $this->session->set_flashdata($error);
  }
  echo $response;
  return $response;
  }
  public function create($data){
    $debit = $data['debit_info'];
    $debit_amount = $data['debit_amount'];
    $credit = $data['credit_info'];
    $credit_amount = $data['credit_amount'];
    $credit_amount = json_decode($credit_amount);
    $credit = json_decode($credit);

    $debit_amount = json_decode($debit_amount);
    $debit = json_decode($debit);
    for($i = 0; $i< count($debit); $i++){
      $debit[$i] = strtolower(str_replace(" ", "", $debit[$i]));
    $this->Entry_model->create_table_debit($debit[$i], $debit_amount[$i]);
    }
    for($i = 0; $i< count($credit); $i++){
      $credit[$i] = strtolower(str_replace(" ", "", $credit[$i]));
    $this->Entry_model->create_table_credit($credit[$i], $credit_amount[$i]);
    }
  }
}