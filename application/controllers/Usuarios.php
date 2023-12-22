<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller {
	
	public function index() {

		$data = array(
			'titulo' => 'Usuários cadastrados',
			'sub_titulo' => 'Listando todos os usuários cadastrados.',
			'titulo_tabela' => 'Lista de usuários',
			'usuarios' => $this->ion_auth->users()->result(), // get all users
		);

		// debugar array de usuários
		//echo '<pre>';
		//print_r($data['usuarios']);
		//exit();

		$this->load->view('layout/header', $data);
		$this->load->view('usuarios/index');
		$this->load->view('layout/footer');
	}
}
