<?php


/**
 * 
 * Função responsável por selecionar o idioma
 * 
 */
function __($str = ''){
	
	$ci =& get_instance();
	
	$lang = $ci->lang->lang();
	
	if( $ci->lang->line( $str )  ) {
		echo $ci->lang->line( $str );
	} else {
		echo $str;
	}
}
 
/**
 * 
 * 
 * Cria os endereços para pasta comum
 * 
 */
function jsSkin( $file = '') {
	return site_url('comum/js/' . $file);	
}

function cssSkin( $file = '') {
	return site_url('comum/css/' . $file);	
}

function imgSkin($img = '') {
	return site_url('comum/imagens/' . $img);	
}

function imgUpload($img='', $w='', $h='', $tipo='') {

	$tipo = ($tipo) ? $tipo : 'size';
	
	return site_url("imagem/$tipo/".$w."x".$h."/$img");
	
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
 * Funções para data
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

function getMesAnalytics($month){
			
	switch ($month) {
		case "01":    return $mes = Janeiro;     break;
		case "02":    return $mes = Fevereiro;   break;
		case "03":    return $mes = Março;       break;
		case "04":    return $mes = Abril;       break;
		case "05":    return $mes = Maio;        break;
		case "06":    return $mes = Junho;       break;
		case "07":    return $mes = Julho;       break;
		case "08":    return $mes = Agosto;      break;
		case "09":    return $mes = Setembro;    break;
		case "10":    return $mes = Outubro;     break;
		case "11":    return $mes = Novembro;    break;
		case "12":    return $mes = Dezembro;    break; 
	}

}

/**
 * Exibe todos os videos de um usuário no youtube
 * 
 * 
 * @param string $user
 *    Usuário de quem vai receber a lista de videos
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
