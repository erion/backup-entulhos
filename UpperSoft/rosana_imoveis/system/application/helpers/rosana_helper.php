<?php

if (!function_exists('money')) {
	
	function money($str) {
		return 'R$ '.number_format($str, 2, ',' ,'.');
	}
	
}

if (!function_exists('anchor_confirm')) {
	
	function anchor_confirm($url,$confirm,$str) {
		return '<a href="#" onclick="if (confirm(\''.$confirm.'\')){location.href=\''.site_url($url).'\';}">'.$str.'</a>';
	}
	
}

if (!function_exists('localizacao')) {
	
	function localizacao($texto) {
		$CI = &get_instance();
		$config = $CI->config->item('localizacao');
		return $config[$texto];		
	}
	
}

if (!function_exists('tipo')) {
	
	function tipo($texto) {
		$CI = &get_instance();
		$config = $CI->config->item('tipo');
		return $config[$texto];		
	}
	
}

if (!function_exists('modalidade')) {
	
	function modalidade($texto) {
		$CI = &get_instance();
		$config = $CI->config->item('modalidade');
		return $config[$texto];		
	}
	
}

if (!function_exists('get_pagination_config')) {
	function get_pagination_config($total_rows=0) {
		$CI = &get_instance();
		$config = array();
		$config['base_url'] = site_url($CI->uri->segment(1).'/'.$CI->uri->segment(2).'/');
		$config['per_page'] = $CI->config->item('per_page');
		$config['total_rows'] = $total_rows;
		return $config;
	}
}

if (!function_exists('pagination')) {
	function pagination() {
		$CI = &get_instance();
		return $CI->pagination->create_links();
	}
}

?>