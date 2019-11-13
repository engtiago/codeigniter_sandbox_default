<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pessoa_model extends CI_Model
{

	public function salvaPessoa($pessoa)
	{
		$pessoainsert = array(
			'nome_pessoa' => $pessoa['nome_pessoa'],
			'email_pessoa' => $pessoa['email_pessoa'],
			'senha_pessoa' => $pessoa['senha_pessoa'],
			'nivel_acesso_id_nivel_acesso' => $pessoa['nivel_acesso_id_nivel_acesso']
		);
		$insert = $this->db->insert("pessoa", $pessoainsert);
		if ($insert) {
			$endereco  = array(
				'id_pessoa_endereco' => $this->db->insert_id($insert),
				'cep_endereco' => $pessoa['cep_endereco'],
				'logradouro_endereco' => $pessoa['logradouro_endereco'],
				'bairro_endereco' => $pessoa['bairro_endereco'],
				'numero_endereco' => $pessoa['numero_endereco'],
				'cidade_endereco' => $pessoa['cidade_endereco'],
				'uf_endereco' => $pessoa['uf_endereco'],
				'complemento_endereco' => $pessoa['complemento_endereco']
			);
			$this->db->insert("endereco", $endereco);
			return true;
			exit;
		}
		return false;
	}

	public function editPessoa($pessoa)
	{
		$pessoainsert = array(
			'id_pessoa' => $pessoa['id_pessoa'],
			'nome_pessoa' => $pessoa['nome_pessoa'],
			'senha_pessoa' => $pessoa['senha_pessoa'],
			'nivel_acesso_id_nivel_acesso' => $pessoa['nivel_acesso_id_nivel_acesso']
		);	
		$where = array('id_pessoa' => $pessoa['id_pessoa']);
		$this->db->where($where);
		$update = $this->db->update('pessoa', $pessoainsert);
		if ($update) {
			$endereco  = array(
				'id_pessoa_endereco' => $pessoa['id_pessoa'],
				'cep_endereco' => $pessoa['cep_endereco'],
				'logradouro_endereco' => $pessoa['logradouro_endereco'],
				'bairro_endereco' => $pessoa['bairro_endereco'],
				'numero_endereco' => $pessoa['numero_endereco'],
				'cidade_endereco' => $pessoa['cidade_endereco'],
				'uf_endereco' => $pessoa['uf_endereco'],
				'complemento_endereco' => $pessoa['complemento_endereco']
			);
			$where = array('id_pessoa_endereco' => $pessoa['id_pessoa']);
			$this->db->where($where);
			$update = $this->db->update('endereco', $endereco);
			return true;
			exit;
		}
		return false;
	}

	public function buscaPessoaId($id_pessoa)
	{
	  $this->db->select('*');
	  $this->db->from('pessoa');
	  $this->db->join('endereco', 'id_pessoa_endereco = id_pessoa');
	  $this->db->where('id_pessoa',$id_pessoa);
	  return $this->db->get()->row_array();
	}

	public function buscaPorEmailESenha($email_pessoa, $senha_pessoa)
	{
		$this->db->where("email_pessoa", $email_pessoa);
		$this->db->where("senha_pessoa", $senha_pessoa);
		$pessoa = $this->db->get("pessoa")->row_array();

		if ($pessoa != "") {
			return array(
				'id_pessoa' => $pessoa['id_pessoa'],
				'nome_pessoa' => $pessoa['nome_pessoa'],
				'email_pessoa' => $pessoa['email_pessoa'],
				'nivel_acesso_id_nivel_acesso' => $pessoa['nivel_acesso_id_nivel_acesso'],
			);
		} else {
			return false;
		}
	}

	public function buscaTudoPessoas($limit, $start,$order_by, $pesquisa)
	{
	  if($pesquisa == 'all'){
		$pesquisa='';
	  }
	  $pesquisa = $this->db->escape_str($pesquisa);
	  $this->db->select('*');
	  $this->db->from('pessoa');
	  $this->db->join('nivel_acesso', 'nivel_acesso_id_nivel_acesso = id_nivel_acesso');
	  $this->db->where("nome_pessoa like '%{$pesquisa}%'");
	  $this->db->limit($limit, $start);
	  $this->db->order_by($order_by);
	  return $this->db->get();
	}
}
