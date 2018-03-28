<?php
class Posto_Model extends Model {
	
	var $table = 'posto';
	
	function Posto_Model() {
		parent::Model();
	}
	
	function listar($pagina=0) {
		return SQL::result(
			$this->table,
			array(
				'`posto`.`id`',
				'`posto`.`cidade`',
				'`posto`.`proprietario`',
				'`posto`.`localizacao`',
				'`posto`.`tipo`',
				'`posto`.`valor_aluguel`'
			),
			'',
			'',
			'ASC',
			$pagina,
			$this->config->item('per_page'),
			array(
			)
		);
	}
	
	function detalhes($id) {
		return SQL::row($this->table,'*',array('id' => $id));
	}
	
	function total_consulta() {
		
	}
	
	function consulta($pagina=0) {

	}
	
	function cadastrar($proprietario,$endereco,$cidade,$estado,$telefone,$celular,$email,$nome_posto,$bandeira,$localizacao,$duracao_contrato,$tipo,$valor_aluguel,$tempo_contrato_aluguel,$situacao_legal,$vol_venda_mes,$vol_gasolina,$vol_alcool,$vol_diesel,$margem_venda,$funcionarios,$aberto_24h,$loja_conveniencia,$troca_oleo,$lavagem,$venda_vista,$venda_prazo,$venda_cheque,$venda_cartao) {
		return SQL::insert($this->table, array(
				'proprietario'=> $proprietario,
				'endereco'=> $endereco ,
				'cidade'=> $cidade,
				'estado'=> $estado,
				'telefone'=> $telefone,
				'celular'=> $celular,
				'email'=> $email,								
				'nome_posto'=> $nome_posto,
				'bandeira'=> $bandeira,				
				'localizacao'=> $localizacao,
				'duracao_contrato'=> $duracao_contrato,
				'tipo'=> $tipo,
				'valor_aluguel'=> $valor_aluguel,
				'tempo_contrato_aluguel'=> $tempo_contrato_aluguel,
				'situacao_legal'=> $situacao_legal,
				'vol_venda_mes'=> $vol_venda_mes,
				'vol_gasolina'=> $vol_gasolina,
				'vol_alcool'=> $vol_alcool,
				'vol_diesel'=> $vol_diesel,
				'margem_venda'=> $margem_venda,
				'funcionarios'=> $funcionarios,
				'aberto_24h'=> $aberto_24h,
				'loja_conveniencia'=> $loja_conveniencia,
				'troca_oleo'=> $troca_oleo,
				'lavagem'=> $lavagem,
				'venda_vista'=> $venda_vista,
				'venda_prazo'=> $venda_prazo,
				'venda_cheque'=> $venda_cheque,
				'venda_cartao'=> $venda_cartao
		));
	}
	
	function editar($id,$proprietario,$endereco,$cidade,$estado,$telefone,$celular,$email,$nome_posto,$bandeira,$localizacao,$duracao_contrato,$tipo,$valor_aluguel,$tempo_contrato_aluguel,$situacao_legal,$vol_venda_mes,$vol_gasolina,$vol_alcool,$vol_diesel,$margem_venda,$funcionarios,$aberto_24h,$loja_conveniencia,$troca_oleo,$lavagem,$venda_vista,$venda_prazo,$venda_cheque,$venda_cartao)  {
		return SQL::update($this->table, array(
				'proprietario'=> $proprietario,
				'endereco'=> $endereco ,
				'cidade'=> $cidade,
				'estado'=> $estado,
				'telefone'=> $telefone,
				'celular'=> $celular,
				'email'=> $email,								
				'nome_posto'=> $nome_posto,
				'bandeira'=> $bandeira,				
				'localizacao'=> $localizacao,
				'duracao_contrato'=> $duracao_contrato,
				'tipo'=> $tipo,
				'valor_aluguel'=> $valor_aluguel,
				'tempo_contrato_aluguel'=> $tempo_contrato_aluguel,
				'situacao_legal'=> $situacao_legal,
				'vol_venda_mes'=> $vol_venda_mes,
				'vol_gasolina'=> $vol_gasolina,
				'vol_alcool'=> $vol_alcool,
				'vol_diesel'=> $vol_diesel,
				'margem_venda'=> $margem_venda,
				'funcionarios'=> $funcionarios,
				'aberto_24h'=> $aberto_24h,
				'loja_conveniencia'=> $loja_conveniencia,
				'troca_oleo'=> $troca_oleo,
				'lavagem'=> $lavagem,
				'venda_vista'=> $venda_vista,
				'venda_prazo'=> $venda_prazo,
				'venda_cheque'=> $venda_cheque,
				'venda_cartao'=> $venda_cartao
		),'`id` = '.$id);
	}
	
	function excluir($id)  {
		return SQL::delete($this->table,array('id' => $id)) ;
	}
	
	function total()  {
		return SQL::total($this->table);
	}	
	
}
?>
