<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<td>N° Pedido</td>
			<td>Companhia</td>
			<td>Data</td>
			<td>Usuário</td>			
			<td>Editar</td>
			<td>Excluir</td>			
		</tr>				
	</thead>
	<tbody>
		<?php

			$query = mysql_query("SELECT count(*) FROM pedido");
			$total_registros = mysql_result($query,0);
						
			if (isset($_GET['pag'])) {
				$min = 10 * ($_GET['pag']-1);			
				$pagina = $_GET['pag'];
			} else {
				$min = 0;
				$pagina = 1;				
			}			
			$max = 10;			
			
			$pag_pedido = new paginacao($pagina,10,$total_registros,10,ceil(mysql_result($query,0)/10),'-');								
		
			$query = mysql_query("SELECT p.pedido_id, ip.item_pedido_id, c.nome as companhia, p.data, p.prazo_entrega, u.login as usuario" .
								" FROM pedido p" .
								" LEFT JOIN companhia c ON ( p.companhia_id = c.companhia_id )" .
								" LEFT JOIN usuario u ON ( p.usuario_id = u.usuario_id )" .
								" LEFT JOIN item_pedido ip on (p.pedido_id = ip.pedido_id) limit $min,$max");
			$cont = 1;

			while ($campos = mysql_fetch_assoc($query)):
				$cont++;
				if ($cont%2 == 0):
					if (status_pedido($campos['prazo_entrega'])):			
		?>
		<tr style="background-color:#FF0505;color: white !important">
		<?php		else: ?>
		<tr style="background-color:#E8E8E8">
		<?php		endif;
				else:
					if (status_pedido($campos['prazo_entrega'])): 
		?>
		<tr style="background-color:#FF0505;color: white !important;">
		<?php		else: ?>
		<tr>
		<?php		endif; ?>
		<?php	endif; ?>	
			<td><?php echo $campos['pedido_id'] ?></td>
			<td><?php echo $campos['companhia'] ?></td>
			<td><?php echo date('d/m/Y',strtotime($campos['data'])) ?></td>
			<td><?php echo $campos['usuario']; $_POST['usuario'] = $campos['usuario']; ?></td>			
			<td><a href="?pagina=pedidocadastro&tabela=pedido&acao=editar&idp=<?php echo $campos["pedido_id"]; ?>&idip=<?php echo $campos["item_pedido_id"]; ?>"><img src="imagens/icone_editar.png"/></a></td>
			<td><a href="javascript:confirmDelete('?pagina=pedido&tabela=pedido&acao=excluir&idp=<?php echo $campos["pedido_id"]?>&idip=<?php echo $campos["item_pedido_id"]?>')"><img src="imagens/icone_deletar.png"/></a></td>			
		</tr>	
		<?php endwhile; ?> 
	</tbody>		
</table>
<center><?php if ($pag_pedido->numPaginas > 1) $pag_pedido->links(); ?></center>