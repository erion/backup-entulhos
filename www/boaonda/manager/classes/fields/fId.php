<?php
class fId extends Field{
	var $tipo;
	var $campo;
	var $obrigatorio;
	var $tamanho;
	function fId($campo) {
		$this->tipo = 'fId';
		$this->campo = $campo;
		$this->dbType = ' PRIMARY ';
		$this->visible = false;
		$this->valor = "";
	}
	function getCampo(){
		return $this->campo;
	}
}

?>