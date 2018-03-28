<?
class fRadio extends Field {
	var $valores;
	var $valor;
	
	function fRadio($campo, $label, $valores, $valor_default = '', $maxlength=1, $obrigatorio=false) {
		$this->tipo = 'fRadio';
		$this->campo = $campo;
		$this->valores = $valores;
		$this->valor = "";
		$this->dbType = ' CHAR ';
        $this->maxlength = $maxlength;
		$this->setObrigatorio($obrigatorio);
		$this->label = $label;
		$this->valor_default = $valor_default;
	}
	
	function formatForm() {
		$s = '<div class="campoRadio">';

		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$fieldlabel = $this->getLabel();
		
		$primeiro = true;
		foreach ($this->valores as $cod => $label) {
			
			if( $this->valor ) {
			
				if ($cod == $this->valor)
					$checked = "checked";
				else 
					$checked = "";
					
			} else if( $this->valor_default ) {
				
				if ($cod == $this->valor_default ) 
					$checked = "checked";
				else 
					$checked = "";
				
			} else
				$checked = "";
				
			if ( $primeiro ) {
				$s .= '<input type="radio" name="'.$this->campo.'" id="'.$this->campo.'_'.$cod.'" value="'.$cod.'" '.$checked.' '.$fieldlabel.' class="'.$obrigatorio.'" /> <label for="'.$this->campo.'_'.$cod.'">'.$label.'</label>';
				$primeiro = false;
			} else 
				$s .= '<input type="radio" name="'.$this->campo.'" id="'.$this->campo.'_'.$cod.'" value="'.$cod.'" '.$checked.' /> <label for="'.$this->campo.'_'.$cod.'">'.$label.'</label>';
			
		}
			
		$s .= '</div>';

		return $s;
	}

	function formatListagem() {
		return $this->valores[$this->valor];
	}
	function getCampo(){
		return $this->campo;
	}
}

?>