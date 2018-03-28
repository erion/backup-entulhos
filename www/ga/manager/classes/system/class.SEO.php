<?php
	class SEO extends ModuloDB {
		public function __construct( $cod = '' ) {

			$this->tabela = "mgr_seo";
			$this->tituloModulo = 'SEO';
			$this->chave = 'SEOID';
			$this->colecaoListagem = array( 'SEOID', 'Sessao', 'Ativo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}

		function getCampos( $camposRequisitados = array( 'SEOID', 'Sessao', 'Title', 'Description', 'Url', 'Ativo' ) ) {

			if ( in_array( 'SEOID', $camposRequisitados ) )
				$campos[] 	= new fId( 'SEOID', true );

			if ( in_array( 'Sessao', $camposRequisitados ) )
				$campos[] 	= new fListaSimples( 'Sessao', 'Sessão:', array( 'a-empresa' => 'A Empresa', 'produtos' => 'Produtos', 'onde-encontrar' => 'Onde Encontrar', 'fale-conosco' => 'Fale Conosco' ), true );

			if ( in_array( 'Title', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Title', 'Title:', false );

			if ( in_array( 'Description', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Description', 'Description:', false );

			if ( in_array( 'Url', $camposRequisitados ) )
				$campos[] 	= new fUrl( 'Url', 'Url:', 'Title' );

			if ( in_array( 'Ativo', $camposRequisitados ) )
				$campos[]	= new fSimNao( 'Ativo', 'Publicado:' );

			return $campos;
		}
	
		function getFiltro() {
			return $this->getCampos( $this->colecaoListagem );
		}

		function listagem() {
	
			$queryBusca = $this->getBusca();
		
			$query = "SELECT * FROM ".$this->tabela." ".$queryBusca." ";
	
			$campos = $this->getCampos( $this->colecaoListagem );

			$view = new Listagem($campos,$this->modulo,$query);

			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
	}
