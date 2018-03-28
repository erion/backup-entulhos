<?php


class Colecao extends ModuloDB {
	
	public function Colecao( $cod = '' ) {
	
		$this->tabela = "site_colecao";
		$this->tituloModulo = 'COLEÇÃO';
		$this->chave = 'ColecaoID';
		
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
	
	function getCampos($camposRequisitados = array('ColecaoID', 'Referencia', 'Nome', 'ColecaoGeneroID', 'ColecaoCorID', 'ColecaoGradeID','ColecaoGaleriaID', 'Url', 'Ativo')) {
	
		if (in_array('ColecaoID', $camposRequisitados)) 
			$campos[] 		= new fId('ColecaoID',true);

		if (in_array('Referencia', $camposRequisitados)) 
			$campos[]		= new fChar('Referencia', 'Referência', true, 200, 200, true);			
			
		if (in_array('Nome', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Nome', true, 200, 200, true);
					
		if (in_array('ColecaoGeneroID', $camposRequisitados))
			$campos[] 		= new fManyToMany('ColecaoGeneroID', 'Gêneros', 'ColecaoGenero', 'Titulo', 'Colecao', 'Nome', true);
			
		if (in_array('ColecaoGradeID', $camposRequisitados))
			$campos[] 		= new fManyToMany('ColecaoGradeID', 'Grades', 'ColecaoGrade', 'Grade', 'Colecao', 'Nome', true);
			
		if (in_array('ColecaoGaleriaID', $camposRequisitados))
			$campos[]		= new fMicroModulo('ColecaoID','Imagens','ColecaoCorImagem', $this);

		if (in_array('Url', $camposRequisitados)) 
			$campos[]		= new fChar('Url', 'Url', true, 200, 200, false);
			
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Nome', 'ColecaoGaleriaID', 'Ativo'));
		
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
