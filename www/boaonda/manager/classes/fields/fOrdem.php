<?
class fOrdem extends Field {
	var $campoLista;
	
	function fOrdem($campo,$campoLista, $tabela, $chave) {
		$this->tipo = 'fOrdem';
		$this->campo = $campo;
		$this->campoLista = $campoLista;
		$this->valor = "";
		$this->tabela = $tabela;
		$this->chave = $chave;
	}
	
	function formatForm() {
		$s = "";
		return $s;
	}

	function formatListagem() {
		$objFld = array();
		$objFld["campo"] = $this->campo;
		$objFld["campoLista"] = $this->campoLista;
		
		$db = new db();
		
		$vQuery = "SELECT ".$objFld['campo'];
		
		if ($objFld["campoLista"] != "")
			$vQuery .= ", ".$objFld["campoLista"];
		
		$vQuery .= " FROM ".$this->tabela." WHERE ".$this->chave."=".$this->codObjeto;
		$rsQuery = $db->query($vQuery);
		
		$vQuery = "SELECT max(".$objFld["campo"].") as maxval FROM ".$this->tabela;
		if ($objFld["campoLista"] != "")
			$vQuery .= " WHERE ".$objFld["campoLista"]."=".$rsQuery->Fields($objFld["campoLista"]);
		$rsMax = $db->query($vQuery);
		
		$objFld["valor"] = intval($rsQuery->Fields($objFld["campo"]));
		if ($objFld["campoLista"] != "")
			$objFld["lista"] = intval($rsQuery->Fields($objFld["campoLista"]));
		$objFld["maxval"] = intval($rsMax->Fields('maxval'));				
		
		$vURLup = '<a href="javascript: jah(\'listagem.php?objeto='.$_GET['objeto'].'&action=_goUp&cod='.$_GET["cod"].'\',\'contents\', \'showHtml\')" >';
		$vURLdown = '<a href="javascript: jah(\'listagem.php?objeto='.$_GET['objeto'].'&action=_goDown&cod='.$_GET["cod"].'\',\'contents\', \'showHtml\')" >';
		
		if ($objFld["valor"] == 1)
			$s = '<img src="../manager/_img/bto-up-inativo.gif" />';
		else
			$s = $vURLup.'<img src="../manager/_img/bto-up-ativo.gif" border="0" /></a>';
		
		$s .= '&nbsp;';
		if ($objFld["valor"] == $objFld["maxval"])
			$s .= '<img src="../manager/_img/bto-down-inativo.gif" />';
		else
			$s .= $vURLdown.'<img src="../manager/_img/bto-down-ativo.gif" border="0" /></a>';
		return $s;
	}
}

?>