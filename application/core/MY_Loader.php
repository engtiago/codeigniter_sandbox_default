<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Loader extends CI_Loader
{

	public function template($nome, $dados = array(), $datapage = array())
	{
		$this->view("commons/header", $dados);
		$this->view($nome, $datapage);
		$this->view("commons/footer");
	}

	public function templateAdmin($nome, $dados = array('title' => 'MarizaFoods | Admin', 'description' => 'Marizafoods Admin'), $datapage = array())
	{
		$this->view("admin/headerAdmin", $dados);
		$this->view($nome, $datapage);
		$this->view("admin/footerAdmin");
	}

	public function alert($tipo = '', $strongMsg = '', $msg = '')
	{
		$alert = array(
			'tipo' => $tipo,
			'strongMsg' => $strongMsg,
			'msg' => $msg
		);

		$this->view("commons/alert", $alert);
	}


	public function configPagination()
	{
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']  = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']  = '</span></li>';
		return $config;
	}


	public function captcha($controller)
    {
		$controller->load->helper('captcha');
        $random = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 5);
        $sessioncaptcha = array('user_captcha' => $random);
      	$controller->session->set_userdata($sessioncaptcha);
        $vals = array(
            'captcha_form' => TRUE,
            'word'          => $random,
			'img_path'      => './assets/',
            'img_url'       => base_url('assets/'),
            'font_path'     => APPPATH . '../assets/font-captcha.ttf',
            'img_width'     => '200',
            'img_height'    => 70,
            'expiration'    => 1,
            'word_length'   => 8,
            'font_size'     => 30,
            'img_id'        => 'Imageid',
            'pool'          => '16052019manoelsoarescoelho',
            'colors'        => array(
                'background' => array(200, 400, 300),
                'border' => array(0, 80, 0),
                'text' => array(0,80, 0),
                'grid' => array(0, 80, 0)
            )
        );
        //cria captcha
		
	  return create_captcha($vals);
		
    }
}
