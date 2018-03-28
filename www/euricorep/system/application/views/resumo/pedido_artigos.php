<script type="text/javascript">
	function excluir_obs(selector,id) {
		if (confirm('Deseja excluir esta observação?')){
			$(selector).qtip('destroy');
			$(selector).parent().parent().remove();
			$.post(getBaseURL()+'index.php/pedidos/excluir_obs/'+id, {data_reprogramacao: $('#reprogramacao').val()} ,function(data) {});
		}
	}

    function cancelar(artigo_id,pedido_id) {
		if (confirm('Tem certeza de que deseja cancelar este artigo?')){
			$("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
			$('#TB_load').show();
			$.post(getBaseURL()+'index.php/pedidos/cancelar_artigo/'+artigo_id, function(data) {
				tb_show("",getBaseURL()+"index.php/resumos/resumo_pedido/"+pedido_id+"?height=469&width=620&modal=true&amostrav=2");
			});
		}
    }

    function finalizar(artigo_id,pedido_id) {
		if (confirm('Tem certeza de que deseja finalizar este artigo?')){
			$("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
			$('#TB_load').show();
			$.post(getBaseURL()+'index.php/pedidos/finalizar_artigo/'+artigo_id, function(data) {
				tb_show("",getBaseURL()+"index.php/resumos/resumo_pedido/"+pedido_id+"?height=469&width=620&modal=true&amostrav=2");
			});
		}
    }

    function analise_critica_comercial(pedido_id,artigo_id) {
        if(confirm("Preencher dados financeiros?")) {
            window.open(getBaseURL()+'index.php/pedidos/imprimir_analise/'+pedido_id+'/true/'+artigo_id);
        } else {
            window.open(getBaseURL()+'index.php/pedidos/imprimir_analise/'+pedido_id+'/false/'+artigo_id);
        }
    }

    $(document).ready(function(){
        $('#TB_window img[title],#TB_window a[title]').qtip({
           style: { border:{color:'#A9A9A9'}, name: 'light',tip:true },
           show: 'mouseover',
           hide: 'mouseout',
           fixed:true,
           onHide: function(){
                $(this).qtip('destroy');
           }
        });
    });
</script>
<style type="text/css">
	table tr.faturamento_sobrando {font-weight:bold;color:rgb(51,166,0);}
	table tr.faturamento_faltando {font-weight:bold;color:rgb(166,0,0);}
</style>
<div class="resumo_pedido">
<?php if (!isset($email)) : ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/resumo.css" />
	<ul class="imagens">
		<li class="risco_fechar"><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' title="fechar" /></li>
		<li class="risco"><?php echo anchor(site_url().'/pedidos/observacao/'.$artigo_pedido->id."/artigos_pedidos?height=369&width=478&modal=true","<img src='".base_url()."assets/img/resumo_comentario.gif' alt='' title='adicionar comentário' />","class='thickbox' ") ?></li>
                <?php if($tipo_usuario == USUARIO_CURTUME_COMERCIAL): ?>
                        <li><a target="blank" href="#" onclick="analise_critica_comercial(<?php echo $pedido->id ?>,<?php echo $artigo_pedido->id ?>)"><img src="<?php echo base_url() ?>assets/img/imprimir_analise_critica.gif" alt="" title="imprimir análise crítica" /></a></li>
                <?php else: ?>
                        <li><a target="blank" href="<?php echo site_url()."/pedidos/imprimir_analise/".$pedido->id."/".$artigo_pedido->id ?>"><img src="<?php echo base_url() ?>assets/img/imprimir_analise_critica.gif" alt="" title="imprimir análise crítica" /></a></li>
                <?php endif; ?>
		<?php if ($tipo_usuario == 'ADM' || $tipo_usuario == 'SAD'): ?>
			<li><?php echo anchor_confirm("#","Tem certeza de que deseja cancelar este artigo?","<img src='".base_url()."assets/img/resumo_cancelar.gif' alt='' title='cancelar artigo' onclick='cancelar(".$artigo_pedido->id.",".$pedido->id.")' />","onclick='return false'") ?></li>
			<li><?php echo anchor_confirm("#","Tem certeza de que deseja finalizar este artigo?","<img src='".base_url()."assets/img/resumo_finalizar.gif' alt='' title='marcar artigo como finalizado' onclick='finalizar(".$artigo_pedido->id.",".$pedido->id.")' />","onclick='return false'") ?></li>
		<?php endif;
			if ($tipo_usuario == 'CCM') {
				echo "<li class='risco' >".anchor(site_url().'/pedidos_comercial/editar/'.$pedido->id."/".$artigo_pedido->id,"<img src='".base_url()."assets/img/resumo_editar.gif' alt='' title='editar pedido' />")."</li>";
			}
		?>
	</ul>
<?php endif; ?>
	<?php
		$codigos = array();
		if(!empty($pedido->ordem_servico))
			$codigos[] = "O.C.".$pedido->ordem_servico;
		if(!empty($pedido->nota_fiscal))
			$codigos[] = "NF.".$pedido->nota_fiscal;
	?>
	<h4>O.I.<?php echo $pedido->id ?><span><?php echo (!empty($codigos) ? ' - '.implode(' | ', $codigos) : '')." (<a style='color:#000000 !important' href='".keep_current_gets(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&modal=true")."' class='thickbox sublinhado' >visualizar pedido completo</a>)" ?></span></h4>
	<ul>
		<li>Cliente</li>
		<li><span>
			<?php
				$email_confirmado = "";
				if (!isset($email)) $title = 'enviar e-mail para o cliente';
				else			    $title = "";
				if($pedido->email_enviado_cliente == 1)
					$email_confirmado = " <img src='".base_url()."assets/img/enviado_email.gif' alt='' />";
				if ($tipo_usuario == 'ADM' || $tipo_usuario == 'SAD') {
					echo anchor(site_url().'/resumos/email/'.$pedido->id."/cliente?height=469&width=620&modal=true",$cliente." <img src='".base_url()."assets/img/enviar_email.gif' alt='' />".$email_confirmado,"class='thickbox' title='".$title."'");
						 anchor(site_url().'/resumos/email/'.$pedido->id."/cliente?height=469&width=620&modal=true",$cliente." <img src='".base_url()."assets/img/enviar_email.gif' alt='' />".$email_confirmado,"class='thickbox' title='".$title."'");
				} else {
					echo $cliente;
				}
			?>
		</span></li>
	</ul>
	<ul>
		<li>Fornecedor</li>
		<li><span>
			<?php
				$email_confirmado = "";
				if (!isset($email)) $title = 'enviar e-mail para o fornecedor';
				else			    $title = "";
				if($pedido->email_enviado_fornecedor == 1)
					$email_confirmado = " <img src='".base_url()."assets/img/enviado_email.gif' alt='' />";
				if ($tipo_usuario == 'ADM' || $tipo_usuario == 'SAD') {
					echo anchor(site_url().'/resumos/email/'.$pedido->id."/fornecedor?height=469&width=620&modal=true",$fornecedor." <img src='".base_url()."assets/img/enviar_email.gif' alt='' />".$email_confirmado,"class='thickbox' title='".$title."'");
				} else {
					echo $fornecedor;
				}
			?>
		</span></li>
	</ul>
	<dl class="datas">
		<dt>Emissão</dt>
		<dd><span><?php echo data_br($pedido->created_at) ?></span></dd>
	</dl>
	<dl class="datas">
		<dt>Entrega</dt>
		<dd><span><?php echo data_br($pedido->data_entrega) ?></span></dd>
	</dl>
	<?php if($artigo_pedido->data_reprogramacao > 0 && $artigo_pedido->data_reprogramacao != null): ?>
	<dl class="datas">
		<dt>Reprogramado para:</dt>
		<dd><span><?php echo data_br($artigo_pedido->data_reprogramacao)." <img src='".base_url()."/assets/img/reprogramado_para.gif' />" ?></span></dd>
	</dl>
	<?php endif; ?>
	<div class="detalhes_artigo">
	<?php
		$lista_artigo = "";
		if (!empty($artigo))
			$lista_artigo .= $artigo;
		if (!empty($mat_prima))
			$lista_artigo .= "<span> - ".$mat_prima."</span>";
	?>
		<h2><?php echo $lista_artigo ?></h2>
		<h2><?php echo $artigo_pedido->cor." ".double_br($artigo_pedido->quantidade).$pedido->unidade_medida." <span>(".$artigo_pedido->get_amostra().")</span>" ?></h2>
		<div class="detalhes">
			<?php if (!empty($pedido->classificacao)): ?>
			<dl>
				<dt>Classificação</dt>
				<dd><span><?php echo $pedido->classificacao ?></span></dd>
			</dl>
			<?php endif; if (!empty($pedido->valor_unitario_corrigido)): ?>
			<dl>
				<dt>Valor unitário</dt>
				<dd><span><?php echo double_br($pedido->valor_unitario_corrigido) ?></span></dd>
			</dl>
			<?php endif; if (!empty($pedido->tamanho_peca)): ?>
			<dl>
				<dt>Tamanho da peça</dt>
				<dd><span><?php echo $pedido->tamanho_peca ?></span></dd>
			</dl>
			<?php endif; if (!empty($pedido->espessura)): ?>
			<dl>
				<dt>Espessura</dt>
				<dd><span><?php echo $pedido->espessura ?></span></dd>
			</dl>
			<?php endif; if (!empty($pedido->faturamento)): ?>
			<dl>
				<dt>Faturamento</dt>
				<dd><span><?php echo $pedido->faturamento ?></span></dd>
			</dl>
			<?php endif;?>
		</div>
		<div class="artigos_cores">
			<?php
				$total_entregue = 0;$cont = 0;
				echo "<table><thead><tr><th>Qtd.</th><th>Entregue</th><th>N.F</th></tr></thead>";
				foreach($faturamento as $f) {
					$cont++;
					$total_entregue += $f->qtd;
					echo "<tbody>";
					echo "<tr><td>".double_br($f->qtd)."</td>";
					echo "<td>".data_br($f->data)."</td>";
					echo "<td>".$f->nota_fiscal."</td></tr>";
				}
				if($cont == 0) echo "</thead><tbody>";
				$faturado = $artigo_pedido->quantidade - $total_entregue;
				if($faturado > 0)
					echo "<tr class='faturamento_faltando' colspan='3' ><td>Faltando: ".abs($faturado).$pedido->unidade_medida."</td></tr>";
				else
					echo "<tr class='faturamento_sobrando' colspan='3' ><td>Sobrando: ".abs($faturado).$pedido->unidade_medida."</td></tr>";
				echo "</tbody></table>";
			?>
		</div>
	</div>
	<ul class="obs">
		<?php if (!empty($observacao)): ?>
		<li>Observação</li>
		<?php foreach ($observacao as $log): ?>
		<li><p>
			<?php echo $log->usuario_nome()." - ".strip_tags(str_replace("<br>"," ",$log->msg),"<i>") ?>
			<span><?php echo " - ".date('d/m',strtotime($log->created_at));
				if($tipo_usuario == USUARIO_ADMINISTRADOR || $tipo_usuario == USUARIO_SUPER_ADMINISTRADOR): ?>
					<img src='<?php echo base_url() ?>assets/img/resumo_excluir_obs.gif' alt='' title='excluir' onclick='excluir_obs($(this),<?php echo $log->id ?>)' />
			<?php endif; ?>		
			</span>
		</p></li>
		<?php
			endforeach;
		endif; ?>
	</ul>
</div>