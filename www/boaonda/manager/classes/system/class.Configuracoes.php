<?php
	class Configuracoes extends ModuloDB {
		function __construct( $cod = '' ) {
			$this->tabela = 'mgr_configuracoes';
			$this->modulo = 'Configuracoes';
			$this->tituloModulo = 'Configura��es';
			$this->chave = 'ConfiguracaoID';
			$this->acaoPadrao = 'cadastro';

			$this->ModuloDB();

			if ( $cod != '' ) {
				$this->configDb( $cod );
			}
		}

		function posPost () {
			$Sessao = new Sessao();
			$Sessao->atualizaSessao();
		}

		function getTableDefinition() {
			$campos[] = new fId( 'ConfiguracaoID', true );

			$campos[] = new fHtml( '<legend>Dados da Empresa</legend>' );

			$campos[] = new fChar( 'NomeEmpresa', 'Nome da Empresa:', false );
			$campos[] = new fChar( 'RuaEmpresa', 'Rua:', false );
			$campos[] = new fChar( 'NumeroEmpresa', 'N�mero:', false );
			$campos[] = new fChar( 'BairroEmpresa', 'Bairro:', false );
			$campos[] = new fChar( 'TelefoneEmpresa', 'Telefones: <span>Separados por ponto-e-virgula (;).</span>', false );
			$campos[] = new fChar( 'EmailEmpresa', 'Emails da Empresa: <span>Separados por ponto-e-virgula (;).</span>', false );
			$campos[] = new fChar( 'EmailContato', 'Emails para o formul�rio de contato: <span>Separados por ponto-e-virgula (;).</span>', false );

			$campos[] = new fHtml( '<hr />' );
			$campos[] = new fHtml( '<legend>Redes Sociais</legend>' );
			$campos[] = new fChar( 'Twitter', 'Twitter:', false );
			$campos[] = new fChar( 'Facebook', 'Facebook:', false );
			$campos[] = new fChar( 'LinkedIn', 'LinkedIn:', false );

			$campos[] = new fHtml( '<hr />' );
			$campos[] = new fHtml( '<legend>SEO</legend>' );

			$campos[] = new fChar( 'TitleHome', 'Meta T�tulo Home:', false );
			$campos[] = new fChar( 'DescriptionHome', 'Meta Description Home:', false );
			$campos[] = new fChar( 'SiteUrl', 'Url Can�nica Home:', false );

			$campos[] = new fChar( 'TitleDefault', 'Meta T�tulo Geral:', false );
			$campos[] = new fChar( 'DescriptionDefault', 'Meta Description Geral:', false );

			$campos[] = new fHtml( '<hr />' );
			$campos[] = new fHtml( '<legend>Configura��es gerais</legend>' );

			$numPaginas = array( '5' => '5', '10' => '10', '15' => '15', '20' => '20', '25' => '25' );
			
			$campos[] = new fListaSimples( 'PaginacaoSite', 'N�mero de registro por p�gina (Site):', $numPaginas, true, false );
			$campos[] = new fListaSimples( 'PaginacaoManager', 'N�mero de registro por p�gina (Manager):', $numPaginas, true, false );

			$campos[] = new fHtml( '<hr />' );
			$campos[] = new fHtml( '<legend>Google Analytics</legend>' );

			$campos[] = new fTextArea( 'GoogleAnalytics', 'Script Google Analytics:', false );

			return $campos;
		}
		
		function getMenuAcoes() {
			return array();
		}
		
		function cadastro() {
			$campos = $this->fillFields( $this->getTableDefinition(), 1 );

			$view = new Form( $campos, $this->modulo, 'salvar', 1 );

			return $view;	
		}
	}
