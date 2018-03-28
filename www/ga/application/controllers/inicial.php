<?php

class Inicial extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
		$data = array(
			'conteudo'=>'inicial/capa'
		);
		
		$this->load->view('master', $data);
		
	}	
}