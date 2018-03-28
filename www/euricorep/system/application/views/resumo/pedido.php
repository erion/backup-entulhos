<?php
if(!$modal) $this->load->view('pedido/editar_programacao');
if (!isset($email)) :
?>
<script type="text/javascript">
    function imprimir(id) {
        $('.qtip').remove();
		$('.finalizado').each(function() {
			$(this).attr('class','finalizado_imprimindo');
		});
        $('#TB_load').show();
        window.print();
            $.post(getBaseURL()+'index.php/pedidos/imprimir/'+id, null,function(data) {
                $('#TB_load').remove();
                var tr_remover_classe = '#'+id;
                $(tr_remover_classe).parent().removeClass('a_imprimir');
				$('.finalizado_imprimindo').each(function() {
					$(this).attr('class','finalizado');
				});
            });
    }

	function excluir_obs(selector,id) {
		if (confirm('Deseja excluir esta observação?')){
			$(selector).qtip('destroy');
			$(selector).parent().parent().remove();
			$.post(getBaseURL()+'index.php/pedidos/excluir_obs/'+id, {data_reprogramacao: $('#reprogramacao').val()} ,function(data) {});
		}
	}

    function analise_critica_comercial(pedido_id) {
        if(confirm("Preencher dados financeiros?")) {
            window.open(getBaseURL()+'index.php/pedidos/imprimir_analise/'+pedido_id+'/true');
        } else {
            window.open(getBaseURL()+'index.php/pedidos/imprimir_analise/'+pedido_id);
        }
    }

    $(document).ready(function(){
		$('#TB_window img.top_qtip[title],#TB_window a.top_qtip[title]').qtip({
           style: { border:{color:'#A9A9A9'}, name: 'light',tip:true },
           show: 'mouseover',
           hide: 'mouseout',
		   position: {
			  corner: {
				 target: 'topRight',
				 tooltip: 'bottomLeft'
			  }
		   },
           fixed:true,
           onHide: function(){
                $(this).qtip('destroy');
           }
        });

        $('#TB_window img[title],#TB_window a[title],#TB_window span[title]').qtip({
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
<?php endif; ?>
<div class="resumo_pedido">
	<?php if (!isset($email)) : ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/resumo.css" />
		<ul class="imagens">
			<?php if($this->uri->segment(2) != 'visualizar_resumo'): ?>
				<li class="risco_fechar"><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' title="fechar" /></li>
			<?php endif; ?>
				<li><img src="<?php echo base_url() ?>assets/img/resumo_imprimir.gif" onclick="imprimir(<?php echo $pedido->id ?>)" alt="" title="imprimir esta página" /></li>
                        <?php if($tipo_usuario == USUARIO_CURTUME_COMERCIAL): ?>
                                <li><a target="blank" onclick="analise_critica_comercial(<?php echo $pedido->id ?>)"><img src="<?php echo base_url() ?>assets/img/imprimir_analise_critica.gif" alt="" title="imprimir análise crítica" /></a></li>
                        <?php else: ?>
				<li><a target="blank" href="<?php echo site_url()."/pedidos/imprimir_analise/".$pedido->id ?>"><img src="<?php echo base_url() ?>assets/img/imprimir_analise_critica.gif" alt="" title="imprimir análise crítica" /></a></li>
                        <?php endif; ?>
				<li><?php echo anchor(site_url().'/pedidos/observacao/'.$pedido->id."/pedidos?height=369&width=478&modal=true","<img src='".base_url()."assets/img/resumo_comentario.gif' alt='' title='adicionar comentário' />","class='thickbox' ") ?></li>
			<?php if ($tipo_usuario == 'ADM' || $tipo_usuario == 'SAD'):
					echo "<li class='risco' >".anchor(site_url().'/pedidos/detalhes/'.$pedido->id,"<img src='".base_url()."assets/img/resumo_editar.gif' alt='' title='editar pedido' /> ")."</li>";
                                        echo "<li>".anchor(site_url().'/pedidos/historico/'.$pedido->id."?height=469&width=600&modal=true","<img src='".base_url()."assets/img/resumo_historico.png' alt='' title='exibir histórico' />","class='thickbox'")."</li>";
					if($pedido->fechado == "0" && $pedido->cancelado == "0"):
			?>
				<li><?php echo anchor_confirm("pedidos/finalizar/".$pedido->id,"Tem certeza de que deseja finalizar este pedido?","<img src='".base_url()."assets/img/resumo_finalizar.gif' alt='' title='marcar como finalizado'/>") ?></li>
			<?php   else:?>
				<li><?php echo anchor_confirm("pedidos/reativar/".$pedido->id."/?".$this->input->server('QUERY_STRING'),"Tem certeza de que deseja reativar este pedido?","<img src='".base_url()."assets/img/resumo_reativar.gif' alt='' title='reativar pedido'/>") ?></li>
			<?php   endif;
				  elseif($tipo_usuario == 'CCM'):
					echo "<li class='risco' >".anchor(site_url().'/pedidos_comercial/editar/'.$pedido->id,"<img src='".base_url()."assets/img/resumo_editar.gif' alt='' title='editar pedido' />")."</li>";
				  endif;
			?>
		</ul>
	<?php endif; ?>
	<?php
		if($this->input->get('projecao'))
			$amostra = 2;
		else
			$amostra = $this->input->get('amostrav');
		$codigos = array();
		$thickbox = '';
		if(!empty($pedido->ordem_servico))
			$codigos[] = "O.C.".$pedido->ordem_servico;
		if(!empty($pedido->nota_fiscal))
			$codigos[] = "NF.".$pedido->nota_fiscal;
		if(!empty($pai))
			$thickbox = " (<a style='color:#000000 !important' href='".site_url()."/resumos/resumo_pedido/".$pai."?height=469&width=620&modal=true&amostrav=".$amostra."&projecao=1' class='thickbox sublinhado' >visualizar projeção</a>)"
	?>
	<h4>O.I.<?php echo $pedido->id ?><span><?php echo (!empty($codigos) ? ' - '.implode(' | ', $codigos) : '').$thickbox ?></span></h4>
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
					echo anchor(site_url().'/resumos/email/'.$pedido->id."/cliente?height=469&width=620&modal=true&amostrav=".$amostra,$cliente." <img src='".base_url()."assets/img/enviar_email.gif' alt='' />".$email_confirmado,"class='thickbox' title='".$title."'");
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
					echo anchor(site_url().'/resumos/email/'.$pedido->id."/fornecedor?height=469&width=620&modal=true&amostrav=".$amostra,$fornecedor." <img src='".base_url()."assets/img/enviar_email.gif' alt='' />".$email_confirmado,"class='thickbox' title='".$title."'");
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
	<div class="detalhes_artigo">
	<?php
		$lista_artigo = "";
		if (!empty($artigo))
			$lista_artigo .= $artigo;
		if (!empty($mat_prima))
			$lista_artigo .= "<span> - ".$mat_prima."</span>";
	?>
		<h2><?php echo $lista_artigo ?></h2>
		<div class="detalhes">
			<?php if (!empty($pedido->classificacao)): ?>
			<dl>
				<dt>Classificação</dt>
				<dd><span><?php echo $pedido->classificacao ?></span></dd>
			</dl>
			<?php endif; if (!empty($pedido->unidade_medida)): ?>
			<dl>
				<dt>Medidos em</dt>
				<dd><span><?php echo $pedido->unidade_medida ?></span></dd>
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
			if (count($artigo_pedido) > 0) {
				echo "<table><thead>";
				$reprogramado = false;
				foreach ($artigo_pedido as $ap) {
					if (!empty($ap->data_reprogramacao) && $ap->data_reprogramacao != 0)
						$reprogramado = true;
				}
				if($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO) {
					if ($reprogramado)
						echo "<th>Cor</th><th>Fatur.</th><th>Tipo</th><th class='reprogramacao'>Reprog.</th></thead><tbody>";
					else
						echo "<th>Cor</th><th>Fatur.</th><th>Tipo</th></thead><tbody>";
				} else {
					if ($reprogramado)
						echo "<th>Cor</th><th>Fatur.</th><th>Valor</th><th>Tipo</th><th class='reprogramacao'>Reprog.</th></thead><tbody>";
					else
						echo "<th>Cor</th><th>Fatur.</th><th>Valor</th><th>Tipo</th></thead><tbody>";
				}
				foreach ($artigo_pedido as $ap) {
					if ($ap->data_reprogramacao > 0 && !$this->input->get('projecao')) {
						if($ap->fechado == 0)
							$rep = "<img src='".base_url()."assets/img/reprogramado_para.gif' class='top_qtip' alt='' title='reprogramado para ".data_br($ap->data_reprogramacao)."' />";
						else
							$rep = "";
						$rep_impressao = "<td class='reprogramacao'>".data_br($ap->data_reprogramacao)."</td>";
					} else {
						$rep = null;
						$rep_impressao = $rep;
					}
					$total_entregue = 0;
					$title_oi = "<table><thead><th><b>Qtd.</b></th><th><b>Entregue</b></th><th><b>N.F.</b></th></thead><tbody>";
					$this_faturamento = array();
					if(!empty($_GET['projecao'])) {
						if(isset($faturamento[$ap->cor]))
							$this_faturamento = $faturamento[$ap->cor];
					} else {
						if(isset($faturamento[$ap->id]))
							$this_faturamento = $faturamento[$ap->id];
					}
					foreach($this_faturamento as $f) {
						$title_oi .= "<tr><td>".double_br($f['qtd'])."</td><td>".$f['data']."</td><td>".$f['nota_fiscal']."</td></tr>";
						$total_entregue += $f['qtd'];
					}
					$title_oi .= "</tbody></table>";
					if(!$this->input->get('projecao')) {
						$href_modal_artigo = site_url()."/resumos/resumo_pedido/".$pedido->id."/".$ap->id."?height=469&width=620&modal=true&amostrav=".$amostra;
						$visualizar_artigo_begin = "<a class='thickbox sublinhado' href='".$href_modal_artigo."' title='visualizar artigo' >";
						$visualizar_artigo_end = "</a>";
						$show_faturamento = "<a href='".$href_modal_artigo."' class='thickbox' title='".$title_oi."' >".double_br(($ap->quantidade-$total_entregue))."/".double_br($ap->quantidade)."</a>";
					} else {
						$href_modal_artigo = $visualizar_artigo_begin = $visualizar_artigo_end = "";
						$show_faturamento = "<span style='cursor:default' title='".$title_oi."'>".double_br(($ap->quantidade-$total_entregue))."/".double_br($ap->quantidade)."</spa>";
					}
					if (isset($email))//se envia por email, não mostra title
						$title_oi = "";
					$reprogramar = null;
					if($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO && !$modal)
						$reprogramar = anchor('#TB_inline?height=55&width=315&inlineId=editar_reprogramacao',"<img src='".base_url()."assets/img/lapis.png' title='reprogramar' />","class='thickbox' onclick=\"show_thickbox(".$ap->id.",$(this).parent(),'".$ap->data_reprogramacao."')\"");
					echo ($ap->fechado == 1) ? "<tr class='finalizado'>" : "<tr>";
					echo "<td>".$visualizar_artigo_begin.$ap->cor.$reprogramar."  ".$rep.$visualizar_artigo_end."</td>";

					echo "<td>".$show_faturamento."</td>";

					if($tipo_usuario != USUARIO_CURTUME_PROGRAMACAO)
						echo "<td>".double_br($ap->valor_unitario_corrigido)."</td>";
					echo "<td>".$ap->get_amostra()."</td>";
					echo $rep_impressao."</tr>";
				}
				echo "</tbody></table>";
			}
			?>
		</div>
	</div>
	<ul class="obs">
		<?php
		if (!empty($observacao) || !empty($filhos)): ?>
			<li>Observação</li>
			<?php
				if($pedido->projecao == '1'):
					$cor = false;
					foreach($filhos as $fp):
						echo "<li><p>";
						$href_modal_artigo = site_url()."/resumos/resumo_pedido/".$fp->id."?height=469&width=620&modal=true&amostrav=".$amostra;
						$visualizar_artigo_begin = "<a class='thickbox sublinhado' href='".$href_modal_artigo."' title='visualizar pedido' >";
						$visualizar_artigo_end = "</a>";
						echo $fp->usuario_nome($fp->created_by)." - ".$visualizar_artigo_begin."Novo pedido: ".$fp->id.$visualizar_artigo_end;
			?>
						<span><?php echo " - ".date('d/m',strtotime($fp->created_at)) ?></span>
			<?php		echo "</p></li>";
					endforeach;
				endif;
			foreach ($observacao as $log):
				if($log->cor != '1') {
					$cor = $log->cor;
					$href_modal_artigo = site_url()."/resumos/resumo_pedido/".$pedido->id."/".$log->ap_id."?height=469&width=620&modal=true&amostrav=".$amostra;
					$visualizar_artigo_begin = "<a class='thickbox sublinhado' href='".$href_modal_artigo."' title='visualizar artigo' >";
					$visualizar_artigo_end = "</a> - ";
				} else {
					$cor = "";
					$visualizar_artigo_end = $visualizar_artigo_begin = $href_modal_artigo = $cor;
				}
			?>
				<li><p><?php
							echo $log->usuario." - ".$visualizar_artigo_begin.$cor.$visualizar_artigo_end.strip_tags(str_replace("<br>"," ",$log->msg),"<i>");
					   ?>
					<span>
						<?php
							echo " - ".date('d/m',strtotime($log->created_at));
							if($tipo_usuario == USUARIO_ADMINISTRADOR || $tipo_usuario == USUARIO_SUPER_ADMINISTRADOR):
						?>
								<img src='<?php echo base_url() ?>assets/img/resumo_excluir_obs.gif' alt='' title='excluir' onclick='excluir_obs($(this),<?php echo $log->id ?>)' />
					<?php   endif; ?>
					</span>
					</p>
				</li>
		<?php
			endforeach;
		endif; ?>
	</ul>
</div>