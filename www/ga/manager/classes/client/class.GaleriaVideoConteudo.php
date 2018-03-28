<?php
	class GaleriaVideoConteudo extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_galeria_video';
			$this->tituloModulo = 'Galeria de vídeo Conteúdo';
			$this->chave = 'GaleriaVideoID';
			$this->colecaoFiltro = array( 'ConteudoID', 'Titulo' );

			$this->ModuloDB();
			
			$this->visible = false;

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'GaleriaVideoID', 'ConteudoID', 'Titulo', 'Descricao', 'VideoUrl' ) ) {
			
			if ( in_array( 'GaleriaVideoID', $camposRequisitados ) )
				$campos[]	= new fId( 'GaleriaVideoID' );

			if ( in_array( 'ConteudoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'ConteudoID', 'Conteúdo:', 'Titulo', 'site_conteudo', 'Conteudo', 'Selecione', '', false, false, false ); // @todo Ajustar parametros

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 150 );

			if ( in_array( 'Descricao', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Descricao', 'Descrição:', true, '', true, 500 );

			if ( in_array( 'VideoUrl', $camposRequisitados ) )
				$campos[]	= new fUpload( 'VideoUrl', 'Vídeo:', '../uploads/videos/', 'wmv, avi, mp4, flv, mov, rmvb' );

			return $campos;
		}

		function listagem() {
			$query = 'SELECT * FROM ' . $this->tabela;
		
			if ( isset( $_GET[ 'ConteudoID' ] ) && is_numeric( $_GET[ 'ConteudoID' ] ) )
				$query .= ' WHERE ConteudoID = ' . $_GET[ 'ConteudoID' ];
		
			$campos = $this->getCampos( array( 'ConteudoID', 'Titulo', 'VideoUrl'));
			$view = new AjaxListagem( $campos, $this->modulo, $query, 'delete', 'list' );
		
			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
	}
