<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_sistemas extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->helper('Auth_helper');
        Autentica($this);
        $this->load->model('Sistemas_model');
    }

    /*Area interna view
    ########################################## */
    public function novoSistema()
    {

        $data['title']       = "Sistemas - TI";
        $data['description'] = "Sistemas - TI";
        $dados = array(
            'sistema' => null,
            'formsubmit' => 'Admin_sistemas/function_novoSitema',
        );
        $this->load->templateAdmin('sistemas/formSistemas', $data, $dados);
    }

    public function verEditSistema($id_sistema)
    {

        $data['title']       = "Sistemas - TI";
        $data['description'] = "Sistemas - TI";
        $sistema = $this->Sistemas_model->buscaSistemaId($id_sistema);
        $dados = array(
            'sistema' => $sistema,
            'formsubmit' => 'Admin_sistemas/function_editSistema',
        );
        $this->load->templateAdmin('sistemas/formSistemas', $data, $dados);
    }

    public function listaSistemas($order_by = 'id_sistema', $pesquisa = 'all')
    {
         if ($this->input->post()) {
            $pesquisa = $this->input->post('pesquisa');
        }
        $pesquisa = urldecode($pesquisa);
        $this->load->library('pagination');
        $data['title']       = "Sistemas - TI";
        $data['description'] = "Sistemas - TI";
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $config = array(
            "base_url" => base_url("Admin_sistemas/listaSistemas/$order_by/$pesquisa"),
            "total_rows" => $this->Sistemas_model->buscaTudoSistemas(100000000, 0, $order_by, $pesquisa)->num_rows(),
            "per_page" => 15,
            "uri_segment" => 5
        );
        $config = array_merge($config, $this->load->configPagination());
        $this->pagination->initialize($config);
        $sistemas = $this->Sistemas_model->buscaTudoSistemas($config["per_page"], $page, $order_by, $pesquisa, 'ASC')->result_array();
        $dados = array(
            'sistemas' => $sistemas,
            'links' => $this->pagination->create_links(),
            'pesquisa' => $pesquisa
        );
        $this->load->templateAdmin('sistemas/listaSistemas', $data, $dados);
    }

    /*Area interna functions receitas
    ########################################## */
    private function rules()
    {
        return   array(
            array(
                'field'    =>    'nome_sistema',
                'label'    =>    'Nome do sistema',
                'rules'    =>    'trim|required|min_length[3]|max_length[255]'
            )
        );
    }

    public function function_novoSitema()
    {
        $rules = $this->rules();
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $sistemas = array(
                "nome_sistema" => $this->input->post("nome_sistema")
            );
            $id_sistema =  $this->Sistemas_model->salvaSistema($sistemas);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo sitema cadastrado'
            ));
            redirect(base_url('Admin_sistemas/listaSistemas'));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_sistemas/novoSistema'));
    }

    public function function_editSistema()
    {

        $rules = $this->rules();
      
        $rules =  array_merge( $rules,
            array(
                'field'    =>    'id_sistema',
                'label'    =>    'id_sistema',
                'rules'    =>    'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $sistemas = array(
                "id_sistema" => $this->input->post("id_sistema"),
                "nome_sistema" => $this->input->post("nome_sistema")
            );
            
            $this->Sistemas_model->editarSistema($sistemas);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Sistema Editado'
            ));
        } else {
            
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
        }
        redirect(base_url('Admin_sistemas/listaSistemas'));
    }

    public function function_deletarSistemas($id_sistema)
    {

        if ($this->Sistemas_model->deleteSistemas($id_sistema)) {

            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Sistema deletado '
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

    private function UploadFile($inputFileName, $caminho, $types)
    {
        $config = array(
            "upload_path" => "upload/download/$caminho",
            "allowed_types" => $types,
            "max_size" => " 1073741824",
            "max_filename" => "255",
            "file_name" => md5($inputFileName)
        );

        $this->load->library('upload');
        $this->upload->initialize($config);
        $data['check'] = $this->upload->do_upload($inputFileName);
        $data['file_name'] = $this->upload->file_name;
        $data['erro'] = $this->upload->display_errors();
        $data['data'] = $this->upload->data();
        return  $data;
    }
}
