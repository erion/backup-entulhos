<div id="filtro">
	<h2><a href="#" onclick="esconder_filtro()" >Atualizar tabela<img src="<?php echo base_url()."assets/img/seta_dir.gif" ?>" name="filtro" alt="" /></a></h2>
            <?php 
                echo form_open('pedidos/financeiro/upload',"method='post' id='form_filtro'");
                echo "<span style='float:left'>";
                echo form_input('tabela_financeira','',"id='tabela_financeira' size='200' placeholder='Tabela' rel='file'");
                echo "</span>";
                echo form_button('upload','Enviar','onclick="atualizar_tabela_financeira()"');
                echo "<span style='float:right'>";
                echo anchor(site_url('pedidos/financeiro/tabela/'.$current_month.'/?width=800&height=600&modal=true'),'Verificar tabela',"class='thickbox'");
                echo "</span>";
                echo form_close();
            ?>
</div>
<ul class="paginacao" style="padding-top:5px;padding-left:10%;">
	<span><a href="<?php echo site_url().'/pedidos/financeiro/listar/'.get_month_navigation($current_month,0) ?>"><</a></span>
	<?php for($i=1;$i<=12;$i++) {
		if($i == $current_month)
                    $selecionado = "class='selecionado'";
		else
                    $selecionado = null;
		echo "<span><a ".$selecionado." href='".site_url().'/pedidos/financeiro/listar/'.$i."'>".$i."</a></span>";
	}
	?>
	<span><a href="<?php echo site_url().'/pedidos/financeiro/listar/'.get_month_navigation($current_month,1) ?>">></a></span>
</ul>
<div>LISTAGEM DO COMPARATIVO AQUI</div>
<ul class="paginacao" style="padding-top:5px;padding-left:10%;">
	<span><a href="<?php echo site_url().'/pedidos/financeiro/listar/'.get_month_navigation($current_month,0) ?>"><</a></span>
	<?php for($i=1;$i<=12;$i++) {
		if($i == $current_month)
                    $selecionado = "class='selecionado'";
		else
                    $selecionado = null;
		echo "<span><a ".$selecionado." href='".site_url().'/pedidos/financeiro/listar/'.$i."'>".$i."</a></span>";
	}
	?>
	<span><a href="<?php echo site_url().'/pedidos/financeiro/listar/'.get_month_navigation($current_month,1) ?>">></a></span>
</ul>