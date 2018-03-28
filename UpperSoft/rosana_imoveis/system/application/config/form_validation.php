<?php

$config = array(
	
	'potencial_imovel' => array(
		array(
			'field' => 'cliente_id',
			'label' => 'Cliente',
			'rules' => 'required'
		),
		array(
			'field' => 'investimento_minimo',
			'label' => 'Investimento mínimo',
			'rules' => 'required|is_numeric'
		),
		array(
			'field' => 'investimento_maximo',
			'label' => 'Investimento máximo',
			'rules' => 'required|is_numeric'
		)
	),
	
	'potencial_posto' => array(
		array(
			'field' => 'cliente_id',
			'label' => 'Cliente',
			'rules' => 'required'
		),
		array(
			'field' => 'bandeira',
			'label' => 'Bandeira',
			'rules' => ''
		)
	),	
	
	'cliente' => array(
		array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		),
		array(
			'field' => 'pessoa',
			'label' => 'Pessoa',
			'rules' => ''
		),
		array(
			'field' => 'cpf_cnpj',
			'label' => 'CPF/CNPJ',
			'rules' => ''
		),
		array(
			'field' => 'cidade',
			'label' => 'Cidade',
			'rules' => ''
		),
		array(
			'field' => 'uf',
			'label' => 'UF',
			'rules' => ''
		),
		array(
			'field' => 'endereco',
			'label' => 'Endereço',
			'rules' => ''
		),
		array(
			'field' => 'numero',
			'label' => 'Número',
			'rules' => ''
		),
		array(
			'field' => 'apto',
			'label' => 'Apto.',
			'rules' => ''
		),
		array(
			'field' => 'bairro',
			'label' => 'Bairro',
			'rules' => ''
		),
		array(
			'field' => 'cep',
			'label' => 'CEP',
			'rules' => ''
		),
		array(
			'field' => 'telefone',
			'label' => 'Telefone',
			'rules' => ''
		),
		array(
			'field' => 'celular',
			'label' => 'Celular',
			'rules' => ''
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => ''
		)																							
	),
	
	'imovel' => array(
		array(
			'field' => 'categoria',
			'label' => 'Categoria',
			'rules' => ''
		),
		array(
			'field' => 'modalidade',
			'label' => 'Modalidade',
			'rules' => ''
		),
		array(
			'field' => 'construcao',
			'label' => 'Construção',
			'rules' => ''
		),
		array(
			'field' => 'tipo',
			'label' => 'Tipo',
			'rules' => ''
		),
		array(
			'field' => 'quartos',
			'label' => 'Quartos',
			'rules' => ''
		),
		array(
			'field' => 'area',
			'label' => 'Área',
			'rules' => ''
		),
		array(
			'field' => 'valor',
			'label' => 'Valor',
			'rules' => ''
		),
		array(
			'field' => 'cidade',
			'label' => 'Cidade',
			'rules' => ''
		),
		array(
			'field' => 'uf',
			'label' => 'UF',
			'rules' => ''
		),
		array(
			'field' => 'endereco',
			'label' => 'Endereço',
			'rules' => ''
		),
		array(
			'field' => 'numero',
			'label' => 'Número',
			'rules' => ''
		),
		array(
			'field' => 'apto',
			'label' => 'Apto.',
			'rules' => ''
		),
		array(
			'field' => 'bairro',
			'label' => 'Bairro',
			'rules' => ''
		),
		array(
			'field' => 'descricao',
			'label' => 'Descrição',
			'rules' => ''
		)		
	),
	
	'posto' => array(
		array(
			'field' => 'proprietario',
			'label' => 'Proprietário',
			'rules' => ''
		),
		array(
			'field' => 'endereco',
			'label' => 'Endereço',
			'rules' => ''
		),
		array(
			'field' => 'cidade',
			'label' => 'Cidade',
			'rules' => ''
		),
		array(
			'field' => 'estado',
			'label' => 'UF',
			'rules' => ''
		),
		array(
			'field' => 'telefone',
			'label' => 'Telefone',
			'rules' => ''
		),
		array(
			'field' => 'celular',
			'label' => 'Celular',
			'rules' => ''
		),
		array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => ''
		),
		array(
			'field' => 'nome_posto',
			'label' => 'Nome do Posto',
			'rules' => ''
		),
		array(
			'field' => 'bandeira',
			'label' => 'Bandeira',
			'rules' => ''
		),
		array(
			'field' => 'localizacao',
			'label' => 'Localização',
			'rules' => ''
		),
		array(
			'field' => 'duracao_contrato',
			'label' => 'Duração do Contrato',
			'rules' => ''
		),
		array(
			'field' => 'tipo',
			'label' => 'Tipo',
			'rules' => ''
		),
		array(
			'field' => 'valor_aluguel',
			'label' => 'Valor do Aluguel',
			'rules' => ''
		),
		array(
			'field' => 'tempo_contrato_aluguel',
			'label' => 'Tempo de Contrato do Aluguel',
			'rules' => ''
		),
		array(
			'field' => 'situacao_legal',
			'label' => 'Sitaução Legal',
			'rules' => ''
		),
		array(
			'field' => 'vol_venda_mes',
			'label' => 'Volume de Venda/Mês',
			'rules' => ''
		),
		array(
			'field' => 'vol_gasolina',
			'label' => 'Volume de gasolina',
			'rules' => ''
		),
		array(
			'field' => 'vol_alcool',
			'label' => 'Volume de Álcool',
			'rules' => ''
		),
		array(
			'field' => 'vol_diesel',
			'label' => 'Volume de Diesel',
			'rules' => ''
		),
		array(
			'field' => 'margem_venda',
			'label' => 'Margem de Venda',
			'rules' => ''
		),
		array(
			'field' => 'funcionarios',
			'label' => 'Funcionários',
			'rules' => ''
		),
		array(
			'field' => 'aberto_24h',
			'label' => 'Aberto 24h',
			'rules' => ''
		),
		array(
			'field' => 'loja_conveniencia',
			'label' => 'Loja Conveniência',
			'rules' => ''
		),
		array(
			'field' => 'troca_oleo',
			'label' => 'Troca de Óleo',
			'rules' => ''
		),
		array(
			'field' => 'lavagem',
			'label' => 'Lavagem',
			'rules' => ''
		),
		array(
			'field' => 'venda_vista',
			'label' => 'Venda à Vista',
			'rules' => ''
		),
		array(
			'field' => 'venda_prazo',
			'label' => 'Venda à Prazo',
			'rules' => ''
		),
		array(
			'field' => 'venda_cheque',
			'label' => 'Venda com Cheque',
			'rules' => ''
		),
		array(
			'field' => 'venda_cartao',
			'label' => 'Venda com Cartão',
			'rules' => ''
		)				
	)
	
);

?>