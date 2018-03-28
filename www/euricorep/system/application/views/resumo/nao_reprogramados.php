<?php
	$p = new Pedido();
	$nao_reprogramado = $p->get_nao_reprogramado();
	$id = 0;
	$dt_criacao = '';
	$usuario_id = 0;
	$email = array();
	$email_to = $email;
	$u = new Usuario();
	foreach($nao_reprogramado as $nr) {
		if((int)$usuario_id != (int)$nr->created_by) {
			(int)$usuario_id = (int)$nr->created_by;
			if(!in_array($usuario_id,$email_to))
				$email_to[] = $usuario_id;
		}
		if ($dt_criacao != data_br($nr->created_at)) {
			$dt_criacao = data_br($nr->created_at);
			$email[$nr->created_by][] = "<b>Data emissão </b>".data_br($nr->created_at)."<br/><b>Pedido ".$nr->id." - ".$nr->artigo_nome."</b> <a href='".site_url()."/usuarios/login/0/".$nr->visualizar."'>Visualize pelo sistema</a><br/>";
		} elseif($id != $nr->id) {
			$id = $nr->id;
			$email[$nr->created_by][] = "<b>Pedido ".$nr->id." - ".$nr->artigo_nome."</b> <a href='".site_url()."/usuarios/login/0/".$nr->visualizar."'>Visualize pelo sistema</a><br/>";
		}
		$email[$nr->created_by][] = "Cor - ".$nr->cor." - quantidade - ".$nr->quantidade."<br/>";
	}
	foreach($email_to as $send_to) {
		$conteudo = '';
		$u->get_by_id($send_to);
		foreach($email[$u->id] as $e)
			$conteudo .= $e;
		enviar_email($u->email,"Pedidos não reprogramados", $conteudo);
	}
?>
