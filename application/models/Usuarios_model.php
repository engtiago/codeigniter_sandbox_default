<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Usuarios_model extends CI_Model

{
  public function buscaTudoUsuarios($limit, $start, $order_by, $pesquisa, $ordem = 'desc', $status, $setor, $cargo, $empresa, $dt_inicial, $dt_final)
  {
    $pesquisa = urldecode($pesquisa);
    $setor = urldecode($setor);
    $cargo = urldecode($cargo);
    $empresa = urldecode($empresa);


    if ($pesquisa != 'all') {
      $this->db->like('nome', $pesquisa);
    }

    if ($setor != 'all') {
      $this->db->like('local', $setor, 'before');
    }

    if ($cargo != 'all') {
      $this->db->like('cargo', $cargo, 'before');
    }

    if ($empresa != 'all') {
      $this->db->like('empresa', $empresa, 'before');
    }

    if($status == 1){
      $this->db->where("admissao between '$dt_inicial' and '$dt_final'");
    }else{
      $this->db->where("afastamento between '$dt_inicial' and '$dt_final'");
    }

    $pesquisa = $this->db->escape_str($pesquisa);
    $this->db->select('usuarios_sistemas.*');
    $this->db->distinct();
    $this->db->from('usuarios_sistemas');
    $this->db->join('sistemas_has_usuarios_sistemas', 'usuarios_sistemas_codigo = codigo', 'left');
    $this->db->where('status', $status);
    $this->db->limit($limit, $start);
    $this->db->order_by($order_by, $ordem, true);
    return $this->db->get();
  }

  public function buscaSistemasUsuarios($codigo)
  {

    $this->db->select('nome_sistema,id_sistema');
    $this->db->from('usuarios_sistemas');
    $this->db->join('sistemas_has_usuarios_sistemas', 'usuarios_sistemas_codigo = codigo');
    $this->db->join('sistemas', 'id_sistema = sistemas_id_sistemas');
    $this->db->where('codigo', $codigo);
    $resultado = $this->db->get()->result_array();
    $programas = [];
    foreach ($resultado as $value) {
      $programas[$value['id_sistema']] =  $value['nome_sistema'];
    }
    return $programas;
  }

  public function buscaUsuarioId($cpf)
  {
    $this->db->select('*');
    $this->db->from('usuarios_sistemas');
    $this->db->where('cpf', $cpf);
    return $this->db->get()->row_array();
  }

  public function IncluirSistemaUsuario($UserSistemas)
  {
    return $this->db->insert("sistemas_has_usuarios_sistemas", $UserSistemas);
  }



  public function deleteSistemaUsuario($UserSistemas)
  {
    return $this->db->delete(
      'sistemas_has_usuarios_sistemas',
      array(
        'sistemas_id_sistemas' => $UserSistemas['sistemas_id_sistemas'],
        'usuarios_sistemas_codigo' => $UserSistemas['usuarios_sistemas_codigo']
      )
    );
  }

  public function buscaDistictUsuarioRow($row)
  {
    $this->db->select($row);
    $this->db->distinct();
    $this->db->from('usuarios_sistemas');
    return $this->db->get()->result_array();
  }
}
