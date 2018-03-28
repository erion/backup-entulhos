<?php
/*
 * Todas as fun��es chamadas aqui pertencem aos helpers
 * 
 * Exemplo: 
 * anchor() -> est� no URL Helper (s� dar uma olhada na documenta��o do CodeIgniter que tem mais detalhes)
 * money()/anchor_confirm() -> t� em "rosana_helper" que eu criei no diretorio application/helpers para ajudar na formata��o
 * 
 */
?>
<h2>Potencial Comprador</h2>
<form>
	<select id="potencial" onchange="location.href='<?php echo site_url('potencial_comprador/listar') ?>'+'/'+this.value">
		<option value="imovel"<?php if($this->uri->segment(3) == 'imovel') echo "selected"; ?>>Im�vel</option>
		<option value="posto"<?php if($this->uri->segment(3) == 'posto') echo "selected"; ?>>Posto</option>
	</select>
</form></br></br>
<table cellspacing="0" cellpadding="10px">
	<thead>
		<tr>
			<td>Cliente</td>
			<td>Investimento m�nimo</td>
			<td>Investimento m�ximo</td>
			<td>A��es</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo $registro['nome'] ?></td>
			<td><?php echo money($registro['investimento_minimo']) ?></td>
			<td><?php echo money ($registro['investimento_maximo']) ?></td>
			<td>
				<?php echo anchor('potencial_comprador/editar/'.$this->uri->segment(3).'/'.$registro['id'],'Editar'); ?> |
				<?php echo anchor_confirm('potencial_comprador/excluir/'.$this->uri->segment(3).'/'.$registro['id'],'Deseja realmente excluir o potencial comprador?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>