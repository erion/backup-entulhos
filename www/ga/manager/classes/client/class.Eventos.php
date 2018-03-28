<?php
	class Eventos extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_eventos';
			$this->tituloModulo = 'Eventos';
			$this->chave = 'EventoID';
			$this->colecaoFiltro = array( 'Titulo', 'Destaque', 'DataInicio', 'DataFim', 'TipoEventoID', 'Ativo' );

			$this->ModuloDB();
			
			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'EventoID', 'Titulo', 'Resumo', 'Descricao', 'Destaque', 'Local', 'Imagem', 'DataInicio', 'DataFim', 'TipoEventoID', 'Url', 'Title', 'Description', 'Ativo' ) ) {
			
			if ( in_array( 'EventoID', $camposRequisitados ) )
				$campos[]	= new fId( 'EventoID' );

			if ( in_array( 'TipoEventoID', $camposRequisitados ) )
				$campos[]	= new fComboAdd( 'TipoEventoID', 'TipoEvento:', 'Titulo', 'site_tipo_evento', 'TipoEvento', 'Selecione', '', false, false, false );

			if ( in_array( 'Titulo', $camposRequisitados ) )
				$campos[]	= new fChar( 'Titulo', 'Título:', true, 200 );

			if ( in_array( 'Resumo', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Resumo', 'Resumo:', true, '', true, 500 );

			if ( in_array( 'Descricao', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Descricao', 'Descrição:', true );

			if ( in_array( 'Local', $camposRequisitados ) )
				$campos[]	= new fTextArea( 'Local', 'Local:', false, '', true, 500 );

			if ( in_array( 'Imagem', $camposRequisitados ) )
				$campos[]	= new fMicroModulo( 'GaleriaImagemID', 'Galeria de Imagens:', 'GaleriaImagemEvento', $this );

			if ( in_array( 'DataInicio', $camposRequisitados ) )
				$campos[]	= new fData( 'DataInicio', 'Data início:', true, false, true, false);

			if ( in_array( 'DataFim', $camposRequisitados ) )
				$campos[]	= new fData( 'DataFim', 'Data fim:', true, false, true, false);

			if ( in_array( 'Destaque', $camposRequisitados ) )
				$campos[]	= new fSimNao( 'Destaque', 'Destaque:' );

			if ( in_array( 'Ativo', $camposRequisitados ) )
				$campos[]	= new fSimNao( 'Ativo', 'Ativo:' );

			if ( in_array( 'Url', $camposRequisitados ) )
				$campos[]	= new fUrl( 'Url', 'Url:', SITE_URL . '/evento-', 'Titulo', true, 210 );

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
