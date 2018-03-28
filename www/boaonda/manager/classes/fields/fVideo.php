<?
class fVideo extends Field {    
	var $caminho;
	var $height;
	
	function fVideo($campo,$caminho,$width=320,$height=240) {
		$this->tipo = 'fVideo';
		$this->campo = $campo;
		$this->valor = "";
		$this->tipoBusca = "%";
		$this->maxlength = 255;
		$this->caminho = $caminho;
		$this->width = $width;
		$this->height = $height;
	}
	
	function formatForm() {
		$html = '<div id="'.$this->campo.'_div"></div>
				<script language="javascript" type="text/javascript">
					var so = new SWFObject("video.swf", "swf'.$this->campo.'", "'.$this->width.'", "'.$this->height.'", "9", "#FFFFFF");
					so.addParam("menu", "false");
					so.addParam("allowScriptAccess","sameDomain");
					so.addParam("wmode", "transparent");
					so.addParam("flashvars","video='.$this->caminho.$this->valor.".flv".'");
					so.write("'.$this->campo.'_div");
				</script>';
		
		return $html;
	}

	function formatListagem() {
		$s = $this->caminho.$this->valor.".flv";
		return $this->valor;
	}
}

?>