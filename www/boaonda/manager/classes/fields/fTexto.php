<?php
class fTexto extends Field {
	function fTexto($campo, $label='', $obrigatorio=true, $width='550', $rows='10', $cols=null ) {
		$this->tipo = 'fTexto';
		$this->campo = $campo;
		$this->valor = "";
		$this->label = $label;
		$this->readonly = false;
		$this->setObrigatorio($obrigatorio);
		$this->dbType = ' TEXT ';
		$this->width = $width;
		$this->rows = $rows;
		$this->cols = $cols;
	}

	function formatForm() {
		$obrigatorio = $this->getObrigatorio();
		$validacao = $this->getValidacao();
		$label = $this->getLabel();

		$this->valor = str_replace("<br>",chr(13),$this->valor);
		
		$readonly = '';
		if ( $this->readonly == true )
			$readonly = ' readonly="readonly" ';

		$width = '';
		if (isset($this->width))
			$width = ' style="width:'.$this->width.'px;" ';
		
		$s = '<textarea class="input-text '.$obrigatorio.' " rows="' . $this->rows . '" name="'.$this->campo.'" id="'.$this->campo.'" '.$width.' '.$readonly.' '.$validacao.' '.$label.' >'.$this->valor.'</textarea>';

		/*
		$s .= '<script type="text/javascript" src="comum/js/tiny_mce/tiny_mce.js"></script>';
		$s .= '<script type="text/javascript">
				tinyMCE.init({
					mode : "exact",
					elements : "'.$this->campo.'",
					theme : "advanced",
					plugins : "advimage",
					width: ' . $this->width . '
				});
			</script>';
		*/
		return $s;
	}

	function formatListagem() {
		$valor = strip_tags( $this->valor );
		$valor = str_replace(chr(10),"",$valor);
		if( strlen($valor) > 255 ) {			
			$valor = substr($valor, 0, 255) . "...";
		} 
		
		
		return $valor;
	}
	
	function prePost() {
		$this->valor = stripslashes($this->valor);
	}
	
	function getCampo(){
		return $this->campo;
	}
}

?>
