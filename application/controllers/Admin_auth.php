<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth_helper');Autentica($this);
        //$this->output->enable_profiler(TRUE);
    }

    /*cadatro nivel_acesso
    ########################################## */
    public function novonivel_acesso()
    {
        $data['title']    =    "Marizafoods | Novo Nível de Acesso";
        $data['description']    =    "Criar novo Nível de Acesso";
        $dados = array(
            'nivel_acesso' => null,
            'formsubmit' => 'Admin_auth/function_novonivel_acesso'
        );
        $this->load->templateAdmin('auth/formnivelAcesso', $data, $dados);
    }

    public function vereditnivel_acesso($id_nivel_acesso)
    {
        $data['title']    =    "Marizafoods | Editar Nível deAcesso";
        $data['description']    =    "Editar Nível de Acesso";
        $nivel_acesso = $this->Auth_model->buscanivel_acessoId($id_nivel_acesso);
        $dados = array(
            'nivel_acesso' => $nivel_acesso,
            'formsubmit' => 'Admin_auth/function_editnivel_acesso'

        );
        $this->load->templateAdmin('auth/formnivelAcesso', $data, $dados);
    }

    public function listanivel_acessos()
    {
        $data['title']    =    "Marizafoods | Lista de Nível Acessos";
        $data['description']    =    "Lista de Nível Acessos";
        $nivel_acessos = $this->Auth_model->buscaTodosnivel_acesso();
        $dados = array(
            'nivel_acessos' => $nivel_acessos
        );
        $this->load->templateAdmin('auth/listanivelAcessos', $data, $dados);
    }

    public function function_novonivel_acesso()
    {
        $rules = array(
            array(
                'field' => 'nome_nivel_acesso',
                'label' => 'Nome do Nivel de acesso',
                'rules' =>  'trim|required|min_length[3]|max_length[45]'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $nivel_acesso = array(
                "nome_nivel_acesso" => $this->input->post("nome_nivel_acesso")
            );
            $this->Auth_model->salvanivel_acesso($nivel_acesso);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo Nível acesso cadastrado'
            ));
             redirect(base_url().'Admin_auth/novonivel_acesso');
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/novonivel_acesso');
        }
    }

    public function function_editnivel_acesso()
    {
        $rules = array(
            array(
                'field' => 'id_nivel_acesso',
                'label' => 'id_nível_acesso',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'nome_nivel_acesso',
                'label' => 'Nome do Nível de acesso',
                'rules' => 'trim|required|min_length[3]|max_length[45]'
            ),
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $nivel_acesso = array(
                "id_nivel_acesso" => $this->input->post("id_nivel_acesso"),
                "nome_nivel_acesso" => $this->input->post("nome_nivel_acesso"),
            );
            $this->Auth_model->editarnivel_acesso($nivel_acesso);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Nível de acesso editado'
            ));
             redirect(base_url().'Admin_auth/vereditnivel_acesso/' . $this->input->post("id_nivel_acesso"));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/vereditnivel_acesso/' . $this->input->post("id_nivel_acesso"));
        }
    }

    public function function_deletenivel_acesso($id_nivel_acesso)
    {
        if ($this->Auth_model->deletenivel_acesso($id_nivel_acesso)) {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Carrousel deletado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir Carrousel'
            ));
        }
         redirect(base_url().'Admin_auth/listanivel_acessos');
    }

    /*controler Programa
    ########################################## */
    public function novoprograma()
    {
        $data['title']    =    "Marizafoods | Novo Programa";
        $data['description']    =    "Criar novo programa";
        $dados = array(
            'programa' => null,
            'formsubmit' => 'Admin_auth/function_novoprograma'
        );
        $this->load->templateAdmin('auth/formPrograma', $data, $dados);
    }

    public function vereditprograma($id_programa)
    {
        $data['title']    =    "Marizafoods | Editar Programa";
        $data['description']    =    "Editar Programa";
        $programa = $this->Auth_model->buscaProgramaId($id_programa);
        $dados = array(
            'programa' => $programa,
            'formsubmit' => 'Admin_auth/function_editprograma'

        );
        $this->load->templateAdmin('auth/formPrograma', $data, $dados);
    }

    public function listaprogramas()
    {
        $data['title']    =    "Marizafoods | Lista de programas";
        $data['description']    =    "Lista de programas";
        $programas = $this->Auth_model->buscaTodosPrograma();
        $dados = array(
            'programas' => $programas
        );
        $this->load->templateAdmin('auth/listaProgramas', $data, $dados);
    }

    public function function_novoprograma()
    {
        $rules = array(
            array(
                'field' => 'nome_programa',
                'label' => 'Nome da categoria',
                'rules' =>  'trim|required|min_length[3]|max_length[45]'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $programa = array(
                "nome_programa" => $this->input->post("nome_programa")
            );
            $this->Auth_model->salvaPrograma($programa);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo programa cadastrado'
            ));
             redirect(base_url().'Admin_auth/novoPrograma');
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/novoPrograma');
        }
    }

    public function function_editPrograma()
    {
        $rules = array(
            array(
                'field' => 'id_programa',
                'label' => 'id_programa',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'nome_programa',
                'label' => 'Nome do programa',
                'rules' => 'trim|required|min_length[3]|max_length[45]'
            ),
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $programa = array(
                "id_programa" => $this->input->post("id_programa"),
                "nome_programa" => $this->input->post("nome_programa"),
            );
            $this->Auth_model->editarprograma($programa);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Programa editado'
            ));
             redirect(base_url().'Admin_auth/vereditprograma/' . $this->input->post("id_programa"));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/vereditprograma/' . $this->input->post("id_programa"));
        }
    }

    public function function_deletprograma($id_programa)
    {
        if ($this->Auth_model->deletePrograma($id_programa)) {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Programa deletado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir Programa'
            ));
        }
         redirect(base_url().'Admin_auth/listaProgramas');
    }

    /*controler nivel_acesso_programa
    ########################################## */
    public function teste()
    {
       print_r($this->Auth_model->buscaNivel_Acesso_Programa_separado());
    }

    public function novonivel_acesso_programa()
    {   
        $data['title']    =    "Marizafoods | Novo Nível de acesso ao programa";
        $data['description']    =    "Criar novo Nível de acesso ao programa";
        $programa = $this->Auth_model->buscaTodosPrograma();
        $nivel_acesso = $this->Auth_model->buscaTodosnivel_acesso();
        $dados = array(
            'nivel_acesso_programa' => null,
            'formsubmit' => 'Admin_auth/function_novonivel_acesso_programa',
            'programa' => $programa,
            'nivel_acesso' => $nivel_acesso
        );
        $this->load->templateAdmin('auth/formnivelAcessoPrograma', $data, $dados);
    }

    public function vereditnivel_acesso_programa($id_nivel_acesso_programa)
    {
        $data['title']    =    "Marizafoods | Editar Nível de acesso ao programa";
        $data['description']    =    "Editar Nível de acesso ao programa";
        $programa = $this->Auth_model->buscaTodosPrograma();
        $nivel_acesso = $this->Auth_model->buscaTodosnivel_acesso();
        $nivel_acesso_programa = $this->Auth_model->buscanivel_acesso_programaId($id_nivel_acesso_programa);
        $dados = array(
            'nivel_acesso_programa' => $nivel_acesso_programa,
            'formsubmit' => 'Admin_auth/function_editnivel_acesso_programa',
            'programa' => $programa,
            'nivel_acesso' => $nivel_acesso
        );
        $this->load->templateAdmin('auth/formnivelAcessoPrograma', $data, $dados);
    }

    public function listanivel_acesso_programas()
    {
        $data['title']    =    "Marizafoods | Nível de acessos aos programas";
        $data['description']    =    "Lista de Nível de acessos aos programas";
        $nivel_acesso_programas = $this->Auth_model->buscaNivel_Acesso_Programa_separado();
        $dados = array(
            'nivel_acesso_programas' => $nivel_acesso_programas
        );
        $this->load->templateAdmin('auth/listanivelAcessoProgramas', $data, $dados);
    }

    public function function_novonivel_acesso_programa()
    {
        $rules = array(
            array(
                'field' => 'programa_id_programa',
                'label' => 'Programa',
                'rules' =>  'trim|required|integer'
            ),
            array(
                'field' => 'nivel_acesso_id_nivel_acesso',
                'label' => 'Nivel de acesso',
                'rules' =>  'trim|required|integer'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $nivel_acesso_programa = array(
                "programa_id_programa" => $this->input->post("programa_id_programa"),
                "nivel_acesso_id_nivel_acesso" => $this->input->post("nivel_acesso_id_nivel_acesso")
            );
            $this->Auth_model->salvanivel_acesso_programa($nivel_acesso_programa);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'Novo nível de acesso ao programa cadastrado'
            ));
             redirect(base_url().'Admin_auth/novonivel_acesso_programa');
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/novonivel_acesso_programa');
        }
    }

    public function function_editnivel_acesso_programa()
    {
        $rules = array(
            array(
                'field' => 'id_nivel_acesso_programa',
                'label' => 'id_nivel_acesso_programa',
                'rules' =>  'trim|required|integer'
            ),
            array(
                'field' => 'programa_id_programa',
                'label' => 'Programa',
                'rules' =>  'trim|required|integer'
            ),
            array(
                'field' => 'nivel_acesso_id_nivel_acesso',
                'label' => 'Nível de acesso',
                'rules' =>  'trim|required|integer'
            )
        );
        $this->form_validation->set_rules($rules);
        $validacaoForm = $this->form_validation->run();
        if ($validacaoForm) {
            $nivel_acesso_programa = array(
                "id_nivel_acesso_programa" => $this->input->post("id_nivel_acesso_programa"),
                "programa_id_programa" => $this->input->post("programa_id_programa"),
                "nivel_acesso_id_nivel_acesso" => $this->input->post("nivel_acesso_id_nivel_acesso")
            );
            $this->Auth_model->editarnivel_acesso_programa($nivel_acesso_programa);
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'nível de acesso ao programa editado'
            ));
             redirect(base_url().'Admin_auth/vereditnivel_acesso_programa/' . $this->input->post("id_nivel_acesso_programa"));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => validation_errors()
            ));
             redirect(base_url().'Admin_auth/vereditnivel_acesso_programa/' . $this->input->post("id_nivel_acesso_programa"));
        }
    }

    public function function_deletnivel_acesso_programa($id_nivel_acesso_programa)
    {
        if ($this->Auth_model->deletenivel_acesso_programa($id_nivel_acesso_programa)) {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'success',
                'strongMsg' => '<i class="fas fa-check"></i> Sucesso',
                'msg' => 'nível de acesso ao programa deletado'
            ));
        } else {
            $this->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Erro ao excluir nível de acesso ao programa'
            ));
        }
         redirect(base_url().'Admin_auth/listanivel_acesso_programas');
    }
}
