<?php
class fSimNao extends Field {
	function fSimNao($campo,$label="", $valor_default = 'N') {
		$this->tipo = 'fSimNao';
		$this->campo = $campo;
		$this->valor = "";
		$this->dbType = ' CHAR ';
		$this->label = $label;
		$this->setObrigatorio(true);
        $this->maxlength = '1';
        $this->valor_default = $valor_default;
	}
	
	function formatForm() {
		$s = '';
		
		$this->valor = (!$this->valor) ? $this->valor_default : $this->valor;

		if ( $this->valor && $this->valor == "S" ) {
			$sim = "checked";
			$nao = "";
		} else {
			$sim = "";
			$nao = "checked";
		}			
		
		$obrigatorio = $this->getObrigatorio();
		
		$s .= '<div class="radio">';
		$s .= '<label><input type="radio" '.$sim.' name="'.$this->campo.'" id="s_'.$this->campo.'" value="S" class="radio '.$obrigatorio.'" /> Sim</label>&nbsp;&nbsp;';	
		$s .= '<label><input type="radio" '.$nao.' name="'.$this->campo.'" id="n_'.$this->campo.'" value="N" class="radio" /> N&atilde;o</label>';		
		$s .= '</div>';
		
		return $s;
	
	}

	function formatListagem() {
		if ($this->valor == "S") 
			return "<div align=\"center\"><img src='".IMG_CLASSPATH."cms-bt-true.gif' class=\"fSimNao\" title=\"".$this->campo."#S\" /></div>";
		else
			return "<div align=\"center\"><img src='".IMG_CLASSPATH."cms-bt-false.gif' class=\"fSimNao\" title=\"".$this->campo."#N\" /></div>";
	}
	function getCampo(){
		return $this->campo;
	}
}

?>