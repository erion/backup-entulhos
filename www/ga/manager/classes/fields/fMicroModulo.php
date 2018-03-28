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
		$codpai = isset($_GET['cod']) ? $_GET['cod'] : "";
		
		$objeto = new $classe();

		$acao = $_GET['acao'];
		
		if($acao == 'cadastro' && $codpai) {
			$acoes = $objeto->getMenuAcoes();
			if (isset($objeto->campos[$this->chavePai])) { $objeto->campos[$this->chavePai] = $codpai; }
			
			$html = '<div id="'.$campo.'_container" class="campoMicroModulo">';
			
			foreach ($acoes as $acao => $label) {
				if ($acao == "listagem") {
					$class = "ativar_listagem";
				} else {
					$class = "";
				}
				
				$html .= '<a href="javascript:toggleView(\''.$classe.'\',\''.$acao.'\',\''.$campo.'\',\''.$codpai.'\');" class="'.$class.' bt-listagem">'.$label.'</a>';
				$html .= '<input type="hidden" name="'.$campo.'_'.$acao.'_field" id="'.$campo.'_'.$acao.'_field" value="'.$this->chavePai.'" />';
				$html .= '<div id="'.$campo.'_'.$acao.'" style="padding: 5px; border: 1px solid #ccc; display: none;"></div>';
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

?>
