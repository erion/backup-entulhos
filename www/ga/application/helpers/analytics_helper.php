<?php

	function graph($aData){
	    
	    $iMax = max($aData);
	    if ($iMax == 0){
	        echo 'No data';
	        return;
	    }
	    echo '<table>
	            <tr>
	                <td>Metric</td>
	                <td>#</td>
	                <td>Graph</td>
	            </tr>';
	    foreach($aData as $sKey => $sValue){
	  
	        echo '  <tr>
	                    <td>' . $sKey . '</td>
	                    <td>' . $sValue . '</td>
	                    <td><div class="bar" style="width: ' . intval(($sValue / $iMax) * 300) . 'px;"></div> 
	                </tr>';
	    }
	    echo '</table>';
	    
	}
	
	function getPercentual($mesanterior, $mesatual, $importacao = false){
	
		$mesanterior = (int)$mesanterior;
		$mesatual = (int)$mesatual;
		if($mesanterior == 0 && $importacao) return 0;
		if($mesanterior == 0)  throw new Exception('Divisão por zero');
		$percent = ($mesatual / $mesanterior) * 100;
		$percent = 100 - $percent;
		
		return number_format($percent,2,'.','.').'%';
	
	
	}
	
	function getPercentualParticipacao($total,$mes, $importacao = false) {
		
		$total = (int)$total;
		$mes = (int)$mes;
		if($total == 0 && $importacao) return 0;
		if($total == 0)  throw new Exception('Divisão por zero');
		$percent = ($mes * 100) / $total;
		return number_format($percent,2,'.','.').'%';
	
	
	}
	
	function getNomeMes($month){
				
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
	 
	 
	 function getArrayKeywords($dados){
	 
	 
	 	foreach ($dados as $key => $row) {
	    	
	    	$keyword = substr($key, 3);
    		$keyword = str_replace('ga:keyword','', $keyword);
    		$mes = substr($key, 0, 3);
    		$mes = str_replace(' ','',$mes);
    		
    		switch ($mes) {
			    case 01:
			        $janeiro[$keyword] = $row; 
			        break;
			    case 02:
			        $fevereiro[$keyword] = $row; 
			        break;
			    case 03:
			        $marco[$keyword] = $row; 
			        break;
			    case 04:
			        $abril[$keyword] = $row; 
			        break;
			    case 05:
			        $maio[$keyword] = $row; 
			        break;
	    		case 06:
			        $junho[$keyword] = $row; 
			        break;
			    case 07:
			        $julho[$keyword] = $row; 
			        break;
	    		case 08:
			        $agosto[$keyword] = $row; 
			        break;
			    case 09:
			        $setembro[$keyword] = $row; 
			        break;
			   case 10:
			        $outubro[$keyword] = $row; 
			        break;     
			   case 11:
			        $novembro[$keyword] = $row; 
			        break;         
	    		case 12:
			        $dezembro[$keyword] = $row; 
			        break;
	    	}
		}
			
		$kwd[01] = $janeiro;
		$kwd[02] = $fevereiro;
		$kwd[03] = $marco;
		$kwd[04] = $abril;
		$kwd[05] = $maio;
		$kwd[06] = $junho;
		$kwd[07] = $julho;
		$kwd[08] = $agosto;
		$kwd[09] = $setembro;
		$kwd[10] = $outubro;
		$kwd[11] = $novembro;
		$kwd[12] = $dezembro;

	 
	 	$keywords[] = null;
	 	
	 	foreach($kwd as $mes => $row){

			if (is_array($row)){
				
				foreach ($row as $keywd => $sub) {
				
					if(array_key_exists($keywd, $keywords)){
						
						$keywords[$keywd][$mes] = $sub; 
					
					}else{
					
						$keywords[$keywd] = array($mes => $sub);
					
					}
	
				}
							
			}

		}
		
		unset($keywords[0]);
		return $keywords;
	 
	 
	 }


?>