<?php
	class fTags extends Field {
		public $tipo = 'fTags';
		public $valor = '';
		public $campoLabelExtra = NULL;
		public $url = 'Url';
		public $capturarValor = TRUE;
		public $multiplo = TRUE;
		public $linkTag = NULL;
		
		function __construct( $campo, $label, $tabela, $pk, $ClasseFk, $campoFk, $novo = true, $obrigatorio = false, $maxLength = 255, $width = NULL, $visible = true, $readonly = false, $ajuda = 'Tecle "Enter" para adicionar!' ) {
			$this->tabelafk = $ClasseFk;
			$this->fk = $campoFk;
			$this->tabela = $tabela;
			$this->tabelaRelacionamento = $this->tabelafk . '_' . $this->tabela;
			$this->visible = $visible;
			$this->readonly = $readonly;
			$this->campo = $campo;
			$this->maxlength = $maxLength;
			$this->setObrigatorio( $obrigatorio );
			$this->label = $label;
			$this->pk = $pk;
			$this->novo = $novo;
			$this->ajuda = $ajuda;
			$this->tipobusca = NULL;
			$this->dbType = NULL;

			$this->verifyTable();
		}

		function verifyTable() {
			if ( $GLOBALS[ 'VERIFICAR_TABELAS' ] ) {
				/* Cria tabela de tags */
				$objs = array();

				$objs[] = new fId( $this->pk );
				$objs[] = new fChar( $this->campo, $this->label );
				$objs[] = new fChar( $this->url );

				$campos = '';
				foreach($objs as $valor){
					if (strlen($campos) > 0) { $campos .= ','; }
					$campos .= $valor->getSQL();
				}

				$db = new db();
				$query = "CREATE TABLE IF NOT EXISTS ".$this->tabela." ( " . $campos . " ) ENGINE=Innodb ";
				$db->query( $query );

				/* Cria tabela de relacionamento de tags */
				$objs = array();

				$objs[] = new fInt( $this->fk );
				$objs[] = new fInt( $this->pk );

				$campos = '';
				foreach($objs as $valor){
					if (strlen($campos) > 0) { $campos .= ','; }
					$campos .= $valor->getSQL();
				}

				$query = "CREATE TABLE IF NOT EXISTS " . $this->tabelaRelacionamento . " ( " . $campos . ", PRIMARY KEY ( " . $this->fk . ",  " . $this->pk . " ) ) ENGINE=Innodb ";
				$db->query( $query );
			}
		}
		
		function setCampoLabel( $campoLabel ) {
			$this->campoLabelExtra = $campoLabel;
			return $this;
		}
		
		function setMultiplo( $bool ) {
			$this->multiplo = $bool;
			return $this;
		}
		
		function setLinkTag( $link ) {
			$this->linkTag = $link;
			return $this;
		}

		function formatForm() {
			$db = new db();
				
			if ( $this->campoLabelExtra )
				$query = 'SELECT ' . $this->pk . ', ' . $this->campo . ', ' . $this->campoLabelExtra . ' FROM ' . $this->tabela . ';';
			else
				$query = 'SELECT ' . $this->pk . ', ' . $this->campo . ' FROM ' . $this->tabela . ';';
				
			$rs = $db->query( $query );

			$colecaoValor = array();
			$colecaoValorID = array();
			while ( !$rs->EOF ) {
				if ( $this->campoLabelExtra ) {
					$labelExtra = $rs->fields( $this->campoLabelExtra );
					if ( !empty( $labelExtra ) )
						$colecaoValor[] = utf8_encode( $rs->fields( $this->campo ) . ' - ' . $labelExtra );
					else
						$colecaoValor[] = utf8_encode( $rs->fields( $this->campo ) );
				} else
					$colecaoValor[] = utf8_encode( $rs->fields( $this->campo ) );
					
				$colecaoValorID[] = $rs->fields( $this->pk );
				$rs->MoveNext();
			}
			
			$readonly = '';
			if ( $this->readonly == TRUE )
				$readonly = ' readonly="readonly" ';

			$width = '';
			if (isset($this->width))
				$width = ' style="width:'.$this->width.';" ';

			$obrigatorio = $this->getObrigatorio();

			$classBox = '';
			if ( !$this->multiplo && !empty( $this->valor ) )
					$classBox = ' hidden';

			$s = '<div class="boxInput' . $this->campo . $classBox . '"><input class="input-text ' . $obrigatorio . '" ' . $width . ' name="temp' . $this->campo . '" id="' . $this->campo . '" maxlength="' . $this->maxlength . '" value="" ' . $readonly . ' />';
			$s .= '<span class="naoTem" style="color:red; display:none;" >Não encontrado!</span>';

			if ( !empty( $this->ajuda ) )
				$s .= '<span class="ajuda">' . $this->ajuda . '</span>';
			
			$s .= '</div>';
			
			$campo = '<li><input type=\"hidden\" name=\"{PRE}' . $this->campo . '[]\" value=\"{VALOR}\"/><a href=\"javascript:void(0);\" class=\"remover remover' . $this->campo . ' \" title=\"Remover\">Remover</a> {TEXTO}</li>';

			if ( !empty( $this->linkTag ) )
				$campo = str_replace( '{TEXTO}', '<a target=\"_blank\" href=\"' . $this->linkTag . '\">{TEXTO}</a>', $campo );
			
			$htmlValor = '';
			if ( !empty( $this->valor ) )
				foreach ( $this->valor as $key => $valor )
					$htmlValor .= str_replace( '{PRE}', '', str_replace( '{VALOR}', $key, str_replace( '{TEXTO}', $valor, str_replace( '\\', '', $campo ) ) ) );
				
			$s .= '<div class="box' . $this->campo . '"><ul class="listaTag">' . $htmlValor . '</ul></div>';

			$s .= '<script>
					$( function () {
						var colecao' . $this->campo . ' = ' . json_encode( $colecaoValor ) . ';
						var colecao' . $this->pk . ' = ' . json_encode( $colecaoValorID ) . ';
						
						var campo = "' . $campo . '";

						function split( val ) { return val.split( /,\s*/ ); }

						function extractLast( term ) { return split( term ).pop(); }

						$( ".remover' . $this->campo . '" ).live( "click", function () {
							$( this ).parent( "li" ).remove();
							$( ".boxInput' . $this->campo . '" ).removeClass( "hidden" );
						} );

						$( "#' . $this->campo . '" ).autocomplete( {
							source: colecao' . $this->campo . '
						} ).keypress( function ( e ) {
							if ( e.which == 13 ) {
								var texto = $( this ).val();
								
								var id = 0;
								$.each( colecao' . $this->campo . ', function ( key, value ) {
									if ( value == texto ) {
										id = colecao' . $this->pk . '[ key ];
									}
								} );';
								
						if ( $this->novo ) {
							$s .= '
							if ( id != "0" )
								$( ".box' . $this->campo . ' > ul" ).append( campo.replace( /{PRE}/gi, "" ).replace( /{VALOR}/gi, id ).replace( /{TEXTO}/gi, texto ) );
							else
								$( ".box' . $this->campo . ' > ul" ).append( campo.replace( /{PRE}/gi, "novo" ).replace( /{VALOR}/gi, texto ).replace( /{TEXTO}/gi, texto ) );';
						} else {
							$s .= '
							if ( id != "0" )
								$( ".box' . $this->campo . ' > ul" ).append( campo.replace( /{PRE}/gi, "" ).replace( /{VALOR}/gi, id ).replace( /{TEXTO}/gi, texto ) );
							else
								$( this ).next( ".naoTem" ).css( "display", "inline" ).fadeOut( 6000 );';
						}

						$s .= '	
								$( this ).val( "" ).focus();

								if ( !eval(' . $this->multiplo . ') && $( ".box' . $this->campo . ' > ul > li" ).length >= 1 )
									$( ".boxInput' . $this->campo . '" ).addClass( "hidden" );
								
							}
						} );
					} );
				</script>';

			return $s;
		}

		function capturarValor( $cod ) {
			if ( !empty( $cod ) ) {
				$db = new db();
				
				if ( $this->campoLabelExtra )
					$query = 'SELECT a.' . $this->pk . ', a.' . $this->campo . ', a.' . $this->campoLabelExtra . ' FROM ' . $this->tabela . ' a JOIN ' . $this->tabelaRelacionamento . ' b ON a.' . $this->pk . ' = b.' . $this->pk . ' WHERE b.' . $this->fk . ' = ' . $cod . ';';
				else
					$query = 'SELECT a.' . $this->pk . ', a.' . $this->campo . ' FROM ' . $this->tabela . ' a JOIN ' . $this->tabelaRelacionamento . ' b ON a.' . $this->pk . ' = b.' . $this->pk . ' WHERE b.' . $this->fk . ' = ' . $cod . ';';
					
				$rs = $db->query( $query );

				$colecaoValor = array();
				while ( !$rs->EOF ) {
					if ( $this->campoLabelExtra )
						$colecaoValor[ $rs->fields( $this->pk ) ] = $rs->fields( $this->campo ) . ' - ' . $rs->fields( $this->campoLabelExtra );
					else
						$colecaoValor[ $rs->fields( $this->pk ) ] = $rs->fields( $this->campo );
					$rs->MoveNext();
				}

				$this->valor = $colecaoValor;
			}
		}

		function doPost( $cod ) {
			$colecaoCampo = $_POST[ $this->campo ];
			$colecaoCampoNovo = $_POST[ 'novo' . $this->campo ];
			
			$db = new db();

			if ( count( $colecaoCampoNovo ) > 0 )
			foreach ( $colecaoCampoNovo as $campo ) {
				$query = 'INSERT INTO ' . $this->tabela . ' ( ' . $this->campo . ', ' . $this->url . ' ) VALUES ( "' . $campo . '", "' . Utils::cleanUrl( $campo ) . '" ); ';
				$db->query( $query );
				$colecaoCampo[] = $db->insert_id();
			}
			
			$query = 'DELETE FROM ' . $this->tabelaRelacionamento . ' WHERE ' . $this->fk . ' = ' . $cod . ';';
			$db->query( $query );

			foreach ( $colecaoCampo as $ID ) {
				$query = 'INSERT INTO ' . $this->tabelaRelacionamento . ' VALUES ( ' . $cod . ', ' . $ID . ' ); ';
				$db->query( $query );
			}
		}

		function formatListagem() {
			return implode( ', ', $this->valor );
		}
	}
