<?php

class Potencial_Comprador_Model extends Model {
	
	var $table = array();
	var $tabela_selecionada;
	var $fields;
	var $join = array();
	
	
	function Potencial_Comprador_Model($tabela = 'imovel') {
		parent::Model();
		$this->table['imovel'] = 'potencial_imovel';
		$this->table['posto'] = 'potencial_posto';
		
		$this->fields['imovel'] = array(
			'`potencial_imovel`.`id`',
			'`cliente`.`nome` as `nome`',
			'`potencial_imovel`.`investimento_minimo`',
			'`potencial_imovel`.`investimento_maximo`'
		);
		
		$this->join['imovel'] = array(
				'INNER JOIN `cliente` ON (`potencial_imovel`.`cliente_id` = `cliente`.`id`)'
		);
		
		$this->fields['posto'] = array(
			'`potencial_posto`.`id`',
			'`cliente`.`nome` as `nome`',
			'`potencial_posto`.`bandeira`',
		);

		$this->join['posto'] = array(
				'INNER JOIN `cliente` ON (`potencial_posto`.`cliente_id` = `cliente`.`id`)'
		);		
		
		//$this->tabela_selecionada = &$this->table;
		$this->tabela_selecionada = $tabela;
	}
	
	function listar($tabela,$pagina=0) {
			return SQL::result(
			$this->table[$this->tabela_selecionada],
			$this->fields[$this->tabela_selecionada],
			'',
			'',
			'ASC',
			$pagina,
			$this->config->item('per_page'),
			$this->join[$this->tabela_selecionada]
		);
				
	}
	
	function detalhes($tabela,$id) {
		return SQL::row($this->table[$tabela],'*',array('id' => $id));
	}
	
	function total_consulta() {
		
	}
	
	function consulta($pagina=0) {
		return SQL::result(
			$this->table[$this->tabela_selecionada],
			array(
				'`potencial_imovel`.`id`',
				'`cliente`.`nome` as `nome`',
				'`cliente`.`email`',
				'`cliente`.`celular`',
				'`imovel`.`endereco`',
				'`imovel`.`cidade`',
				'`imovel`.`bairro`',
				'`imovel`.`numero`',
				'`imovel`.`valor`',
				'`potencial_imovel`.`investimento_minimo`',
				'`potencial_imovel`.`investimento_maximo`'
			),
			'',
			'',
			'ASC',
			$pagina,
			$this->config->item('per_page'),
			array(
				'INNER JOIN `imovel` ON (`imovel`.`valor` < `potencial_imovel`.`investimento_maximo` AND `imovel`.`valor` > `potencial_imovel`.`investimento_minimo`)',
				'INNER JOIN `cliente` ON (`potencial_imovel`.`cliente_id` = `cliente`.`id`)'
			)
		);
	}
	
	function cadastrar($cliente_id,$investimento_minimo,$investimento_maximo) {
		return SQL::insert($this->table[$this->tabela_selecionada], array(
			'cliente_id' => $cliente_id,
			'investimento_minimo' => $investimento_minimo,
			'investimento_maximo' => $investimento_maximo
		));
	}
	
	function cadastrar_posto($cliente_id,$bandeira) {
		return SQL::insert($this->table['posto'], array(
			'cliente_id' => $cliente_id,
			'bandeira' => $bandeira
		));					
	}
	
	function editar($id,$cliente_id,$investimento_minimo,$investimento_maximo) {
		return SQL::update($this->table[$this->tabela_selecionada], array(
			'cliente_id' => $cliente_id,
			'investimento_minimo' => $investimento_minimo,
			'investimento_maximo' => $investimento_maximo
		),'`id` = '.$id);
	}
	
	function editar_posto($id,$cliente_id,$bandeira) {
		return SQL::update($this->table['posto'], array(
			'cliente_id' => $cliente_id,
			'bandeira' => $bandeira
		),'`id` = '.$id);
	}	
	
	function excluir($tabela,$id) {
		return SQL::delete($this->table[$tabela],array('id' => $id));
	}
	
	function total($tabela) {
		return SQL::total($this->table[$tabela]);
	}
	
}

?>