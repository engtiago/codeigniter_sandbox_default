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
        //$this->output->enable_profiler(TRUE);

    }

    /*Area interna view
    ########################################## */

    public function listaUsuarios($order_by = 'sistemas_id_sistemas', $pesquisa = 'all',$status =1,$setor = 'all',$cargo= 'all',$empresa= 'all',$dt_inicial='1900-01-01' , $dt_final='3000-12-31')
    {

        $this->load->model('Sistemas_model');
        $sistemas = $this->Sistemas_model->buscaTudoSistemas(100000000, 0, 'nome_sistema', null, 'asc')->result_array();
        $setores = $this->Usuarios_model->buscaDistictUsuarioRow('local');
        $cargos = $this->Usuarios_model->buscaDistictUsuarioRow('cargo');
        $empresas = $this->Usuarios_model->buscaDistictUsuarioRow('empresa');

        $post = $this->input->post();
        if ($post) {
            $pesquisa = $post['pesquisa'];
            if ($post['pesquisa'] == '') {
                $pesquisa = 'all';
            }
            
            $setor = $post['setor'];
            if ($post['setor'] == '') {
                $setor = 'all';
            }

            $cargo = $post['cargo'];
            if ($post['cargo'] == '') {
                $cargo = 'all';
            }
            
            $empresa = $post['empresa'];
            if ($post['empresa'] == '') {
                $empresa = 'all';
            }
            
            $dt_inicial = $post['dt_inicial'];
            if ($post['dt_inicial'] == '') {
                $dt_inicial = '1900-01-01';
            }

            $dt_final = $post['dt_final'];
            if ($post['dt_final'] == '') {
                $dt_final = '3000-12-31';
            }
            
            $status = $post['status'];
        }

        $pesquisa = urldecode($pesquisa);
        $this->load->library('pagination');
        $data['title']       = "Sistemas - TI";
        $data['description'] = "Sistemas - TI";
        $page = ($this->uri->segment(11)) ? $this->uri->segment(11) : 0;
        $config = array(
            "base_url" => base_url("Admin_Usuarios/listaUsuarios/$order_by/$pesquisa/$status/$setor/$cargo/$empresa/$dt_inicial/$dt_final"),
            "total_rows" => $this->Usuarios_model->buscaTudoUsuarios(100000000, 0, $order_by, $pesquisa, null, $status,$setor,$cargo, $empresa,$dt_inicial,$dt_final)->num_rows(),
            "per_page" => 15,
            "uri_segment" => 11
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $usuarios = $this->Usuarios_model->buscaTudoUsuarios($config["per_page"], $page, $order_by, $pesquisa, 'DESC', $status,$setor,$cargo, $empresa,$dt_inicial,$dt_final)->result_array();
        $usuariosProgramas = [];
        foreach ($usuarios as $key => $value) {
            $usuariosProgramas[$value['codigo']] = $this->Usuarios_model->buscaSistemasUsuarios($value['codigo']);
        }

        $dados = array(
            'usuarios' => $usuarios,
            'links' => $this->pagination->create_links(),
            'sistemas' => $sistemas,
            'usuariosProgramas' => $usuariosProgramas,

            'pesquisa' => $pesquisa,
            'status' => $status,

            'setores' => $setores,
            'setor' => $setor,
            'cargos' => $cargos,
            'cargo' => $cargo,
            'empresas' => $empresas,
            'empresa' => $empresa,
            'dt_inicial'=>$dt_inicial,
            'dt_final'=>$dt_final 

        );

        $this->load->templateAdmin('usuarios/listaUsuarios', $data, $dados);
    }

    /*Area interna functions sistema
    ########################################## */
    private function rules()
    {
        return   array(
            array(
                'field'    =>    'usuarios_sistemas_codigo',
                'label'    =>    'Codigo Usuario',
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

            foreach ($post as $sistemas => $id) {
                if ($sistemas == 'usuarios_sistemas_codigo') continue;
                $UserSistemas = array(
                    "sistemas_id_sistemas" =>  $id,
                    "usuarios_sistemas_codigo" => $post["usuarios_sistemas_codigo"],
                );
                $this->Usuarios_model->IncluirSistemaUsuario($UserSistemas);
            }

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

    public function function_deletarSistemaUsuario()
    {
        $post = $this->input->post();
        $rules = $this->rules();
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {

            foreach ($post as $sistemas => $id) {
                if ($sistemas == 'usuarios_sistemas_codigo') continue;
                $UserSistemas = array(
                    "sistemas_id_sistemas" =>  $id,
                    "usuarios_sistemas_codigo" => $post["usuarios_sistemas_codigo"],
                );
                print_r($this->Usuarios_model->deleteSistemaUsuario($UserSistemas));
            }

            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Sistemas deletados do usuário'
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
}
