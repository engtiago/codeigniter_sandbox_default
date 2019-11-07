<?php
defined('BASEPATH') or exit('No direct script access allowed');

function Autentica($controler)
{
    if ($controler->session->userdata("usuario_logado")) {
        $controler->load->model('Auth_model'); 
        $acesso = $controler->session->userdata("usuario_logado")['nivel_acesso_id_nivel_acesso'];
        $nivel = $controler->Auth_model->buscaAcesso($acesso);
        if (!verificaniveldeacesso($nivel, get_class($controler))) {
            $controler->session->set_flashdata('alert', array(
                'tipo' => 'danger',
                'strongMsg' => '<i class="fas fa-times"></i> Erro',
                'msg' => 'Acesso Negado'
            ));
            redirect(base_url('admin'));
            exit;
        }
    } else {
        $controler->session->set_flashdata('alert', array(
            'tipo' => 'danger',
            'strongMsg' => '<i class="fas fa-times"></i> Erro',
            'msg' => 'Acesso Negado'
        ));
        redirect(base_url());
        exit;
    }
}

function verificaniveldeacesso($nivel, $localdeAcesso)
{
    $validar = false;
    foreach ($nivel as $nivel) {
        if ($nivel['nome_programa'] == $localdeAcesso) {
            $validar = true;
            return $validar;
            exit;
        } else {
            $validar = false;
        }
    }
    return $validar;
}
