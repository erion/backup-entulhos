<ul class="paginacao">
	<span><a href="<?php echo site_url().'/entidades/pedidos/'.get_month_navigation($current_month,0) ?>"><</a></span>
	<?php for($i=1;$i<=12;$i++) {
		if($i == $current_month)
			$selecionado = "class='selecionado'";
		else
			$selecionado = null;
		echo "<span><a ".$selecionado." href='".site_url().'/entidades/pedidos/'.$i."'>".$i."</a></span>";
	}
	?>
	<span><a href="<?php echo site_url().'/entidades/pedidos/'.get_month_navigation($current_month,1) ?>">></a></span>
</ul>
				<table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th width="40%"><?php echo 'Clientes'; ?></th>
                            <th width="15%"><?php echo 'Metragem'; ?></th>
                            <th width="15%"><?php echo 'Valor Total'; ?></th>
                            <th width="15%"><?php echo '% Valor'; ?></th>
                            <th width="15%"><?php echo '% Qtd.'; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        $qtdTotal = $vlrTotal = 0;
                        foreach($clientes as $c):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $c->nome ?></td>
                            <td><?php echo (trim($c->qtdTotal) == null)?'0':double_br($c->qtdTotal); $qtdTotal += $c->qtdTotal; ?></td>
                            <td><?php echo (trim($c->vlrTotal) == null)?'0':double_br($c->vlrTotal); $vlrTotal += $c->vlrTotal; ?></td>
                            <td><?php echo (trim($c->vlrPercentual) == null)?'0':double_br($c->vlrPercentual) ?></td>
                            <td><?php echo (trim($c->qtdPercentual) == null)?'0':double_br($c->qtdPercentual) ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                        <tr <?php echo ($i % 2) ? "" : "class='cor'" ?>>
                            <td><b>Qtd. Total:</b></td>
                            <td><?php echo double_br($qtdTotal); ?></td>
                            <td><b>Valor Total:</b></td>
                            <td><?php echo double_br($vlrTotal); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>