<?php
class fCharAdd extends Field {
	function fCharAdd($campo,$label="",$obrigatorio=true,$maxLength=255,$width="",$visible=true) {
		$this->tipo = 'fCharAdd';
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
		if ($this->readonly == 1) {
			$readonly = ' readonly="readonly" ';
		} else {
			$readonly = "";
		}

		if (isset($this->width))
			$width = ' style="width:'.$this->width.';" ';
		else
			$width = '';
			
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();
		
		$this->valor = str_replace('"','&quot;',$this->valor);

		$s = '<input onkeyup="multiplica(this.value, \'retorno_'.$this->campo.'\')" class="input-text '.$obrigatorio.' '.$this->validacao.' " '.$width.' name="'.$this->campo.'" id="'.$this->campo.'" maxlength="'.$this->maxlength.'" value="'.$this->valor.'" '.$readonly.' />';
		$s.= '<div><ul id="retorno_'.$this->campo.'"></ul></div>';
		return $s;
	}

	function formatListagem() {
		$this->valor = str_replace('"','&quot;',$this->valor);
		return $this->valor;
	}
	function getCampo(){
		return $this->campo;
	}
}

?>