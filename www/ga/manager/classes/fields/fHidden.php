<?
class fHidden extends Field {
	function fHidden($campo,$label="",$obrigatorio=false,$maxLength=255,$visible=false) {
		$this->tipo = 'fHidden';
		$this->campo = $campo;
		$this->valor = "";
		$this->tipoBusca = "%";
        $this->maxlength = $maxLength;
		$this->setObrigatorio($obrigatorio);
		$this->label = $label;
		$this->dbType = ' VARCHAR ';
		$this->visible = $visible;
	}
	
	
	function formatForm() {
		$s = $this->valor;
		$s .= '<input type="hidden" name="'.$this->campo.'" id="'.$this->campo.'" value="'.$this->valor.'" />';

		return $s;
	}

	function formatListagem() {
		return $this->valor;
	}
}

?>