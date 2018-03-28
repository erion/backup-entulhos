<style type="text/css">
    .faturamento {
        font-size:12px;
        padding:5px 0px 5px 14px;
    }

    .add {margin-left:0px !important;padding-left:0px !important;}

    table.faturamento tr td img {cursor:pointer;cursor:hand;}
	h3.artigo_expandido a{text-decoration:none !important;}
	.faturamento_artigos {overflow:hidden;}
</style>
<?php
    $new_uri = 'pedidos_comercial/editar/'.$this->uri->segment(3)."/".$this->uri->segment(4);
    echo form_open($new_uri,"class='form_cadastro'");
    $contador = 0;
    foreach($ap as $artigo_pedido):
?>
<h3 <?php echo ($abre_artigo == $artigo_pedido->id)?'class="artigo_expandido"':'class="artigo_comprimido"' ?>><?php echo "<a href='#' onclick='contrai_expande($(this),\"".$artigo_pedido->id."\");return false'>".$artigo_pedido->cor." - ".double_br($artigo_pedido->quantidade)." ".$unidade_medida."</a>" ?></h3>
<div class="faturamento_artigos" id="<?php echo $artigo_pedido->id ?>">
	<dl>
		<dt><label>Valor unitário</label></dt>
		<dd><?php echo form_input('valor_alterado[]',(!empty($artigo_pedido->valor_unitario_corrigido)) ? double_br($artigo_pedido->valor_unitario_corrigido) : double_br($artigo_pedido->valor_unitario),'id="valor['.$contador.']" rel="validacao"') ?></dd>
	</dl>
	<dl>
		<dt><label>P.I.</label></dt>
		<dd><?php echo form_input('oi_curtume[]',$artigo_pedido->oi_curtume,'id="oi_curtume['.$contador.']" rel="validacao"') ?></dd>
	</dl>
	<?php echo form_hidden('artigo_pedido_id[]',$artigo_pedido->id); ?>
	<table class="faturamento">
		<thead>
			<th width="100px">N.F.</th>
			<th width="60px">Qtd.</th>
			<th width="50px">Data</th>
			<th>&nbsp;</th>
		</thead>
		<tbody>
	<?php $i = 0;
		if(isset($fat[$artigo_pedido->id])) {
			foreach($fat[$artigo_pedido->id] as $faturamento) {
				$i++;
				echo "<script type='text/javascript'>$(document).ready(function() { ";
				echo "addFaturamento('".$faturamento['nota_fiscal']."','".double_br($faturamento['qtd'])."','".$faturamento['data']."','".$faturamento['id']."','".$artigo_pedido->id."','#btn".$contador."');";
				echo "})</script>";
			}
		}
	?>
		</tbody>
		<tfoot>
			<tr><td colspan="3">
				<div class="add">
					<a class="bkgd_left" id="btn<?php echo $contador ?>" href='#' onclick="return addFaturamento('','','','','<?php echo $artigo_pedido->id ?>',$(this))">Adicionar faturamento</a>
				</div>
			</td></tr>
		</tfoot>
	</table>
	<div class="obs">
		<label>Observações:</label>
		<?php echo form_textarea('msg['.$artigo_pedido->id.']',"",'id="observacao'.$artigo_pedido->id.'"');
		echo "<script type='text/javascript'>$(document).ready(function() { ";
		echo "addObs('".$artigo_pedido->id."');";
		echo "})</script>";
		?>
	</div>
</div>
	<?php
	$contador++;
		endforeach;
	?>
<?php
    echo "<dl><dt>";
    echo form_submit('salvar','Salvar',"id='btn_confirmar'");
    echo "|";
    echo anchor($this->input->server('HTTP_REFERER'),'Cancelar');
    echo form_close();
    echo "</dt></dl>";
	if(isset($abre_artigo)) {
		foreach($ap as $artigo_pedido) {
			if ($artigo_pedido->id != $abre_artigo)
				echo "<script type='text/javascript'>$(document).ready(function() { $('#".$artigo_pedido->id."').hide()});</script>";
		}
	} else {
		echo "<script type='text/javascript'>$(document).ready(function() { $('.faturamento_artigos').hide()});</script>";
	}
?>