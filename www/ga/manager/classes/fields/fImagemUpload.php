<?php
class fImagemUpload extends Field {
	var $caminho;
	var $exclusao;
	var $thumbs;
	var $valores;				// Valores dos campos de thumb..
	
	function fImagemUpload($campo, $label="",$caminho = "",$visible=true, $thumbs=array(), $exclusao = true, $obrigatorio = true ) {
		$this->tipo = 'fImagemUpload';
		$this->campo = $campo;
		$this->caminho = $caminho;
		$this->valor = '';
		$this->label = $label;
		$this->exclusao = $exclusao;
		$this->thumbs = $thumbs;
		$this->valores = array();
        $this->maxlength = "150";
		$this->dbType = ' VARCHAR ';
		$this->visible = $visible;
		$this->setObrigatorio( $obrigatorio );
		
		$this->verifyPath();
	}
	
	function verifyPath() {
		if (is_dir($this->caminho)) {
			if (!is_writable($this->caminho)) {
				@chmod($this->caminho, 755);
			}
		} else {
			if (@mkdir($this->caminho, 755) === false) {
				system("mkdir ".$this->caminho,$mensagem);
				@chmod($this->caminho, 755);
			}
		}
	}
	
	function preDelete($obj) {
		if (file_exists($this->caminho.$this->valor)) {
			@unlink($this->caminho.$this->valor);
		}
	}
	
	function prePost() {
		
		if (isset($_POST['hdnUploadDel_'.$this->campo]) && $_POST['hdnUploadDel_'.$this->campo] != "") {
			$arquivo = $this->caminho.$_POST['hdnUpload_'.$this->campo];
			$_POST['hdnUpload_'.$this->campo] = "";
			if (file_exists($arquivo))
				@unlink($arquivo);
				
			foreach ($this->valores	as $campoThumb => $imagemThumb) {
				$arquivo = $this->caminho.$imagemThumb;
				if (file_exists($arquivo))
					@unlink($arquivo);
			}
		}
		
		if ((isset($_FILES[$this->campo]['name'])) && ($_FILES[$this->campo]['name'] != "")) {
			
			if (isset($_POST['hdnUpload_'.$this->campo]) && $_POST['hdnUpload_'.$this->campo] != "") {
				$arquivo = $this->caminho.$_POST['hdnUpload_'.$this->campo];
				$_POST['hdnUpload_'.$this->campo] = "";
				if (is_file($arquivo))
					unlink($arquivo);
			}

			$tmpExtesion = Utils::getFileExtension($_FILES[$this->campo]['name']);
			$tmpFileName = uniqid() .'.'. $tmpExtesion;
			
			$tmpNewFile = $this->caminho.$tmpFileName;
			move_uploaded_file($_FILES[$this->campo]['tmp_name'],$tmpNewFile);
			$this->valor = $tmpFileName;
			$_FILES[$this->campo]['name'] = $tmpFileName;
			
		} else {
			if (isset($_POST['hdnUpload_'.$this->campo])) {
				$this->valor = $_POST['hdnUpload_'.$this->campo];
			}
		}
	}
	
	function formatForm() {

		$width = '';
		if (isset($this->width))
			$width = ' style="width:'.$this->width.';" ';
		
		$s = '<input id="'.$this->campo.'" class="input_upload' . $this->getObrigatorio() . '" name="'.$this->campo.'" type="file" />';
		$tipo_arquivo = "O arquivo será removido";
		
		if ($this->valor != "") {
			if (file_exists($this->caminho.$this->valor)) {
				list($width, $height, $type, $attr) = getimagesize($this->caminho.$this->valor);
			} else {
				$width = 20;
				$height = 20;
			}
			$tamanhoX = 120;
			$tamanhoY = 120;

			if (($width >= $height) && ($width > $tamanhoX)) {
				$porcentagem = (100 * $tamanhoX)/$width;
				$tamanhoY = ($height * $porcentagem)/100;
			} else if ($height > $tamanhoY) {
				$porcentagem = (100 * $tamanhoY)/$height;
				$tamanhoX = ($width * $porcentagem)/100;
			} else {
				$tamanhoX = $width;
				$tamanhoY = $height;
			}
		}
		
		if ($this->valor != "") {

			$s .= '<div class="field_box" id="divUpload_'.$this->campo.'" style="padding:5px 0;">Arquivo existente:<br><a href="'.$this->caminho.$this->valor.'" class="ampliacao"><img src="'.$this->caminho.$this->valor.'" border="0" width="'.$tamanhoX.'" height="'.$tamanhoY.'" /></a>
				<input type="hidden" name="hdnUpload_'.$this->campo.'" id="hdnUpload_'.$this->campo.'" value="'.$this->valor.'" />';
	
			if ($this->exclusao && $this->valor != "") {
				$s .= '<br /><a class="btn" href="javascript: removerArquivo(\''.$this->campo.'\');"><span>Remover</span></a>
				<input type="checkbox" name="hdnUploadDel_'.$this->campo.'" id="hdnUploadDel_'.$this->campo.'" class="hidden" />';
			}
			$s .= '</div>';

			$s .= '<script language="javascript" type="text/javascript">
				$( "#' . $this->campo . '" ).removeClass( "required" );
				$(document).ready(function(){
				  $("a[rel^=prettyPhoto]").prettyPhoto();
				});
			 </script>';

		}		
		$s .= '<div id="divMsgUpload_'.$this->campo.'" style="display:none; padding:5px 0;"><span style="color:#FF0000;"><b>Removido</b></span><br />'.$tipo_arquivo.' quando os dados forem gravados.</div>';

		return $s;
	}

	function formatListagem() {
		if ($this->valor != "" && file_exists($this->caminho.$this->valor)) {
			list($width, $height, $type, $attr) = getimagesize($this->caminho.$this->valor);
			$tamanhoX = 50;
			$tamanhoY = 50;
			
			if (($width >= $height) && ($width > $tamanhoX)) {
				$porcentagem = (100 * $tamanhoX)/$width;
				$tamanhoY = ($height * $porcentagem)/100;
			} else if ($height > $tamanhoY) {
				$porcentagem = (100 * $tamanhoY)/$height;
				$tamanhoX = ($width * $porcentagem)/100;
			} else {
				$tamanhoX = $width;

				$tamanhoY = $height;
			}
			$imagem = '<img src="'.$this->caminho.$this->valor.'" border="0" width="'.$tamanhoX.'" height="'.$tamanhoY.'" />';

		} else {
			$imagem = "Sem imagem.";
		}
		
		return $imagem;
	}
	
	function doPost($cod, $classe) {
		if ((isset($_FILES[$this->campo]['name'])) && ($_FILES[$this->campo]['name'] != "") && ($this->valor != "")) {
			$arquivo = $this->valor;
			
			eval("$"."o = new ".$classe."(".$cod.");");
			$hasThumbToMainField = false;
			
			foreach ($this->thumbs as $campo => $arr) {		
				$tmpFile = $arr['nome'].$arquivo;
				$tmpFile = Utils::fileNameTest($tmpFile,$this->caminho);
				$o->campos[$campo] = $tmpFile;

				$thumb = new Thumb($this->caminho.$arquivo, $arr['width'], $arr['height']);
				if ($arr['force'] == true) {
					$thumb->ForceThumb();
				}
				$thumb->writeThumb($this->caminho.$tmpFile);
				
				if ($campo == $this->campo) {
					$hasThumbToMainField = true;
				}
			}
			
			if ($hasThumbToMainField) {
				@unlink($this->caminho.$this->valor);
			}
			
			$o->_update($o->chave."=".$cod);	
		} else if ((isset($_POST['hdnUploadDel_'.$this->campo])) && ($_POST['hdnUploadDel_'.$this->campo] != "") && (is_array($this->thumbs))) {
			eval("$"."o = new ".$classe."(".$cod.");");
			foreach ($this->thumbs as $campo => $arrConfig) {
				$o->campos[$campo] = '';
			}
			$o->_update($o->chave."=".$cod);
		}

	}
	function getCampo(){
		return $this->campo;
	}
}

