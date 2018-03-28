<?php


/**
 * 
 * Fun��o respons�vel por selecionar o idioma
 * 
 */
function __($prefix = '',$str = ''){
	
	$ci =& get_instance();
	
	//$lang = $ci->lang->lang();
	$line = $prefix."_".$str;
	
	if( $ci->lang->line($line)  ) {
		echo $ci->lang->line( $line );
	} else {
		echo $str;
	}
}

function getDadosComuns($lang = 'BR') {

	$ci =& get_instance();
	
	switch($lang) {		
		case 'pt': $cadastro = $ci->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO'),1);
		break;
		case 'en': $cadastro = $ci->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO_EN'),1);
		break;
		case 'es': $cadastro = $ci->ProjetoModel->get('site_conteudo',array('Nome' => 'CADASTRO_SP'),1);
		break;
		default	 : show_404(); break;
	}	
	
	$retorno['banners'] = $ci->ProjetoModel->get('site_banner');
	$retorno['footerColecao'] = $ci->ProjetoModel->select('site_conteudo','Imagem',array('Nome' => 'COLECAO_DESTAQUE'),1);
	$retorno['footerCampanha'] = $ci->ProjetoModel->select('site_conteudo','Imagem',array('Nome' => 'CAMPANHA_DESTAQUE'),1);
	$retorno['footerBlog'] = $ci->ProjetoModel->getBlogContent();
	$retorno['footerCadastro'] = $cadastro;
	
	$campanha = $ci->ProjetoModel->get('site_campanha',array('Destaque' => 'S'),1,'','CampanhaID DESC');
	$campanhaDestaque = substr($campanha['Video'],strpos($campanha['Video'],'v='),strlen($campanha['Video']));
	$campanhaDestaque = str_replace('v=','',$campanhaDestaque);
	
	$retorno['videoCampanha'] = $campanhaDestaque;
		
	return $retorno;

}

function getMenuLang($lang = 'BR') {

	$ci =& get_instance();

	switch($lang) {
		case 'pt': $ci->lang->load('boaonda', 'portuguese'); break;
		case 'en': $ci->lang->load('boaonda', 'english');    break;
		case 'es': $ci->lang->load('boaonda', 'spanish');    break;
	}
	
	$menu = array(
		'empresa' 	   => $ci->lang->line("menu_empresa"),
		'colecao' 	   => $ci->lang->line("menu_colecao"),
		'campanha' 	   => $ci->lang->line("menu_campanha"),
		'blog' 		   => $ci->lang->line("menu_blog"),
		'ondeecontrar' => $ci->lang->line("menu_ondeencontrar"),
		'faleConosco'  => $ci->lang->line("menu_contato")
	);
	
	return $menu;
	
}
 
/**
 * 
 * 
 * Cria os endere�os para pasta comum
 * 
 */
function jsSkin( $file = '') {
	return site_url('comum/js/' . $file);	
}

function cssSkin( $file = '') {
	return site_url('comum/css/' . $file);	
}

function _mkdir( $dir = '' ) {
	if( !is_dir($dir) ) {
		mkdir($dir, 0777);			
	}
	return $dir;
}

function imgSkin($img = '') {
	return site_url('comum/img/' . $img);	
}

function imgUpload($img='', $w='', $h='', $tipo='', $imgNovoNome = '') {
	$tipo = ($tipo) ? $tipo : 'size';
	return resizeImg($img, $w, $h, $tipo, $imgNovoNome);	
}

function resizeImg($imgNome='', $w='', $h='', $efeito='', $imgNovoNome = '' ) {
	
	$ci =& get_instance();
	$ci->load->library(array('phpthumb_lib', 'easyphpthumbnail'));
	
	$w = ($w) ? $w : 250;
	$h = ($h) ? $h : 250;
	$tamanho = $w.'x'.$h;
	
	$efeito = ($efeito) ? $efeito : 'size';
	
	$dirImg = FCPATH . 'uploads/imagens';			
	$dirCache = $dirImg . '/cache';	

	_mkdir( $dirCache );
	_mkdir( $dirCache.'/'.$tamanho );
	_mkdir( $dirCache.'/'.$tamanho.'/'.$efeito );
	
	if( $imgNome ) {
	
		try {
		
			$options = array('jpegQuality' => 90);
			
			$thumb = phpthumb_lib::create($dirImg . '/' . $imgNome );			
			if( $efeito == 'adaptiveResize' ) 
				$thumb->adaptiveResize($w, $h);
			else 
				$thumb->resize($w, $h);		
			
			$nome = ($imgNovoNome) ? strtolower(url_title($imgNovoNome)).'.'.fileExtension($imgNome) : $imgNome;
			
			$dirFinal = implode('/', array($dirCache, $tamanho, $efeito));
			
			$thumb->save(  $dirFinal .'/'. $nome );		
			
			return site_url( 'uploads/imagens/cache/'.$tamanho.'/'.$efeito.'/'. $nome );
				
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}

function arquivoUpload($arquivo) {
	return site_url("uploads/curriculos/".$arquivo);	
}

/**
 * 
 * Link
 * 
 */
function url($str) {
	$str = trim($str);	

	$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ /';
	$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby--';

	$string = strtr($str, $a, $b);
	$string = str_replace('%', '-porcento', $string);		

	return strtolower($string);
}

function urlCompartilhe( ) {

	$ci =& get_instance();
	
	$url = site_url($ci->uri->uri_string());
	
	return $url;
	
}


/**
 * 
 * Fun��es para data
 * 
 */ 
function getDia($data) {

	return substr($data, 8, 10);
	
}

function getDiaSemana($data) {

	$diasemana = getdate(strtotime($data));
	
	return traduzDiaSemana($diasemana['weekday']);
	
}

function getMes($data) {

	if(strlen($mes) == 3 ) {
	
		$mes = getdate(strtotime($data));
		return traduzMes($mes['month']);
		
	} else {
	
		return traduzMes($data);
		
	}
	
}

function traduzMes( $str ) {
	
	switch( $str ) {
		case "January": return "Janeiro"; 	break;
		case "Jan": 	return "Jan"; 	break;
		case "February":return "Fevereiro"; break;
		case "Feb": 	return "Fev"; 	break;
		case "March": 	return "Março"; break;
		case "Mar": 	return "Mar"; 	break;
		case "April": 	return "Abril"; break;
		case "Apr": 	return "Abr"; 	break;
		case "May": 	return "Maio"; 	break;
		case "May": 	return "Mai"; 	break;
		case "Juny": 	return "Junho"; break;
		case "Jun": 	return "Jun"; 	break;
		case "July": 	return "Julho"; break;
		case "Jul": 	return "Jul"; 	break;
		case "August": 	return "Agosto";break;
		case "Aug": 	return "Ago"; 	break;
		case "Sep": 	return "Set"; 	break;
		case "Oct": 	return "Out"; 	break;
		case "November":return "Novembro"; 	break;
		case "Nov": 	return "Nov"; 	break;
		case "December":return "Dezembro"; 	break;
		case "Dec": 	return "Dez"; 	break;
	}
	
}

function traduzDiaSemana($str) {

	switch($str) {
		case "Saturday":
			return "Sábado";
			break;
		case "Sunday":
			return "Domingo";
			break;
		case "Monday":
			return "Segunda-feira";
			break;
		case "Tuesday":
			return "Terça-feira";
			break;
		case "Wednesday":
			return "Quarta-feira";
			break;
		case "Thursday":
			return "Quinta-feira";
			break;
		case "Friday":
			return "Sexta-feira";
			break;
	}
	
}
function meses() {

	return array(
		'01'=>'Janeiro',
		'02'=>'Fevereiro',
		'03'=>'Março',
		'04'=>'Abril',
		'05'=>'Maio',
		'06'=>'Junho',
		'07'=>'Julho',
		'08'=>'Agosto',
		'09'=>'Setembro',
		'10'=>'Outubro',
		'11'=>'Novembro',
		'12'=>'Dezembro'
	);
	
}

/**
 * Exibe todos os videos de um usu�rio no youtube
 * 
 * 
 * @param string $user
 *    Usu�rio de quem vai receber a lista de videos
 *
 */
function youtube( $user ) {
   
   	// set feed URL
    $feedURL = 'http://gdata.youtube.com/feeds/api/users/' . $user . '/uploads?max-results=2';
    
	ini_set('allow_url_fopen', 1);
    // read feed into SimpleXML object
    $sxml = @simplexml_load_file($feedURL);	
	
	if(!empty($sxml->entry)) {
		
		$arr 	= array();
		$i		= 0;
		// iterate over entries in feed
		foreach ($sxml->entry as $entry) {
		  // get nodes in media: namespace for media information
		  $media = $entry->children('http://search.yahoo.com/mrss/');
		  
		  // get video player URL
		  $attrs = $media->group->player->attributes();
		  $watch = $attrs['url']; 
		  
		  // get video thumbnail
		  $attrs = $media->group->thumbnail[1]->attributes();
		  
		  $thumbnail = $attrs['url']; 
		  $arr[$i]['url'] 	= str_replace('watch?v=', 'v/', (string)$watch);
		  $arr[$i]['thumb'] = (string)$thumbnail;
		  $arr[$i]['title']	= (string)$media->group->title;
		  $arr[$i]['description']	= (string)$media->group->description;
		  
		  $i++;
		}

	} 
		
	return $arr;
}

function listaEstados() {
	return array(
		"AC" => "Acre",
		"AL" => "Alagoas",
		"AP" => "Amapá",
		"AM" => "Amazonas",
		"BA" => "Bahia",
		"CE" => "Ceará",
		"DF" => "Distrito Federal",
		"ES" => "Espírito Santo",
		"GO" => "Goiás",
		"MA" => "Maranhão",
		"MT" => "Mato Grosso",
		"MS" => "Mato Grosso do Sul",
		"MG" => "Minas Gerais",
		"PA" => "Pará",
		"PB" => "Paraíba",
		"PA" => "Paraná",
		"PE" => "Pernambuco",
		"PI" => "Piauí",
		"RJ" => "Rio de Janeiro",
		"RN" => "Rio Grande do Norte",
		"RS" => "Rio Grande do Sul",
		"RO" => "Rondônia",
		"RR" => "Roraima",
		"SC" => "Santa Catarina",
		"SP" => "São Paulo",
		"SE" => "Sergipe",
		"TO" => "Tocantins"
	);
}
