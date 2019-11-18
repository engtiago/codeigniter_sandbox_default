<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_pessoa extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('Auth_helper');
		Autentica($this);
		$this->load->model("Pessoa_model");
		$this->load->helper('Auth_helper');
		//$this->output->enable_profiler(TRUE);
	}

	public function ver($ver)
	{
		print_r($this->Pessoa_model->buscaPessoaId($ver));
	}

	#######################################################################
	public function novapessoa()
	{
		$data['title']    =    "Marizafoods | Nova Pessoa";
		$data['description']    =    "Criar nova pessoa";
		$this->load->model('Auth_model');
		$nivel_acesso = $this->Auth_model->buscaTodosnivel_acesso();
		$dados = array(
			'pessoa' => null,
			'formsubmit' => 'Admin_pessoa/function_novapessoa',
			'nivel_acesso' => $nivel_acesso
		);
		$this->load->templateAdmin('pessoa/formPessoa', $data, $dados);
	}

	public function editPessoa($id_pessoa)
	{
		$data['title']    =    "Marizafoods | Editar Pessoa";
		$data['description']    =    "Editar Pessoa";
		$this->load->model('Auth_model');
		$nivel_acesso = $this->Auth_model->buscaTodosnivel_acesso();
		$pessoa = $this->Pessoa_model->buscaPessoaId($id_pessoa);

		$dados = array(
			'pessoa' => $pessoa,
			'formsubmit' => 'Admin_pessoa/function_editPessoa',
			'nivel_acesso' => $nivel_acesso
		);
		$this->load->templateAdmin('pessoa/formPessoa', $data, $dados);
	}

	public function listaPessoa($order_by = 'nome_nivel_acesso', $pesquisa = 'all')
	{
		if ($this->input->post()) {
			$pesquisa = $this->input->post('nome_pessoa');
		}

		$this->load->library('pagination');
		$data['title']    =    "Marizafoods | Lista de Pessoas";
		$data['description']    =    "Lista de Pessoas";
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$config = array(
			"base_url" => base_url() . "Admin_pessoa/listaPessoa/$order_by/$pesquisa",
			"total_rows" => $this->Pessoa_model->buscaTudoPessoas(100000000, 0, $order_by, $pesquisa)->num_rows(),
			"per_page" => 15,
			"uri_segment" => 5
		);
		$config = array_merge($config, $this->load->configPagination());
		$this->pagination->initialize($config);
		$pessoas = $this->Pessoa_model->buscaTudoPessoas($config["per_page"], $page, $order_by, $pesquisa)->result_array();
		$dados = array(
			'pessoas' => $pessoas,
			'links' => $this->pagination->create_links(),
			'pesquisa' => $pesquisa
		);
		$this->load->templateAdmin('pessoa/listaPessoa', $data, $dados);
	}

	#############################################################################################################
	public function function_novapessoa()
	{
		$post = $this->input->post();
		$rules    =    array(
			array(
				'field'    =>    'nome_pessoa',
				'label'    =>    'Nome',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'senha_pessoa',
				'label'    =>    'Senha',
				'rules'    =>    'trim|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'nivel_acesso_id_nivel_acesso',
				'label'    =>    'Nivel de acesso',
				'rules'    =>    'trim|required|integer'
			),
			array(
				'field'    =>    'cep_endereco',
				'label'    =>    'CEP',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'logradouro_endereco',
				'label'    =>    'Logradouro',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'bairro_endereco',
				'label'    =>    'Bairro',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'numero_endereco',
				'label'    =>    'Numero',
				'rules'    =>    'trim|required|min_length[1]|max_length[255]'
			),
			array(
				'field'    =>    'cidade_endereco',
				'label'    =>    'Cidade',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'uf_endereco',
				'label'    =>    'UF-Estado',
				'rules'    =>    'trim|required|min_length[1]|max_length[255]'
			),
			array(
				'field'    =>    'complemento_endereco',
				'label'    =>    'Cidade',
				'rules'    =>    'trim|min_length[3]|max_length[255]'
			)
		);
		$this->form_validation->set_rules($rules);
		$validacaoForm = $this->form_validation->run();
		if ($validacaoForm) {
			$pessoa = array(
				'nome_pessoa' => $post['nome_pessoa'],
				'senha_pessoa' => md5($post['senha_pessoa']),
				'email_pessoa' => $post['email_pessoa'],
				'nivel_acesso_id_nivel_acesso' => $post['nivel_acesso_id_nivel_acesso'],
				'cep_endereco' => $post['cep_endereco'],
				'logradouro_endereco' => $post['logradouro_endereco'],
				'bairro_endereco' => $post['bairro_endereco'],
				'numero_endereco' => $post['numero_endereco'],
				'cidade_endereco' => $post['cidade_endereco'],
				'uf_endereco' => $post['uf_endereco'],
				'complemento_endereco' => $post['complemento_endereco']
			);
			$this->Pessoa_model->salvaPessoa($pessoa);
			$this->session->set_flashdata('alert', array(
				'tipo' => 'success',
				'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
				'msg' => 'Pessoa cadastrada'
			));
			redirect(base_url() . 'Admin_pessoa/novapessoa');
		} else {
			$this->session->set_flashdata('alert', array(
				'tipo' => 'danger',
				'strongMsg' => '<i class="fas fa-times"></i> Erro ao cadastrar Pessoa',
				'msg' => validation_errors()
			));
			redirect(base_url() . 'Admin_pessoa/novapessoa');
		}
	}

	#############################################################################################################
	public function function_editPessoa()
	{
		$post = $this->input->post();
		$rules    =    array(
			array(
				'field'    =>    'id_pessoa',
				'label'    =>    'ID PESSOA',
				'rules'    =>    'trim|required|integer'
			),
			array(
				'field'    =>    'nome_pessoa',
				'label'    =>    'Nome',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'senha_pessoa',
				'label'    =>    'Senha',
				'rules'    =>    'trim|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'nivel_acesso_id_nivel_acesso',
				'label'    =>    'Nivel de acesso',
				'rules'    =>    'trim|required|integer'
			),
			array(
				'field'    =>    'cep_endereco',
				'label'    =>    'CEP',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'logradouro_endereco',
				'label'    =>    'Logradouro',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'bairro_endereco',
				'label'    =>    'Bairro',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'numero_endereco',
				'label'    =>    'Numero',
				'rules'    =>    'trim|required|min_length[1]|max_length[255]'
			),
			array(
				'field'    =>    'cidade_endereco',
				'label'    =>    'Cidade',
				'rules'    =>    'trim|required|min_length[3]|max_length[255]'
			),
			array(
				'field'    =>    'uf_endereco',
				'label'    =>    'UF-Estado',
				'rules'    =>    'trim|required|min_length[1]|max_length[255]'
			),
			array(
				'field'    =>    'complemento_endereco',
				'label'    =>    'Cidade',
				'rules'    =>    'trim|min_length[3]|max_length[255]'
			)
		);

		$this->form_validation->set_rules($rules);
		$validacaoForm = $this->form_validation->run();
		if ($validacaoForm) {
			$pessoa = array(
				'id_pessoa' => $post['id_pessoa'],
				'nome_pessoa' => $post['nome_pessoa'],
				'nivel_acesso_id_nivel_acesso' => $post['nivel_acesso_id_nivel_acesso'],
				'cep_endereco' => $post['cep_endereco'],
				'logradouro_endereco' => $post['logradouro_endereco'],
				'bairro_endereco' => $post['bairro_endereco'],
				'numero_endereco' => $post['numero_endereco'],
				'cidade_endereco' => $post['cidade_endereco'],
				'uf_endereco' => $post['uf_endereco'],
				'complemento_endereco' => $post['complemento_endereco']
			);

			if ($post['senha_pessoa'] == "") {
				$pessoa['senha_pessoa'] = $post['senha_pessoa_escondido'];
			} else {
				$pessoa['senha_pessoa'] = md5($post['senha_pessoa']);
			}

			$this->Pessoa_model->editPessoa($pessoa);
			$this->session->set_flashdata('alert', array(
				'tipo' => 'success',
				'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
				'msg' => 'Pessoa Editada'
			));
		} else {
			$this->session->set_flashdata('alert', array(
				'tipo' => 'danger',
				'strongMsg' => '<i class="fas fa-times"></i> Erro ao cadastrar Pessoa',
				'msg' => validation_errors()
			));
		}
		redirect(base_url("Admin_pessoa/editPessoa/{$post['id_pessoa']}"));
	}
}
