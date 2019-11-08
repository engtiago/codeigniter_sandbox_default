<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sistemas_model extends CI_Model

{
  /*receitas
    ########################################## */

  public function buscaTudoSistemas($limit, $start, $order_by, $pesquisa, $ordem = 'DESC')
  {
    if ($pesquisa == 'all') {
      $pesquisa = '';
    }
    $pesquisa = $this->db->escape_str($pesquisa);
    $this->db->select('*');
    $this->db->from('sistemas');
    $this->db->like('nome_sistema', $pesquisa);
    $this->db->limit($limit, $start);
    $this->db->order_by($order_by, $ordem);
    return $this->db->get();
  }

  public function buscaSistemaId($id_sistema)
  {
    $this->db->select('*');
    $this->db->from('sistemas');
    $this->db->where('id_sistema', $id_sistema);
    return $this->db->get()->row_array();
  }

  public function salvaSistema($sistemas)
  {
    $this->db->insert("sistemas", $sistemas);
    return  $this->db->insert_id();
  }

  public function editarSistema($sistemas)
  {
    $where = array('id_sistema' => $sistemas['id_sistema']);
    $this->db->where($where);
    return $this->db->update('sistemas', $sistemas);
  }

  public function deleteSistemas($id_sistema)
  {
    return $this->db->delete('sistemas', array('id_sistema' => $id_sistema));
  }
}
