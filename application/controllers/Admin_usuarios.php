<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_usuarios extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->helper('Auth_helper');
        Autentica($this);
        $this->load->model('Usuarios_model');
        $this->output->enable_profiler(TRUE);
    }

    /*Area interna view
    ########################################## */

    public function listaUsuarios($order_by = 'cpf', $pesquisa = 'all', $status = '1',$dt_inic = '01/01/1900',$dt_final= '31/12/2250')
    {
        $post = $this->input->post();
        if ($post) {
            $pesquisa = $post['pesquisa'];
            $status = $post['status'];
        }
        $pesquisa = urldecode($pesquisa);
        $this->load->library('pagination');
        $data['title']       = "Sistemas - TI";
        $data['description'] = "Sistemas - TI";
        $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
        $config = array(
            "base_url" => base_url("Admin_Usuarios/listaUsuarios/$order_by/$pesquisa/$status/$dt_inic/$dt_final"),
            "total_rows" => $this->Usuarios_model->buscaTudoUsuarios(100000000, 0, $order_by, $pesquisa, null, $status,$dt_inic,$dt_final)->num_rows(),
            "per_page" => 15,
            "uri_segment" => 8
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $usuarios = $this->Usuarios_model->buscaTudoUsuarios($config["per_page"], $page, $order_by, $pesquisa, 'ASC',$status,$dt_inic,$dt_final)->result_array();
        $dados = array(
            'usuarios' => $usuarios,
            'links' => $this->pagination->create_links(),
            'pesquisa' => $pesquisa,
            'status' => $status
        );
        $this->load->templateAdmin('usuarios/listaUsuarios', $data, $dados);
    }

    /*Area interna functions sistema
    ########################################## */
    private function rules()
    {
        return   array(
            array(
                'field'    =>    'sistemas_id_sistemas',
                'label'    =>    'ID Sistemas',
                'rules'    =>    'trim|required'
            ),
            array(
                'field'    =>    'usuarios_sistemas_cpf',
                'label'    =>    'CPF Usuarios',
                'rules'    =>    'trim|required'
            )
        );
    }

    public function function_novoSistemasUsuarios()
    {
        $post = $this->input->post();
        $rules = $this->rules();
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $UserSistemas = array(
                "sistemas_id_sistemas" =>  $post["sistemas_id_sistemas"],
                "usuarios_sistemas_cpf" => $post["usuarios_sistemas_cpf"],
            );
            $this->Usuarios_model->IncluirSistemaUsuario($UserSistemas);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo sistema cadastrado no usuário'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_usuarios/listaUsuarios'));
    }

    public function function_deletarSistemaUsuario($UserSistemas)
    {
        $post = $this->input->post();
        $UserSistemas = array(
            "sistemas_id_sistemas" =>  $post["sistemas_id_sistemas"],
            "usuarios_sistemas_cpf" => $post["usuarios_sistemas_cpf"],
        );

        if ($this->Sistemas_model->deleteSistemas($UserSistemas)) {

            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Sistema de usuário deletado '
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir sistema'
            ));
        }
        redirect(base_url('Admin_sistemas/listaSistemas'));
    }
}
