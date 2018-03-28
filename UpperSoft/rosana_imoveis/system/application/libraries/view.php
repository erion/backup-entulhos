<?php

class View {
	
	var $CI;
	
	function View() {
		$this->CI = &get_instance();
	}
	
	function load($view='',$vars=array())
	{
		$this->CI->load->view('cabecalho',$vars);
		$this->CI->load->view($view,$vars);
		$this->CI->load->view('rodape',$vars);
	}
	
}

?>
