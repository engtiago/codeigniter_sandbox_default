<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Usuarios_model extends CI_Model

{
  public function buscaTudoUsuarios($limit, $start, $order_by, $pesquisa, $ordem = 'DESC',$status ,$dt_inic,$dt_final)
  {
    if ($pesquisa == 'all') {
      $pesquisa = '';
    }
    $pesquisa = $this->db->escape_str($pesquisa);
    $this->db->select('*');
    $this->db->from('usuarios_sistemas');
    $this->db->where('status', $status);
    $this->db->like('nome', $pesquisa);
    $this->db->where("afastamento  between '$dt_inic' and '$dt_final'");
    $this->db->limit($limit, $start);
    $this->db->order_by($order_by, $ordem);
    return $this->db->get();
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

  // public function editarSistema($sistemas)
  // {
  //   $where = array('id_sistema' => $sistemas['id_sistema']);
  //   $this->db->where($where);
  //   return $this->db->update('sistemas', $sistemas);
  // }

  public function deleteSistemaUsuario($UserSistemas)
  {
    return $this->db->delete(
      'sistemas_has_usuarios_sistemas',
      array(
        'sistemas_id_sistemas' => $UserSistemas['sistemas_id_sistemas'],
        'usuarios_sistemas_cpf' => $UserSistemas['usuarios_sistemas_cpf']
      )
    );
  }
}
