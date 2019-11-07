<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
  /*Model programa
    ########################################## */
  public function salvaPrograma($programa)
  {
    return $this->db->insert("programa", $programa);
  }

  public function buscaTodosPrograma()
  {
    return $this->db->get("programa")->result_array();
  }

  public function buscaProgramaId($id_programa)
  {
    return $this->db->get_where("programa", array("id_programa" => $id_programa))->row_array();
  }

  public function editarprograma($programa)
  {
    $where = array('id_programa' => $programa['id_programa']);
    $this->db->where($where);
    return $this->db->update('programa', $programa);
  }

  public function deletePrograma($id_programa)
  {
    return $this->db->delete('programa', array('id_programa' => $id_programa));
  }

  /*Model nivel de acesso
    ########################################## */

  public function salvanivel_acesso($nivel_acesso)
  {
    return $this->db->insert("nivel_acesso", $nivel_acesso);
  }

  public function buscaTodosnivel_acesso()
  {
    return $this->db->get("nivel_acesso")->result_array();
  }

  public function buscanivel_acessoId($id_nivel_acesso)
  {
    return $this->db->get_where("nivel_acesso", array("id_nivel_acesso" => $id_nivel_acesso))->row_array();
  }

  public function editarnivel_acesso($nivel_acesso)
  {
    $where = array('id_nivel_acesso' => $nivel_acesso['id_nivel_acesso']);
    $this->db->where($where);
    return $this->db->update('nivel_acesso', $nivel_acesso);
  }

  public function deletenivel_acesso($id_nivel_acesso)
  {
    return $this->db->delete('nivel_acesso', array('id_nivel_acesso' => $id_nivel_acesso));
  }

  /*Model nivel_acesso_programa
    ########################################## */
  public function salvanivel_acesso_programa($nivel_acesso_programa)
  {
    return $this->db->insert("nivel_acesso_programa", $nivel_acesso_programa);
  }

  public function buscaTodosnivel_acesso_programa()
  {
    return $this->db->get("nivel_acesso_programa")->result_array();
  }

  public function buscanivel_acesso_programaId($id_nivel_acesso_programa)
  {
    return $this->db->get_where("nivel_acesso_programa", array("id_nivel_acesso_programa" => $id_nivel_acesso_programa))->row_array();
  }

  public function buscaNivel_Acesso_Programa_separado()
  {
    $niveldeacesso = $this->db->query("SELECT * FROM nivel_acesso");
    $nivelAcesso = $niveldeacesso->result_array();
    foreach ($nivelAcesso as $nivelAcesso) {
      $programa = $this->db->query(
        "SELECT pg.*, id_nivel_acesso_programa id
            FROM nivel_acesso na, programa pg, nivel_acesso_programa nap 
            WHERE nap.programa_id_programa = pg.id_programa 
            and nap.nivel_acesso_id_nivel_acesso = na.id_nivel_acesso
            and na.id_nivel_acesso ='{$nivelAcesso['id_nivel_acesso']}'"
      );
      $nomesdeprogramasporniveldeacesso = $programa->result_array();
      $programas = array();
      foreach ($nomesdeprogramasporniveldeacesso as $value) {
        $programas[$value['id']] = $value['nome_programa'];
      }
      $resultado[] = array(
        'NivelAcesso' => $nivelAcesso['nome_nivel_acesso'],
        'Programa' => $programas,
      );
    }
    return $resultado;
  }

  public function editarnivel_acesso_programa($nivel_acesso_programa)
  {
    $where = array('id_nivel_acesso_programa' => $nivel_acesso_programa['id_nivel_acesso_programa']);
    $this->db->where($where);
    return $this->db->update('nivel_acesso_programa', $nivel_acesso_programa);
  }

  public function deletenivel_acesso_programa($id_nivel_acesso_programa)
  {
    return $this->db->delete('nivel_acesso_programa', array('id_nivel_acesso_programa' => $id_nivel_acesso_programa));
  }

  /*BUSCAR VALIDAÇÕES
    ########################################## */
  public function buscaAcesso($id_nivel_acesso)
  {
    return $this->db->query(
      "SELECT pg.*
            FROM nivel_acesso na, programa pg, nivel_acesso_programa nap 
            WHERE nap.programa_id_programa = pg.id_programa 
            and nap.nivel_acesso_id_nivel_acesso = na.id_nivel_acesso
            and na.id_nivel_acesso ='{$id_nivel_acesso}'"
    )->result_array();
  }
}
