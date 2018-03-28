<?php
class fMultiVideo extends Field {
	var $titulo;
	var $descricao;
	var $campos;
	var $fk;
	var $campoVideo;
	var $campoTitulo;
	var $campoDescricao;
	var $chave;
	var $stdImagem;
	var $texto1;
	var $texto2;
	
	function fMultiVideo($campo, $label, $tabela, $campoVideo, $campoTitulo, $campoDescricao, $fk, $chave, $titulo=TRUE, $descricao=TRUE) {
		$this->tipo 		= 'fMultiVideo';
		$this->campo 		= $campo;
		$this->label 		= $label;
		$this->titulo 		= $titulo;		
		$this->descricao 	= $descricao;		
		$this->tabela 		= $tabela;
		$this->campoVideo 	= $campoVideo;
		$this->campoTitulo 	= $campoTitulo;
		$this->campoDescricao = $campoDescricao;
		$this->fk 			= $fk;
		$this->chave 		= $chave;
		$this->texto1 		= "Video(s) selecionado(s):";
		$this->texto2 		= "video(s) existente(s):";
		$this->capturarValor = true;
		
		$this->verifyTable();
		
		$this->stdVideo = new stdVideos($tabela, $chave, $fk, $campoVideo, $campoTitulo);
	}
	
	function getSQL(){
		return "";
	}

	
	function verifyTable() {
		$objs = array();
		
		$objs[] = new fId($this->chave);
		$objs[] = new fInt($this->fk,$this->fk);
		$objs[] = new fChar($this->campoVideo,$this->campoVideo, false);
		$objs[] = new fRadio('Destaque', 'Destaque:', 'S');
		
		if ($this->titulo) {
			$objs[] = new fChar($this->campoTitulo, $this->campoTitulo, false);
		}
		
		if ($this->descricao) {
			$objs[] = new fTextArea($this->campoDescricao, $this->campoDescricao, false);
		}
		
		$campos = '';
		foreach($objs as $valor){
			if (strlen($campos) > 0) { $campos .= ','; }
			$campos .= $valor->getSQL();
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS ".$this->tabela." ( ".$campos." ) ENGINE=Innodb ";

		$db = new db();
		$db->query( $sql );
	}
	
	function thumbVideo($video, $retorno = 'thumb'){
		
		if(stristr($video, 'vimeo') || is_numeric($video)){
			$video = end( explode( '/', $video ) );
			$video = reset( explode( '?', $video ) );

			if($video){
				$hash = unserialize( file_get_contents("http://vimeo.com/api/v2/video/{$video}.php" ) );
			
				$thumb = $hash[0]['thumbnail_medium'];
				
				if( !$thumb ) 
					$thumb = '';
			} else
				$thumb = '';

			$origem = 'Vimeo';
		}elseif(!is_null(stristr($video, 'youtube')) || !is_numeric( $video )){
			if ( stristr( $video, 'v=' ) )
				$video = end( explode( 'v=', $video ) );

			if ( stristr( $video, 'v/' ) )
				$video = end( explode( 'v/', $video ) );

			if ( stristr( $video, 'embed/' ) )
				$video = end( explode( 'embed/', $video ) );

			$video = reset( explode( '&', $video ) );

			$origem = 'YouTube';
			$thumb = 'http://i2.ytimg.com/vi/' . $video . '/default.jpg';

		}
		
		if($retorno == 'thumb')
			return $thumb;
		
		if($retorno == 'video')
			return $video;
	}
	
	function formatForm() {
		$texto1 = $this->texto1;
		$texto2 = $this->texto2;
		$valor = $this->valor;
		
		$campo = '\n\
					<li>\n\
						<img width=\"120\" src=\"d\" /><br /><br />\n\
						Titulo: <input type=\"text\" name=\"t_'.$this->campoVideo.'[]\" style=\"margin-left:20px; width:180px\" />\n\
						<br />\n\
						Descrição: <textarea rows=\"2\" name=\"d_'.$this->campoVideo.'[]\"> </textarea>\n\
						<br />\n\
						<a href=\"javascript:void();\" class=\"remover-video\" title=\"Remover\" onclick=\"$(this).parent(\'li\').remove();\">Remover</a>\n\
						<br />\n\
						<br />\n\
						<input type=\"hidden\" value=\"" + $(".input_video").val() + "\" name=\"v_'.$this->campoVideo.'[]\" />\n\
					</li>';

		$s = '	<input id="'.$this->campo.'" class="input_video" name="'.$this->campo.'" type="text" />
				<button title="Adicionar Video" class="btn-add-video"></button>
				<div class="form-multiple-upload" id="formMultipleVideos" style="display:none;">
					<div id="msg_'.$this->campo.'" >
						<br />
						<strong>'.$texto1.'</strong>
						<br />
						<br />
					</div>
					<div class="divVideos" id="mu_'.$this->campo.'">
						<ul></ul>
					</div>				
				</div>
				<script type="text/javascript">
					$(".btn-add-video").click(function(){
						if($(".input_video").val() == ""){
							return false;
						}
						$(".divVideos ul").append("' . $campo . '");
						thumbVideos($(".input_video").val(), ".divVideos ul li:last");
						$(".input_video").val("");
						$("#formMultipleVideos").fadeIn("fast");
						return false;
					});
				</script>';

		if (is_array($valor) && !empty($valor))
		{	
			$s .= '
			<div class="videosExistentes">
			<br />
			<strong>'.$texto2.'</strong>
			<br />
			<br />
			<div class="divUpload" id="muatuais_'.$this->campo.'">';
				foreach($valor as $aVideo){

					$galeriaVideoId = $aVideo["GaleriaVideoID"];
					$video 			= $aVideo["videoUrl"];
					$titulo 		= $aVideo["titulo"];
					$descricao 		= $aVideo["descricao"];
					$codvideo 		= $aVideo["codvideo"];
					$checkboxChecked = $aVideo["checkbox"];
					
					$exibe_news = 'N';
					if ( array_key_exists( 'exibe_news', $aVideo ) )
						$exibe_news = $aVideo["exibe_news"];
					
					$chk = '';
					if ( $exibe_news == 'S' )
						$chk = 'checked';
			
					$s .= '<div class="divVideoContainer" id="div_'.$this->campo.'_'.$codvideo.'">';
					
					$s .= '<img width="120" src="' . $this->thumbVideo($video) . '" />';

					if ($this->titulo == "true") {
						$s .= '	<div>Titulo:
									<input type="text" class="input_titulo" name="leg_'.$this->campo.'_' . $codvideo . '" id="leg_'.$this->campo.'_'.$codvideo.'" value="'.$titulo.'" style="margin-left:20px; width:175px" />
								</div>';
					}
					
					if ($this->descricao == "true") {
						$s .= '	<div>Descrição:
									<textarea name="desc_'.$this->campo.'_' . $codvideo . '">'.$descricao.'</textarea>
								</div>';
					}

					$s .= ' <input type="hidden" id="hdn_'.$this->campo.'_'.$codvideo.'" name="hdn_'.$this->campo.'[]" style="display:none;" value="' . $codvideo . '" />
							<a href="javascript:void(0);" class="botao-remover pcb grey-button" onclick="$(this).parent(\'div\').remove();"><span>Remover</span></a>
							<br />';
													
					$s .= '</div>';
				}
			$s .= '</div></div>';
		}
		return $s;
	}
	
	function doPost($cod) {
		// Uploads existentes.
		if(isset($_POST['v_VideoUrl'])){
			foreach($_POST['v_VideoUrl'] as $indice => $video){
				$_POST['v_VideoUrl'][$indice] = $this->thumbVideo($video, 'video');
			}
		}
		$rsVideos = $this->stdVideo->getVideos($cod);
		
		while (!$rsVideos->EOF){
			$codvideo = $rsVideos->Fields($this->chave);

			
			$o = new stdVideos($this->tabela, $this->chave, $this->fk, $this->campoVideo, $this->campoTitulo, $codvideo);
	
			if(in_array($codvideo, $_POST['hdn_GaleriaVideoID'])){
				$vid = $this->campo . '_' . $codvideo;
			
				$o->campos[ $this->campoTitulo ] = '';
				if ( isset( $_POST[ 'leg_' . $vid ] ) )
					$o->campos[ $this->campoTitulo ] = $_POST[ 'leg_' . $vid ];
					
				$o->campos[ $this->campoDescricao ] = '';
				if ( isset( $_POST[ 'leg_' . $vid ] ) )
					$o->campos[ $this->campoDescricao ] = $_POST[ 'desc_' . $vid ];

				$o->_update( $this->chave . " = " . $codvideo );
			}else{
				$this->delVideo($codvideo);
			}

			$rsVideos->MoveNext();
		}
		
		// Novos Uploads.
		if ( count( $_POST['v_VideoUrl'] ) > 0 )
		foreach($_POST['v_VideoUrl'] as $indice=>$video){
			$this->addVideo($_POST['t_VideoUrl'][$indice], $cod, $_POST['v_VideoUrl'][$indice], $_POST['d_VideoUrl'][$indice]);
		}
	}
	
	function capturarValor($cod) {
		$db = new db();
		$query = "SELECT * FROM {$this->tabela} WHERE {$this->fk}='{$cod}'";
		$rs = $db->query($query);
		
		$arrVideos = array();
		
		while (!$rs->EOF) {
			$arrValor = array();
			$arrValor["videoUrl"] = $rs->fields($this->campoVideo);
			$arrValor["codvideo"] = $rs->fields($this->chave);
			
			$arrValor["titulo"] = '';
			if ( $this->titulo )
				$arrValor["titulo"] = $rs->fields($this->campoTitulo);
			
			if ( $this->descricao )
				$arrValor["descricao"] = $rs->fields($this->campoDescricao);
			
			$arrVideos[] = $arrValor;
			unset( $arrValores );
			$rs->MoveNext();
		}
		
		$this->valor = $arrVideos;
	}
	
	function addVideo($titulo, $cod, $videoUrl, $descricao) {

		$db = new db();

		$o = new stdVideos($this->tabela, $this->chave, $this->fk, $this->campoVideo, $this->campoTitulo, $this->campoDescricao, "");

		$o->campos[$this->fk] = $cod;
		if ($this->titulo)
			$o->campos[$this->campoTitulo] = $titulo;
			
		if ($this->descricao)
			$o->campos[$this->campoDescricao] = $descricao;
			
		if ($this->campoVideo)
			$o->campos[$this->campoVideo] = $videoUrl;

		$cod = $o->_insert();

	}
	
	function delVideo($codVideo)
	{
		$db = new db();

		$db->_delete($this->tabela, $this->chave."=".$codVideo);
	}
	
	function formatListagem() {
		return $this->valor;
	}
}
