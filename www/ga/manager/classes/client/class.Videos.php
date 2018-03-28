<?php


class Videos extends ModuloDB {
	
	public function Videos( $cod = '' ) {
	
		$this->tabela = "site_videos";
		$this->tituloModulo = 'VÍDEOS';
		$this->chave = 'VideoID';
		
		$this->ModuloDB();
		
		if ( $cod )	
			$this->configDb($cod);
		
	}		
	
	function getCampos( $camposRequisitados = array('VideoID', 'Titulo', 'Descricao', 'Link', 'Ativo' ) ) {
	
		if (in_array('VideoID', $camposRequisitados)) 
			$campos[] = new fId('VideoID',true);
		
		if (in_array('Titulo', $camposRequisitados)) 
			$campos[] = new fChar('Titulo','Titulo:',true,200,200,true);
		
		if (in_array('Descricao', $camposRequisitados)) 
			$campos[] = new fTexto('Descricao','Descrição:', false);
		
		if (in_array('Link', $camposRequisitados)) 
			$campos[] = new fChar('Link','Link:',true,200,200,true);
		
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[] = new fSimNao('Ativo', 'Publicado:');		
		
		return $campos;
		
	}		
	
	function getTableDefinition() {
	
		return $this->getCampos();
		
	}
	
	
	
	
}