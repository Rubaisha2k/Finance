<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jquery extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->load->helper('text');
		$this->load->model('Entry_model');
	  }
      public function index(){
          $this->load->view('jquery');
      }

    }