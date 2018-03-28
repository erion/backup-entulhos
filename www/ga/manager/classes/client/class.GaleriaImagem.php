<?php
	class GaleriaImagem extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_galeria_imagem';
			$this->tituloModulo = 'Galeria de imagem';
			$this->chave = 'GaleriaImagemID';
			$this->colecaoFiltro = array( 'ConteudoID', 'EventoID', 'Titulo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'GaleriaImagemID', 'ConteudoID', 'EventoID', 'Titulo', 'ImagemUrl' ) ) {
			
			if ( in_array( 'GaleriaImagemID', $camposRequisitados ) )
				$campos[]	= new fId( 'GaleriaImagemID' );

			if ( in_array( 'ConteudoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'ConteudoID', 'Conteúdo:', 'Titulo', 'site_conteudo', 'Conteudo', 'Selecione', '', false, false, false );

			if ( in_array( 'EventoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'EventoID', 'Eventos:', 'Titulo', 'site_eventos', 'Eventos', 'Selecione', '', false, false, false );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 150 );

			if ( in_array( 'ImagemUrl', $camposRequisitados ) )
				$campos[]	= new fImagemUpload( 'ImagemUrl', 'Imagem:', '../uploads/imagens/' );

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
