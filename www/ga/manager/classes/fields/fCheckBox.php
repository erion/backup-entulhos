<?php
	class fCheckBox extends Field {
		public $colecao = array();
		public $campo = NULL;
		public $campoFK = NULL;
		public $campoPK = NULL;
		public $campoPKPai = NULL;
		public $tabelaFK = NULL;
		public $tabelaPK = NULL;
		public $tabela = NULL;
		public $classHtml = 'item';
		public $visible = TRUE;
		public $recursivo = FALSE;
		public $tipo = ' fCheckBox ';
		public $capturarValor = TRUE;
		public $label = 'CheckBox:';
		public $preCampoPai = 'Pai';
		public $obrigatorio = TRUE;
		public $AddValorPosicao = 'F';
		public $sufixoQuery = NULL;
		public $dbType = NULL;
		public $SQL_JOIN = ' LEFT JOIN {TABELA} ON {TABELA}.{CHAVEPKPAI} = {TABELAPK}.{CHAVEPK} WHERE ';
		
		/**
		 * Construtor
		 * @param string $classePK
		 * @param string $classeFK
		 */
		public function __construct( $classePK, $classeFK ) {
			$PK = new $classePK();
			$FK = new $classeFK();
			
			$this->campo = $FK->chave;

			$this->campoFK = $FK->chave;
			$this->campoPK = $PK->chave;
			$this->campoPKPai = $this->campoPK . $this->preCampoPai;
			$this->tabelaFK = $FK->tabela;
			$this->tabelaPK = $PK->tabela;

			$this->tabela = $this->tabelaPK . '_' . $this->tabelaFK;
			
			unset( $PK, $FK );
						
			$this->verifyTable();
			
			$this->setObrigatorio( $this->obrigatorio );

			$this->SQL_ORDER = str_replace( '{CHAVEPK}', $this->chave, str_replace( '{TABELA}', $this->tabela, str_replace( '{CHAVEPKPAI}', $this->campoPKPai, $this->SQL_ORDER ) ) );
			$this->SQL_JOIN = str_replace( '{CHAVEPK}', $this->campoPK, str_replace( '{TABELA}', $this->tabela, str_replace( '{CHAVEPKPAI}', $this->campoPKPai, str_replace( '{TABELAPK}', $this->tabelaPK, $this->SQL_JOIN ) ) ) );

			return $this;
		}

		/**
		 * Metodo que busca valores de tabela
		 * @param string $tabela
		 * @param string $key
		 * @param string $label
		 */
		public function DefineValoresTabela( $tabela, $key, $label ) {
			$query = 'SELECT ' . $key . ', ' . $label . ' FROM ' . $tabela;

			if ( !empty( $this->sufixoQuery ) )
				$query .= ' WHERE ' . $this->sufixoQuery;

			$db = new db();
			$rs = $db->query( $query );

			$colecao = array();
			while( !$rs->EOF ) {
				$colecao[] = array(
						'key' => $rs->fields( $key )
						,'label' => $rs->fields( $label )
					);
				
				$rs->MoveNext();
			}

			if ( $this->AddValorPosicao == 'F' )
				$this->colecao = array_merge( $colecao, $this->colecao );
			else
				$this->colecao = array_merge( $this->colecao, $colecao );

			return $this;
		}

		/**
		* Metodo que busca valores de tabela recursivo
		* @param string $tabela
		* @param string $key
		* @param string $keyPai
		* @param string $label
		*/
		public function DefineValoresTabelaRecursivo( $tabela, $key, $keyPai, $label ) {
			if ( $this->AddValorPosicao == 'F' )
				$this->colecao = array_merge( $this->getValores( $tabela, $key, $keyPai, $label ), $this->colecao );
			else
				$this->colecao = array_merge( $this->colecao, $this->getValores( $tabela, $key, $keyPai, $label ) );
				
			$this->DefineRecursivo( TRUE );

			return $this;
		}

		/**
		 * Método que busca valores recursivo
		 * 
		 * @param string $tabela
		 * @param string $key
		 * @param string $keyPai
		 * @param string $label
		 * @param string/int $valor
		 * 
		 * @return array
		 */
		public function getValores( $tabela, $key, $keyPai, $label, $valor = NULL ) {
			$query = 'SELECT ' . $key . ', ' . $label . ' FROM ' . $tabela . ' WHERE ' . $keyPai;

			if ( !empty( $this->sufixoQuery ) )
				$query .= ' AND ' . $this->sufixoQuery;
			
			if ( empty( $valor ) )
				$query .= ' IS NULL OR ' . $keyPai . ' = 0 ';
			else
				$query .= ' = ' . $valor;

			$db = new db();
			$rs = $db->query( $query );

			$colecao = array();
			while( !$rs->EOF ) {
				$id = $rs->fields( $key );
				$lab = $rs->fields( $label );
				
				$colecao[] = array(
					'key' => $id
					,'label' => $lab
					, 'colecao' => $this->getValores( $tabela, $key, $keyPai, $label, $id )
				);

				$rs->MoveNext();
			}			
			
			return $colecao;
		}

		/**
		 * Método que seta valores recebidos por parâmetro
		 * @param array $colecao
		 */
		public function DefineValoresArray( array $colecao ) {
			if ( $this->AddValorPosicao == 'F' )
				$this->colecao = array_merge( $colecao, $this->colecao );
			else
				$this->colecao = array_merge( $this->colecao, $colecao );

			return $this;
		}

		/**
		 * Método que adiciona valor ao colecao
		 * @param array $valor
		 */
		public function AdicionaValor( $colecao, $posicao = 'F' ) {
			$this->AddValorPosicao = $posicao;
			
			if ( $this->AddValorPosicao == 'F' )
				$this->colecao = array_merge( $this->colecao, $colecao );
			else
				$this->colecao = array_merge( $colecao, $this->colecao );

			return $this;
		}

		/**
		 * Método que seta where nas query
		 * @param string $query
		 */
		public function AdicionaFiltro( $query ) {
			$this->sufixoQuery = $query;

			return $this;
		}

		/**
		 * Método que seta titulo
		 * @param string $titulo
		 */
		public function DefineTitulo( $titulo ) {
			$this->label = $titulo;

			return $this;
		}

		/**
		 * Método que seta obrigatoriedade
		 * @param bool
		 */
		public function setObrigatoriedade( $obrigatorio ) {
			$this->obrigatorio = $obrigatorio;
			$this->setObrigatorio( $this->obrigatorio );

			return $this;
		}
		
		/**
		 * Método que seta visible
		 * @param boolean $bool
		 */
		public function DefineVisivel( $bool ){
			$this->visible = $bool;

			return $this;
		}
		
		/**
		* Método que seta recursividade
		* @param boolean $bool
		*/
		public function DefineRecursivo( $bool ) {
			$this->recursivo = $bool;

			return $this;
		}
		
		/**
		* Método que seta classe html
		* @param string $classeHtml
		*/
		public function DefineClasseHtml( $classeHtml ) {
			$this->classHtml = ' ' . $classeHtml;

			return $this;
		}
		
		/**
		 * Método que adiciona classes html
		 * @param string $classeHtml
		 */
		public function AdicionaClasseHtml( $classeHtml ) {
			$this->classHtml .= ' ' . $classeHtml;

			return $this;
		}
		
		/**
		 * Monta html do formulário
		 */
		public function formatForm() {
			$html = $this->montaHtml( $this->colecao );
			
			if ( $this->recursivo )
				$html .= '<script>'
						. T . '$( ".toggle_' . $this->campo . '" ).css( "cursor", "pointer" ).click( function () {' . PHP_EOL
						. T . T . '$( this ).next( "ul" ).toggle( "fast" );' . PHP_EOL
						. T . T . 'if ( $( this ).is( ":contains( \'+ \'  )" ) ) {' . PHP_EOL
						. T . T . T . '$( this ).html( $( this ).text().replace( "+ ", "- " ) );' . PHP_EOL
						. T . T . '} else if ( $( this ).is( ":contains( \'- \'  )" ) ) {' . PHP_EOL
						. T . T . T . '$( this ).html( $( this ).text().replace( "- ", "+ " ) );' . PHP_EOL
						. T . T . '}' . PHP_EOL
						. T . '} );' . PHP_EOL
						. T . '$( ".toggle_' . $this->campo . '" ).each( function () {' . PHP_EOL
						. T . T . 'if( $( this ).next( "ul" ).find( ":checked" ).length > 0 ) {' . PHP_EOL
						. T . T . T . '$( this ).html( $( this ).text().replace( "+ ", "- " ) );' . PHP_EOL
						. T . T . T . '$( this ).next( "ul" ).show();' . PHP_EOL
						. T . T . '}' . PHP_EOL
						. T . '} );' . PHP_EOL
					. '</script>';
				
			return $html;
		}
		
		private function montaHtml( $colecao, $interna = false ) {
			$cl = 'fCheckBox';
			$st = '';
			if ( $interna ) {
				$cl = '';
				$st = 'style="display:none"';
			}

			$classObr = '';
			if ( $this->obrigatorio )
				$classObr = ' required';
			
			$html = '<ul class="' . $cl . ' clearfix" ' . $st . '>';

			if( empty( $colecao ) )
				$html .= '<li>Não há itens cadastrados.</li>';
			else			
				foreach ( $colecao as $key => $value ) {
					$checked = '';
					if ( is_array( $this->valor ) && in_array( $value[ 'key' ], $this->valor ) )
					$checked = ' checked="checked" ';
				
					$html .= '<li class="' . $this->classHtml . '">';
					
					if ( ( $this->recursivo ) && ( isset( $value[ 'colecao' ] ) && count( $value[ 'colecao' ] ) > 0 ) )
						$html .= '	<a class="toggle_' . $this->campo . '">+ ' . $value[ 'label' ] . '</a>';
					else
						$html .= '	<input type="checkbox" ' . $checked . '  class="' . $classObr . '" name="' . $this->campo . '[]" id="' . $this->campo . '_' . $value[ 'key' ] . '" value="' . $value[ 'key' ] . '" /> ' . $value[ 'label' ];
					
					if ( ( $this->recursivo ) && ( isset( $value[ 'colecao' ] ) && count( $value[ 'colecao' ] ) > 0 ) )
						$html .= $this->montaHtml( $value[ 'colecao' ], true );
					
					$html .= '</li>';
				}

			$html .= '</ul>';
			
			return $html;
		}

		/**
		 * Monta html da listagem
		 */
		public function formatListagem() {
			$this->SQL_ORDER = str_replace( '{CHAVEPK}', $this->chave, str_replace( '{TABELA}', $this->tabela, str_replace( '{CHAVEPKPAI}', $this->campoPKPai, $this->SQL_ORDER ) ) );
			$this->SQL_INNER = str_replace( '{CHAVEPK}', $this->chave, str_replace( '{TABELA}', $this->tabela, str_replace( '{CHAVEPKPAI}', $this->campoPKPai, $this->SQL_INNER ) ) );

			$html = '<ul>';

			$html .= $this->montaListagem( $this->colecao );
			
			$html .= '</ul>';

			return $html;
		}

		private function montaListagem( $colecao ) {
			$html = '';
			
			foreach ( $colecao as $key => $value ) {
				if ( is_array( $this->valor ) && in_array( $value[ 'key' ], $this->valor ) )
					$html .= '<li>' . $value[ 'label' ] . '</li>';
				
				if ( ( $this->recursivo ) && ( isset( $value[ 'colecao' ] ) && count( $value[ 'colecao' ] ) > 0 ) )
					$html .= $this->montaListagem( $value[ 'colecao' ] );
			}
			
			return $html;
		}

		/**
		 * Executa acao depois de post do formulário
		 * @param int $IDPK
		 * @param string $classe
		 */
		public function doPost( $IDPK, $classe ) {
			$query = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $this->campoPKPai . ' = ' . $IDPK;

			$db = new db();
			$rs = $db->query( $query );

			$this->valor = array();
			if ( isset( $_POST[ $this->campo ] ) && is_array( $_POST[ $this->campo ] ) )
				$this->valor = $_POST[ $this->campo ]; 
			
			if ( count( $this->valor ) > 0 ) {
				foreach ( $this->valor as $value ) {
					$query = 'INSERT INTO ' . $this->tabela . ' (' . $this->campoPKPai . ', ' . $this->campoFK . ')';
					$query .= ' VALUES ("' . $IDPK . '", "' . $value . '")';
					$rs = $db->query( $query );
				}
			}
		}
		
		/**
		 * Busca valores para edição
		 * @param int $IDPK
		 */
		public function capturarValor( $IDPK = NULL ) {
			if ( !empty( $IDPK )  ) {
				$query = 'SELECT ' . $this->campo . ' FROM ' . $this->tabela . ' WHERE ' . $this->campoPKPai . ' = ' . $IDPK;
			
				$db = new db();
				$rs = $db->query($query);
					
				$this->valor = array();
				while ( !$rs->EOF ) {
					$this->valor[] = $rs->fields( $this->campo );
	
					$rs->moveNext();
				}
			}
		}

		/**
		 * Método que verifica a existencia da tabela
		 */
		private function verifyTable() {
			if ( $GLOBALS[ 'VERIFICAR_TABELAS' ] ) {
				$query = 'CREATE TABLE IF NOT EXISTS ' . $this->tabela . ' ( ' . PHP_EOL;
				$query .= T . $this->campoPKPai . ' INT NOT NULL, ' . PHP_EOL;
				$query .= T . $this->campoFK . ' INT NOT NULL, ' . PHP_EOL;
				$query .= T . 'PRIMARY KEY (' . $this->campoPKPai . ',  ' . $this->campoFK . ') ' . PHP_EOL;
				$query .= ') ENGINE=Innodb; ';

				$db = new db();
				$db->query( $query );
			}
		}
	}
