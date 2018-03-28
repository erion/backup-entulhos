<?php


class Produto extends ModuloDB {
	
	public function Produto( $cod = '' ) {
	
		$this->tabela = "site_produto";
		$this->tituloModulo = 'PRODUTO';
		$this->chave = 'ProdutoID';
		
		$this->ModuloDB();
		
		if ( $cod ) 
			$this->configDb($cod);
		
	}
	
	// alguns tratamentos para antes da postagem
	function prePost(){	
		
		if( !$_GET['cod'] ) 
			$_POST['DataPublicacao'] = date("d/m/Y H:i:s");
			
		$utils = new Utils();
		
		$Url = $utils->cleanUrl($_POST['Nome']);
		
		$_POST['Url'] = $Url;
		
		return $_POST;	
	
	}
	
	function getCampos($camposRequisitados = array('ProdutoID', 'Nome', 'Url', 'Descricao', 'ProdutoAplicacaoID', 'Aplicacao', 'DataPublicacao', 'Ativo')) {
	
		if (in_array('ProdutoID', $camposRequisitados)) 
			$campos[] 	= new fId('ProdutoID',true);
			
		if (in_array('Nome', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Nome:', true, 200, 200, true);
		
		if (in_array('Url', $camposRequisitados)) 
			$campos[]		= new fChar('Url', 'Url:', true, 200, 200, false);
		
		if (in_array('Descricao', $camposRequisitados)) 
			$campos[]		= new fTexto('Descricao', 'Descrição:');

		if (in_array('ProdutoAplicacaoID', $camposRequisitados)) 
			$campos[]		= new fMicroModulo('ProdutoAplicacaoID','Lista de Aplicações','ProdutoAplicacao',$this);
			
		if (in_array('DataPublicacao', $camposRequisitados)) 
			$campos[]		= new fData('DataPublicacao', 'Data de publicação:', true, true, false, true);
		
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado:');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Nome', 'Descricao', 'Ativo'));
		
		$view = new Listagem($campos,$this->modulo,$query, 'delete', 'list');

		return $view;
	}
	
	function getFiltro() {
	
		return $this->getCampos(array('CategoriaID', 'Nome', 'Ativo'));
		
	}

	function getTableDefinition() {
	
		return $this->getCampos();
		
	}
	
}
