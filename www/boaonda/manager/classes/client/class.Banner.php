<?php


class Banner extends ModuloDB {
	
	public function Banner( $cod = '' ) {
	
		$this->tabela = "site_banner";
		$this->tituloModulo = 'BANNER';
		$this->chave = 'BannerID';
		
		$this->ModuloDB();
		if ( $cod ) 
			$this->configDb($cod);
		
	}
	
	function getCampos($camposRequisitados = array('BannerID', 'Titulo', 'Imagem', 'Descricao', 'Url', 'Ativo')) {
	
		if (in_array('BannerID', $camposRequisitados)) 
			$campos[] 		= new fId('BannerID',true);
			
		if (in_array('Titulo', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Título', true, 200, 200, true);

		if (in_array('Imagem', $camposRequisitados))
			$campos[] 		= new fImagemUpload('Imagem', 'Imagem','../uploads/imagens/');
			
		if (in_array('Descricao', $camposRequisitados)) 
			$campos[] 	= new fCKEditor('Descricao','Descrição',null,false);
		
		if (in_array('Url', $camposRequisitados)) 
			$campos[]		= new fChar('Url', 'Link', false, 200, 200, true);
			
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Titulo', 'Imagem', 'Ativo'));
		
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
