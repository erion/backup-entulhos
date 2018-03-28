<?php


class Conteudo extends ModuloDB {
	
	public function Conteudo( $cod = '' ) {
	
		$this->tabela = "site_conteudo";
		$this->tituloModulo = 'CONTEÚDOS';
		$this->chave = 'ConteudoID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}
	
	function getCampos( $camposRequisitados = array('Conteudo', 'Nome', 'Titulo', 'Descricao', 'Imagem', 'SubTitulo', 'DescricaoSub', 'Url', 'Title', 'Description', 'Ativo') ) {

		if (in_array('Conteudo', $camposRequisitados)) 
			$campos[] 	= new fId('ConteudoID',true);		

		if (in_array('Nome', $camposRequisitados)) 
			$campos[] 	= new fChar('Nome','Nome',true,200,200,true);			
			
		if (in_array('Titulo', $camposRequisitados)) 
			$campos[] 	= new fChar('Titulo','Título',true,200,200,true);
			
		if (in_array('Descricao', $camposRequisitados)) 
			$campos[] 	= new fCKEditor('Descricao','Descrição',null,false);						
			
		if (in_array('Imagem', $camposRequisitados))
			$campos[] 	= new fImagemUpload('Imagem', 'Imagem', '../uploads/imagens/', true,"", true, false);
			
		if (in_array('SubTitulo', $camposRequisitados)) 
			$campos[] 	= new fChar('SubTitulo','Sub-título',false,200,200,true);			
			
		if (in_array('DescricaoSub', $camposRequisitados)) 
			$campos[] 	= new fCKEditor('DescricaoSub','Descrição sub-titulo',null,false);
		
		if (in_array('Url', $camposRequisitados)) 
			$campos[] 	= new fChar('Url','Url',false,200,200,true);					

		if (in_array('Title', $camposRequisitados)) 
			$campos[] 	= new fChar('Title','Title',false,200,200,true);			
			
		if (in_array('Description', $camposRequisitados)) 
			$campos[] 	= new fCKEditor('Description','Description',null,false);			
			
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado');

		return $campos;
	
	}
	
	function listagem( ) {
		$queryBusca = $this->getBusca();
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Conteudo', 'Nome', 'Titulo', 'Imagem', 'SubTitulo', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		return $view;
	}
	
	function getTableDefinition() {
		
		$campos = $this->getCampos();
		
		return $campos;
		
	}
	
}