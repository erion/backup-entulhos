<?php
	class GaleriaImagemConteudo extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_galeria_imagem';
			$this->tituloModulo = 'Galeria de imagem de Conteúdo';
			$this->chave = 'GaleriaImagemID';
			$this->colecaoFiltro = array( 'ConteudoID', 'Titulo' );

			$this->ModuloDB();
			
			$this->visible = false;

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'GaleriaImagemID', 'ConteudoID', 'Titulo', 'ImagemUrl' ) ) {
			
			if ( in_array( 'GaleriaImagemID', $camposRequisitados ) )
				$campos[]	= new fId( 'GaleriaImagemID' );

			if ( in_array( 'ConteudoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'ConteudoID', 'Conteúdo:', 'Titulo', 'site_conteudo', 'Conteudo', 'Selecione', '', false, false, false );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 150 );

			if ( in_array( 'ImagemUrl', $camposRequisitados ) )
				$campos[]	= new fImagemUpload( 'ImagemUrl', 'Imagem:', '../uploads/imagens/' );

			return $campos;
		}

		function listagem() {
			$query = 'SELECT * FROM ' . $this->tabela;
		
			if ( isset( $_GET[ 'ConteudoID' ] ) && is_numeric( $_GET[ 'ConteudoID' ] ) )
				$query .= ' WHERE ConteudoID = ' . $_GET[ 'ConteudoID' ];
		
			$campos = $this->getCampos( array( 'ConteudoID', 'Titulo', 'ImagemUrl'));
			$view = new AjaxListagem( $campos, $this->modulo, $query, 'delete', 'list' );
		
			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
	}
