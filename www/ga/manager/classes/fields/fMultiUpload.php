<?
class fMultiUpload extends Field {
	var $checkbox;
	var $checkboxTexto;
	var $caminho;
	var $legenda;
	var $campos;
	var $fk;
	var $campoImagem;
	var $campoLegenda;
	var $chave;
	var $stdImagem;
	var $texto1;
	var $texto2;
	
	function fMultiUpload($campo, $label, $tabela, $campoImagem, $campoLegenda, $fk, $chave, $caminho="../uploads/", $thumbs=array(), $quantidade=5, $checkbox="false", $checkboxTexto="", $legenda=true) {
		$this->tipo = 'fMultiUpload';
		$this->campo = $campo;
		$this->label = $label;
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
		$this->thumbs = $thumbs;
		$this->texto1 = "Imagem(ns) selecionada(s):";
		$this->texto2 = "Imagem(ns) existente(s):";
		$this->capturarValor = true;
		
		if ($campoLegenda == "") {
			$this->legenda = false;
		}
		
		$this->stdImagem = new stdImagens($tabela, $chave, $fk, $campoImagem, $campoLegenda);
		
		$this->verifyPath();
		$this->verifyTable();
	}
	
	function getSQL(){
		return "";
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

	
	function verifyTable() {
		$objs = array();
		
		$objs[] = new fId($this->chave);
		$objs[] = new fInt($this->fk,$this->fk);
		$objs[] = new fChar($this->campoImagem,$this->campoImagem, false);
		$objs[] = new fRadio('Destaque', 'Destaque:', 'S');
		
		foreach ($this->thumbs as $nomeCampo => $thumbObj) {
			if ($nomeCampo != $this->campoImagem) {
				$objs[] = new fChar($nomeCampo, $nomeCampo, false);
			}
		}
		
		if ($this->legenda) {
			$objs[] = new fChar($this->campoLegenda, $this->campoLegenda, false);
		}
		
		$campos = '';
		foreach($objs as $valor){
			if (strlen($campos) > 0) { $campos .= ','; }
			$campos .= $valor->getSQL();
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS ".$this->tabela." ( ".$campos." ) ENGINE=Innodb ";

		$db = new db();
		//$db->debug = true;
		$db->query( $sql );
	}
	
	function formatForm() {
		$texto1 = $this->texto1;
		$texto2 = $this->texto2;
		$valor = $this->valor;
		
		$s = '<input id="'.$this->campo.'" class="input_upload" name="'.$this->campo.'" type="file" />
				<div class="form-multiple-upload" id="formMultipleUpload" style="display:none;">
					<div id="msg_'.$this->campo.'" style="display:none;" >
					<br /><strong>'.$texto1.'</strong><br />
					<br />
					</div>
					<div class="divUpload" id="mu_'.$this->campo.'" style="display:none;"></div>				
					<script type="text/javascript">
					var ms_'.$this->campo.' = new MultiSelector( document.getElementById( "mu_'.$this->campo.'" ), '.$this->quantidade.', "'.$this->campo.'", '.$this->checkbox.', "'.$this->checkboxTexto.'", "'.$this->legenda.'");
					ms_'.$this->campo.'.addElement( document.getElementById( "'.$this->campo.'" ) );
					</script>
					<div class="clr"></div>
				</div>';

		if (is_array($valor) && !empty($valor))
		{	
			$s .= '
			<div class="imgExistentes">
			<br />
			<strong>'.$texto2.'</strong>
			<br />
			<br />
			<div class="divUpload" id="muatuais_'.$this->campo.'">';
				foreach($valor as $aImg)
				{
					$imagem = $aImg["imagem"];
					$legenda = $aImg["legenda"];
					$codimagem = $aImg["codimagem"];
					$checkboxChecked = $aImg["checkbox"];
					
					$exibe_news = 'N';
					if ( array_key_exists( 'exibe_news', $aImg ) )
						$exibe_news = $aImg["exibe_news"];
					
					$chk = '';
					if ( $exibe_news == 'S' )
						$chk = 'checked';
			
					$s .= '<div class="divImgContainer" id="div_'.$this->campo.'_'.$codimagem.'">';
					
					if ((strtoupper(substr($imagem,strlen($imagem)-3,3)) == "JPG")) {
						$s .= '<img align="left" src="thumb.php?img='.$imagem.'" title="'.$imagem.'" />';
					} else {
						$s .= '<a href="'.$this->caminho."/".$imagem.'" target="visualizarArquivo" />'.$imagem.'</a>';
					}

					if ($this->legenda == "true") {
						$s .= '<div>Legenda:
						<input type="text" class="input_legenda" name="leg_'.$this->campo.'_'.$codimagem.'" id="leg_'.$this->campo.'_'.$codimagem.'" value="'.$legenda.'" />
						</div>';
					}
					
					if ( $this->checkbox == "true" ) {
						$chk = '';
						if ( $checkboxChecked == 'S' )
							$chk = 'checked';
						$s .= '<label><input type="checkbox" ' . $chk . ' id="chk_' . $this->campo . '_' . $codimagem . '" name="chk_'.$this->campo.'_'.$codimagem.'" value="S" /> '.$this->checkboxTexto.'</label><br />';
					} 
	
					$s .= ' <input type="hidden" id="hdn_'.$this->campo.'_'.$codimagem.'" name="hdn_'.$this->campo.'_'.$codimagem.'" style="display:none;">
							<a href="javascript:removerImagem(\''.$codimagem.'\', \''.$this->campo.'\');" class="botao-remover pcb grey-button"><span>Remover</span></a>
							<br />';
													
					$s .= '</div>';
				}
			$s .= '</div><div class="clr"></div></div>
			<script>multiUploadCustom();</script>';
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
				$leg = '';
				if ( isset( $_POST[ 'leg_' . $this->campo . '_' . $codimagem ] ) )
					$leg = $_POST[ 'leg_' . $this->campo . '_' . $codimagem ];
				
				$destaque = 'N';
				if ( isset( $_POST[ 'chk_' . $this->campo . '_' . $codimagem ] ) && $_POST[ 'chk_' . $this->campo . '_' . $codimagem ] == 'S' )
					$destaque = 'S';

				$o->campos[ $this->campoLegenda ] = $leg;
				$o->campos[ 'Destaque' ] = $destaque;
				$o->_update( $this->chave . " = " . $codimagem );
			}
	
			$rsImgs->MoveNext();
		}


		// Novos Uploads.
		$num_arquivos = $this->quantidade;
		for($a=0; $a<$num_arquivos; $a++) {
			if (isset($_FILES[$this->campo."_".$a]) && $_FILES[$this->campo."_".$a]["name"] != "")
			{
				$nomeArquivo = $this->doUpload($this->campo."_".$a);
				
				$leg = '';
				if ( isset( $_POST[ 'l_' . $a . '_' . $this->campo ] ) )
					$leg = $_POST[ 'l_' . $a . '_' . $this->campo ];
				
				$destaque = 'N';
				if ( isset( $_POST[ 'chk_' . $this->campo . '_' . $codimagem ] ) && $_POST[ 'chk_' . $this->campo . '_' . $codimagem ] == 'S' )
					$destaque = 'S';
				
				$this->addImagem($nomeArquivo, $leg, $cod);
				if (count($this->thumbs) > 0) {
					@unlink($this->caminho.$nomeArquivo);
				}
			}
		}
	}
	
	function capturarValor($cod) {
		$db = new db();
		$query = "SELECT * FROM ".$this->tabela." WHERE ".$this->fk."='".$cod."'";
		$rs = $db->query($query);
		
		$arrImgs = array();
		
		while (!$rs->EOF) {
			$arrValor = array();
			$arrValor["imagem"] = $rs->fields($this->campoImagem);
			$arrValor["codimagem"] = $rs->fields($this->chave);
			
			$arrValor["legenda"] = '';
			if ( $this->legenda )
				$arrValor["legenda"] = $rs->fields($this->campoLegenda);
				
			$arrValor[ 'checkbox' ] = '';
			if ( $this->legenda )
				$arrValor[ 'checkbox' ] = $rs->fields( $this->checkboxTexto );
			
			$arrImgs[] = $arrValor;
			unset( $arrValores );
			$rs->MoveNext();
		}
		
		$this->valor = $arrImgs;
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
		if(!empty($this->valor[0]['imagem']) && $this->valor[0]['imagem'] != '') {
			$caminhoImagem = $this->caminho.$this->valor[0]['imagem'];
			$imagem = '<img src="'.$caminhoImagem.'" border="0" width="50" height="50" />'; 
		} else $imagem = 'Sem imagem';	
		return $imagem;
	}
}

?>
