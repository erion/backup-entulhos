<?php
	include "../funcoes.php";	
	include "../config.php";
	include "../actions/companhia.php";	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="../scripts/jquery.min.js" ></script>
		<script type="text/javascript" src="../scripts/jquery.validate.js"></script>		
		<link rel="stylesheet" type="text/css" href="../css/css2.css" /> 	
	</head>
	<body>
		<form method="post" name="form_companhia" id="form_companhia">
			<div class="companhia">
				<dl>
					<dt>Nome:</dt>
					<dd><input type="text" name="nome" id="nome" /></dd>
				</dl>
				<dl>
					<dt>Endereço:</dt>
					<dd><input type="text" name="endereco" /></dd>
				</dl>
				<dl>
					<dt>País:</dt>
					<dd>			
						<select name="pais">
							<?php foreach ($paises as $valor): ?>
							<option value="<?php echo $valor["pais_id"]; ?>"><?php echo $valor["descricao"]; ?></option>
							<?php endforeach; ?>
						</select>
					</dd>
				</dl>		
				<dl>
					<dt>Telefone:</dt>
					<dd><input type="text" name="telefone" /></dd>
				</dl>
				<dl>
					<dt>Celular:</dt>
					<dd><input type="text" name="celular" /></dd>
				</dl>
				<dl>
					<dt>Contato:</dt>
					<dd><input type="text" name="contato" /></dd>
				</dl>
				<dl>
					<dt>Tipo:</dt>			
					<dd>
						<input type="radio" name="tipo" id="tipo" value="COMPANHIA" /> Compania
						<input type="radio" name="tipo" id="tipo" value="FABRICA" /> Fábrica
						<input type="radio" name="tipo" id="tipo" value="CURTUME" /> Curtume
					</dd>
				</dl>	
				<div class="botoes">
					<input type="submit" name="salvar" value="Salvar" />
					<input type="reset" name="cancelar" value="Cancelar" onclick="self.parent.tb_remove();"/>
				</div>
				<div id="carregando">Aguarde, carregando...</div>
			</div>
		</form>	
	</body>
</html>
<script type="text/javascript">
	$().ready(function(){
		
		var campo_tabela = '<?php echo $_GET['campo'] ?>';
		$('#carregando').hide();
		$("#form_companhia").validate({
			rules: {
				nome:"required",
				tipo:"required"
			},
			messages:{
				nome:"É necessário um nome.",
				tipo:"Selecione um tipo."
			},
			
			submitHandler: function(form_target) {
				
				//substitui o valor
				parent.document.getElementById(campo_tabela).value = document.getElementById('nome').value;
				
				//substitui o id
				$.post('../index.php?pagina=companhiacadastro&tabela=companhia&acao=inserir&retorna_id=1', $("#form_companhia").serialize(),
				function(resposta){
					parent.document.getElementById(campo_tabela+'_id').value = resposta;
					self.parent.tb_remove();
				});
				$('#carregando').show();
			}
			
			
		});
	});
</script>
