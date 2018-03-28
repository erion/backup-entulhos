<?php

class Posto extends Controller {
	
	function Posto() {
		parent::Controller();
		$this->load->model('posto_model');
	}
	
	function index() {
		$this->listar();
	}
	
	function editar($id) {
		$this->load->library('form_post');
		
		$registro = $this->posto_model->detalhes($id);
		form_post::set_default_values($registro);

		if (form_post::valid('posto'))
		{
			$this->posto_model->editar(
				$id,
				form_post::value('proprietario'),
				form_post::value('endereco'),
				form_post::value('cidade'),
				form_post::value('estado'),
				form_post::value('telefone'),
				form_post::value('celular'),
				form_post::value('email'),								
				form_post::value('nome_posto'),
				form_post::value('bandeira'),				
				form_post::value('localizacao'),
				form_post::value('duracao_contrato'),
				form_post::value('tipo'),
				form_post::value('valor_aluguel'),
				form_post::value('tempo_contrato_aluguel'),
				form_post::value('situacao_legal'),
				form_post::value('vol_venda_mes'),
				form_post::value('vol_gasolina'),
				form_post::value('vol_alcool'),
				form_post::value('vol_diesel'),
				form_post::value('margem_venda'),
				form_post::value('funcionarios'),
				form_post::value('aberto_24h'),
				form_post::value('loja_conveniencia'),
				form_post::value('troca_oleo'),
				form_post::value('lavagem'),
				form_post::value('venda_vista'),
				form_post::value('venda_prazo'),
				form_post::value('venda_cheque'),
				form_post::value('venda_cartao')
			);
			redirect('posto/listar');
		}
		echo $registro['aberto_24h'];
		echo $registro['loja_conveniencia'];
		echo $registro['loja_conveniencia'];
		echo $registro['lavagem'];
		$this->load->model('posto_model');
		$this->view->load('postos/formulario',array(
			'localizacao' => $this->config->item('localizacao'),
			'tipo' => $this->config->item('tipo_posto'),
			'aberto_24h' => $registro['aberto_24h'],
			'loja_conveniencia' => $registro['loja_conveniencia'],
			'troca_oleo' => $registro['loja_conveniencia'],
			'lavagem' => $registro['lavagem'],
			'acao' => 'Editar'
		));	
	}
	
	function listar($pagina=0) {
		$this->load->library('pagination');

		$this->pagination->initialize(get_pagination_config(
			$this->posto_model->total()
		));
		
		$this->view->load('postos/listar', array(
			'registros' => $this->posto_model->listar($pagina)
		));
	}
	
	function cadastrar() {
		$this->load->library('form_post');
		
		if (form_post::valid('posto'))
		{
			$this->posto_model->cadastrar(
				form_post::value('proprietario'),
				form_post::value('endereco'),
				form_post::value('cidade'),
				form_post::value('estado'),
				form_post::value('telefone'),
				form_post::value('celular'),
				form_post::value('email'),								
				form_post::value('nome_posto'),
				form_post::value('bandeira'),				
				form_post::value('localizacao'),
				form_post::value('duracao_contrato'),
				form_post::value('tipo'),
				form_post::value('valor_aluguel'),
				form_post::value('tempo_contrato_aluguel'),
				form_post::value('situacao_legal'),
				form_post::value('vol_venda_mes'),
				form_post::value('vol_gasolina'),
				form_post::value('vol_alcool'),
				form_post::value('vol_diesel'),
				form_post::value('margem_venda'),
				form_post::value('funcionarios'),
				form_post::value('aberto_24h'),
				form_post::value('loja_conveniencia'),
				form_post::value('troca_oleo'),
				form_post::value('lavagem'),
				form_post::value('venda_vista'),
				form_post::value('venda_prazo'),
				form_post::value('venda_cheque'),
				form_post::value('venda_cartao')
			);
			redirect('posto/listar');
		}
		
		$this->load->model('posto_model');
		$this->view->load('postos/formulario',array(
			'localizacao' => $this->config->item('localizacao'),
			'tipo' => $this->config->item('tipo_posto'),
			'aberto_24h' => '0',
			'loja_conveniencia' => '0',
			'troca_oleo' => '0',
			'lavagem' => '0',			
			'acao' => 'Cadastrar'
		));
	}		
	
}

?>
