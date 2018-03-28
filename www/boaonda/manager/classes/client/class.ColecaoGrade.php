<?php


class ColecaoGrade extends ModuloDB {
	
	public function ColecaoGrade( $cod = '' ) {
	
		$this->tabela = "site_colecao_grade";
		$this->tituloModulo = 'GRADES';
		$this->chave = 'ColecaoGradeID';
		
		$this->ModuloDB();
		
		if ( $cod )
			$this->configDb($cod);
		
	}		
	
	function getCampos( $camposRequisitados = array('ColecaoGradeID', 'Grade', 'Ativo') ) {

		if (in_array('ColecaoGradeID', $camposRequisitados)) 
			$campos[] 	= new fId('ColecaoGradeID',true);		

		if (in_array('Grade', $camposRequisitados)) 
			$campos[] 	= new fChar('Grade','Grade',true,200,200,true);
			
		if (in_array('Ativo', $camposRequisitados))
			$campos[] 	= new fSimNao('Ativo', 'Publicado');

		return $campos;
	
	}
	
	function listagem( ) {
		$queryBusca = $this->getBusca();
		$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
		$campos = $this->getCampos( array('Grade', 'Ativo') );	

		$view = new Listagem($campos,$this->modulo,$query);
		return $view;
	}
	
	function getTableDefinition() {
		
		$campos = $this->getCampos();
		
		return $campos;
		
	}
	
}