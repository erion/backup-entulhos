<?

class stdVideos extends db {
	var $tabela;
	var $chave;
	var $fk;
	var $campo_video;
	var $campo_titulo;
	
	function stdVideos($tabela, $chave, $fk, $campo_video, $campo_titulo="", $cod="") {
		$this->tabela = $tabela;
		$this->chave = $chave;
		$this->fk = $fk;
		$this->campo_video = $campo_video;
		$this->campo_titulo = $campo_titulo;
		$this->configDb($cod);
	}
	
	function getVideos($cod) {
		$db = new db();
		
		$vQuery = "SELECT * FROM ".$this->tabela." WHERE ".$this->fk."=".$cod;
		$rs = $db->query($vQuery);
		
		return $rs;		
	}
	
	function getVideo($codvideo) {
		$db = new db();
		$vQuery = "SELECT * FROM ".$this->tabela." WHERE ".$this->chave."=".$codvideo;
		$rs = $db->query($vQuery);
		return $rs;
	}
}

?>