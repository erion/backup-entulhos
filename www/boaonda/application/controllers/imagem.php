<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Imagem extends CI_Controller {

    function __construct() {
        parent::__construct();
		
		$this->load->library(array('phpthumb_lib', 'easyphpthumbnail'));
		
        // directory where source images are stored
        $this->img_dir = FCPATH . 'uploads/imagens';		
		
        // directory where cached files will be stored.
        $this->cache_dir = $this->img_dir . '/cache';

        // image quality
        $this->quality = 86;
		
		$this->grayscale = FALSE;

        // max memory limit, used when resizing/cropping to handle large files
        $this->memory_limit = '64M';

        // END OF CONFIGURATION  --------------------------------------- //
    }
	
	function _get_file_from_uri() {
		// returns the requested image from the uri
        $seg_array = $this->uri->segment_array();

        return '/' . implode('/', array_slice($seg_array, $this->offset));
	}
	
	
	function _get_mime($file) {
		$mimes = array('bmp'=>'image/bmp', 'gif'=>'image/gif', 'jpg'=>'image/jpeg', 'png'=>'image/png');
        return $mimes[$this->_get_ext($file)];
    }
	
	function _get_ext($file) {
		return substr($file, strrpos($file, '.')+1);
    }
	
	function _mkdir( $dir = '' ) {
		if( !is_dir($dir) ) {
			mkdir($dir, 0777);			
		}
		return $dir;
	}
	
	function _resizeImg($srcFile, $imgNome, $dirCache, $w = 120, $h = 75, $adaptiveResize = FALSE) {		
		
		$this->_mkdir($dirCache);
		
		if( !is_file($dirCache . $imgNome) ) {
			
			try {
			
				$options = array('jpegQuality' => 90);				
				$thumb = phpthumb_lib::create($srcFile);			
				if( $adaptiveResize ) 
					$thumb->adaptiveResize($w, $h);
				else 
					$thumb->resize($w, $h);				
				$thumb->save($dirCache . $imgNome);		
				
			} catch (Exception $e) {
			
				show_error( $e->getMessage() );
				
			}
			
		} else {
			return FALSE;
		}
	}
	
	function _renderizeImg($dirCache) {
		
		// serve cache file
        $mime = $this->_get_mime($dirCache);
		
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s T', filemtime($dirCache)));
        header('Content-Type: '.$mime);
        header('Content-Length: '.filesize($dirCache)."\n\n");
        header('Etag: '.md5($dirCache));	
		
		echo file_get_contents($dirCache);
	}
	
	function adaptiveResize() {
		$this->offset = array_search(__FUNCTION__, $this->uri->segment_array())+1;
		
		$file = $this->_get_file_from_uri();
		
		if( $file ) {	
		
			$srcFile = $this->img_dir . $file;
			$tamanho = $this->uri->segment($this->offset);
			$dirCache = $this->_mkdir($this->cache_dir . '/' . $tamanho);		
			$dirCache = $this->_mkdir($dirCache.'/a');		
			$dirImgCache = $dirCache . $file;		
			
			list($w, $h) = explode("x", $tamanho);
			
			$this->_resizeImg($srcFile, $file, $dirCache, $w, $h, TRUE);
			
			$this->_renderizeImg($dirImgCache);
		} else {
			show_error('Imagem não foi passada!');
		}
		
	}
	
	public function size() {
		$this->offset = array_search(__FUNCTION__, $this->uri->segment_array())+1;		
		$file = $this->_get_file_from_uri();
        $srcFile = $this->img_dir . $file;
        $tamanho = $this->uri->segment($this->offset);
		$dirCache = $this->_mkdir($this->cache_dir . '/' . $tamanho);		
		$dirCache = $this->_mkdir($dirCache.'/s');		
        $dirImgCache = $dirCache . $file;				
		list($w, $h) = explode("x", $tamanho);		
		$this->_resizeImg($srcFile, $file, $dirCache, $w, $h);		
		$this->_renderizeImg($dirImgCache);		
	}
	
	function _grayscale($dirImgCache, $w = 150, $h = 75, $adaptive = FALSE) {
		
		$thumb = $this->easyphpthumbnail;
		
		$thumb->Thumbwidth 	= $w;
		$thumb->Thumbheight	= $h;
		$thumb->Quality 	= 100;
		$thumb->Greyscale  	= TRUE;
		
		if($adaptive) $thumb->Square = FALSE; 
		
		$thumb->Createthumb($dirImgCache);
		
	}
	
	public function grayAdpativeSize() {
	
		$this->offset = array_search(__FUNCTION__, $this->uri->segment_array())+1;		
		$file = $this->_get_file_from_uri();
        $srcFile = $this->img_dir . $file;
        $tamanho = $this->uri->segment($this->offset);
        $dirCache = $this->cache_dir . '/' . $tamanho.'/ga';		
        $dirImgCache = $dirCache . $file;	
			
		list($w, $h) = explode("x", $tamanho);		

		$this->_mkdir($dirCache);		
		$this->_resizeImg($srcFile, $file, $dirCache, $w, $h, TRUE);

		
		$this->_grayscale($dirImgCache, $w, $h, TRUE);		
	}
	
	public function graySize() {
	
		$this->offset = array_search(__FUNCTION__, $this->uri->segment_array())+1;		
		$file = $this->_get_file_from_uri();
        $srcFile = $this->img_dir . $file;
        $tamanho = $this->uri->segment($this->offset);
        $dirCache = $this->cache_dir . '/' . $tamanho.'/gs';		
        $dirImgCache = $dirCache . $file;	
				
		list($w, $h) = explode("x", $tamanho);		

		$this->_mkdir($dirCache);		
		$this->_resizeImg($srcFile, $file, $dirCache, $w, $h, TRUE);
		
		$this->_grayscale($dirImgCache, $w, $h, FALSE);		
	}
	
}
