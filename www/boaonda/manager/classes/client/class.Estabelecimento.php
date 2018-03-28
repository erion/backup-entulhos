<?php
	class Estabelecimento extends ModuloDB {
		public function __construct( $cod = '' ) {
			$this->tabela = 'site_estabelecimento';
			$this->tituloModulo = 'ESTABELECIMENTO';
			$this->chave = 'EstabelecimentoID';
			$this->colecaoFiltro = array( 'RazaoSocial', 'Ativo' );

			$this->ModuloDB();

			if ( $cod )
				$this->configDb( $cod );
		}	

		function prePost() {
			if( !$cod )
				$_POST[ 'DataPublicacao' ] = date( "d/m/Y H:i:s" );

			return $_POST;
		}

		function carregaCidadesAjax() {
			if	( $_GET[ 'EstadoID' ] == '' || !is_numeric( $_GET[ 'EstadoID' ] ) )
				die;

			die( json_encode( $this->carregaCidades( $_GET[ 'EstadoID' ] ) ) );
		}

		function preencheCidade( $cod ) {
			$query = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $this->chave . ' = ' . $cod;
			
			$db = new db();

			$rs = $db->query( $query );

			return $this->carregaCidades( $rs->fields( 'EstadoID' ) );
		}

		function carregaCidades( $EstadoID ) {
			
			$query = 'SELECT * FROM site_cidade WHERE EstadoID = ' . $EstadoID;

			$db = new db();

			$rs = $db->query( $query );

			$colecaoCidade = array();

			while( !$rs->EOF ) {
				$colecaoCidade[ $rs->fields( 'CidadeID' ) ] =  $rs->fields( 'Nome' ) ;

				$rs->MoveNext();
			}
		
			return $colecaoCidade;
		}

		function getCampos( $camposRequisitados = array( 'EstabelecimentoID', 'RazaoSocial', 'Cnpj','PaisID', 'EstadoID', 'CidadeID', 'Telefone', 'Endereco', 'Bairro', 'DataPublicacao', 'Ativo' ) ) {
		
			$colecaoCidade = array();
			if ( isset( $_GET[ 'cod' ] ) && $_GET[ 'cod' ] != '' )
				$colecaoCidade = $this->preencheCidade( $_GET[ 'cod' ] );

			if ( in_array( 'EstabelecimentoID', $camposRequisitados ) )
				$campos[] 	= new fId( 'EstabelecimentoID', true );
				
			if ( in_array( 'RazaoSocial', $camposRequisitados ) )
				$campos[] 	= new fChar( 'RazaoSocial', 'Razão Social:', false, 200, 200, true );
				
			if ( in_array( 'Cnpj', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Cnpj', 'CNPJ:', true, 200, 200, true );				

			if ( in_array( 'PaisID', $camposRequisitados ) )
				$campos[] 	= new fComboAdd( 'PaisID', 'País:', 'Nome', 'site_pais', $this->modulo, 'Selecione', '', false, false, false, true);
				
			if ( in_array( 'EstadoID', $camposRequisitados ) )
				$campos[] 	= new fComboAdd( 'EstadoID', 'Estado:', 'Nome', 'site_estado', $this->modulo, 'Selecione', '', false, false, false, true, "carregaCidades( 'EstadoID', 'CidadeID', 'Selecione', 'Estabelecimento' );" );

			if ( in_array( 'CidadeID', $camposRequisitados ) )
				$campos[] 	= new fListaSimples( 'CidadeID', 'Cidade:', $colecaoCidade );

			if ( in_array( 'Telefone', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Telefone', 'Telefone:', false, 200, 200, true, 0, 'telefone' );

			if ( in_array( 'Endereco', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Endereco', 'Endereço:', false, 200, 200, true );

			if ( in_array( 'Bairro', $camposRequisitados ) )
				$campos[] 	= new fChar( 'Bairro', 'Bairro:', false, 200, 200, true );								

			if ( in_array( 'DataPublicacao', $camposRequisitados ) )
				$campos[] 	= new fData( 'DataPublicacao', 'Data de publicação:', true, true, false );

			if ( in_array( 'Ativo', $camposRequisitados ) )
				$campos[] 	= new fSimNao( 'Ativo', 'Publicado:' );
			
			/*
			$tratamentoPais = "<script>" . PHP_EOL;
			$tratamentoPais .=		"$('#PaisID').change(function(){" . PHP_EOL;
			$tratamentoPais .=			"if($(this).val() == 1) {" . PHP_EOL;
			$tratamentoPais .=			"} else {" . PHP_EOL;
			$tratamentoPais .=				"$('#EstadoID').remove();" . PHP_EOL;
			$tratamentoPais .=				"$('#CidadeID').remove();" . PHP_EOL;
			$tratamentoPais .=			"}" . PHP_EOL;
			$tratamentoPais .=		"})" . PHP_EOL;
			$tratamentoPais .="</script>" . PHP_EOL;
			$campos[] = new fHtml($tratamentoPais);
			*/
			return $campos;
		}
		
		function getFiltro() {
			return $this->getCampos( $this->colecaoFiltro );			
		}

		function listagem() {
			$queryBusca = $this->getBusca();

			$query = 'SELECT * FROM ' . $this->tabela;
			$query .= $queryBusca . ' ';
						
			$campos = $this->getCampos( array( 'RazaoSocial', 'NomeFantasia', 'Ativo' ) );

			$view = new Listagem( $campos, $this->modulo, $query );

			return $view;
		}

		function getTableDefinition() {
			return $this->getCampos();
		}
		
	}
	