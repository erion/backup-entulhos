<?php
	class Tag extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_tag';
			$this->tituloModulo = 'Tag';
			$this->chave = 'TagID';
			$this->colecaoFiltro = array( 'Titulo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'TagID', 'Titulo' ) ) {
			
			if ( in_array( 'TagID', $camposRequisitados ) )
				$campos[]	= new fId( 'TagID' );

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
