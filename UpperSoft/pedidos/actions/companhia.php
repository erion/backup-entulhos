<?php
	testa_sessao();

	$pais_query = mysql_query("SELECT * FROM pais order by descricao");
	while ($pais = mysql_fetch_assoc($pais_query)) {
		$paises[] = $pais;
	}
	
	if ($_GET['keepThis'] == true) {
		require("../includes/ServerValidator.php");		
	} else {
		require("includes/ServerValidator.php");		
	}	
	
	$validacao = new ServerValidator($_POST);
	
	$regras['nome'] = "Required|NotNull";
	$regras['tipo'] = "Required|NotNull";	
	
	$validacao->setRules($regras);	
	
	if (count($_POST) > 0) {
		
		if ($validacao->Run()) {

			if ($_GET['acao'] == 'inserir') {
				$insert = "INSERT INTO companhia(" .
							"nome,endereco,pais_id,fone,celular,contato,tipo)" .
							"VALUES('{$_POST['nome']}','{$_POST['endereco']}','{$_POST['pais']}','{$_POST['telefone']}','{$_POST['celular']}','{$_POST['contato']}','{$_POST['tipo']}');";
				$query = mysql_query($insert);
				if (isset($_GET['retorna_id'])) {
					echo mysql_insert_id(); exit;
				}
				
				if ($query) {
					echo "Registro inserido com sucesso.";
					redirecionar("?pagina=companhia&tabela=companhia");
				} else {
					echo "Erro ao inserir registro, tente novamente.";
				}			
			} elseif ($_GET['acao'] == 'editar') {
				$update = "UPDATE companhia set pais_id = {$_POST[pais]}, nome = '{$_POST['nome']}', endereco = '{$_POST['endereco']}', fone = '{$_POST['telefone']}', celular = '{$_POST['celular']}', contato = '{$_POST['contato']}', tipo = '{$_POST['tipo']}' WHERE companhia_id = {$_GET['id']} ";
				$query = mysql_query($update);
				
				if ($query) {
					redirecionar("?pagina=companhia&tabela=companhia");
				} else {
					echo "Erro ao alterar registro, tente novamente.";
				}
			}			
		} else {
			echo $validacao->getErrorList();
		}		
	}
	
	if ($_GET['acao'] == 'editar') {
	 	$query = mysql_query("SELECT * FROM companhia WHERE companhia_id = {$_GET['id']}");
	 	$editar = mysql_fetch_assoc($query);
	}
	
	if ($_GET['acao'] == 'excluir') {
		mysql_query("DELETE FROM companhia WHERE companhia_id = {$_GET['id']}");
	}
		
?>
