<?php
//======================================================================================
//==> Classe de para manipulação com datas
//======================================================================================
class DataUtils {
	var $data;
	var $dia;
	var $mes;
	var $ano;
	var $erro;
	
	function UltimoDia($ano,$mes){
		if ($ano%400 == 0) {
			$dias_fevereiro = 29;
		}
		elseif (($ano%4 == 0) && ($ano%100 == 0)){
			$dias_fevereiro = 28;
		}
		elseif (($ano%4 == 0) && ($ano%100 != 0)){
			$dias_fevereiro = 29;
		}
	    switch($mes) {
	       case 01: return 31; break;
	       case 02: return $dias_fevereiro; break;
	       case 03: return 31; break;
	       case 04: return 30; break;
	       case 05: return 31; break;
	       case 06: return 30; break;
	       case 07: return 31; break;
	       case 08: return 31; break;
	       case 09: return 30; break;
	       case 10: return 31; break;
	       case 11: return 30; break;
	       case 12: return 31; break;
	   }
	}	
	function GetData(){
		$this->nome_mes = array(1=>'Janeiro',2=>'Fevereiro',3=>'Março',4=>'Abril',5=>'Maio',6=>'Junho',7=>'Julho',8=>'Agosto',9=>'Setembro',10=>'Outubro',11=>'Novembro',12=>'Dezembro');
		$this->ult_dia_mes = array(1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31);
	}
	function getDataHoje($tipo='/'){
		$this->dia = date('d');
		$this->mes = date('m');
		$this->ano = date('Y');
		if($tipo=='/')
			$this->data = $this->dia."/".$this->mes."/".$this->ano;
		else
			$this->data = $this->ano."-".$this->mes."-".$this->dia;
		return $this->data;
	}
	function getNomeMesInteiro($mes){
		return $this->nome_mes[(int)$mes];
	}
	function getNomeMesAbrev($mes){
		return substr($this->nome_mes[(int)$mes],0,3);
	}
	function getNomeDia($dia_semana){
		$desc_dia = array("Domingo","Segunda-Feira","Terça-Feira","Quarta-Feira","Quinta-Feira","Sexta-Feira","Sábado");
		return $desc_dia[$dia_semana];
	}
	function getNomeDiaCurto($dia_semana){
		$desc_dia = array("dom","seg","ter","qua","qui","sex","sab");
		return $desc_dia[$dia_semana];
	}
	function getDiasSemana(){
		$this->dias_semana = array("Domingo","Segunda-Feira","Terça-Feira","Quarta-Feira","Quinta-Feira","Sexta-Feira","Sábado");
	}
	
	function getDiasSemanaCurto(){
		$this->dias_semana = array("dom","seg","ter","qua","qui","sex","sab");
	}
	
	function getDataSeparada($data){
		if (preg_match ("^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})^", $data))
			list ($dia, $mes, $ano) = explode ("/", $data);
		else
			list ($ano, $mes, $dia) = explode ("-", $data);
		$this->dia = (int)$dia;
		$this->mes = (int)$mes;
		$this->ano = (int)$ano;
	}
	function getDataFormatada($data){
		if (strlen($data) > 0 && $data != '0000-00-00'){
			if (preg_match ("^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})^", $data)){
				list ($dia, $mes, $ano) = explode ("/", $data);
				$this->data = ($ano."-".$mes."-".$dia);
			}
			else{
				list ($ano, $mes, $dia) = explode ("-", $data);
				$this->data = ($dia."/".$mes."/".$ano);
			}
			return $this->data;
		}else
			return "";
	}
	function getDataJuliana($data){
		$meses_ano = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		list ($anos, $meses, $dias) = explode("-",$data);
		if (($anos % 4) == 0)
			$meses_ano[2] = 29;
		for ($anos_bi = $anos; ($anos_bi % 4) > 0; $anos_bi--){
		}
		$anos_bi = $anos_bi / 4;
		$tot_dias = 0;
		for ($nr_meses = 0; $nr_meses <> $meses; $nr_meses++){
			$tot_dias = $tot_dias + $meses_ano[$nr_meses];
		}
		$tot_dias = $tot_dias + $dias;
		$dias_seculo = ((($anos - $anos_bi) * 365) + ($anos_bi * 366) + $tot_dias) ;
		return $dias_seculo;
	}
	function nrAnos($data_1,$data_2){
		$nr_anos = $this->getDataJuliana($data_2) - $this->getDataJuliana($data_1);
		$nr_anos = $nr_anos / 365;
		return (int)$nr_anos;
	}
	function getAcresData($data,$tp_calc,$qtd){
		// $tp_calc ==> 1: Acrescenta Anos
		//			==> 2: Acrescenta Meses
		//			==> 3: Acrescenta Dias
		$qtd_acr = array(0,0,0,0);
		$qtd_acr[$tp_calc] = $qtd;	
		$this->getDataSeparada($data);
		return date("Y-m-d", mktime (0,0,0,$this->mes + $qtd_acr[2],$this->dia + $qtd_acr[3],$this->ano + $qtd_acr[1]));
	}
	function getDecresData($data,$tp_calc,$qtd){
		// $tp_calc ==> 1: Diminuir Anos
		//			==> 2: Diminuir Meses
		//			==> 3: Diminuir Dias
		$qtd_acr = array(0,0,0,0);
		$qtd_acr[$tp_calc] = $qtd;	
		$this->getDataSeparada($data);
		return date("Y-m-d", mktime (0,0,0,$this->mes - $qtd_acr[2],$this->dia - $qtd_acr[3],$this->ano - $qtd_acr[1]));
	}
	function getConvMinutos($hr){
		return (int)((substr($hr,0,2) * 60)  + substr($hr,3,2));	
	}
	function getConvHora($minutos){
		$hr = ($minutos / 60);
		$mm = (($hr - (int)$hr) * 100) * 60 / 100;
		return sprintf("%02.0f",(int)$hr).":".sprintf("%02.0f",$mm);
	}
	function convMktime($data){
		$dt = new GetData;
		$dt->getDataSeparada($data);
		return mktime(0,0,0,$dt->mes,$dt->dia,$dt->ano);
	}
	function diaSemana($data,$retorno='Não',$tipo='1'){
		$this->getDataSeparada($data);
		$dt_mktime = mktime(0,0,0, $this->mes, $this->dia, $this->ano);
		if ($retorno == 'Sim'){
			return date('w',$dt_mktime);
		}else{
			if($tipo == '1'){
				return $this->getNomeDia(date('w',$dt_mktime));
			}else{
				return $this->getNomeDiaCurto(date('w',$dt_mktime));
			}
		}		
	}
	function reduzHora($hr){
		return substr($hr,0,2).'h';
	}
	function horaComum($hr){
		return substr($hr,0,5);
	}
	function getHora(){
		return date("H:i:s");	
	}
}
?>