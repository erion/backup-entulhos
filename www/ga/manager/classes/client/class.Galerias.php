<?php

class Galerias extends ModuloDB {
	
	public function Galerias( $cod = '' ) {
	
		$this->tabela = "site_galerias";
		$this->tituloModulo = 'GALERIAS DE FOTOS';
		$this->chave = 'GaleriaID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}	
	
	function prePost(){
		
		$util = new Utils();
		
		$_POST['Url'] =  $util->cleanUrl( $_POST['Titulo'] );
		
		if( !$cod )
			$_POST['PublicadoData'] = date("d/m/Y H:i:s");
		
		return $_POST;
	}

	function getCampos( $camposRequisitados = array('GaleriaID', 'Titulo', 'Url', 'Descricao', 'PublicadoData', 'Ativo', 'ImagemDestaque', 'Foto') ) {
	
		if (in_array('GaleriaID', $camposRequisitados))
			$campos[] 	= new fId('GaleriaID',true);
						
		if (in_array('Titulo', $camposRequisitados))
			$campos[] 	= new fChar('Titulo','Titulo:',true,200,200,true);

		if (in_array('Url', $camposRequisitados))
			$campos[] 	= new fChar('Url','Url:',true,200,200,true);

		if (in_array('Descricao', $camposRequisitados))
			$campos[] 	= new fTexto('Descricao','Descricão:');

			if (in_array('PublicadoData', $camposRequisitados)) 
			$campos[] 	= new fData('PublicadoData', 'Data de publicação:', true, false,false);
		
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado:');

		if (in_array('ImagemDestaque', $camposRequisitados))
			$campos[] 	= new fImagemUpload('ImagemDestaque', 'Imagem Destaque:', '../uploads/imagens/',true);
		
		if (in_array('Foto', $camposRequisitados))
			$campos[] 	= new fMultiUpload('Foto', 'Fotos:', 'site_galeria_fotos', 'Foto', 'Legenda', 'GaleriaID', 'FotoID', '../uploads/imagens/');
		
		return $campos;
		
	}
		
	function listagem() {
	
		$queryBusca = $this->getBusca();
		
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Titulo', 'PublicadoData', 'Imagem') );	

		$view = new Listagem($campos,$this->modulo,$query);
		
		return $view;
		
	}
	
	function getTableDefinition() {
		
		return $this->getCampos();
		
	}
	
}