<?
class fMultiUploadRadio extends Field {
	var $checkbox;
	var $checkboxTexto;
	var $caminho;
	var $legenda;
	var $tabela;
	var $fk;
	var $campoImagem;
	var $campoLegenda;
	var $chave;
	var $stdImagem;
	var $texto1;
	var $texto2;
	
	function fMultiUploadRadio($campo, $tabela, $campoImagem, $campoLegenda, $fk, $chave, $caminho="../imgs/default/", $campo_radio="capa", $thumbs=array(), $quantidade=5, $checkbox="false", $checkboxTexto="", $legenda=true) {
		$this->tipo = 'fMultiUploadRadio';
		$this->campo = $campo;
		$this->quantidade = $quantidade;
		$this->checkbox = $checkbox;
		$this->checkboxTexto = $checkboxTexto;
		$this->legenda = $legenda;
		$this->caminho = $caminho;		
		$this->tabela = $tabela;
		$this->campoImagem = $campoImagem;
		$this->campoLegenda = $campoLegenda;
		$this->fk = $fk;
		$this->chave = $chave;
		$this->campoRadio = $campo_radio;
		$this->thumbs = $thumbs;
		$this->texto1 = "Imagem(ns) selecionada(s):";
		$this->texto2 = "Imagem(ns) existente(s):";
		
		if ($campoLegenda == "") {
			$this->legenda = false;
		}
		
		$this->stdImagem = new stdImagens($tabela, $chave, $fk, $campoImagem, $campoLegenda);
	}
	
	function formatForm() {
		$texto1 = $this->texto1;
		$texto2 = $this->texto2;
		$valor = $this->valor;
		$s = '<input id="'.$this->campo.'" class="input_upload" name="'.$this->campo.'" type="file" />
				<div id="msg_'.$this->campo.'" style="display:none;" >
				<br />
				'.$texto1.'<br />
				<br />
				</div>
				<div class="divUpload" id="mu_'.$this->campo.'" style="display:none;"></div>
				<script type="text/javascript">
				var ms_'.$this->campo.' = new MultiSelector( document.getElementById( "mu_'.$this->campo.'" ), '.$this->quantidade.', "'.$this->campo.'", '.$this->checkbox.', "'.$this->checkboxTexto.'", "'.$this->legenda.'");
				ms_'.$this->campo.'.addElement( document.getElementById( "'.$this->campo.'" ) );
				</script>';

		if (is_array($valor) && !empty($valor))
		{	
			$s .= '<br />
			'.$texto2.'
			<br />
			<br />
			<div class="divUpload" id="muatuais_'.$this->campo.'">';
				foreach($valor as $aImg)
				{
					$imagem = $aImg["imagem"];
					$legenda = $aImg["legenda"];
					$codimagem = $aImg["codimagem"];
					if (array_key_exists('exibe_news',$aImg)) {
						$exibe_news = $aImg["exibe_news"];
					} else {
						$exibe_news = 'N';
					}
					
					if ($exibe_news == "S")
						$chk = "checked";
					else
						$chk = "";
			
					$s .= '<div class="divImgContainer" id="div_'.$this->campo.'_'.$codimagem.'">';
					
					if ((strtoupper(substr($imagem,strlen($imagem)-3,3)) == "JPG")) {
						$s .= '<img height="48" align="left" src="'.$this->caminho."/".$imagem.'" title="'.$imagem.'" />';
					} else {
						$s .= '<a href="'.$this->caminho."/".$imagem.'" target="visualizarArquivo" />'.$imagem.'</a>';
					}

					if ($this->legenda == "true")
					{
						$s .= '<div>
						<input id="'.$this->campo.'_radio" class="radio" name="'.$this->campo.'_radio" type="radio" />
						<input type="text" class="input_legenda" name="leg_'.$this->campo.'_'.$codimagem.'" id="leg_'.$this->campo.'_'.$codimagem.'" value="'.Utils::isoEncode($legenda).'" />
						</div>';
					}				
	
					$s .= ' <input type="hidden" id="hdn_'.$this->campo.'_'.$codimagem.'" name="hdn_'.$this->campo.'_'.$codimagem.'" style="display:none;">
												<a href="javascript:removerImagem(\''.$codimagem.'\', \''.$this->campo.'\');">Remover</a>
												<br />';
					if ($this->checkbox == "true")
					{				
						$s .= '<input type="checkbox" '.$chk.' id="chk_'.$this->campo.'_'.$codimagem.'" name="chk_'.$this->campo.'_'.$codimagem.'" value="S" /> '.$this->checkboxTexto;
					} 
	
					$s .= '</div>';
				}
			$s .= '</div>';
		}
		return $s;
	}
	
	function doPost($cod) {
		// Uploads existentes.
		$rsImgs = $this->stdImagem->getImagens($cod);
		while (!$rsImgs->EOF)
		{
			$codimagem = $rsImgs->Fields($this->chave);
			
			$o = new stdImagens($this->tabela, $this->chave, $this->fk, $this->campoImagem, $this->campoLegenda, $codimagem);
	
			if (isset($_POST["hdn_".$this->campo."_".$codimagem]) && $_POST["hdn_".$this->campo."_".$codimagem] != "") {
				$this->delImagem($codimagem, $this->caminho);
			} else {
				if (isset($_POST['leg_'.$this->campo.'_'.$codimagem])) {
					$leg = $_POST['leg_'.$this->campo.'_'.$codimagem];
				} else {
					$leg = "";
				}
				
				if (isset($_POST[$this->campo.'_radio']) && $_POST[$this->campo.'_radio'] == $codimagem) {
					$rdo = 'S';
				} else {
					$rdo = 'N';
				}
				
				$o->campos[$this->campoRadio] = $do;
				$o->campos[$this->campoLegenda] = $leg;
				$o->_update($this->chave."=".$codimagem);
			}
	
			$rsImgs->MoveNext();
		}


		// Novos Uploads.
		$num_arquivos = $this->quantidade;
		for($a=0; $a<$num_arquivos; $a++) {
			if (isset($_FILES[$this->campo."_".$a]) && $_FILES[$this->campo."_".$a]["name"] != "")
			{
				$nomeArquivo = $this->doUpload($this->campo."_".$a);
				
				if (isset($_POST["l_".$a."_".$this->campo]))
					$leg = $_POST["l_".$a."_".$this->campo];
				else
					$leg = "";
				
				$this->addImagem($nomeArquivo, $leg, $cod);
				if (count($this->thumbs) > 0) {
					@unlink($this->caminho.$nomeArquivo);
				}
			}
		}
	}
	
	function doUpload($file) {
		$tmpFileName = Utils::fileNameTest($_FILES[$file]['name'],$this->caminho);
		$tmpNewFile = $this->caminho.$tmpFileName;
		move_uploaded_file($_FILES[$file]['tmp_name'],$tmpNewFile);
		$_FILES[$file]['name'] = $tmpFileName;
		return $tmpFileName;
	}
	
	function addImagem($arquivo, $legenda, $cod) {
		$db = new db();
		$o = new stdImagens($this->tabela, $this->chave, $this->fk, $this->campoImagem, $this->campoLegenda, "");
		
		$o->campos[$this->fk] = $cod;
		if ($this->legenda) {
			$o->campos[$this->campoLegenda] = $legenda;
		}
		
		$o->campos[$this->campoRadio] = 'N';		
		
		if (count($this->thumbs) > 0) {
			foreach ($this->thumbs as $campo => $arr) {		
				$tmpFile = $arr['nome'].$arquivo;
				$tmpFile = Utils::fileNameTest($tmpFile,$this->caminho);
				$o->campos[$campo] = $tmpFile;
				
				$thumb = new Thumb($this->caminho.$arquivo, $arr['width'], $arr['height']);
				if ($arr['force'] == true) {
					$thumb->ForceThumb();
				}
				$thumb->writeThumb($this->caminho.$tmpFile);
			}
		} else {
			$o->campos[$this->campoImagem] = $arquivo;
		}
		
		$cod = $o->_insert();
	}
	
	function delImagem($codimagem)
	{
		$db = new db();
		$o = new stdImagens($this->tabela, $this->chave, $this->fk, $this->campoImagem, $this->campoLegenda, $codimagem);

		foreach ($this->thumbs as $campo => $arr) {		
			if (file_exists($this->caminho."/".$o->campos[$campo]))
				unlink($this->caminho."/".$o->campos[$campo]);
			
		}
		$db->_delete($this->tabela, $this->chave."=".$codimagem);
	}
	
	function formatListagem() {
		return $this->valor;
	}
}

?>
