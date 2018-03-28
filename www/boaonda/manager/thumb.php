<?php
error_reporting(E_ALL & ~E_NOTICE);

include('phpthumb/ThumbLib.inc.php');

$img = '../uploads/imagens/' . $_GET['img'];
$w = (is_numeric($_GET['w'])) ? $_GET['w'] : 100;
$h = (is_numeric($_GET['h'])) ? $_GET['h'] : 100;
$tipo = ($_GET['t']) ? $_GET['t'] : 'resize';

if( is_file( $img ) ) {

	try {
		$thumb = PhpThumbFactory::create( $img );  
	} catch (Exception $e) {
		 echo $e->printMessage();
	}
	
	if( $tipo == 'resize' ) {
		$thumb->resize($w, $h);  
	} else {
		$thumb->adaptiveResize($w, $h);  
	}
	$thumb->show(); 
}

