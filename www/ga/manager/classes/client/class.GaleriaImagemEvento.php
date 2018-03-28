<?php
	class GaleriaImagemEvento extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_galeria_imagem';
			$this->tituloModulo = 'Galeria de imagem de Evento';
			$this->chave = 'GaleriaImagemID';
			$this->colecaoFiltro = array( 'EventoID', 'Titulo' );

			$this->ModuloDB();
			
			$this->visible = false;

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'GaleriaImagemID', 'EventoID', 'Titulo', 'ImagemUrl' ) ) {
			
			if ( in_array( 'GaleriaImagemID', $camposRequisitados ) )
				$campos[]	= new fId( 'GaleriaImagemID' );

			if ( in_array( 'EventoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'EventoID', 'Eventos:', 'Titulo', 'site_eventos', 'Eventos', 'Selecione', '', false, false, false );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 150 );

			if ( in_array( 'ImagemUrl', $camposRequisitados ) )
				$campos[]	= new fImagemUpload( 'ImagemUrl', 'Imagem:', '../uploads/imagens/' );

			return $campos;
		}

		function listagem() {
			$query = 'SELECT * FROM ' . $this->tabela;
		
			if ( isset( $_GET[ 'EventoID' ] ) && is_numeric( $_GET[ 'EventoID' ] ) )
				$query .= ' WHERE EventoID = ' . $_GET[ 'EventoID' ];
		
			$campos = $this->getCampos( array( 'EventoID', 'Titulo', 'ImagemUrl'));
			$view = new AjaxListagem( $campos, $this->modulo, $query, 'delete', 'list' );
		
			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
	}
