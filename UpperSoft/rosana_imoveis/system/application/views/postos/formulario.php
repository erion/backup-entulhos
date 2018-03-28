<?php
/*
 * Para todos os formul�rios ser� utilizado a library "form_post", que est� localizada em application/libraries/form_post.php
 * Esta classe gera a sa�da em HTML dos inputs e faz a verifica��o se h� dados no post, para estes n�o serem perdidos
 * caso ocorra erro de valida��o no formul�rio.
 */
?>

<h2>Posto &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Propriet�rio</label></dt>
		<dd><?php echo form_post::input('proprietario')?></dd>
	</dl>
	<dl>
		<dt>Endere�o</dt>
		<dd><?php echo form_post::input('endereco')?></dd>
	</dl>
	<dl>
		<dt>Cidade</dt>
		<dd><?php echo form_post::input('cidade')?></dd>
	</dl>
	<dl>
		<dt>UF</dt>
		<dd><?php echo form_post::input('estado')?></dd>
	</dl>
	<dl>
		<dt>Telefone</dt>
		<dd><?php echo form_post::input('telefone')?></dd>
	</dl>
	<dl>
		<dt>Celular</dt>
		<dd><?php echo form_post::input('celular')?></dd>
	</dl>
	<dl>
		<dt>E-mail</dt>
		<dd><?php echo form_post::input('email')?></dd>
	</dl>
	<dl>
		<dt>Nome do Posto</dt>
		<dd><?php echo form_post::input('nome_posto')?></dd>
	</dl>
	<dl>
		<dt>Bandeira</dt>
		<dd><?php echo form_post::input('bandeira')?></dd>
	</dl>
	<dl>
		<dt>Localiza��o</dt>
		<dd><?php echo form_post::dropdown('localizacao',$localizacao)?></dd>
	</dl>
	<dl>
		<dt>Dura��o do Contrato</dt>
		<dd><?php echo form_post::input('duracao_contrato')?></dd>
	</dl>
	<dl>
		<dt>Tipo</dt>
		<dd><?php echo form_post::dropdown('tipo',$tipo)?></dd>
	</dl>
	<dl>
		<dt>Valor do Aluguel</dt>
		<dd><?php echo form_post::input('valor_aluguel')?></dd>
	</dl>												
	<dl>
		<dt>Tempo de Contrato do Aluguel</dt>
		<dd><?php echo form_post::input('tempo_contrato_aluguel')?></dd>
	</dl>
	<dl>
		<dt>Situa��o Legal</dt>
		<dd><?php echo form_post::input('situacao_legal')?></dd>
	</dl>
	<dl>
		<dt>Volume de Venda/M�s</dt>
		<dd><?php echo form_post::input('vol_venda_mes')?></dd>
	</dl>
	<dl>
		<dt>Volume de Gasolina</dt>
		<dd><?php echo form_post::input('vol_gasolina')?></dd>
	</dl>
	<dl>
		<dt>Volume de �lcool</dt>
		<dd><?php echo form_post::input('vol_alcool')?></dd>
	</dl>
	<dl>
		<dt>Volume de Diesel</dt>
		<dd><?php echo form_post::input('vol_diesel')?></dd>
	</dl>
	<dl>
		<dt>Margem de Venda</dt>
		<dd><?php echo form_post::input('margem_venda')?></dd>
	</dl>
	<dl>
		<dt>Funcion�rios</dt>
		<dd><?php echo form_post::input('funcionarios')?></dd>
	</dl>
	<dl>
		<dt>Aberto 24h</dt>
		<dd><?php echo form_post::checkbox('aberto_24h','1')?></dd>
	</dl>
	<dl>
		<dt>Loja Conveni�ncia</dt>
		<dd><?php echo form_post::checkbox('loja_conveniencia','1')?></dd>
	</dl>
	<dl>
		<dt>Troca de �leo</dt>
		<dd><?php echo form_post::checkbox('troca_oleo','1')?></dd>
	</dl>
	<dl>
		<dt>Lavagem</dt>
		<dd><?php echo form_post::checkbox('lavagem','1')?></dd>
	</dl>
	<dl>
		<dt>Venda � Vista</dt>
		<dd><?php echo form_post::input('venda_vista')?></dd>
	</dl>
	<dl>
		<dt>Venda � Prazo</dt>
		<dd><?php echo form_post::input('venda_prazo')?></dd>
	</dl>
	<dl>
		<dt>Venda com Cheque</dt>
		<dd><?php echo form_post::input('venda_cheque')?></dd>
	</dl>
	<dl>
		<dt>Venda com Cart�o</dt>
		<dd><?php echo form_post::input('venda_cartao')?></dd>
	</dl>																		
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('posto/listar','Cancelar') ?>
</form>