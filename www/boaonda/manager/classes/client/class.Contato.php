<?php
class Contato extends ModuloDB {
	
	public function __construct( $cod = '' ) {
		$this->tabela = 'site_contato';
		$this->tituloModulo = 'CONTATO';
		$this->chave = 'ContatoID';
		$this->ModuloDB();
		if ( $cod )
			$this->configDb( $cod );
	}

	function getMenuAcoes() {
		return array(  );
	}

	function getCampos() {
		
		$campos[]	= new fId( 'ContatoID' );
		//$campos[]	= new fChar( 'Assunto', 'Departamento', false, 50, '', true, 1 );
		$campos[]	= new fChar( 'Nome', 'Nome', false, 45, '', true, 1 );
		$campos[]	= new fChar( 'Telefone', 'Telefone', false, 45, '', true, 1 );
		$campos[]	= new fChar( 'Email', 'E-mail', false, 255, '', true, 1 );
		$campos[]	= new fChar( 'DataContato', 'Data de Contato', false, 10, '', true, 1 );
		$campos[]	= new fTextArea( 'Mens', 'Mensagem', false, '', true, null, true, true );

		return $campos;
		
	}

	function getFiltro() {
		
		$campos[]	= new fChar( 'Nome', 'Nome:', false, 45, '', true );
		$campos[]	= new fChar( 'Email', 'E-mail:', false, 255, '', true);
		
		return $campos;
		
	}

	function listagem() {
		
		$queryBusca = $this->getBusca();
		$query = 'SELECT * FROM ' . $this->tabela . ' ' . $queryBusca . ' ';
		
		$campos[] = new fChar( 'Nome', 'Nome', false, 45, '', true, 1 );
		$campos[] = new fChar( 'Email', 'E-mail', false, 255, '', true, 1 );
		$campos[] = new fChar( 'DataContato', 'Data de contato', false, 10, '', true, 1 );
		
		$view = new Listagem( $campos, $this->modulo, $query );
		
		return $view;
		
	}

	function getTableDefinition() {
		
		return $this->getCampos();
		
	}
}
