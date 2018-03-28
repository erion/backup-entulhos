<?php


class Campanha extends ModuloDB {
	
	public function Campanha( $cod = '' ) {
	
		$this->tabela = "site_campanha";
		$this->tituloModulo = 'CAMPANHA';
		$this->chave = 'CampanhaID';
		
		$this->ModuloDB();
		if ( $cod ) 
			$this->configDb($cod);
		
	}
	
	// alguns tratamentos para antes da postagem
	function prePost(){	
		
		$utils = new Utils();
		
		$Url = $utils->cleanUrl($_POST['Nome']);
		
		$_POST['Url'] = $Url;
		
		return $_POST;	
	
	}
	
	function getCampos($camposRequisitados = array('CampanhaID', 'Nome', 'Video', 'Imagens','Destaque', 'Url', 'Ativo')) {
	
		if (in_array('CampanhaID', $camposRequisitados)) 
			$campos[] 		= new fId('CampanhaID',true);
			
		if (in_array('Nome', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Campanha', true, 200, 200, true);

		if (in_array('Video', $camposRequisitados)) 
			$campos[]		= new fChar('Video', 'Link Vídeo', true, 200, 200, true);
			
		if (in_array('Imagens', $camposRequisitados))
			$campos[] 		= new fMultiUpload('Imagem', 'Galeria de imagens:', 'site_campanha_galeria', 'Imagem', 'Legenda', 'CampanhaID', 'CampanhaGaleriaID', '../uploads/imagens/');
			
		if (in_array('Destaque', $camposRequisitados)) 
			$campos[]		= new fSimNao('Destaque', 'Destaque');			
		
		if (in_array('Url', $camposRequisitados)) 
			$campos[]		= new fChar('Url', 'Url', true, 200, 200, false);
			
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Nome', 'Imagens', 'Destaque', 'Ativo'));
		
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
