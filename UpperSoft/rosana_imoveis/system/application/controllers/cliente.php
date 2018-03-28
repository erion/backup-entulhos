<?php

class Cliente extends Controller {
	
	function Cliente() {
		parent::Controller();
		$this->load->model('cliente_model');
	}
	
	function index() {
		$this->listar();
	}
	
	function editar($id) {
		$this->load->library('form_post');
		
		form_post::set_default_values($this->cliente_model->detalhes($id));
		
		if (form_post::valid('cliente'))
		{
			$this->cliente_model->editar(
				$id,
				form_post::value('nome'),
				form_post::value('pessoa'),
				form_post::value('cpf_cnpj'),
				form_post::value('cidade'),
				form_post::value('uf'),
				form_post::value('endereco'),
				form_post::value('numero'),
				form_post::value('apto'),
				form_post::value('bairro'),
				form_post::value('cep'),
				form_post::value('telefone'),
				form_post::value('celular'),																																												
				form_post::value('email')
			);
			redirect('cliente/listar');
		}
		
		$this->load->model('cliente_model');
		$this->view->load('clientes/formulario',array(
			'pessoa' => $this->config->item('pessoa'),		
			'acao' => 'Editar'
		));
	}
	
	function listar($pagina=0) {
		$this->load->library('pagination');

		$this->pagination->initialize(get_pagination_config(
			$this->cliente_model->total()
		));
		
		$this->view->load('clientes/listar', array(
			'registros' => $this->cliente_model->listar($pagina)
		));
	}	
	
	function cadastrar() {
		$this->load->library('form_post');
		
		if (form_post::valid('cliente')) {
			
			$this->cliente_model->cadastrar(
				form_post::value('nome'),
				form_post::value('pessoa'),
				form_post::value('cpf_cnpj'),
				form_post::value('cidade'),
				form_post::value('uf'),
				form_post::value('endereco'),
				form_post::value('numero'),
				form_post::value('apto'),
				form_post::value('bairro'),
				form_post::value('cep'),
				form_post::value('telefone'),
				form_post::value('celular'),																																												
				form_post::value('email')
			);
			redirect('cliente/listar');
		}
		
		$this->load->model('cliente_model');
		$this->view->load('clientes/formulario',array(
			'pessoa' => $this->config->item('pessoa'),
			'acao' => 'Cadastrar'
		));
	}	
/*
 * $config['pessoa']['F'] = 'Física';
   $config['pessoa']['J'] = 'Jurídica';
 */	
	
}

?>
