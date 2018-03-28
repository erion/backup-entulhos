<?php


class Contato extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
		
	public function index() {
		
		//debug($_POST);
		
		if( $this->input->post('txtNome') ) {
			
			$this->load->library('email');
			
			$de = $this->input->post('txtEmail');
			$nome = $this->input->post('txtNome');
			$empresa = $this->input->post('txtEmpresa');
			$telefone = $this->input->post('txtTelefone');
			$mensagem = $this->input->post('txtMensagem');
			
			$this->email->from($de, utf8_decode($nome));
			$this->email->to(EMAIL_CONTATO);
			//if( EMAIL_CC ) 
				$this->email->bcc(EMAIL_CC);

			$this->email->subject(utf8_decode(EMAIL_ASSUNTO));
			
			$msg = '<div style="font-size: 12px; font-family: Arial, Tahoma, sans-serif">';
			$msg.= '<p>Mensagem enviada através da Seção "Fale Conosco" do site www.agens.com.br</p>';
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
				$this->session->set_flashdata('msgRetorno', array(
					'tipo'=>'sucesso',
					'msg'=>'Contato realizado com sucesso!'
				));
			}					
			redirect('fale-conosco');
		}
		
		$msgRetorno = $this->session->flashdata('msgRetorno');
		
		// passando variaveis para a view
		$data = array(
			'centro'=>'contato/index',
			'title'=>'Fale Conosco',
			'metaDescription'=>'Entre em contato com a Agens para saber mais sobre gestão por processos, análise de negócio, gestão eletrônica de documentos, automação de processos e integração de dados. ',
			'menu'=>'fale-conosco',
			'msgRetorno'=>$msgRetorno
		);
		$this->load->view('master', $data);
	}
}