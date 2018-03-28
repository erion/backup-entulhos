<?php
class fMicroModulo extends Field {
	var $modulo;
	var $objetoPai;
	var $moduloPai;
	var $chavePai;
	
	function fMicroModulo($campo,$label,$modulo,$objPai) {
		$this->tipo = 'fMicroModulo';
		$this->campo = $campo;
		$this->valor = "";
		$this->label = $label;
		$this->modulo = $modulo;
		$this->objetoPai = $objPai;
		$this->moduloPai = get_class($objPai);
		$this->chavePai = $objPai->chave;
		$this->dbType = '';
	}
	
	function formatForm() {
		$campo = $this->campo;

		$classe = $this->modulo;
		$codpai = ($_GET['cod']) ? $_GET['cod'] : 0;

		$objeto = new $classe();

		$acao = $_GET['acao'];

		if($acao == 'cadastro' && $codpai) {
			$acoes = $objeto->getMenuAcoes();

			if (isset($objeto->campos[$this->chavePai])) { $objeto->campos[$this->chavePai] = $codpai; }
			
			$html = '<div id="'.$campo.'_container" class="campoMicroModulo" cod="'.$codpai.'" name="'.$this->modulo.'">';

			foreach ($acoes as $acao) {
				$class = "";
				if ( $acao[ 'acao' ] == "listagem" ) {
					
					$html .= '<a href="javascript:toggleView(\''.$classe.'\',\''.$acao[ 'acao' ].'\',\''.$campo.'\',\'' . $codpai . '\');" class="'.$class.' btn">'.$acao['titulo'].'</a>';
					$html .= '<script type="text/javascript">jQuery(function(){ toggleView( \'' . $classe . '\', \'' . $acao[ 'acao' ] . '\', \'' . $campo . '\', \'' . $codpai . '\' ); });</script>';		
					$html .= '<input type="hidden" name="' . $campo . '_' . $acao[ 'acao' ] . '_field" id="' . $campo . '_' . $acao[ 'acao' ] . '_field" value="' . $this->chavePai . '" />';			
				} else {
					$html .= '<a href="javascript:toggleView(\''.$classe.'\',\''.$acao[ 'acao' ].'\',\''.$campo.'\',\'' . $codpai . '\',\'adicionar\');" class="'.$class.' btn salvarMicromodulo">'.$acao['titulo'].'</a>';
					$html .= '<input type="hidden" name="' . $campo . '_' . $acao[ 'acao' ] . '_field" id="' . $campo . '_' . $acao[ 'acao' ] . '_field" value="' . $this->chavePai . '" />';			
				}

				$html .= '<div id="' . $campo . '_' . $acao[ 'acao' ] . '" style="padding: 5px; border: 1px solid #ccc; display: none;"></div>';
			}
						
			$html .= '</div>';
		} else {
			$html.= '-';
		}
		
		return $html;
	}

	function formatListagem() {
		return "";
	}
	
	function getCampo(){
		return $this->campo;
	}
}
