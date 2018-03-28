<?php


class Cadastro extends ModuloDB {
	
	public function Cadastro( $cod = '' ) {
	
		$this->tabela = "site_cadastro";
		$this->tituloModulo = 'CADASTROS';
		$this->chave = 'CadastroID';
		
		$this->ModuloDB();
		if ( $cod ) 
			$this->configDb($cod);
		
	}
	
	function getMenuAcoes() {
		return array(  );
	}	
	
	function getCampos($camposRequisitados = array('CadastroID', 'Nome', 'Email', 'Telefone', 'Sexo','DataNascimento', 'Calcado', 'Profissao', 'Endereco', 'Numero', 'Complemento', 'Estado', 'Cidade', 'Ativo')) {
	
		if (in_array('CadastroID', $camposRequisitados)) 
			$campos[] 		= new fId('CadastroID',true);
			
		if (in_array('Nome', $camposRequisitados)) 
			$campos[]		= new fChar('Nome', 'Nome', true, 200, 200, true);
					
		if (in_array('Email', $camposRequisitados)) 
			$campos[]		= new fChar('Email', 'Email', true, 200, 200, true);
			
		if (in_array('Telefone', $camposRequisitados)) 
			$campos[]		= new fChar('Telefone', 'Telefone', true, 200, 200, true);

		if (in_array('Sexo', $camposRequisitados)) 
			$campos[]		= new fChar('Sexo', 'Sexo', true, 200, 200, true);

		if (in_array('DataNascimento', $camposRequisitados)) 
			$campos[]		= new fChar('DataNascimento', 'Data de Nascimento', true, 200, 200, true);

		if (in_array('Calcado', $camposRequisitados)) 
			$campos[]		= new fChar('Calcado', 'Calçado', true, 200, 200, true);

		if (in_array('Profissao', $camposRequisitados)) 
			$campos[]		= new fChar('Profissao', 'Profissão', true, 200, 200, true);

		if (in_array('Endereco', $camposRequisitados)) 
			$campos[]		= new fChar('Endereco', 'Endereço', true, 200, 200, true);

		if (in_array('Numero', $camposRequisitados)) 
			$campos[]		= new fChar('Numero', 'Número', true, 200, 200, true);

		if (in_array('Complemento', $camposRequisitados)) 
			$campos[]		= new fChar('Complemento', 'Complemento', true, 200, 200, true);

		if (in_array('Estado', $camposRequisitados)) 
			$campos[]		= new fChar('Estado', 'Estado', true, 200, 200, true);

		if (in_array('Cidade', $camposRequisitados)) 
			$campos[]		= new fChar('Cidade', 'Cidade', true, 200, 200, true);
			
		if (in_array('Ativo', $camposRequisitados)) 
			$campos[]		= new fSimNao('Ativo', 'Publicado');
		
		return $campos;
	
	}
	
	
	function listagem(){
		$query = "SELECT * FROM ".$this->tabela;
		
		$campos = $this->getCampos(array('Nome', 'Email', 'Sexo', 'Calcado', 'Estado', 'Ativo'));
		
		$view = new Listagem($campos,$this->modulo,$query, 'delete', 'list');

		return $view;
	}
	
	function getFiltro() {
	
		return $this->getCampos(array('Nome', 'Estado', 'Calcado', 'Sexo', 'Ativo'));
		
	}

	function getTableDefinition() {
		return $this->getCampos();
	}
	
}
