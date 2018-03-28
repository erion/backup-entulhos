<?php
class Utils {

	function dateToBr( $date  = NULL ) {
		if ( empty( $date ) )
			$date = date( 'Y-m-d' );

			$date = date( 'd/m/Y', strtotime( $date ) );

		return $date;
	}

	function dateToBase( $date  = NULL ) {
		if ( empty( $date ) )
			$date = date( 'd/-m/Y' );

			$date = date( 'Y-m-d', strtotime( str_replace( '/', '-', $date ) ) );

		return $date;
	}

	function clear($valor){
		$valor = str_replace("'","&quot;",$valor);
		return $valor;
	}

	function cleanUrl( $url ) {
		$aa = array( 'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','&','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','Þ','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ý','ý','þ','ÿ',' ','/','*','#','@','!','$','~','`',"'",'"','?','\\','{','}','[',']',':',';',',','.','<','>','+','=','_','^','|','%','(',')' );
		$bb = array( 'a','a','a','a','a','a','a','c','e','e','e','e','e','i','i','i','i','d','n','o','o','o','o','o','o','u','u','u','u','y','b','s','a','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','d','n','o','o','o','o','o','o','u','u','u','y','y','b','y','-','-','','','','','','','','','','','-','','','','','','','','','','','','','','','','','','' );

		return strtolower( str_replace( $aa, $bb, str_replace( '--', '-', str_replace( ' ', '-', trim( $url ) ) ) ) );
	}

	function getFileExtension( $file ) {
	    return end( explode( ".", $file ) );
	}

	function fileNameTest($filename, $path) {

		$acentos 	= array(" ","-","'","ç","À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å","È","É","Ê","Ë","è","é","ê","ë","Ò","Ó","Ô","Õ","Ö","ò","ó","ô","õ","ö","Ù","Ú","Û","Ü","ù","ú","û","ü","Ì","Í","Î","Ï","ì","í","î","ï","Ç");
		$letras 	= array("_","_","_","c","A","A","A","A","A","A","a","a","a","a","a","a","E","E","E","E","e","e","e","e","O","O","O","O","O","o","o","o","o","o","U","U","U","U","u","u","u","u","I","I","I","I","i","i","i","i","C");

		for ($i=0; $i<count($acentos); $i++) {
			$filename = str_replace($acentos[$i],$letras[$i],$filename);
		}

		if (file_exists($path.$filename)) {
			$x = 0;

			$tmpFilename = substr($filename, 0,strrpos($filename, "."));
			$tmpExt = substr($filename, strrpos($filename, "."));
			$tmpNr = "";

			while (file_exists($path.$tmpFilename.$tmpNr.$tmpExt)) {
				$x++;
				$tmpNr = "_".$x;
			}

			$filename = $tmpFilename.$tmpNr.$tmpExt;
		}
		return $filename;
	}

	function showInicio($texto, $caracteres) {
		if (strlen($texto) > $caracteres) {
			return substr($texto,0,$caracteres)."...";
		} else {
			return $texto;
		}
	}

	function getArrayList($cod, $label, $tabela,$where="") {
		$db = new db();
		if($where != ""){
			$where = " WHERE ".$where;
		}
		$vQuery = "SELECT ".$cod.",".$label." FROM ".$tabela." ".$where." ORDER BY ".$label;
		$rs = $db->query($vQuery);

		$tmpArr = array();
		while (!$rs->EOF) {
			$tmpArr[$rs->fields($cod)] = $rs->fields($label);
			$rs->moveNext();
		}
		return $tmpArr;
	}

	function cleanArray($arr) {
		$t = $arr;
		foreach($t as $pos => $valor)
			if ($pos == 0 && $valor == "")
				unset($t[$pos]);
		return $t;
	}

	function isoEncode($str) {
		return utf8_encode($str);
		//return $str;
		//return iconv('latin1', 'iso-8859-1', $str);
		//return iconv('latin1', 'latin1', $str);
		//return preg_replace("/([\xC2\xC3])([\x80-\xBF])/e", "chr(ord('\\1')<<6&0xC0|ord('\\2')&0x3F)", $str);
	}

	function extract($str, $ini) {
		$pos = strpos($str, $ini);
		if ($pos !== FALSE)
			return substr($str, strlen($ini));
		else
			return "";
	}

	function escape($str) {
		$s = str_replace('"', '&quot;', $str);
		return $s;
	}

	function unescape($str) {
		$s = str_replace('\\"', '"', $str);
		return $s;
	}

	function rteSafe($strText) {
		//returns safe code for preloading in the RTE
		$tmpString = $strText;

		//convert all types of single quotes
		//$tmpString = str_replace(chr(145), chr(39), $tmpString);
		//$tmpString = str_replace(chr(146), chr(39), $tmpString);
		$tmpString = str_replace("'", "&#39;", $tmpString);

		//convert all types of double quotes
		//$tmpString = str_replace(chr(147), chr(34), $tmpString);
		//$tmpString = str_replace(chr(148), chr(34), $tmpString);
		$tmpString = str_replace('"', '\"', $tmpString);

		//replace carriage returns & line feeds
		$tmpString = str_replace(chr(10), " ", $tmpString);
		$tmpString = str_replace(chr(13), " ", $tmpString);

		return $tmpString;
	}

	//retorna um timestamp para uma data no formato yyyy-mm-dd
	function iso2unix($dstr)
	{
		$i = preg_split("/[^0-9]/", $dstr);
		return mktime(0, 0, 0, $i[1], $i[2], $i[0]);
	}

	//retorna uma data no formato dd/mm/yyyy, recebendo
	// uma data no formato yyyy-mm-dd hh:mm:ss
	function formatDateTime($datahora, $modo = "")
	{
		if ($datahora != "")
		{
			// Separa data e hora.
			$dh = explode(" ", $datahora);
			$data = $dh[0];
			if (isset($dh[1]) && $dh[1] != '00:00:00') {
				$hora = ' '.$dh[1];

				$tmp = explode(":",$dh[1]);

				$horas = $tmp[0];
				$minutos = $tmp[1];
				$segundos = $tmp[2];

			} else {
				$hora = '';
				$horas = "00";
				$minutos = "00";
				$segundos = "00";
			}

			// Separa a data.
			$d = explode("-", $data);
			$ano = $d[0];
			$mes = $d[1];
			$dia = $d[2];
			$data = $d[2]."/".$d[1]."/".$d[0];

			if ($modo == "") {
				return $data.$hora;
			} else if ($modo == "dia_mes") {
				return $d[2]."/".$d[1];
			} else if ($modo == "mes_dia") {
				return $d[1]."/".$d[2];
			} else if ($modo == "dia_mes_ano") {
				return $d[2]."/".$d[1]."/".$d[0];
			} else if ($modo == "pontos") {
				return $d[2].".".$d[1].".".$d[0];
			} else if ($modo == "pontos_ingles") {
				return $d[1].".".$d[2].".".$d[0];
			} else if ($modo == "dia_mes_escrito") {
				return $d[2]." de ".Utils::getNomeMes(intval($d[1]));
			} else if ($modo == "data_hora") {
				return $data." - ".$horas.":".$minutos;
			} else if ($modo == "hora_abreviada") {
				return $horas.":".$minutos;
			} else if ($modo == "dia_extenso") {
				$diaDaSemana = date("l",mktime($horas,$minutos,$segundos,$mes,$dia,$ano));
				switch($diaDaSemana) {
					case 'Sunday': $diaDaSemana = 'Domingo'; break;
					case 'Monday': $diaDaSemana = 'Segunda-feira'; break;
					case 'Tuesday': $diaDaSemana = 'Terça-feira'; break;
					case 'Wednesday': $diaDaSemana = 'Quarta-feira'; break;
					case 'Thursday': $diaDaSemana = 'Quinta-feira'; break;
					case 'Friday': $diaDaSemana = 'Sexta-feira'; break;
					case 'Saturday': $diaDaSemana = 'S&aacute;bado'; break;
				}

				return $diaDaSemana.", ".$d[2]." de ".Utils::getNomeMes(intval($d[1]))." de ".$ano;
			} else if ($modo == "newsletter") {
				return $d[2]."<br>de ".Utils::getNomeMes(intval($d[1]))."<br> de ".$ano;
			}
		} else {
			return "";
		}
	}

	//converte uma data no formato dd/mm/yyyy para
	// uma data no formato yyyy-mm-dd
	function strToDbDate($valor) {
		$t = explode(" ", $valor);

		$temp = explode("/", $t[0]);
		$dia = $temp[0];
		$mes = $temp[1];
		$ano = $temp[2];
		$data = $ano."-".$mes."-".$dia;
		$hora = "";

		if (count($t) > 1)
			$hora = " ".$t[1];

		$valor = $data.$hora;

		return $valor;
	}

	//retorna um array (dia, mes, ano) para uma data
	// no formato yyyy-mm-dd
	function splitData($data) {
		$dat = split("-", $data);
		$ano = $dat[0];
		$mes = $dat[1];
		$dia = $dat[2];
		return array("dia" => $dia, "mes" => $mes, "ano" => $ano);
	}

	//trunca uma string.
	function truncate($str, $limite = 20) {
		return substr($str, 0, $limite-3)."...";
	}

	function getMeses() {
		$mesext = array(
			'1' => 'Janeiro',
			'2' => 'Fevereiro',
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro'
		);

		return $mesext;
	}

	//retorna o nome de um determinado mês
	function getNomeMes($mes) {
		$mesext = Utils::getMeses();
		return $mesext[$mes];
	}

	function getNomeMesAtual() {
		$mesext = Utils::getMeses();
		return $mesext[''.intval(date('m'))];
	}

	//retorna uma string contendo informações sobre o cliente e o servidor
	// da aplicação.
	function getInfoClient() {
		//Informações adicionais sobre o envio
		$navegador= $_SERVER['HTTP_USER_AGENT'];
		$ipservidor = gethostbyname($_SERVER['HTTP_HOST']);
		if ($ipservidor == "")
		{
			$ipservidor = "NO-IP";
		}
		$ipcliente = $_SERVER['REMOTE_ADDR'];
		$dataenvio = date("d/m/Y H:i ");


		$str = "Utilizando: ".$navegador."<br>".
		"Host: ".$ipservidor."<br>".
		"IP: ".$ipcliente."<br>".
		"Data de envio: ".$dataenvio."<br><br>";

		return $str;
	}

	function getListaEstados() {
		$lista = array();
		$lista["AC"] = "Acre";
		$lista["AL"] = "Alagoas";
		$lista["AP"] = "Amapá";
		$lista["AM"] = "Amazonas";
		$lista["BA"] = "Bahia";
		$lista["CE"] = "Ceará";
		$lista["DF"] = "Distrito Federal";
		$lista["ES"] = "Espírito Santo";
		$lista["GO"] = "Goias";
		$lista["MA"] = "Maranhão";
		$lista["MT"] = "Mato Grosso";
		$lista["MS"] = "Mato Grosso do Sul";
		$lista["MG"] = "Minas Gerais";
		$lista["PA"] = "Pará";
		$lista["PB"] = "Paraíba";
		$lista["PR"] = "Paraná";
		$lista["PE"] = "Pernambuco";
		$lista["PI"] = "Piauí";
		$lista["RJ"] = "Rio de Janeiro";
		$lista["RN"] = "Rio Grande do Norte";
		$lista["RS"] = "Rio Grande do Sul";
		$lista["RO"] = "Rondônia";
		$lista["RR"] = "Roraima";
		$lista["SC"] = "Santa Catarina";
		$lista["SP"] = "São Paulo";
		$lista["SE"] = "Sergipe";
		$lista["TO"] = "Tocantins";

		return $lista;
	}

	function includeDir($diretorioClasses) {
		if (is_dir($diretorioClasses)) {
			if ($dirHandler = opendir($diretorioClasses)) {
				while (($classeEncontrada = readdir($dirHandler)) !== false) {
					if (($classeEncontrada != ".") && ($classeEncontrada != "..")) {
						require_once($diretorioClasses."/".$classeEncontrada);
					}
				}
				closedir($dirHandler);
			}
		}
	}

	function formatbytes($val, $digits = 3, $mode = "SI", $bB = "B"){ //$mode == "SI"|"IEC", $bB == "b"|"B"
		$si = array("", "k", "M", "G", "T", "P", "E", "Z", "Y");
		$iec = array("", "Ki", "Mi", "Gi", "Ti", "Pi", "Ei", "Zi", "Yi");

		switch(strtoupper($mode)) {
			case "SI" : $factor = 1000; $symbols = $si; break;
			case "IEC" : $factor = 1024; $symbols = $iec; break;
			default : $factor = 1000; $symbols = $si; break;
		}

		switch($bB) {
			case "b" : $val *= 8; break;
			default : $bB = "B"; break;
		}

		for ($i=0;$i<count($symbols)-1 && $val>=$factor;$i++)
			$val /= $factor;

		$p = strpos($val, ".");
		if ($p !== false && $p > $digits) $val = round($val);
		elseif ($p !== false) $val = round($val, $digits-$p);

		return round($val, $digits) . " " . $symbols[$i] . $bB;
	}

	function cleanStr( $str ) {
		return str_replace( '-', ' ', str_replace( '--', '-', str_replace( ' ', '-', trim( $str ) ) ) );
	}

	function cleanEndereco( $endereco ) {
		$a = array( 'Av ','Av. ','Al ','Al. ','R ','R. ','M ','M. ','Mar ','Mar. ','Pça. ', 'Jd', 'Jd.', 'Gen', 'Gen.', 'Gal ', 'Gal.', 'Eng ', 'Eng. ' );
		$b = array( 'Avenida ','Avenida ','Alameda ','Alameda ','Rua ','Rua ','Marginal ','Marginal ','Marginal ','Marginal ', 'Praça ', 'Jardim ', 'Jardim ', 'General ', 'General ', 'General ', 'General ', 'Engenheiro ', 'Engenheiro ' );

		return str_replace( $a, $b, $this->cleanStr( $endereco ) );
	}

	function codificacao( $string ) {
		return mb_detect_encoding( $string . 'x', 'UTF-8, ISO-8859-1' );
	}

	/*
		1 => 'EnderecoErrado'
		2 => 'EnderecaoNaoEncontrado'
	*/
	function buscaDadosGoogle( $endereco ) {
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . str_replace( '-', '+', $this->cleanUrl( $this->cleanEndereco( $endereco ) ) ) . '&sensor=false&language=pt-br';

		$ch = curl_init( $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = json_decode( curl_exec( $ch ) );
		curl_close( $ch );

		if ( $output->status == 'OK' ) {
			$Endereco = new stdClass();

			foreach ( $output->results[ 0 ]->address_components AS $key => $AddressComponent ) {
				switch ( $AddressComponent->types[ 0 ] ) {
					case 'street_number' :
						$Endereco->Numero = $AddressComponent->long_name;
						break;
					case 'route' :
						$Endereco->Endereco = utf8_decode( $AddressComponent->long_name );
						break;
					case 'sublocality' :
						$Endereco->Bairro = utf8_decode( $AddressComponent->long_name );
						break;
					case 'locality' :
						$Endereco->Cidade = utf8_decode( $AddressComponent->long_name );
						break;
					case 'administrative_area_level_1' :
						$Endereco->Estado = utf8_decode( $AddressComponent->long_name );
						$Endereco->EstadoAbreviado = utf8_decode( $AddressComponent->short_name );
						break;
					case 'country' :
						$Endereco->Pais = utf8_decode( $AddressComponent->long_name );
						$Endereco->PaisAbreviado = $AddressComponent->short_name;
						break;
					case 'postal_code' :
						$Endereco->CEP = $AddressComponent->long_name;
						break;
				}
			}

			$Endereco->Latitude = $output->results[ 0 ]->geometry->location->lat;
			$Endereco->Longitude = $output->results[ 0 ]->geometry->location->lng;

			return $Endereco;
		} else
			return $output->status;
	}
}
