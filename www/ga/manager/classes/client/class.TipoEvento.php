<?php
	class TipoEvento extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_tipo_evento';
			$this->tituloModulo = 'Tipo de evento';
			$this->chave = 'TipoEventoID';
			$this->colecaoFiltro = array( 'Titulo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'TipoEventoID', 'Titulo' ) ) {
			
			if ( in_array( 'TipoEventoID', $camposRequisitados ) )
				$campos[]	= new fId( 'TipoEventoID' );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 50 );

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
