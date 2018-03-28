<?php

class Agenda extends ModuloDB {
	
	public function Agenda( $cod = '' ) {
	
		$this->tabela = "site_agenda";
		$this->tituloModulo = 'AGENDA';
		$this->chave = 'AgendaID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}	
	
	// alguns tratamentos para antes da postagem
	function prePost(){	

		$utils = new Utils();
		
		$_POST['Url'] = $utils->cleanUrl($_POST['Titulo']);
		
		if( !$cod )
			$_POST['PublicadoData'] = date("d/m/Y H:i:s");
			
		return $_POST;	
			
	}
			
	
	function getCampos( $camposRequisitados = array('AgendaID', 'GaleriaID', 'Titulo', 'TituloEn', 'Url', 'Corpo', 'CorpoEn', 'Data', 'PublicadoData', 'Ativo' ) ) {
		
		if (in_array('AgendaID', $camposRequisitados))
			$campos[] 	= new fId('AgendaID',true);

		if (in_array('GaleriaID', $camposRequisitados))
			$campos[] 	= new fComboAdd('GaleriaID', 'Galeria Relacionada', 'Titulo', 'site_galerias', 'Galerias', '', '', false, false, false);

		if (in_array('Titulo', $camposRequisitados))
			$campos[] 	= new fChar('Titulo','Titulo',true,200,200,true);

		if (in_array('Url', $camposRequisitados))
			$campos[] 	= new fChar('Url','Url',false,200,200,true);
			
		if (in_array('Corpo', $camposRequisitados))
			$campos[] 	= new fTexto('Corpo','Corpo');
						
		if (in_array('Data', $camposRequisitados))
			$campos[] 	= new fData('Data', 'Data', true, true, true);
			
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado');
			
		
		return $campos;
	}
	
	function getFiltro() {
	
		return $this->getCampos( array('Titulo', 'Data', 'Ativo') );
		
	}

	function listagem() {
	
		$queryBusca = $this->getBusca();
		
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Titulo', 'Data', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		
		return $view;
		
	}
		
	function getTableDefinition() {
	
		return $this->getCampos();
		
	}
	
	
	
}