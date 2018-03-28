<?php
	testa_sessao();
	
	function ValidaData($dtPedido,$campo,$dtEntrega) {
		$dtEntrega = $_POST[$dtEntrega];
		$d1 = date('Ymd',strtotime(formatar_data($dtPedido)));
		$d2 = date('Ymd',strtotime(formatar_data($dtEntrega)));
		if ($d1 >= $d2) {
			return false;
		} else {
			return true;			
		}	
	}
	
	require("includes/ServerValidator.php");
	
	$validacao = new ServerValidator($_POST);
	
	$regras['companhia'] = "Required|NotNull";
	$regras['cliente'] = "Required|NotNull";
	$regras['item'] = "Required|NotNull";
	$regras['materia_prima'] = "Required|NotNull";
	$regras['pais'] = "Required|NotNull";
	$regras['artigo'] = "Required|NotNull";
	$regras['tipo_acabamento'] = "Required|NotNull";
	$regras['finalidade'] = "Required|NotNull";
	$regras['tamanho'] = "Required|NotNull";
	$regras['espessura'] = "Required|NotNull";
	$regras['classificacao'] = "Required|NotNull";
	$regras['percent_classificacao'] = "Required|NotNull";
	$regras['cor'] = "Required|NotNull";
	$regras['quantidade'] = "Required|NotNull";
	$regras['moeda'] = "Required|NotNull";
	$regras['preco'] = "Required|NotNull";
	$regras['icms'] = "Required|NotNull";
	$regras['condicao_pgto'] = "Required|NotNull";
	$regras['fornecedor'] = "Required|NotNull";
	$regras['contato'] = "Required|NotNull";
	$regras['data_pedido'] = "Required|ValidaData(data_entrega)";
	
	$campos['companhia'] = "Companhia";
	$campos['cliente'] = "Cliente";
	$campos['item'] = "Item";
	$campos['materia_prima'] = "Mat. Prima";
	$campos['pais'] = "País";
	$campos['artigo'] = "Artigo";
	$campos['tipo_acabamento'] = "Tipo de Acabamento";
	$campos['finalidade'] = "Finalidade";
	$campos['tamanho'] = "Tamanho/Couro";
	$campos['espessura'] = "Espessura";
	$campos['classificacao'] = "Classificação";
	$campos['percent_classificacao'] = "% Classificação";
	$campos['cor'] = "Cor";
	$campos['quantidade'] = "Quantidade";
	$campos['moeda'] = "Moeda";
	$campos['preco'] = "Valor/Couro";
	$campos['icms'] = "ICMS";
	$campos['condicao_pgto'] = "Condição de Pagamento";
	$campos['fornecedor'] = "Fornecedor";
	$campos['contato'] = "Contato";	
	
	$validacao->setRules($regras);
	$validacao->setFields($campos);		
	
	if (count($_POST) > 0) {
		
		if ($validacao->Run()) {

			if ($_GET['acao'] == 'inserir') {
				
				$testa_cor = mysql_query("SELECT * FROM cor WHERE descricao = '{$_POST['cor']}'");
				if (mysql_num_rows($testa_cor) == 0) {
					$insere_cor = mysql_query("INSERT INTO cor(descricao) VALUES ('{$_POST['cor']}')");
					$cor_id = mysql_insert_id();
				} else {
					if (empty($_POST['cor_id'])) {
						$cor_row = mysql_fetch_row($testa_cor);
						$cor_id = $cor_row[0];
					} else {
						$cor_id = $_POST['cor_id'];
					}
				}
	
				$data_pedido = formatar_data($_POST['data_pedido']);
				$data_entrega = formatar_data($_POST['data_entrega']);
				
				$query = "INSERT INTO pedido(companhia_id, cliente_id, data, prazo_entrega," .
						"					usuario_id, icms, condicao_pgto, pais_id," .
						"					fornecedor_id, contato, representante)".
						"VALUES(" .
								"{$_POST['companhia_id']}," .
								"{$_POST['cliente_id']}," .
								"'{$data_pedido}', " .
								"'{$data_entrega}'," .
								"{$_SESSION['usuario_id']}," .
								"'{$_POST['icms']}'," .
								"'{$_POST['condicao_pgto']}'," .
								"{$_POST['pais_id']}," .
								"{$_POST['fornecedor_id']}," .
								"'{$_POST['contato']}'," .
								"'{$_POST['representante']}')";
								
				$insert = mysql_query($query);	
	
				$pedido_id = mysql_insert_id();
				
				$query = "INSERT INTO item_pedido(item_id, pedido_id, tipo_acabamento_id, " .
						"						cor_id, espessura, tamanho, quantidade," .
						"						unidade_qtd, artigo_id, unidade_tamanho," .
						"						 mat_prima_id, finalidade_id, classificacao, " .
						"						percent_classificacao, moeda, preco)" .
						" VALUES(" .
						"{$_POST['item_id']}," .
						"{$pedido_id}," .
						"{$_POST['tipo_acabamento_id']}," .
						"{$cor_id}," .
						"'{$_POST['espessura']}'," .
						"'{$_POST['tamanho']}',".
						"{$_POST['quantidade']}," .
						"{$_POST['unidade_qtd']}," .
						"{$_POST['artigo_id']}," .
						"{$_POST['unidade']}," .
						"{$_POST['mat_prima_id']}," .
						"{$_POST['finalidade_id']}," .
						"'{$_POST['classificacao']}'," .
						"'{$_POST['percent_classificacao']}'," .
						"'{$_POST['moeda']}'," .
						"'{$_POST['preco']}')";
				
				$insert = mysql_query($query);
	
				if ($query) {
					redirecionar("?pagina=pedido&tabela=pedido");
				} else {
					echo "Falha ao inserir registro, tente novamente.";
				}
	
			} elseif ($_GET['acao'] == 'editar') {
				$data_pedido = formatar_data($_POST['data_pedido']);
				$data_entrega = formatar_data($_POST['data_entrega']);				
				$update = "UPDATE pedido set companhia_id = {$_POST['companhia_id']}, cliente_id = {$_POST['cliente_id']}, data = '{$data_pedido}', " .
						" prazo_entrega = '{$data_entrega}', usuario_id = {$_SESSION['usuario_id']}, icms = '{$_POST['icms']}', condicao_pgto = '{$_POST['condicao_pgto']}', " .
						" pais_id = {$_POST['pais_id']}, fornecedor_id = {$_POST['fornecedor_id']}, contato = '{$_POST['contato']}', representante = '{$_POST['representante']}'" .
						" WHERE pedido_id = {$_GET['idp']}";

				$query = mysql_query($update);
				$update = "UPDATE item_pedido set item_id = {$_POST['item_id']}, pedido_id = {$_GET['idp']}," .
						" tipo_acabamento_id = {$_POST['tipo_acabamento_id']}, cor_id = {$_POST['cor_id']}," .
						" espessura = '{$_POST['espessura']}', tamanho = '{$_POST['tamanho']}'," .
						" quantidade = {$_POST['quantidade']}, unidade_qtd = {$_POST['unidade_qtd']}," .
						" artigo_id = {$_POST['artigo_id']}, unidade_tamanho = {$_POST['unidade']}," .
						" mat_prima_id = {$_POST['mat_prima_id']}, finalidade_id = {$_POST['finalidade_id']}," .
						" classificacao = '{$_POST['classificacao']}', percent_classificacao = '{$_POST['percent_classificacao']}'," .
						" moeda = '{$_POST['moeda']}', preco = '{$_POST['preco']}' " .
						" WHERE item_pedido_id = {$_GET['idip']} ";
				$query = mysql_query($update);				
			
				if ($query) {
					redirecionar("?pagina=pedido&tabela=pedido");
				} else {
					echo "Erro ao alterar registro, tente novamente.";
				}				
			}		
		} else {
			echo $validacao->getErrorList();
		}
	}	
	
	if ($_GET['acao'] == 'editar') {
		
		$query = mysql_query("SELECT c.nome as companhia, cl.nome as cliente, f.nome as fornecedor, p.*, ip.*,".
							" usu.login, i.descricao as item, t.descricao as tipo_acabamento,".
							" co.descricao as cor, a.descricao as artigo, u.descricao as unidade,".
							" fi.descricao as finalidade, m.descricao as materia_prima, pa.descricao as pais".
							" FROM pedido p left join companhia c on (p.companhia_id = c.companhia_id)".
							" LEFT JOIN companhia cl on (cl.companhia_id = p.cliente_id)".
							" LEFT JOIN companhia f on (f.companhia_id = p.fornecedor_id)".
							" LEFT JOIN item_pedido ip on (p.pedido_id = ip.pedido_id )".
							" LEFT JOIN artigo a on (ip.artigo_id = a.artigo_id)".
							" LEFT JOIN pais pa on (p.pais_id = pa.pais_id)".
							" LEFT JOIN mat_prima m on (ip.mat_prima_id = m.mat_prima_id)".
							" LEFT JOIN tipo_acabamento t on (ip.tipo_acabamento_id = t.tipo_acabamento_id)".
							" LEFT JOIN cor co on (ip.cor_id = co.cor_id)".
							" LEFT JOIN unidade u on (ip.unidade_tamanho = u.unidade_id)".
							" LEFT JOIN item i on (ip.item_id = i.item_id)".
							" LEFT JOIN usuario usu on (p.usuario_id = usu.usuario_id)".
							" LEFT JOIN finalidade fi on (ip.finalidade_id = fi.finalidade_id)".
							" WHERE p.pedido_id = {$_GET['idp']}" .
							" AND ip.item_pedido_id = {$_GET['idip']}" .
							" AND p.usuario_id = {$_SESSION['usuario_id']}");
		
		if (mysql_num_rows($query) == 0) {
			echo "Você não tem permissão para alterar este pedido.";
		} else {
			$editar = mysql_fetch_assoc($query);	
		}					
	}
	
	if ($_GET['acao'] == 'excluir') {
		$query = mysql_query("DELETE FROM item_pedido WHERE item_pedido_id = {$_GET['idip']}");
		$query = mysql_query("DELETE FROM pedido WHERE pedido_id = {$_GET['idp']}");
	}
	
	$query = mysql_query("SELECT * FROM unidade order by descricao");
	while ($unidade = mysql_fetch_assoc($query)) {
		$unidades[] = $unidade;
	}	
?>
