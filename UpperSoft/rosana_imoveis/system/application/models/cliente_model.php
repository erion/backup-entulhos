<?php
class Cliente_Model extends Model {
	
	var $table = 'cliente';
	
	function Cliente_Model() {
		parent::Model();
	}
	
	function listar_dropdown() {
		return SQL::id_value($this->table,array('id','nome'));
	}
	
	function listar($pagina=0) {
		return SQL::result(
			$this->table,
			array(
				'`cliente`.`id`',
				'`cliente`.`nome`',
				'`cliente`.`cidade`',
				'`cliente`.`telefone`',
				'`cliente`.`celular`',
				'`cliente`.`email`'
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
	
	function cadastrar($nome,$pessoa,$cpf_cnpj,$cidade,$uf,$endereco,$numero,$apto,$bairro,$cep,$telefone,$celular,$email) {
		return SQL::insert($this->table, array(
				'nome' => $nome,
				'pessoa' => $pessoa,
				'cpf_cnpj' => $cpf_cnpj,
				'cidade' => $cidade,
				'uf' => $uf,
				'endereco' => $endereco,
				'numero' => $numero,
				'apto' => $apto,
				'bairro' => $bairro,
				'cep' => $cep,
				'telefone' => $telefone,
				'celular' => $celular,																																												
				'email' => $email 
        ));		
	}
	
	function editar($id,$nome,$pessoa,$cpf_cnpj,$cidade,$uf,$endereco,$numero,$apto,$bairro,$cep,$telefone,$celular,$email) {
		return SQL::update($this->table, array(
				'nome' => $nome,
				'pessoa' => $pessoa,
				'cpf_cnpj' => $cpf_cnpj,
				'cidade' => $cidade,
				'uf' => $uf,
				'endereco' => $endereco,
				'numero' => $numero,
				'apto' => $apto,
				'bairro' => $bairro,
				'cep' => $cep,
				'telefone' => $telefone,
				'celular' => $celular,																																												
				'email' => $email
		),'`id` = '.$id);
	}
	
	function excluir($id) {
		return SQL::delete($this->table,array('id' => $id));
	}
	
	function total() {
		return SQL::total($this->table);
	}
	
}
?>