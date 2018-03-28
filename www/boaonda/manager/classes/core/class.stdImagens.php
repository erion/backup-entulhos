<?

class stdImagens extends db {
	var $tabela;
	var $chave;
	var $fk;
	var $campo_imagem;
	var $campo_legenda;
	
	function stdImagens($tabela, $chave, $fk, $campo_imagem, $campo_legenda="", $cod="") {
		$this->tabela = $tabela;
		$this->chave = $chave;
		$this->fk = $fk;
		$this->campo_imagem = $campo_imagem;
		$this->campo_legenda = $campo_legenda;
		$this->configDb($cod);
	}
	
	function getImagens($cod) {
		$db = new db();
		
		$vQuery = "SELECT * FROM ".$this->tabela." WHERE ".$this->fk."=".$cod;
		$rs = $db->query($vQuery);
		
		return $rs;		
	}
	
	function getImagem($codimagem) {
		$db = new db();
		$vQuery = "SELECT * FROM ".$this->tabela." WHERE ".$this->chave."=".$codimagem;
		$rs = $db->query($vQuery);
		return $rs;
	}
}

?>