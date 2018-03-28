<?php
	class Representante extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_representante';
			$this->tituloModulo = 'REPRESENTANTE';
			$this->chave = 'RepresentanteID';
			$this->colecaoFiltro = array( 'Nome', 'EstadoID', 'Ativo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}

		function prePost() {
			if( !$cod )
				$_POST[ 'DataPublicacao' ] = date( "d/m/Y H:i:s" );

			return $_POST;
		}

		function getCampos( $camposRequisitados = array( 'RepresentanteID', 'PaisID','EstadoID', 'Nome', 'RazaoSocial', 'TelefoneFixo', 'TelefoneMovel', 'Email', 'RegiaoAtendimento', 'DataPublicacao', 'Ativo' ) ) {
			if ( in_array( 'RepresentanteID', $camposRequisitados ) )
				$campos[] 	= new fId( 'RepresentanteID', true );

			if ( in_array( 'PaisID', $camposRequisitados ) )
				$campos[] 	= new fComboAdd( 'PaisID', 'País', 'Nome', 'site_pais', $this->modulo, 'Selecione', '', false, false, false, true);
				
			if ( in_array( 'EstadoID', $camposRequisitados ) )
				$campos[] 	= new fComboAdd( 'EstadoID', 'Estado', 'Nome', 'site_estado', $this->modulo, 'Selecione', '', false, false, false, false);

			if ( in_array( 'RazaoSocial', $camposRequisitados ) )
				$campos[] 	= new fChar( 'RazaoSocial', 'Razão Social', false, 200, 200, true );
			
			if ( in_array( 'Nome', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Nome', 'Representante', true, 200, 200, true );

			if ( in_array( 'TelefoneFixo', $camposRequisitados ) )
				$campos[] 	= new fChar( 'TelefoneFixo', 'Telefone Fixo', false, 200, 200, true, 0);
			
			if ( in_array( 'TelefoneMovel', $camposRequisitados ) )
				$campos[] 	= new fChar( 'TelefoneMovel', 'Telefone Móvel', false, 200, 200, true, 0);

			if ( in_array( 'Email', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Email', 'E-mail', false, 200, 200, true );
				
			if ( in_array( 'RegiaoAtendimento', $camposRequisitados ) )
				$campos[] 	= new fChar( 'RegiaoAtendimento', 'Região de atendimento', false, 200, 200, true, 0);

			if ( in_array( 'DataPublicacao', $camposRequisitados ) )
				$campos[] 	= new fData( 'DataPublicacao', 'Data de publicação', true, false, false );

			if ( in_array( 'Ativo', $camposRequisitados ) )
				$campos[] 	= new fSimNao( 'Ativo', 'Publicado' );

			return $campos;
		}

		function getFiltro() {
			return $this->getCampos( $this->colecaoFiltro );
		}

		function listagem() {
			$queryBusca = $this->getBusca();

			$query = 'SELECT * FROM ' . $this->tabela . ' ' . $queryBusca . ' ';

			$campos = $this->getCampos( $this->colecaoFiltro );

			$view = new Listagem( $campos, $this->modulo, $query );

			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
	}
