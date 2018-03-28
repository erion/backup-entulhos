<?php


class Cliente extends ModuloDB {
	
	public function Cliente( $cod = '' ) {
	
		$this->tabela = "site_cliente";
		$this->tituloModulo = 'CLIENTES';
		$this->chave = 'ClienteID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}
	
	function getCampos( $camposRequisitados = array('ClienteID', 'Titulo', 'Imagem', 'Ativo') ) {

		if (in_array('ClienteID', $camposRequisitados)) 
			$campos[] 	= new fId('ClienteID',true);		
			
		if (in_array('Titulo', $camposRequisitados)) 
			$campos[] 	= new fChar('Titulo','Titulo',true,200,200,true);
			
		if (in_array('Imagem', $camposRequisitados))
			$campos[] 	= new fImagemUpload('Imagem', 'Imagem', '../uploads/imagens/', true);
			
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado');

		return $campos;
	
	}
	
	function listagem( ) {
		$queryBusca = $this->getBusca();
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Titulo', 'Imagem', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		return $view;
	}
	
	function getTableDefinition() {
		
		$campos = $this->getCampos();
		
		return $campos;
		
	}
	
	
	
	
}