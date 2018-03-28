<?php
/*
 * Created on 10/05/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<h2>Potencial Comprador</h2>
<form>
	<select id="potencial" onchange="location.href='<?php echo site_url('potencial_comprador/listar') ?>'+'/'+this.value">
		<option value="imovel"<?php if($this->uri->segment(3) == 'imovel') echo "selected"; ?>>Imóvel</option>
		<option value="posto"<?php if($this->uri->segment(3) == 'posto') echo "selected"; ?>>Posto</option>
	</select>
</form></br></br>
<table cellspacing="0" cellpadding="10px">
	<thead>
		<tr>
			<td>Cliente</td>
			<td>Bandeira</td>
			<td>Ações</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($registros as $registro) : ?>
		<tr>
			<td><?php echo $registro['nome'] ?></td>
			<td><?php echo $registro['bandeira'] ?></td>
			<td>
				<?php echo anchor('potencial_comprador/editar/'.$this->uri->segment(3).'/'.$registro['id'],'Editar'); ?> |
				<?php echo anchor_confirm('potencial_comprador/excluir/'.$this->uri->segment(3).'/'.$registro['id'],'Deseja realmente excluir o potencial comprador?','Excluir'); ?>  
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php echo pagination() ?>