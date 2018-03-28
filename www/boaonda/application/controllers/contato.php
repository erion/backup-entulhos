<?php


class Contato extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
		
	public function index() {
	
/*
			$assuntos = $this->dbSite->where(array('Assunto'=>$assunto))->select('Emails')->get('site_contato_config');
			$emails = $assuntos->row_array();
			return str_replace(array(';',' '),array(',',''),$emails['Emails']);
*/
		$lang = $this->lang->lang();
		$assunto = $this->ProjetoModel->select('site_contato_config','ConfigID, Assunto');

		if( $this->input->post('txtNome') ) {
			
			$this->load->library('email');

			$assunto = $this->input->post('txtAssunto');
			$de = $this->input->post('txtEmail');
			$nome = $this->input->post('txtNome');
			$empresa = $this->input->post('txtEmpresa');
			$telefone = $this->input->post('txtTelefone');
			$mensagem = $this->input->post('txtMensagem');

			$emails = $this->ProjetoModel->select('site_contato_config','Emails',array('ConfigID' => $assunto),1);	

			$insertContato = array(
				'Nome' 	   	  => $nome,
				'Telefone' 	  => $telefone,
				'Email'	   	  => $de,
				'DataContato' => date('Y-m-d',now()),
				'Mens'		  => $mensagem
			);
			
			$this->email->from($de, utf8_decode($nome));
			$this->email->to($emails['Emails']);
			//if( EMAIL_CC ) 
				//$this->email->bcc(EMAIL_CC);

			$this->email->subject("Novo contato pelo site!");
			
			$msg = '<div style="font-size: 12px; font-family: Arial, Tahoma, sans-serif">';
			$msg.= '<p>Mensagem enviada através da Seção "Fale Conosco" do site www.boaonda.com.br</p>';
			$msg.= '<strong>Nome: </strong>'.$nome . '<br />';
			$msg.= '<strong>Empresa: </strong>'.$empresa . '<br />';
			$msg.= '<strong>Telefone: </strong>'.$telefone . '<br /><br />';
			$msg.= '<strong>Mensagem: </strong><br /><br />'.nl2br( $mensagem ). '<br />';
			$msg.= '</div>';
			
			$this->email->message(utf8_decode($msg));
		
			if( !$this->email->send() ) {
				$this->session->set_flashdata('msgRetorno', array(
					'tipo'=>'erro',
					'msg'=>'Ocorreu um problema ao enviar o contato. Tente novamente!'
				));
			} else {
				$this->ProjetoModel->insert('site_contato',$insertContato);
				$this->session->set_flashdata('msgRetorno', array(
					'tipo'=>'sucesso',
					'msg'=>'Contato realizado com sucesso!'
				));
			}
			
			redirect('fale-conosco');
		}
		
		$msgRetorno = $this->session->flashdata('msgRetorno');
		
		$dadosComuns = getDadosComuns($lang);
		
		// passando variaveis para a view
		$data = array(
			'conteudo'=>'contato/index',
			'paginaID'=>'contato',
			'title'	  =>'Contato - Boa Onda',
			'menu'	  => getMenuLang($lang),
			'currentLang' => $lang,
			'dadosComuns' => $dadosComuns,
			'assuntos' => $assunto,
			'javascript'=> array('fancybox/jquery.fancybox-1.3.4.pack.js'),
			'msgRetorno'=>$msgRetorno
		);
		$this->load->view('master', $data);
	}
}