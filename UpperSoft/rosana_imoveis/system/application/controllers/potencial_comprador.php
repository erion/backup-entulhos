<?php

class Potencial_Comprador extends Controller {

	function Potencial_Comprador()
	{
		parent::Controller();
		
		/*
		 * O model "potencial comprador" provavelmente será utilizado em todos os métodos
		 * desta classe, então carregamos logo no construtor.
		 */
		$this->load->model('potencial_comprador_model');
	}
	
	
	function index()
	{
		/*
		 * O método index também faz a listagem
		 */
		$this->listar();
	}
	
	
	function cadastrar($tabela) {
		$this->load->library('form_post');
		
		if ($tabela == 'imovel') {
			if (form_post::valid('potencial_imovel'))
			{
				//cadastra um novo potencial comprador com os dados enviados por POST no formulário
				$this->potencial_comprador_model->cadastrar(
					form_post::value('cliente_id'), //mesma coisa que utilizar $_POST[''] ou $this->input->post(''), porém tratando de maneira diferente
					form_post::value('investimento_minimo'),
					form_post::value('investimento_maximo')
				);
				//depois de inserir o registro, volta para a listagem
				redirect('potencial_comprador/listar');
			}
			
			$this->load->model('cliente_model');
			$this->view->load('potencial_comprador/formulario',array(
				'clientes' => $this->cliente_model->listar_dropdown(),
				'acao' => 'Cadastrar'
			));			
		} else {
			if (form_post::valid('potencial_posto'))
			{
				$this->potencial_comprador_model->cadastrar_posto(
					form_post::value('cliente_id'),
					form_post::value('bandeira')
				);
				redirect('potencial_comprador/listar/posto');
			}
			
			$this->load->model('cliente_model');
			$this->view->load('potencial_comprador/formulario_posto',array(
				'clientes' => $this->cliente_model->listar_dropdown(),
				'acao' => 'Cadastrar'
			));			
		}
		
			
	}
	
	function listar($tabela='imovel',$pagina=0) {
		$this->load->library('pagination');

		$this->pagination->initialize(get_pagination_config(
			$this->potencial_comprador_model->total($tabela)
		));
		$this->potencial_comprador_model->tabela_selecionada = $tabela;
		
		if ($tabela == 'imovel') {
			$this->view->load('potencial_comprador/listar', array(
				'titulo' => 'Potenciais Compradores',
				'registros' => $this->potencial_comprador_model->listar($pagina)
			));			
		} else {
			$this->view->load('potencial_comprador/listar_posto', array(
				'titulo' => 'Potenciais Compradores',
				'registros' => $this->potencial_comprador_model->listar($tabela,$pagina)
			));			
		}
	}
	
	function editar($tabela,$id) {
		$this->load->library('form_post');
		
		form_post::set_default_values($this->potencial_comprador_model->detalhes($tabela,$id));	
		if ($tabela == 'imovel') {
			if (form_post::valid('potencial_imovel'))
			{
				//cadastra um novo potencial comprador com os dados enviados por POST no formulário
				$this->potencial_comprador_model->editar(
					$id,//passa o id para clausula where
					form_post::value('cliente_id'), //mesma coisa que utilizar $_POST[''] ou $this->input->post(''), porém tratando de maneira diferente
					form_post::value('investimento_minimo'),
					form_post::value('investimento_maximo')
				);
				//depois de inserir o registro, volta para a listagem
				redirect('potencial_comprador/listar/imovel');
			}
			
			$this->load->model('cliente_model');
			$this->view->load('potencial_comprador/formulario',array(
				'clientes' => $this->cliente_model->listar_dropdown(),
				'acao' => 'Editar'
			));						
		} else {
			if (form_post::valid('potencial_posto')) {
				$this->potencial_comprador_model->editar_posto(
					$id,
					form_post::value('cliente_id'),
					form_post::value('bandeira')
				);
				//depois de inserir o registro, volta para a listagem
				redirect('potencial_comprador/listar/posto');				
			}			

			$this->load->model('cliente_model');
			$this->view->load('potencial_comprador/formulario_posto',array(
				'clientes' => $this->cliente_model->listar_dropdown(),
				'acao' => 'Editar'
			));			
		}
		
	}
	
	function excluir($tabela,$id) {
		$this->potencial_comprador_model->excluir($tabela,$id);
		redirect('potencial_comprador/listar/'.$tabela);
	}
	
	function consultar($pagina=0) {
		$this->load->library('pagination');

		$this->pagination->initialize(get_pagination_config(
			$this->potencial_comprador_model->total_consulta()
		));
		
		$this->view->load('potencial_comprador/listar', array(
			'registros' => $this->potencial_comprador_model->consulta($pagina)
		));
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */