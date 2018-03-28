<?php
class fTextArea extends Field {
	function fTextArea($campo,$label="",$obrigatorio=false,$width="",$visible=true, $limite=null) {
		$this->tipo = 'fTextArea';
		$this->campo = $campo;
		$this->valor = "";
		$this->tipoBusca = "%";
        $this->maxlength = 0;
		$this->setObrigatorio($obrigatorio);
		$this->label = $label;
		$this->dbType = ' TEXT ';
		$this->visible = $visible;
		$this->limite = $limite;
	}
	
	function formatForm() {
		$readonly = "";
		if ($this->readonly == 1)
			$readonly = ' readonly="readonly" ';

		$width = '';
		if (isset($this->width))
			$width = ' style="width:'.$this->width.';" ';
			
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();
		
		$this->valor = str_replace('"','&quot;',$this->valor);

		$s = "";

		$onkeyup = '';
		if ( !is_null( $this->limite ) )
			$onkeyup = ' onkeyup="limitaTextArea(\'' . $this->campo . '\',' . $this->limite . ')" ';

		$s .= '<textarea class="input-text '.$obrigatorio.' '.$this->validacao.' " style="height: 150px;" '.$width.' name="'.$this->campo.'" id="'.$this->campo.'" '.$readonly. $onkeyup . '>'.$this->valor.'</textarea>';

		if ( !is_null( $this->limite ) )
			$s .= '<br /><span id="contador' . $this->campo . '"><span>0</span> de ' . $this->limite . '</span>';

		if ( $this->valor && !empty( $this->limite ) )
			$s .= '<script language="javascript" type="text/javascript"> limitaTextArea(\'' . $this->campo . '\',' . $this->limite . '); </script>';

		return $s;
	}

	function formatListagem() {
		$this->valor = str_replace('"','&quot;',str_replace(chr(10),"<br>",$this->valor));
		
		return $this->valor;
	}
	
	function prePost() {
		$this->valor = str_replace(chr(10).chr(13),chr(10),$this->valor);
		$this->valor = str_replace(chr(13).chr(10),chr(10),$this->valor);
	}
	
	function getCampo(){
		return $this->campo;
	}
}

?>
