<?php
class ContatoConfiguracao extends ModuloDB {
	
	public function __construct( $cod = '' ) {
		$this->tabela = 'site_contato_config';
		$this->tituloModulo = 'CONFIGURAÇÕES';
		$this->chave = 'ConfigID';
		$this->ModuloDB();
		if ( $cod )
			$this->configDb( $cod );
	}

	function getCampos() {
		
		$campos[] = new fId( 'ConfigID' );
		$campos[] = new fChar('Assunto', 'Assunto', true, 200, 200, true);
		$campos[] = new fChar('Emails', 'Emails', true, 200, 200, true);

		return $campos;
		
	}

	function getTableDefinition() {
		
		return $this->getCampos();
		
	}
}
