<?php
	include "../funcoes.php";	
	include "../config.php";
	include "../actions/geral.php";	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript" src="../scripts/jquery.min.js" ></script>
		<script type="text/javascript" src="../scripts/jquery.validate.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/css2.css" /> 	
	</head>
	<body>
		<form method="post" id="geral" name="geral">
			<div class="geral">
				<dl>
					<dt><?php echo $tabelas[$_GET['tabela']]; ?>:</dt>
					<dd><input type="text" name="descricao" id="descricao" size="20" maxlegth="25" /></dd>		
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
		$('#carregando').hide();
		var campo_tabela = '<?php echo $_GET['tabela'];?>';
		
		$("#geral").validate({
			rules: {descricao:"required"},
			messages:{descricao:"É obrigatório o preenchimento do campo."},
			submitHandler: function(form_target) {
				//substitui o valor
				parent.document.getElementById(campo_tabela).value = document.getElementById('descricao').value;
				
				//substitui o id
				$.post('../index.php?pagina=geralcadastro&tabela='+campo_tabela+'&acao=inserir&retorna_id=1', $("#geral").serialize(),
				function(resposta){
					parent.document.getElementById(campo_tabela+'_id').value = resposta;
					self.parent.tb_remove();
				});
				$('#carregando').show();
			}
		});
		
		
	});
</script>
