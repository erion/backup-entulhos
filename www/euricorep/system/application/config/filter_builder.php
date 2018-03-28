<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//field definitions
$config['filter_builder'] = array();
$config['filter_builder_SAD'] = $config['filter_builder_ADM'] = array(
      array(//linha 1
            array('cliente_id'), //coluna 1
            array('emissao','status')//coluna 2
      ),
      array(
            array('fornecedor_id'),
            array('reprogramacao')
      ),
      array(
            array('artigo_id','producao','amostra'),
            array('ver_artigos','ver_pedidos')
      ),
	  array(
		  array(),
		  array('aplicar')
	  )
);


$config['filter_builder_CCM'] = array(
      array(
            array('cliente_id'),
            array('reprogramacao')
      ),
      array(
            array(),
            array('emissao','status')
      ),
	  array('artigos_in'),
      array(
            array('producao','amostra'),
            array('ver_artigos','aplicar')
      )
);

$config['filter_builder_CPR'] = array(
		array(
			array('cliente_id'),
			array('reprogramacao')
		),
		array(
			array(),
			array('emissao','status')
		),
		array('artigos_in'),//linha ocupando as 2 colunas
		array('artigos_not_in'),
		array(
			array('producao','amostra'),
			array('aplicar')
		)
	);

$config['filter_builder_D_VISITA'] = array(
		array(
			array('cliente_id'),
			array('emissao')
		),
		array(
			array('usuario_id'),
		),
		array(
			array(),
			array('aplicar')
		)
	);

$config['filter_builder_clientes'] = array(
		array(
			array('ramo'),
			array('vendedor_id')
		),
		array(
			array('programador_mi'),
			array('programador_importacao')
		),
		array(
			array('entidade_id')
		),
		array(
			array(),
			array('aplicar')
		)
	);
?>