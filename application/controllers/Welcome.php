<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->load->helper('text');
		$this->load->model('Entry_model');
		$this->load->model('Report_model');
	  }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['data'] = $this->Entry_model->get_all();
		$data['type'] = $this->Entry_model->get_types();
        $data['revenues'] = $this->Report_model->getRevenues();
		$data['expenses'] = $this->Report_model->getExpenses();
		$data['withdraws'] = $this->Report_model->getOW();
 		$this->load->view('dashboard', $data);
	}
}
