<?php namespace App\Controllers;

class Home extends BaseController
{
	public function __construct() {
		//parent::__construct();

		//$this->load->library('form_validation');
		//$this->load->helper('form');
		//$this->load->model('admin_model');
	}

	public function index()
	{
		return view('login');
	}

	//--------------------------------------------------------------------
 
}
