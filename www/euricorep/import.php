<?php
header('Content-type: text/html; charset=utf-8');

$connection = mysql_connect('mysql02.euricorep.com.br','euricorep1','eur3007');
$banco_antigo = explode("\n",file_get_contents('euricorep.sql'));
mysql_select_db('euricorep1');

/*$connection = mysql_connect('localhost','root','zaq12wsx');
$banco_antigo = explode("\n",file_get_contents('euricorep.sql'));
mysql_select_db('eurico');*/

mysql_query("TRUNCATE TABLE `artigos`");
mysql_query("TRUNCATE TABLE `materias_primas`");
mysql_query("TRUNCATE TABLE `artigos_pedidos`");
mysql_query("TRUNCATE TABLE `pedidos`");
mysql_query("TRUNCATE TABLE `usuarios`");
mysql_query("TRUNCATE TABLE `logs`");
mysql_query("TRUNCATE TABLE `entidades`");

$novo_tipo_entidade = array("'CLI'" => '\'CLIENTE\'',"'FOR'" => '\'FORNECEDOR\'', '0' => '\'CLIENTE\'', '1' => '\'FORNECEDOR\'' );
$novo_tipo_usuario = array('0' => "'CCM'", '1' => "'ADM'" , '2' => "'CPR'");

$entidade_ids = array();
$pedido_ids = array();
$pedidos_data_emissao = array();
$usuario_ids = array();
$pedidos_by_user = array();
$pedidos_updated = array();
$artigo_ids = array();
$materia_prima_ids = array();
$quantidades = 0;

foreach($banco_antigo as $sql)
{
	ignore_user_abort(true);
	set_time_limit(0);
	

	$values = get_value_array($sql);

	if (strpos($sql,"`artigo`") > 0)
	{
		mysql_query("INSERT INTO `artigos` (`nome`) VALUES($values[1])");
		$artigo_ids[$values[0]] = mysql_insert_id();

	} elseif (strpos($sql, "`materia_prima`") > 0) {
		mysql_query("INSERT INTO `materias_primas` (`nome`) VALUES($values[1])");
		$materia_prima_ids[$values[0]] = mysql_insert_id();
		
	} elseif (strpos($sql, "`pedido`") > 0) {
		$created_by = (isset($usuario_ids[$values[1]])) ? $usuario_ids[$values[1]] : 1;
		$cliente = $entidade_ids[$values[2]];
		$fornecedor = $entidade_ids[$values[3]];

		$hash = md5(time().$created_by.$cliente.$fornecedor.rand(0,999));
		
		mysql_query("INSERT INTO `pedidos` (`cliente_id`,
											`fornecedor_id`,
											`icms`,
											`moeda`,
											`faturamento`,
											`ordem_servico`,
											`data_entrega`,
											`fechado`,
											`cancelado`,
											`visualizar`,
											`created_at`,
											`updated_at`,
											`created_by`)
									VALUES (
										$cliente,
										$fornecedor,
										$values[6],
										$values[5],
										$values[7],
										$values[10],
										$values[12],
										1,
										$values[11],
										'$hash',
										$values[13],
										$values[13],
										$created_by
									)");
		$pedidos_data_emissao[$values[0]] = $values[13];
		$pedido_ids[$values[0]] = mysql_insert_id();
		if ($pedido_ids[$values[0]] <= 0) {
			echo mysql_error()."<br />\n";
			var_dump($values);exit;
		}
		$pedidos_by_user[$pedido_ids[$values[0]]] = $created_by;


	} elseif (strpos($sql, "`artigo_pedido`") > 0)
	{
		if (!isset($materia_prima_ids[$values[2]]) || !isset($artigo_ids[$values[3]])) {
			// registro mal formado
			continue;
		}

		$pedido_id = $pedido_ids[$values[1]];
		$materia_prima_id = $materia_prima_ids[$values[2]];
		$artigo_id = $artigo_ids[$values[3]];

		if (!isset($pedidos_updated[$pedido_id])) {
			mysql_query("UPDATE `pedidos` SET `artigo_id` = $artigo_id,
								`materia_prima_id` = $materia_prima_id,
								`tamanho_peca` = $values[10],
								`espessura` = $values[9],
								`unidade_medida` = $values[6],
								`classificacao` = $values[5],
								`linha_producao_id` = '1'
						WHERE `id` = $pedido_id");
			
			$pedidos_updated[$pedido_id] = true;
			if (!empty($values[11])) {
				$usuario_id = $pedidos_by_user[$pedido_id];
				mysql_query("INSERT INTO `logs` (`usuario_id`, `msg`, `relation_table`, `relation_id`, `created_at`)
										 VALUES( $usuario_id, $values[11], 'pedidos', $pedido_id, ".$pedidos_data_emissao[$pedido_id].") ");
				if (mysql_insert_id() <= 0) {
					echo mysql_error();
					var_dump(array(
						'values' => $values,
						'usuario_id' => $usuario_id,
						'log' => $values[11],
						'pedidos_data_emissao' => $pedidos_data_emissao[$pedido_id]
					));
					exit;
				}
			}
		}
		mysql_query("INSERT INTO `artigos_pedidos` (`pedido_id`, `cor`, `quantidade`, `valor_unitario`, `valor_unitario_corrigido`, `data_reprogramacao`, `created_at`)
											 VALUES($pedido_id, $values[4], $values[7], $values[8], $values[8], $values[13], ". $pedidos_data_emissao[$pedido_id] ." )");
		if (mysql_insert_id() > 0) {
			$quantidades++;
		} else {
			echo mysql_error();exit;
		}

	} elseif (strpos($sql, "`entidade`") > 0)
	{
		mysql_query("INSERT INTO `entidades`(`nome`, `tipo`, `endereco`, `cidade`, `bairro`, `cep`, `uf`, `fax`, `cnpj`, `insc_estadual`, `pais`, `invisivel`)
										VALUES($values[1], ".$novo_tipo_entidade[$values[13]].", $values[3], $values[4], $values[5], $values[6], $values[7], $values[8], $values[10], $values[11], 'Brasil', ". ($values[12]=="0" ? "1" : "0") .")");
		$entidade_ids[$values[0]] = mysql_insert_id();
		if ($entidade_ids[$values[0]] <= 0) {
			var_dump($entidade_ids[$values[0]]);
			var_dump($values);
			var_dump(mysql_error());
			exit;
		}
		

	} elseif (strpos($sql, "`representante`") > 0)
	{
		if ($values[6] == "1") {
			mysql_query("INSERT INTO `usuarios` (`nome`, `email`, `senha`, `tipo`) VALUES($values[1], $values[2], $values[3], ".$novo_tipo_usuario[$values[5]].")");
			$usuario_ids[$values[0]] = mysql_insert_id();

			if ($usuario_ids[$values[0]] <= 0) {
				echo mysql_error();
				var_dump($usuario_ids);exit;
			}

			
		}
	} elseif (strpos($sql, "`entidade_contato`") > 0) {
		
	}
}

$total_usuarios = count($usuario_ids);
$total_artigos = count($artigo_ids);
$total_materias_primas = count($materia_prima_ids);
$total_entidades = count($entidade_ids);
$total_pedidos = count($pedido_ids);
echo <<<ESTATISTICAS
	Terminou a importação. <br />
	<ul>
		<li>Usuários importados: $total_usuarios</li>
		<li>Artigos importados: $total_artigos</li>
		<li>Matérias primas importadas: $total_materias_primas</li>
		<li>Entidades importadas: $total_entidades</li>
		<li>Pedidos importados: $total_pedidos</li>
		<li>Total de itens nos pedidos: $quantidades</li>
	</ul>
ESTATISTICAS;


function get_value_array($sql)
{
	//$sql = "INSERT INTO `pedido` VALUES(23, 7, 15, 6, 22687.5, 'BRL', '12%', 'A vista', NULL, NULL, '58344', 0, '2009-04-16 00:00:00', '2009-04-01 11:08:58');";

	$start = strpos($sql,'VALUES(') + 7;
	$length = strlen($sql);
	$values = substr($sql, $start, $length-$start-2);
	$nv = array();

	preg_match_all('/(NULL|\'(.*?)\'|([.0-9]{1,8}))[,\s|\)]/', $sql, $matches);
	return $matches[1];
}
?>
