<?php


class ProdutoAplicacao extends ModuloDB {
	
	public function ProdutoAplicacao( $cod = '' ) {

		$this->tabela = "site_produto_aplicacao";
		$this->tituloModulo = 'PRODUTO APLICAÇÃO';
		$this->chave = 'ProdutoAplicacaoID';
		
		$this->ModuloDB();
		$this->visible = false;
		
		if ( $cod ) 
			$this->configDb($cod);
		
		
	}
	
	function getCampos($camposRequisitados = array('ProdutoAplicacaoID', 'ProdutoID', 'Nome', 'Descricao', 'Imagem')) {
			
		if (in_array('ProdutoAplicacaoID', $camposRequisitados)) 
			$campos[] 	= new fId('ProdutoAplicacaoID',true);
		
		if (in_array('ProdutoID', $camposRequisitados)) 
			$campos[] 		= new fInt('ProdutoID', 'Produto', false);
		
		if (in_array('Nome', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Nome:', true, 200, 200, true);
		
		if (in_array('Descricao', $camposRequisitados)) 
			$campos[]		= new fTextArea('Descricao', 'Descrição:');

		if (in_array('Imagem', $camposRequisitados)) 
			$campos[]		= new fImagemUpload('Imagem', 'Imagens:', './uploads/imagens/');
		
		return $campos;
	
	}
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		if (isset($_GET['ProdutoID']) && is_numeric($_GET['ProdutoID'])) {
			$query .= " WHERE ProdutoID=".$_GET['ProdutoID'];	
		}
		
		$campos = $this->getTableDefinition();
		
		$view = new AjaxListagem($campos,$this->modulo,$query, 'delete', 'ajax-list');

		return $view;
	}

	function getTableDefinition() {
		
		return $this->getCampos();
		
	}
	
}
