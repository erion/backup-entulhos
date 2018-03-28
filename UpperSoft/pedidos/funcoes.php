<?php
	ini_set('register_globals','Off');
	session_start();

	$tabelas = array(
		'item' => "Item",
		'artigo' => "Artigo",
		'mat_prima' => "Mat. Prima",
		'classificacao' => "Classificação",
		'tipo_acabamento' => "Tipo de Acabamento",
		'cor' => "Cor",
		'pais' => "País",
		'unidade' => "Unidade",
		'finalidade' => "Finalidade",
		'usuario' => "Usuário" 
	);
	
	$tabelas_plural = array(
		'pedido' => "Pedidos",
		'companhia' => "Companhias",
		'item' => "Itens",
		'artigo' => "Artigos",
		'mat_prima' => "Matérias Primas",
		'classificacao' => "Classificações",
		'tipo_acabamento' => "Tipos de Acabamento",
		'cor' => "Cores",
		'pais' => "Países",
		'unidade' => "Unidades",
		'finalidade' => "Finalidades",
		'usuario' => "Usuários" 
	);

	function testa_sessao() {
		if ($_SESSION['usuario'] == '') {
			redirecionar("index.php?pagina=logincadastro");
			exit;
		}
	}
	
	function formatar_data($data) {
		return implode('-',array_reverse(explode('/',$data)));
	}

	function redirecionar($endereco) {
		header("Location: {$endereco}");
	}
	
	function retornar_valor($input) {
		global $editar;
		
		//função para não perder o valor dos input quando o form é validado
		if ($_GET['acao'] == 'editar') {
			if (count($_POST) > 0) {
				return $_POST[$input];
			} else {
				return $editar[$input];	
			}			
		} 
		elseif (count($_POST) > 0) 
			return $_POST[$input];	 		
	}
	
	function retornar_selecionado($select,$vlr_campo_id, $campo_id) {
		global $editar;
		
		if ($_GET['acao'] == 'editar') {
			if (count($_POST) > 0) {
				if ($_POST[$select] == $vlr_campo_id) {
					return "selected";
				}
			} elseif ($vlr_campo_id == $editar[$campo_id]) {
				return "selected";
			} 
		} elseif ($vlr_campo_id == $_POST[$select]) {
			return "selected";
		}		
	}
	
	function retornar_checado($name,$value) {
		if ($_POST[$name] == $value) {
			echo "checked";
		}
	}
	
	function status_pedido($dt_entrega) {
		$d1 = date('dmY',strtotime('+1 day'));
		$d2 = date('dmY',strtotime(formatar_data($dt_entrega)));
		if ($d2 == $d1) {
			return true;
		} else {
			return false;			
		}			
	}
?>
