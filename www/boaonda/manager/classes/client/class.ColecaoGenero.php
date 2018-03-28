<?php


class ColecaoGenero extends ModuloDB {
	
	public function ColecaoGenero( $cod = '' ) {
	
		$this->tabela = "site_colecao_genero";
		$this->tituloModulo = 'GÊNEROS';
		$this->chave = 'ColecaoGeneroID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}		

	function prePost() {
	
		$utils = new Utils();
		$url = $utils->cleanUrl($_POST['Titulo']);
		$_POST['url'] = $url;
		
		return $_POST;
	}
	
	function getCampos( $camposRequisitados = array('ColecaoGeneroID', 'Titulo', 'Url', 'Title', 'Ativo') ) {

		if (in_array('ColecaoGeneroID', $camposRequisitados)) 
			$campos[] 	= new fId('ColecaoGeneroID',true);		

		if (in_array('Titulo', $camposRequisitados)) 
			$campos[] 	= new fChar('Titulo','Nome',true,200,200,true);			
		
		if (in_array('Url', $camposRequisitados)) 
			$campos[] 	= new fChar('Url','Url',false,200,200,false);					

		if (in_array('Title', $camposRequisitados)) 
			$campos[] 	= new fChar('Title','Title',false,200,200,false);			
			
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado');

		return $campos;
	
	}
	
	function listagem( ) {
		$queryBusca = $this->getBusca();
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Titulo', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		return $view;
	}
	
	function getTableDefinition() {
		
		$campos = $this->getCampos();
		
		return $campos;
		
	}
	
}