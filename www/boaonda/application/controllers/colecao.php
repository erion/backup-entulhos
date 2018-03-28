<?php


class Colecao extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	
		$lang = $this->lang->lang();
		$colecao = $this->ProjetoModel->getColecao();
		$colecaoImagem = $this->ProjetoModel->getColecaoImagem($colecao);
		$generos = $this->ProjetoModel->getGeneros();
		
		$dadosComuns = getDadosComuns($lang);

		$data = array(
			'conteudo'=>'colecao/index',
			'paginaID'=>'colecao',
			'title'	  => 'Coleção - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'colecao' => $colecao,
			'colecaoImagem' => $colecaoImagem,
			'generos' => $generos,
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('jquery.jscrollpane.min.js', 'jquery.mousewheel.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
	public function categoria($categoria = '') {

		$title = ucfirst($categoria)." - Boa Onda";
		$generos = $this->ProjetoModel->getGeneros($categoria);
		
		if(empty($generos))
			show_404();
			
		$lang = $this->lang->lang();
		$colecao = $this->ProjetoModel->getColecaoGenero($categoria);
		$colecaoImagem = $this->ProjetoModel->getColecaoImagem($colecao);
		$generos = $this->ProjetoModel->getGeneros();
		
		$dadosComuns = getDadosComuns($lang);

		$data = array(
			'conteudo'=>'colecao/index',
			'paginaID'=>'colecao',
			'title'	  => $title,
			'menu'	  => getMenuLang($lang),
			'colecao' => $colecao,
			'colecaoImagem' => $colecaoImagem,
			'generos' => $generos,
			'filtro' => $categoria,
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('jquery.jscrollpane.min.js', 'jquery.mousewheel.js')
		);
		
		$this->load->view('master', $data);
	
	}
	
	public function detalhes($produto = '') {

		$lang = $this->lang->lang();
		$categoria = $this->uri->segment(3);
		$generos = $this->ProjetoModel->getGeneros($categoria);
		$title = ucfirst(str_replace('-',' ',$produto))." - ".ucfirst($categoria)." - Boa Onda";
		
		if(empty($generos))
			show_404();		
			
		$generos = $this->ProjetoModel->getGeneros();
		
		//detalhes do produto
		$colecao = $this->ProjetoModel->getColecao($produto);
		
		if(empty($colecao)) 
			show_404();
			
		$colecao['cores'] = $this->ProjetoModel->getColecaoCorImagem($colecao['ColecaoID']);
		$colecao['grades'] = $this->ProjetoModel->getColecaoGrades($colecao['ColecaoID']);
		
		//lista de produtos
		$colecaoCompleta = $this->ProjetoModel->getColecaoGenero($categoria);
		$colecaoCompletaImagens = $this->ProjetoModel->getColecaoImagem($colecaoCompleta);

		$dadosComuns = getDadosComuns($lang);
		
		$data = array(
			'conteudo'=>'colecao/detalhes',
			'paginaID'=>'colecao-detalhes',
			'title'	  =>$title,
			'menu'	  => getMenuLang($lang),
			'colecao' => $colecao,
			'colecaoCompleta' => $colecaoCompleta,
			'colecaoCompletaImagens' => $colecaoCompletaImagens,
			'generos' => $generos,
			'filtro' => $categoria,
			'dadosComuns' => $dadosComuns,
			'javascript'=> array('jquery.jcarousel.min.js', 'loader.js')
		);
		
		$this->load->view('master', $data);
		
	}
	
}