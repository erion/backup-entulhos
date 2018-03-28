<?php
/*
 * Para todos os formulários será utilizado a library "form_post", que está localizada em application/libraries/form_post.php
 * Esta classe gera a saída em HTML dos inputs e faz a verificação se há dados no post, para estes não serem perdidos
 * caso ocorra erro de validação no formulário.
 */
?>

<h2>Posto &raquo; <?php echo $acao ?></h2>
<form method="post" class="formulario">
	<dl>
		<dt><label>Proprietário</label></dt>
		<dd><?php echo form_post::input('proprietario')?></dd>
	</dl>
	<dl>
		<dt>Endereço</dt>
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
		<dt>Localização</dt>
		<dd><?php echo form_post::dropdown('localizacao',$localizacao)?></dd>
	</dl>
	<dl>
		<dt>Duração do Contrato</dt>
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
		<dt>Situação Legal</dt>
		<dd><?php echo form_post::input('situacao_legal')?></dd>
	</dl>
	<dl>
		<dt>Volume de Venda/Mês</dt>
		<dd><?php echo form_post::input('vol_venda_mes')?></dd>
	</dl>
	<dl>
		<dt>Volume de Gasolina</dt>
		<dd><?php echo form_post::input('vol_gasolina')?></dd>
	</dl>
	<dl>
		<dt>Volume de Álcool</dt>
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
		<dt>Funcionários</dt>
		<dd><?php echo form_post::input('funcionarios')?></dd>
	</dl>
	<dl>
		<dt>Aberto 24h</dt>
		<dd><?php echo form_post::checkbox('aberto_24h','1')?></dd>
	</dl>
	<dl>
		<dt>Loja Conveniência</dt>
		<dd><?php echo form_post::checkbox('loja_conveniencia','1')?></dd>
	</dl>
	<dl>
		<dt>Troca de Óleo</dt>
		<dd><?php echo form_post::checkbox('troca_oleo','1')?></dd>
	</dl>
	<dl>
		<dt>Lavagem</dt>
		<dd><?php echo form_post::checkbox('lavagem','1')?></dd>
	</dl>
	<dl>
		<dt>Venda à Vista</dt>
		<dd><?php echo form_post::input('venda_vista')?></dd>
	</dl>
	<dl>
		<dt>Venda à Prazo</dt>
		<dd><?php echo form_post::input('venda_prazo')?></dd>
	</dl>
	<dl>
		<dt>Venda com Cheque</dt>
		<dd><?php echo form_post::input('venda_cheque')?></dd>
	</dl>
	<dl>
		<dt>Venda com Cartão</dt>
		<dd><?php echo form_post::input('venda_cartao')?></dd>
	</dl>																		
	<?php echo form_post::submit($acao) ?> - <?php echo anchor('posto/listar','Cancelar') ?>
</form>