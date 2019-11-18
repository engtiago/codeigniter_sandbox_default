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

			$this->load->model('Usuarios_model');
			$this->load->model('Sistemas_model');
			$QuantidaDeUsuariosProgramasContrados = $this->Usuarios_model->buscarUsuarioscomSistemas(1)->num_rows();
			$QuantidaDeUsuariosProgramasDemitidos = $this->Usuarios_model->buscarUsuarioscomSistemas(0)->num_rows();
			$QuantidadeDeSistemas = $this->Sistemas_model->buscaTudoSistemas(100000000, 0, null,'all')->num_rows();

			
			$dados = array(
				'QuantidaDeUsuariosProgramasContrados' => $QuantidaDeUsuariosProgramasContrados,
				'QuantidaDeUsuariosProgramasDemitidos' => $QuantidaDeUsuariosProgramasDemitidos,
				 'QuantidadeDeSistemas' => $QuantidadeDeSistemas,
			);

		
		$this->load->templateAdmin('admin/homeAdmin', $data,$dados);
	}
}
