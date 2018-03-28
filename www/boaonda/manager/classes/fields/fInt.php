<?php
class fInt extends Field{
	var $tipo;
	var $campo;
	var $obrigatorio;
	var $tamanho;
	var $campo_busca;
	
	function fInt($campo,$label="",$visible=false,$tabela="",$campo_busca="") {
		$this->tipo = 'fInt';
		$this->campo = $campo;
		$this->dbType = ' INT ';
		$this->visible = $visible;
		$this->valor = "";
		$this->label = $label;
		$this->tabela = $tabela;
		$this->campo_busca = $campo_busca;
	}
	
	function getCampo(){
		return $this->campo;
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

		$s = '<input class="input-text '.$obrigatorio.' '.$this->validacao.' " '.$width.' name="'.$this->campo.'" id="'.$this->campo.'" maxlength="'.$this->maxlength.'" value="'.$this->valor.'" '.$readonly.' />';

		return $s;
	}
	
	function formatListagem() {
		if($this->tabela != '' && $this->campo_busca != ''){
			$db = new db();
			$rs = $db->query("SELECT * FROM ".$this->tabela." WHERE ".$this->campo." = '".$this->valor."'");
			return $rs->fields[$this->campo_busca];
		}else{
			return $this->valor;
		}
	}
}

?>