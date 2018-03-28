<?php
	class Conteudo extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_conteudo';
			$this->tituloModulo = 'Conteúdo';
			$this->chave = 'ConteudoID';
			$this->colecaoFiltro = array( 'Titulo', 'TipoConteudoID', 'Data', 'DataInclusao', 'Destaque', 'Ativo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}
		
		function prePost(){	
			$_POST[ 'Url' ] = Utils::cleanUrl( $_POST[ 'Titulo' ] );
		
			return $_POST;	
		}

		function getCampos( $camposRequisitados = array( 'ConteudoID', 'Titulo', 'Resumo', 'Data', 'Conteudo', 'Imagem', 'Video', 'FonteAutor', 'Destaque', 'DataInclusao', 'TagID', 'TipoConteudoID', 'Url', 'Title', 'Description', 'Ativo' ) ) {
			
			if ( in_array( 'ConteudoID', $camposRequisitados ) )
				$campos[]	= new fId( 'ConteudoID' );

			if ( in_array( 'TipoConteudoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'TipoConteudoID', 'Tipo de conteúdo:', 'Titulo', 'site_tipo_conteudo', $this->modulo, 'Selecione', '', false, false, false );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 200 );

			if ( in_array( 'Data', $camposRequisitados ) )
				$campos[]	= new fData( 'Data', 'Data:', true, false, true, false);

			if ( in_array( 'Resumo', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Resumo', 'Resumo:', true, '', true, 500 );

			if ( in_array( 'Conteudo', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Conteudo', 'Conteúdo:', true );

			if ( in_array( 'Imagem', $camposRequisitados ) )
				$campos[]	= new fMicroModulo( 'GaleriaImagemID', 'Galeria de Imagens:', 'GaleriaImagemConteudo', $this );

			if ( in_array( 'Video', $camposRequisitados ) )
				$campos[]	= new fMicroModulo( 'GaleriaVideoID', 'Galeria de Videos:', 'GaleriaVideoConteudo', $this );

			if ( in_array( 'FonteAutor', $camposRequisitados ) )
				$campos[]	= new fChar( 'FonteAutor', 'Fonte/Autor:', true, 150 );

			if ( in_array( 'TagID', $camposRequisitados ) )
				$campos[]	= new fManyToMany( 'TagID', 'Tags:', 'Tag', 'Titulo', 'Conteudo', 'Titulo', true, '', 'site_conteudo_tag' );

			if ( in_array( 'DataInclusao', $camposRequisitados ) )
				$campos[]	= new fData( 'DataInclusao', 'Data de inclusão:', true, false, true, false, true);

			if ( in_array( 'Destaque', $camposRequisitados ) )
				$campos[]	= new fSimNao( 'Destaque', 'Destaque:' );

			if ( in_array( 'Ativo', $camposRequisitados ) )
				$campos[]	= new fSimNao( 'Ativo', 'Ativo:' );

			if ( in_array( 'Url', $camposRequisitados ) )
				$campos[]	= new fUrl( 'Url', 'Url:', SITE_URL . '/conteudo-', 'Titulo', false, 210 );

			if ( in_array( 'Title', $camposRequisitados ) )
				$campos[]	= new fChar( 'Title', 'Title:', false, 70 );

			if ( in_array( 'Description', $camposRequisitados ) )
				$campos[]	= new fChar( 'Description', 'Description:', false, 160 );

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
