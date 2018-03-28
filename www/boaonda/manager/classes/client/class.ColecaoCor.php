<?php


class ColecaoCor extends ModuloDB {
	
	public function ColecaoCor( $cod = '' ) {
	
		$this->tabela = "site_colecao_cor";
		$this->tituloModulo = 'COLEÇÃO CORES';
		$this->chave = 'ColecaoCorID';
		
		$this->ModuloDB();
		
		if ( $cod ) 
			$this->configDb($cod);
		
	}
	
	function getCampos($camposRequisitados = array('ColecaoCorID', 'Nome', 'Cor', 'Ativo')) {
	
		if (in_array('ColecaoCorID', $camposRequisitados)) 
			$campos[] 	= new fId('ColecaoCorID',true);

		if (in_array('Nome', $camposRequisitados))
			$campos[]		= new fChar('Nome', 'Nome', true, 200, 200, true);
			
		if (in_array('Cor', $camposRequisitados))
			$campos[]		= new fColor('Cor', 'Cor');
		
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Cor',	'Nome', 'Ativo'));
		
		$view = new Listagem($campos,$this->modulo,$query, 'delete', 'list');

		return $view;
	}
	
	function getFiltro() {
	
		return $this->getCampos(array('ProdutoCorID', 'Cor', 'Nome', 'Ativo'));
		
	}

	function getTableDefinition() {
	
		return $this->getCampos();
		
	}
	
}
