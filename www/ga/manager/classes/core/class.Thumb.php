<?
class Thumb
{
	var $thumb;
	var $max_largura;
	var $max_altura;
	var $imagem;
	
	function Thumb($imagem, $max_largura = 72, $max_altura = 72)
	{
		$this->max_largura = $max_largura;
		$this->max_altura = $max_altura;
		$this->imagem = $imagem;
		
		list($width, $height, $type, $attr) = getimagesize($imagem);
		if ($type == "1")
			$img = imagecreatefromgif($imagem);
		else
			$img = imagecreatefromjpeg($imagem);

		if ($width >= $height && $width > $max_largura)
		{
			// escalonar por largura
			$altura_thumb = $this->scale_to_width($imagem, $max_largura);
			$largura_thumb = $max_largura;
		}
		else
		if ($height >= $width && $height > $max_altura)
		{
			// escalonar por altura
			$largura_thumb = $this->scale_to_height($imagem, $max_altura);
			$altura_thumb = $max_altura;
		}
		else
		{
			$largura_thumb = $width;
			$altura_thumb = $height;
		}
		
		if ($type == "1")
			$this->thumb = imagecreate($largura_thumb, $altura_thumb);
		else
			$this->thumb = imagecreatetruecolor($largura_thumb, $altura_thumb);
	
		imagecopyresampled($this->thumb, $img, 0, 0, 0, 0, $largura_thumb, $altura_thumb, $width, $height);
	}
	

	function ForceThumb()
	{
		$max_largura = $this->max_largura;
		$max_altura = $this->max_altura;
		$imagem = $this->imagem;
		
		$img = $this->thumb;
		$width = imagesx($img);
		$height = imagesy($img);
		
		
		list($width, $height, $type, $attr) = getimagesize($imagem);
		if ($type == "1")
			$img = imagecreatefromgif($imagem);
		else
			$img = imagecreatefromjpeg($imagem);

		if ($width >= $height && $height > $max_altura)
		{
			// escalonar por altura
			$largura_thumb = $this->scale_to_height($imagem, $max_altura);
			$altura_thumb = $max_altura;
		}
		else
		if ($height >= $width && $width > $max_largura)
		{
			// escalonar por largura
			$altura_thumb = $this->scale_to_width($imagem, $max_largura);
			$largura_thumb = $max_largura;
		}
		else
		{
			$largura_thumb = $width;
			$altura_thumb = $height;
		}
		
		if ($type == "1")
			$this->thumb = imagecreate($largura_thumb, $altura_thumb);
		else
			$this->thumb = imagecreatetruecolor($largura_thumb, $altura_thumb);
	
		imagecopyresampled($this->thumb, $img, 0, 0, 0, 0, $largura_thumb, $altura_thumb, $width, $height);
		
		$img = $this->thumb;
		
		$srcX = ($largura_thumb/2) - ($max_largura/2);
		$srcY = ($altura_thumb/2) - ($max_altura/2);
		
		if ($srcX < 0) $srcX = 0;
		if ($srcY < 0) $srcY = 0;
		
		if ($type == "1")
			$this->thumb = imagecreate($max_largura, $max_altura);
		else
			$this->thumb = imagecreatetruecolor($max_largura, $max_altura);
	
		imagecopyresampled($this->thumb, $img, 0, 0, $srcX, $srcY, $max_largura, $max_altura, $max_largura, $max_altura);
	}


	function writeThumb($destino = "")
	{
		imagejpeg($this->thumb, $destino, 95);
	}

	function scale_to_height ($filename, $targetheight) {
	  $size = getimagesize($filename);
	  $targetwidth = $targetheight * ($size[0] / $size[1]);
	  return $targetwidth;
	}
			 
	function scale_to_width ($filename, $targetwidth) {
	  $size = getimagesize($filename);
	  $targetheight = $targetwidth * ($size[1] / $size[0]);
	  return $targetheight;
	}

	function source_scale_to_height ($srcFile, $targetheight) {
	  $width = imagesx($srcFile);
	  $height = imagesy($srcFile);
	  
	  $targetwidth = $targetheight * ($width / $height);
	  return $targetwidth;
	}
			 
	function source_scale_to_width ($srcFile, $targetwidth) {
	  $width = imagesx($srcFile);
	  $height = imagesy($srcFile);
	  	  
	  $targetheight = $targetwidth * ($height / $width);
	  return $targetheight;
	}

}
?>