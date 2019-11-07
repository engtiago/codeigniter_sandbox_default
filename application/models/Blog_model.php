<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Blog_model extends CI_Model

{
  /*receitas
    ########################################## */

  public function buscaTudoPost($limit, $start, $order_by, $pesquisa, $ordem = 'DESC')
  {
    if ($pesquisa == 'all') {
      $pesquisa = '';
    }
    $pesquisa = $this->db->escape_str($pesquisa);
    $this->db->select('post_blog.* , nome_pessoa');
    $this->db->from('post_blog');
    $this->db->join('pessoa', 'id_pessoa = pessoa_id_pessoa');
    $this->db->where("titulo_post_blog like '%{$pesquisa}%'");
    $this->db->limit($limit, $start);
    $this->db->order_by($order_by, $ordem);
    return $this->db->get();
  }

  public function buscaPostId($id_post_blog)
  {
    $this->db->select('*');
    $this->db->from('post_blog');
    $this->db->where('id_post_blog', $id_post_blog);
    return $this->db->get()->row_array();
  }

  public function salvaPost($post_blog)
  {
    return $this->db->insert("post_blog", $post_blog);
  }


  public function editarPost($post_blog)
  {
    $where = array('id_post_blog' => $post_blog['id_post_blog']);
    $this->db->where($where);
    return $this->db->update('post_blog', $post_blog);
  }

  public function deletePost($id_post_blog)
  {
    return $this->db->delete('post_blog', array('id_post_blog' => $id_post_blog));
  }
}
