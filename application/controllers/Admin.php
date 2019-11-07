<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('Auth_helper');
		Autentica($this);
		 //$this->output->enable_profiler(TRUE);		
	}

	public function index()
	{
		$data['title']    =    "Marizafoods | Admin";
		$data['description']    =    "Admin";
		$this->load->templateAdmin('admin/homeAdmin', $data);
	}
	
	public function teste()
	{
		$data['title']    =    "Marizafoods | teste";
		$data['description']    =    "teste";
		$this->load->templateAdmin('admin/teste', $data);
	}

}
