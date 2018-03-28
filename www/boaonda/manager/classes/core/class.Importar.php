<?php
	class Importar extends Utils {
		private $nome = NULL;
		private $tmpNome = NULL;
		private $arquivo = NULL;
		private $colecaoCabecalho = array();
		private $colecaoDados = array();

		public function __construct( $tmpNome, $nome, $deb = false ){
			$this->nome = '../uploads/' . $nome;
			$this->tmpNome = $tmpNome;

			move_uploaded_file( $this->tmpNome, $this->nome ) or die( 'Erro ao salvar o arquivo "' . $this->nome . '"!' );

			$this->Abrir()->Executar()->Fechar();

			if ( $deb )
				deb( $this );

			return $this;
		}

		public function getDados() {
			return $this->colecaoDados;
		}

		private function Abrir() {
			$this->arquivo = fopen( $this->nome, "r" );

			return $this;
		}

		private function Executar() {
			$temp = array();
			$colecaoCabecalho = true;
			while( ( $linha = fgetcsv( $this->arquivo, 0, ";" ) ) !== FALSE ) {
				if ( !is_array( $colecaoCabecalho ) ) {
					$colecaoCabecalho = array();

					foreach ( $linha as $coluna ) {
						if ( Utils::codificacao( $coluna ) == 'UTF-8' )
							$coluna = utf8_decode( $coluna );

						$colecaoCabecalho[] = $coluna;
					}

					$this->colecaoCabecalho = $colecaoCabecalho;
				} else {
					$Coluna = new stdClass();
					foreach ( $linha as $key => $coluna ) {
						$cabecalho = $this->colecaoCabecalho[ $key ];

						if ( Utils::codificacao( $coluna ) == 'UTF-8' )
							$coluna = utf8_decode( $coluna );

						$Coluna->$cabecalho = $coluna;
					}

					$this->colecaoDados[] = $Coluna;
				}
			}

			return $this;
		}

		private function Fechar() {
			fclose( $this->arquivo );

			unlink( $this->nome );

			return $this;
		}
	}
