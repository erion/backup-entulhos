<?php
	class Exportar {
		private $sql = NULL;
		private $nomeArquivo = NULL;
		private $extensao = 'xls';
		private $colecaoValores = array();
		private $cabecalho = array();
		private $Download = FALSE;
		private $Arquivo = NULL;

		public function __construct( $sql, $nomeArquivo, $extensao = 'xls', $download = TRUE, $deb = FALSE ) {
			if ( !empty( $sql ) )
				$this->sql = $sql;
			else
				die( 'Parametro sql é obrigatorio!' );
				
			if ( !empty( $nomeArquivo ) )
				$this->nomeArquivo = $nomeArquivo;
			else
				$this->nomeArquivo = date( 'd-m-Y H-i-s' );

			if ( !empty( $extensao ) )
				$this->extensao = $extensao;

			$this->Download = $download;

			$this->Arquivo = $this->nomeArquivo . '.' . $this->extensao;

			if ( $deb )
				deb( $this );

			$this->Executa();

			if ( $deb )
				deb( $this, 1 );
		}

		private function Executa() {
			$db = new db();
			$rs = $db->query( $this->sql );

			$colecao = array();
			while ( !$rs->EOF ) {
				$Ex = new stdClass();

				foreach ( $rs->fields as $key => $value )
					if ( !is_numeric( $key ) ) {
						$Ex->$key = ( Utils::codificacao( $value ) == 'UTF-8' ) ? utf8_decode( $value ) : utf8_encode( $value );
						$this->cabecalho[ $key ] = $key;
					}

					$this->colecaoValores[] = $Ex;
				
				$rs->MoveNext();
			}

			switch ( $this->extensao ) {
				case 'xls':
					$this->GerarArquivoXLS();
					break;
			}
		}

		private function GerarArquivoXLS() {
			$xls = new ExportXLS( $this->Arquivo );

			$xls->addHeader( $this->cabecalho );

			foreach ( $this->colecaoValores as $Ex ) :
				$xls->addRow( ( array ) $Ex );
			endforeach;

			$xls->sendFile();
		}
	}
