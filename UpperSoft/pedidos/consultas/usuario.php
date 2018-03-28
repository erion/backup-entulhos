<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<td>Usuário</td>
			<td>Editar</td>
			<td>Excluir</td>			
		</tr>				
	</thead>
	<tbody>
		<?php
			
			$query = mysql_query("SELECT count(*) FROM usuario");
			$total_registros = mysql_result($query,0);
						
			if (isset($_GET['pag'])) {
				$min = 10 * ($_GET['pag']-1);			
				$pagina = $_GET['pag'];
			} else {
				$min = 0;
				$pagina = 1;				
			}			
			$max = 10;			
			
			$pag_usuario = new paginacao($pagina,10,$total_registros,10,ceil(mysql_result($query,0)/10),'-');				
		
			$query = mysql_query("SELECT * FROM usuario order by login limit $min,$max");
			$cont = 1;
			while ($campos = mysql_fetch_assoc($query)):
				$cont++;
				if ($cont%2 == 0):
		?>
		<tr style="background-color:#E8E8E8">
		<?php	else: ?>
		<tr>	
		<?php	endif; ?>
			<td><?php echo $campos['login'] ?></td>
			<td><a href="?pagina=usuariocadastro&acao=editar&id=<?php echo $campos["usuario_id"]; ?>&tabela=usuario"><img src="imagens/icone_editar.png"/></a></td>
			<td><a href="?pagina=usuario&acao=excluir&id=<?php echo $campos["usuario_id"]?>&tabela=usuario"><img src="imagens/icone_deletar.png"/></a></td>			
		</tr>	
		<?php endwhile; ?>
	</tbody>
</table>
<center><?php if ($pag_pedido->numPaginas > 1) $pag_usuario->links(); ?></center>