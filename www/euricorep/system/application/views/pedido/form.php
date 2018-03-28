<style type="text/css">
    #TB_window h1 {font-size:20px;}
    #TB_window h1, #TB_window .form_entidade dl {padding-left:0px !important;margin:5px 0px 0px 0px !important;}
    #TB_window .form_entidade dd {margin: 0px 0px 0px 120px;}
</style>

<?php
    echo $pedido->error->string;
    if ($this->uri->segment(2) == 'detalhes'){
        $new_uri = 'pedidos/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,"class='form_cadastro'");
    } else {
        echo form_open('pedidos/cadastrar',"class='form_cadastro'");
    }
	$check_projecao = '';
	if($this->input->get('projecao') || $pedido->projecao == '1')
		$check_projecao = 'checked';
?>
<h3><label for="projecao">Projeção</label>&nbsp;<?php echo form_checkbox('pedido[projecao]','1',$check_projecao,'id="projecao" onclick="projecao_checked()" rel="nao_valida"') ?></h3>
<div id="projecao_box">
	<div class="obs">
		<label for="projecao_nova">Nova projeção</label>
		<?php echo form_radio('projecao_nova','1','','id="projecao_nova" onclick="dropdown_projecao()" rel="nao_valida"') ?>
		<label for="projecao_existente">Descontar de uma existente</label>
		<?php echo form_radio('projecao_nova','0','','id="projecao_existente" onclick="dropdown_projecao()" rel="nao_valida"') ?>
	</div>
	<div class="obs" id="verschwinden_mull">
		<?php echo form_dropdown('pedido[projecao_id]',$projecoes,$pedido->projecao_id,'id="projecao_id1" rel="nao_valida"') ?>
	</div>
</div>
<h3>Informações Gerais</h3>
<dl>
    <dt><label>Cliente:</label></dt>
    <dd><?php echo form_dropdown('pedido[cliente_id]',$clientes,$pedido->cliente_id,'id="cliente_id" rel="validacao"') ?></dd>
	<?php unset($clientes); ?>
</dl>
<dl>
    <dt><label>Fornecedor:</label></dt>
    <dd><?php echo form_dropdown('pedido[fornecedor_id]',$fornecedores,$pedido->fornecedor_id,'id="fornecedor_id" rel="validacao"') ?></dd>
	<?php unset($fornecedores); ?>
</dl>
<dl>
    <dt><label>Representante:</label></dt>
    <dd><?php echo form_dropdown('pedido[representante_id]',$representante,$pedido->representante_id,'id="representante_id" rel="validacao"') ?></dd>
	<?php unset($representante); ?>
</dl>
<dl>
	<dt><label>Divisão:</label></dt>
	<dd><?php echo form_input('pedido[divisao]',$pedido->divisao,'id="divisao" rel="validacao"') ?></dd>
</dl>
<dl>
	<dt><label>Revisor:</label></dt>
	<dd><?php echo form_input('pedido[revisor]',$pedido->revisor,'id="revisor" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Faturamento / ICMS:</label></dt>
    <dd><?php echo form_dropdown('pedido[icms]',array('12%' => '12%','7%' => '7%'),$pedido->icms,'id="icms" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Moeda:</label></dt>
    <dd><?php echo form_dropdown('pedido[moeda]',array('BRL' => 'BRL','EUR' => 'EUR','USD' => 'USD'),$pedido->moeda,'id="moeda" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Forma de Pagamento:</label></dt>
    <dd><?php echo form_input('pedido[faturamento]',$pedido->faturamento,'id="faturamento" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>O.C.:</label></dt>
    <dd><?php echo form_input('pedido[ordem_servico]',$pedido->ordem_servico,'id="ordem_servico" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>N.F.:</label></dt>
    <dd><?php echo form_input('pedido[nota_fiscal]',$pedido->nota_fiscal,'id="nota_fiscal" rel="validacao"') ?></dd>
</dl>
<dl>
	<dt>Mercado:</dt>
	<dd>
		<label for="mi">INTERNO</label>&nbsp;<?php echo form_radio('pedido[mercado]','MI',($pedido->mercado == 'MI')?'checked':'','id="mi" rel="nao_valida"') ?>
		<label for="me">EXTERNO</label>&nbsp;<?php echo form_radio('pedido[mercado]','ME',($pedido->mercado == 'ME')?'checked':'','id="me" rel="nao_valida"') ?>
	</dd>
</dl>
<dl>
    <dt><label>Linha de produção:</label></dt>
    <dd><?php echo form_dropdown('pedido[linha_producao_id]',$linhas_producao,$pedido->linha_producao_id,'id="linha_producao_id" rel="validacao"') ?></dd>
	<?php unset($linhas_producao); ?>
</dl>
<dl>
    <dt><label>Data de entrega:</label></dt>
    <dd><?php echo form_input('pedido[data_entrega]',data_br($pedido->data_entrega),'id="data_entrega" rel="validacao"') ?></dd>
</dl>
<h3>Artigo</h3>
<dl>
    <dt><label>Matéria prima:</label></dt>
    <dd><?php echo form_dropdown('pedido[materia_prima_id]',$mat_primas,$pedido->materia_prima_id,'id="materia_prima_id" rel="validacao"') ?></dd>
	<?php unset($mat_primas); ?>
</dl>
<dl>
    <dt><label>Artigo:</label></dt>
    <dd><?php echo form_dropdown('pedido[artigo_id]',$artigos,$pedido->artigo_id,'id="artigo_id" rel="validacao"') ?></dd>
	<?php unset($artigos); ?>
</dl>
<dl>
    <dt><label>Classificação:</label></dt>
    <dd><?php echo form_input('pedido[classificacao]',$pedido->classificacao,'id="classificacao" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Unidade de medida:</label></dt>
    <dd><?php echo form_dropdown('pedido[unidade_medida]',array('m²' => 'm²','PES²' => 'PES²', 'Peça' => 'Peça'),$pedido->unidade_medida,'id="unidade_medida" rel="validacao"') ?></dd>
</dl>
<!--
<dl>
    <dt><label>Valor unitário:</label></dt>
    <dd><?php //echo form_input('pedido[valor_unitario]',double_br($pedido->valor_unitario),'id="valor_unitario" rel="validacao"') ?></dd>
</dl>
-->
<dl>
    <dt><label>Tamanho da peça:</label></dt>
    <dd><?php echo form_input('pedido[tamanho_peca]',$pedido->tamanho_peca,'id="tamanho_peca" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Espessura:</label></dt>
    <dd><?php echo form_input('pedido[espessura]',$pedido->espessura,'id="espessura" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Cupim(%):</label></dt>
    <dd><?php echo form_input('pedido[cupim]',$pedido->cupim,'id="cupim" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Tipo de embarque:</label></dt>
    <dd><?php echo form_input('pedido[tipo_embarque]',$pedido->tipo_embarque,'id="tipo_embarque" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Tipo de embalagem:</label></dt>
    <dd><?php echo form_input('pedido[tipo_embalagem]',$pedido->tipo_embalagem,'id="tipo_embalagem" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Tolerância metragem:</label></dt>
    <dd><?php echo form_input('pedido[tolerancia_metragem]',$pedido->tolerancia_metragem,'id="tolerancia_metragem" rel="validacao"') ?></dd>
</dl>

<dl>
    <dt><label>Couros:</label></dt>
    <dd><?php echo form_dropdown('pedido[couro]',array('' => null,'INTEIROS' => 'Inteiros','MEIOS' => 'Meios'),$pedido->couro,'id="couro" rel="validacao"') ?></dd>
</dl>
<dl>
    <dt><label>Raspas:</label></dt>
    <dd><?php echo form_dropdown('pedido[raspa]',array('' => null,'MEIOS' => 'Meios', 'G-DUPLO' => 'Grupon duplo'),$pedido->unidade_medida,'id="raspa" rel="validacao"') ?></dd>
</dl>

<h3>Cores e Quantidades</h3>
<div class="cor">
<?php
/*
    echo form_input('cor',"",'id="cor"');
    echo form_input('quantidade',"",'id="quantidade"');
    echo form_input('valor',"",'id="valor"');
	echo form_checkbox('amostra',"1","","id='amostra' rel='nao_valida'")."<label for='amostra'>&nbsp;Amostra</label>";

 <a href='#' onclick="return addCor($('#cor').val(),$('#quantidade').val(),$('#valor').val(),'',$('#amostra:checked').val())"><img src='<?php echo base_url() ?>assets/img/add.gif' /></a>
 */
?>
</div>
<table class="listar" id="cor" cellpadding="0px" cellspacing="0px">
	<thead>
	<?php 
	    echo "<tr><th>&nbsp;".form_input('cor',"",'id="cadastro_cor" rel="nao_valida"')."</th>";
		echo "<th>&nbsp;".form_input('quantidade',"",'id="quantidade" rel="nao_valida"')."</th>";
		echo "<th>&nbsp;".form_input('valor',"",'id="valor" rel="nao_valida"')."</th>";
		echo "<th>&nbsp;".form_checkbox('amostra',"1","","id='amostra' rel='nao_valida'")."<label for='amostra'>&nbsp;Amostra</label></th>";
		echo '<th>&nbsp;<a href="#" onclick="return addCor($(\'#cadastro_cor\').val(),$(\'#quantidade\').val(),$(\'#valor\').val(),\'\',$(\'#amostra:checked\').val())" ><img src=\''.base_url().'assets/img/adicionar-c.png\' /></a></tr></th>';
	?>
	</thead>
    <tbody id="cores">
    <?php
        if (!empty($pedido->error->string) && $artigo_pedido_cor): //se ocorreu algum erro no cadastro
            echo "<script type='text/javascript'>$(document).ready(function() { ";
            for($i=0;$i<count($artigo_pedido_cor);$i++) {
                echo "addCor('".$artigo_pedido_cor[$i]."','".double_br($artigo_pedido_quantidade[$i])."','".$artigo_pedido_valor[$i]."','','".$artigo_pedido_amostra[$i]."');";
            }
            echo "})</script>";
			unset($artigo_pedido_cor);
			unset($artigo_pedido_quantidade);
			unset($artigo_pedido_valor);
			unset($artigo_pedido_amostra);
        elseif (!empty($pedido->id)): //se está editando
            echo "<script type='text/javascript'>$(document).ready(function() { ";
            foreach($ap as $artigo_pedido){
                echo "addCor('".$artigo_pedido->cor."','".double_br($artigo_pedido->quantidade)."','".double_br($artigo_pedido->valor_unitario_corrigido)."','".$artigo_pedido->id."','".$artigo_pedido->amostra."');";
            }
            echo "})</script>";
			unset($artigo_pedido);
        endif;
    ?>
    </tbody>
</table>
<div class="obs">
    <label>Observações:</label>
    <?php echo form_textarea('msg',"",'id="observacao"') ?>
</div>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor($this->input->server('HTTP_REFERER'),'Cancelar');
        echo form_close();
		unset($pedido);
		unset($projecoes);
		unset($log);
?>
    </dt>
</dl>