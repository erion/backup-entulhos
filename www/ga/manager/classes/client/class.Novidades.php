<?php


class Novidades extends ModuloDB {
	
	public function Novidades( $cod = '' ) {
	
		$this->tabela = "site_novidades";
		$this->tituloModulo = 'NOVIDADES';
		$this->chave = 'NovidadeID';
		
		$this->ModuloDB();
		
		if ( $cod ) 
			$this->configDb($cod);
		
		
	}		
		
	// alguns tratamentos para antes da postagem
	function prePost(){	

		$utils = new Utils();
		
		$_POST['PublicadoData'] = date('d/m/Y H:i:s');
		
		$_POST['Url'] = $utils->cleanUrl($_POST['Titulo']);			
			
		return $_POST;	
			
	}
	function getFiltro(){
		return $this->getCampos(array('Titulo', 'Url', 'NoticiaData', 'Ativo'));
	}
	
	function getCampos( $camposRequisitados = array('NovidadeID', 'Titulo', 'Url', 'Introducao', 'Corpo', 'Imagem', 'Fonte', 'NoticiaData', 'PublicadoData', 'Ativo' ) ) {
	
		if (in_array('NovidadeID', $camposRequisitados)) 
			$campos[] = new fId('NovidadeID',true);
		
		if (in_array('Titulo', $camposRequisitados)) 
			$campos[] = new fChar('Titulo','Titulo',true,200,200,true);
				
		if (in_array('Url', $camposRequisitados)) 
			$campos[] = new fChar('Url','URL',true,200,200,false);
		
		if (in_array('Introducao', $camposRequisitados)) 
			$campos[] = new fTexto('Introducao','Introdução', false);
			
		if (in_array('Corpo', $camposRequisitados)) 
			$campos[] = new fTexto('Corpo','Corpo', false);
				
		if (in_array('Imagem', $camposRequisitados)) 
			$campos[] = new fImagemUpload('Imagem', 'Imagem Destaque', '../uploads/imagens/',true);
		
		if (in_array('Fonte', $camposRequisitados)) 
			$campos[] = new fChar('Fonte','Fonte',true,200,200,true);
		
		if (in_array('NoticiaData', $camposRequisitados)) 
			$campos[] = new fData('NoticiaData', 'Data da notícia', true, true, true);
				
		if (in_array('PublicadoData', $camposRequisitados)) 
			$campos[] = new fData('PublicadoData', 'Data de Publicação', true, true, false);
		
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[] = new fSimNao('Ativo', 'Publicado');
		
		
		return $campos;
		
	}
		

	function listagem() {
	
		$queryBusca = $this->getBusca();
		
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Titulo', 'NoticiaData', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		
		return $view;
		
	}
	
	function getTableDefinition() {
				
		return $this->getCampos();
		
	}
	
	
	
	
}