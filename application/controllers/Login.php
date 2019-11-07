<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		if ($this->session->userdata("usuario_logado")) {
			redirect(base_url() . "admin");
		} else {
			$data['title']    =    "Protocos - Marizafoods | Faça seu login";
			$data['description']    =    "Faça seu login";
			$dados['titulo'] = "Área do Representante";
			$this->load->templateadmin("login/login", $data, $dados);
		}
	}

	public function autenticar()
	{
		$this->load->model("Pessoa_model");
		$rules    =    array(
			array(
				'field'    =>    'email_pessoa',
				'label'    =>    'Email',
				'rules'    =>    'trim|required|valid_email|max_length[255]'
			),
			array(
				'field'    =>    'senha_pessoa',
				'label'    =>    'Senha',
				'rules'    =>    'trim|required|max_length[255]'
			)
		);
		$this->form_validation->set_rules($rules);
		$validacaoForm = $this->form_validation->run();
		if ($validacaoForm) {
			$email_pessoa = $this->input->post("email_pessoa");
			$senha_pessoa = md5($this->input->post("senha_pessoa"));
			$pessoa = $this->Pessoa_model->buscaPorEmailESenha($email_pessoa, $senha_pessoa);
			if ($pessoa) {
				$this->session->set_userdata("usuario_logado", $pessoa);
				$this->session->set_flashdata('alert', array(
					'tipo' => 'success',
					'strongMsg' => '<i class="fas fa-check"></i> Bem vindo',
					'msg' => $pessoa['nome_pessoa']
				));
				redirect(base_url() . "admin");
			} else {
				$this->session->set_flashdata('alert', array(
					'tipo' => 'danger',
					'strongMsg' => '<i class="fas fa-times"></i> Erro',
					'msg' => 'Usuário ou senha invalidos'
				));
				redirect(base_url("admin"));
			}
		} else {
			$this->session->set_flashdata('alert', array(
				'tipo' => 'danger',
				'strongMsg' => '<i class="fas fa-times"></i> Erro',
				'msg' => validation_errors()
			));
			redirect(base_url("admin"));
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("usuario_logado");
		redirect(base_url());
	}

}
