<form method="post" id="form_pedido">
	<div class="pedido">
		<dl>
			<dt>Vendedor:</dt> 
			<dd><input type="text" name="representante" id="representante" value="<?php echo retornar_valor('representante'); ?>" /></dd>
		</dl>	
		<dl>
			<dt>Companhia:</dt> 
			<dd><input type="text" name="companhia" id="companhia" value="<?php echo retornar_valor('companhia'); ?>" /><a href="ajax/companhia.php?tabela=companhia&campo=companhia&acao=inserir&keepThis=true&TB_iframe=true&height=350&width=450" title="Cadastro de Companhias" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		</dl>				
		<input type="hidden" name="companhia_id" id="companhia_id" value="<?php echo retornar_valor('companhia_id'); ?>" />
		<dl>
			<dt>Cliente:</dt>
			<dd><input type="text" name="cliente" id="cliente" value="<?php echo retornar_valor('cliente'); ?>" /><a href="ajax/companhia.php?tabela=companhia&campo=cliente&acao=inserir&keepThis=true&TB_iframe=true&height=350&width=450" title="Cadastro de Companhias" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>			
		</dl>
		<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo retornar_valor('cliente_id'); ?>"/>		
		<dl>
			<dt>Contato:</dt>
			<dd><input type="text" name="contato" id="contato" value="<?php echo retornar_valor('contato'); ?>" /></dd>
		</dl>
		<dl>
			<dt>Item:</dt>
			<dd><input type="text" name="item" id="item" value="<?php echo retornar_valor('item'); ?>" /><a href="ajax/geral.php?tabela=item&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Itens" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="item_id" id="item_id" value="<?php echo retornar_valor('item_id'); ?>"/>	
		</dl>				
		<dl>
			<dt>Matéria Prima:</dt>
			<dd><input type="text" name="materia_prima" id="mat_prima" value="<?php echo retornar_valor('materia_prima'); ?>" /><a href="ajax/geral.php?tabela=mat_prima&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Mat.Prima" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="mat_prima_id" id="mat_prima_id" value="<?php echo retornar_valor('mat_prima_id'); ?>" />	
		</dl>
		<dl>
			<dt>País de Origem:</dt>
			<dd><input type="text" name="pais" id="pais" value="<?php echo retornar_valor('pais'); ?>" /><a href="ajax/geral.php?tabela=pais&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Países" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="pais_id" id="pais_id" value="<?php echo retornar_valor('pais_id'); ?>" />	
		</dl>
		<dl>
			<dt>Artigo:</dt>
			<dd><input type="text" name="artigo" id="artigo" value="<?php echo retornar_valor('artigo'); ?>" /><a href="ajax/geral.php?tabela=artigo&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Artigos" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="artigo_id" id="artigo_id" value="<?php echo retornar_valor('artigo_id'); ?>" />			
		</dl>
		<dl>
			<dt>Tipo Acabamento:</dt>
			<dd><input type="text" name="tipo_acabamento" id="tipo_acabamento" value="<?php echo retornar_valor('tipo_acabamento'); ?>" /><a href="ajax/geral.php?tabela=tipo_acabamento&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Tipos de Acabamento" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="tipo_acabamento_id" id="tipo_acabamento_id" value="<?php echo retornar_valor('tipo_acabamento_id'); ?>" />	
		</dl>
		<dl>
			<dt>Finalidade:</dt>
			<dd><input type="text" name="finalidade" id="finalidade" value="<?php echo retornar_valor('finalidade'); ?>" /><a href="ajax/geral.php?tabela=finalidade&acao=inserir&keepThis=true&TB_iframe=true&height=120&width=400" title="Cadastro de Finalidades" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		<input type="hidden" name="finalidade_id" id="finalidade_id" value="<?php echo retornar_valor('finalidade_id'); ?>"/>	
		</dl>						
		<dl>
			<dt>Tamanho / Couro:</dt>
			<dd>
				<input type="text" name="tamanho" id="tamanho" value="<?php echo retornar_valor('tamanho'); ?>" />
				<select name="unidade">
					<?php foreach ($unidades as $valor): ?>
					<option value="<?php echo $valor["unidade_id"]; ?>" <?php echo retornar_selecionado("unidade",$valor["unidade_id"],"unidade_tamanho") ?>><?php echo $valor["descricao"]; ?></option>
					<?php endforeach; ?>
				</select>								 
			</dd>
		</dl>
		<dl>
			<dt>Espessura:</dt>
			<dd><input type="text" name="espessura" id="espessura" size="7" value="<?php echo retornar_valor('espessura'); ?>" />mm</dd>
		</dl>
		<dl>
			<dt>Classificação:</dt>
			<dd><input type="text" name="classificacao" id="classificacao" value="<?php echo retornar_valor('classificacao'); ?>" /></dd>	
		</dl>
		<dl>
			<dt>% de Classificação:</dt>
			<dd><input type="text" name="percent_classificacao" id="percent_classificacao" value="<?php echo retornar_valor('percent_classificacao'); ?>" /></dd>	
		</dl>						
		<dl>
			<dt>Cor:</dt>
			<dd><input type="text" name="cor" id="cor" size="15" value="<?php echo retornar_valor('cor'); ?>" /></dd>
		</dl>
		<input type="hidden" name="cor_id" id="cor_id" value="<?php echo retornar_valor('cor_id'); ?>"/>										
		<dl>
			<dt>Quantidade:</dt>
			<dd>
				<input type="text" name="quantidade" maxlenght="4" value="<?php echo retornar_valor('quantidade'); ?>" />
				<select name="unidade_qtd">
					<?php foreach ($unidades as $valor): ?>
					<option value="<?php echo $valor["unidade_id"]; ?>" <?php echo retornar_selecionado("unidade_qtd",$valor["unidade_id"],"unidade_qtd") ?>><?php echo $valor["descricao"]; ?></option>
					<?php endforeach; ?>
				</select>				
			</dd>
		</dl>
		<dl>
			<dt>Preço:</dt>						
			<dd>
				<select name="moeda" id="moeda">
					<option value="US$" <?php if ($_GET['acao'] == 'editar') echo retornar_selecionado("moeda",$editar['moeda'],"moeda") ?>>US$</option>
					<option value="€" <?php if ($_GET['acao'] == 'editar') echo retornar_selecionado("moeda",$editar['moeda'],"moeda") ?>>€</option>
					<option value="R$" <?php if ($_GET['acao'] == 'editar') echo retornar_selecionado("moeda",$editar['moeda'],"moeda") ?>>R$</option>
				</select>
				<input type="text" name="preco" id="preco" value="<?php echo retornar_valor('preco'); ?>" />			
			</dd>
		</dl>			
		<dl>
			<dt>Faturamento (ICMS):</dt>
			<dd><input type="text" name="icms" value="<?php echo retornar_valor('icms'); ?>" />%</dd>
		</dl>
		<dl>
			<dt>Condições de Pgto:</dt>
			<dd><input type="text" name="condicao_pgto" value="<?php echo retornar_valor('condicao_pgto'); ?>" /></dd>
		</dl>
		<dl>
			<dt>Fornecedor:</dt>
			<dd><input type="text" name="fornecedor" id="fornecedor" value="<?php echo retornar_valor('fornecedor'); ?>"/><a href="ajax/companhia.php?tabela=companhia&campo=fornecedor&acao=inserir&keepThis=true&TB_iframe=true&height=350&width=450" title="Cadastro de Companhias" class="thickbox" /><img src="imagens/add.bmp" /></a></dd>
		</dl>
		<input type="hidden" name="fornecedor_id" id="fornecedor_id" value="<?php echo retornar_valor('fornecedor_id'); ?>" />		
		<dl>
			<dt>Data Pedido:</dt>
			<dd><input name="data_pedido" id="data_pedido" class="date-pick" value="<?php if ($_GET['acao'] == 'editar') echo date('d/m/Y',strtotime($editar['data'])); ?>" /></dd>
		</dl>
		<dl>
			<dt>Data de Entrega:</dt>
			<dd><input name="data_entrega" id="data_entrega" class="date-pick" value="<?php if ($_GET['acao'] == 'editar') echo date('d/m/Y',strtotime($editar['prazo_entrega'])); ?>" /></dd>
		</dl>
		<div class="botoes">
			<input type="submit" name="salvar" value="Salvar">		
			<a href="?pagina=pedido&tabela=pedido">  Cancelar</a>
		</div>																																			
	</div>
</form>

<script type="text/javascript">

	function findValue(li) {
		if( li == null ) return alert("Nenhum valor encontrado!");
	
		if( !!li.extra ) var sValue = li.extra[0];
	
		else var sValue = li.selectValue;
	}
	
	function selectItem(li) {
		findValue(li);
	}
	
		function selectCompanhia_id(li) {
			findValue(li);
			$("#companhia_id").val(li.extra[0]);		
		}
		
		function selectCliente_id(li) {
			findValue(li);
			$("#cliente_id").val(li.extra[0]);		
		}
		
		function selectFornecedor_id(li) {
			findValue(li);
			$("#fornecedor_id").val(li.extra[0]);		
		}		
		
		function selectArtigo_id(li) {
			findValue(li);
			$("#artigo_id").val(li.extra[0]);		
		}
		
		function selectItem_id(li) {
			findValue(li);
			$("#item_id").val(li.extra[0]);		
		}
		
		function selectTipo_acabamento_id(li) {
			findValue(li);
			$("#tipo_acabamento_id").val(li.extra[0]);		
		}
		
		function selectCor_id(li) {
			findValue(li);
			$("#cor_id").val(li.extra[0]);		
		}		
		
		function selectMat_prima_id(li) {
			findValue(li);
			$("#mat_prima_id").val(li.extra[0]);		
		}
						
		function selectPais_id(li) {
			findValue(li);
			$("#pais_id").val(li.extra[0]);		
		}		
		
		function selectFinalidade_id(li) {
			findValue(li);
			$("#finalidade_id").val(li.extra[0]);
		}										
	
	function formatItem(row) {
		return row[0] + " (id: " + row[1] + ")";
	}
	
	function lookupLocal(){
		var oSuggest = $("#companhia")[0].autocompleter;
	
		oSuggest.findValue();
	
		return false;
	}
	
	$(document).ready(function() {
		
		$("#moeda").change(function(){
			$("#preco").val($(this).val()+" ");
			$("#preco").focus();
		});
		$("#espessura").mask("9,9 à 9,9");
		<?php if ($_GET['acao'] == 'inserir'): ?> 
			$('.date-pick').datePicker().val(new Date().asString()).trigger('change');
		<?php else: ?>
			$('.date-pick').datePicker();
		<?php endif; ?>				
	
		$("#companhia").autocomplete(
			"ajax/companhias.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectCompanhia_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10,
				cacheLength:1
			}
		);
		
		$("#cliente").autocomplete(
			"ajax/companhias.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectCliente_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);
		
		$("#fornecedor").autocomplete(
			"ajax/companhias.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectFornecedor_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);		
		
		$("#artigo").autocomplete(
			"ajax/artigos.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectArtigo_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);
	
		$("#item").autocomplete(
			"ajax/itens.php",
			{
				delay:10,
				minChars:3,
				matchSubset:1,
				onItemSelect:selectItem_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);
		
		$("#tipo_acabamento").autocomplete(
			"ajax/tipos_acabamento.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectTipo_acabamento_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);
		
		$("#finalidade").autocomplete(
			"ajax/finalidades.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectFinalidade_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);		
		
		$("#cor").autocomplete(
			"ajax/cores.php",
			{
				delay:10,
				minChars:2,
				matchSubset:1,
				onItemSelect:selectCor_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);		

		$("#mat_prima").autocomplete(
			"ajax/materias_primas.php",
			{
				delay:10,
				minChars:1,
				matchSubset:1,
				onItemSelect:selectMat_prima_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);
		
		$("#pais").autocomplete(
			"ajax/paises.php",
			{
				delay:10,
				minChars:1,
				matchSubset:1,
				onItemSelect:selectPais_id,
				onFindValue:findValue,
				autoFill:true,
				maxItemsToShow:10
			}
		);

	});	
											
</script>