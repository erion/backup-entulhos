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
			'label' => 'Investimento m�nimo',
			'rules' => 'required|is_numeric'
		),
		array(
			'field' => 'investimento_maximo',
			'label' => 'Investimento m�ximo',
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
			'label' => 'Endere�o',
			'rules' => ''
		),
		array(
			'field' => 'numero',
			'label' => 'N�mero',
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
			'label' => 'Constru��o',
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
			'label' => '�rea',
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
			'label' => 'Endere�o',
			'rules' => ''
		),
		array(
			'field' => 'numero',
			'label' => 'N�mero',
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
			'label' => 'Descri��o',
			'rules' => ''
		)		
	),
	
	'posto' => array(
		array(
			'field' => 'proprietario',
			'label' => 'Propriet�rio',
			'rules' => ''
		),
		array(
			'field' => 'endereco',
			'label' => 'Endere�o',
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
			'label' => 'Localiza��o',
			'rules' => ''
		),
		array(
			'field' => 'duracao_contrato',
			'label' => 'Dura��o do Contrato',
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
			'label' => 'Sitau��o Legal',
			'rules' => ''
		),
		array(
			'field' => 'vol_venda_mes',
			'label' => 'Volume de Venda/M�s',
			'rules' => ''
		),
		array(
			'field' => 'vol_gasolina',
			'label' => 'Volume de gasolina',
			'rules' => ''
		),
		array(
			'field' => 'vol_alcool',
			'label' => 'Volume de �lcool',
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
			'label' => 'Funcion�rios',
			'rules' => ''
		),
		array(
			'field' => 'aberto_24h',
			'label' => 'Aberto 24h',
			'rules' => ''
		),
		array(
			'field' => 'loja_conveniencia',
			'label' => 'Loja Conveni�ncia',
			'rules' => ''
		),
		array(
			'field' => 'troca_oleo',
			'label' => 'Troca de �leo',
			'rules' => ''
		),
		array(
			'field' => 'lavagem',
			'label' => 'Lavagem',
			'rules' => ''
		),
		array(
			'field' => 'venda_vista',
			'label' => 'Venda � Vista',
			'rules' => ''
		),
		array(
			'field' => 'venda_prazo',
			'label' => 'Venda � Prazo',
			'rules' => ''
		),
		array(
			'field' => 'venda_cheque',
			'label' => 'Venda com Cheque',
			'rules' => ''
		),
		array(
			'field' => 'venda_cartao',
			'label' => 'Venda com Cart�o',
			'rules' => ''
		)				
	)
	
);

?>