<?php

class Imovel extends Controller {
	
	function Imovel() {
		parent::Controller();
		$this->load->model('imovel_model');
	}
	
	function index() {
		$this->listar();
	}
	
	function editar($id) {
		$this->load->library('form_post');
		
		form_post::set_default_values($this->imovel_model->detalhes($id));
		
		if (form_post::valid('imovel'))
		{
			$this->imovel_model->editar(
				$id,
				form_post::value('categoria'),
				form_post::value('modalidade'),
				form_post::value('construcao'),
				form_post::value('tipo'),
				form_post::value('quartos'),
				form_post::value('area'),
				form_post::value('valor'),
				form_post::value('cidade'),
				form_post::value('uf'),
				form_post::value('endereco'),
				form_post::value('numero'),
				form_post::value('apto'),
				form_post::value('bairro'),
				form_post::value('descricao')
			);
			redirect('imovel/listar');
		}
		
		$this->load->model('imovel_model');
		$this->view->load('imoveis/formulario',array(
			'categoria' => $this->imovel_model->listar_dropdown(),
			'modalidade' => $this->config->item('modalidade'),
			'construcao' => $this->config->item('construcao'),
			'tipo' => $this->config->item('tipo_imovel'),
			'acao' => 'Editar'
		));
	}
	
	function listar($pagina=0) {
		$this->load->library('pagination');

		$this->pagination->initialize(get_pagination_config(
			$this->imovel_model->total()
		));
		
		$this->view->load('imoveis/listar', array(
			'registros' => $this->imovel_model->listar($pagina)
		));
	}
	
	function cadastrar() {
		$this->load->library('form_post');
		
		if (form_post::valid('imovel'))
		{
			$this->imovel_model->cadastrar(
				form_post::value('categoria'),
				form_post::value('modalidade'),
				form_post::value('construcao'),
				form_post::value('tipo'),
				form_post::value('quartos'),
				form_post::value('area'),
				form_post::value('valor'),
				form_post::value('cidade'),
				form_post::value('uf'),
				form_post::value('endereco'),
				form_post::value('numero'),
				form_post::value('apto'),
				form_post::value('bairro'),
				form_post::value('descricao')
			);
			redirect('imovel/listar');
		}
		
		$this->load->model('imovel_model');
		$this->view->load('imoveis/formulario',array(
			'categoria' => $this->imovel_model->listar_dropdown(),
			'modalidade' => $this->config->item('modalidade'),
			'construcao' => $this->config->item('construcao'),
			'tipo' => $this->config->item('tipo_imovel'),
			'acao' => 'Cadastrar'
		));
	}		
	
}

?>
