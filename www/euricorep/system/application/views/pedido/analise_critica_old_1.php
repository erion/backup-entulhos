<?php
	if($producao == 'P') {
		$producao = 'X';
		$amostra  = '&nbsp;';
	} else {
		$producao = '&nbsp;';
		$amostra = 'X';
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/analise_critica.css" media="all" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.4.2.min.js"></script>
		<script type='text/javascript'>
			$(document).ready(function(){
				window.print();
				window.close();
			});
		</script>
	</head>
	<body>
		<?php //tabela 1- Dados de Entrada (1tabela para cada linha para alinhar como o layout do curtume)?>
<?php 
$contador = 0;
foreach($artigos as $a): 
	$contador++;
?>
		<div class="borda">
			<table cellspacing="0px" cellpadding="0px" >
				<tr class="normal">
					<td width="100px" class="borda titulo"><img src="<?php echo base_url() ?>assets/img/minuano_logo.gif" alt="logo" /></td>
					<td width="100px" class="borda titulo"><img width="70px" height="70px" src="<?php echo base_url() ?>assets/img/logo2.gif" alt="logo" /></td>
					<td width="300px" class="borda titulo">ANÁLISE CRÍTICA ENTRADA PEDIDO<br/><small><?php echo " O.I. ".$pedido->id ?></small></td>
					<td class="borda">
						<?php //Produção ou Amostra (mais fácil alinhar em table)?>
						<table>
							<tr>
								<td class="borda center" width="30px" height="30px"><?php echo $producao ?></td>
								<td>&nbsp;Produção</td>
							</tr>
							<tr>
								<td class="borda center" width="30px" height="30px"><?php echo $amostra ?></td>
								<td>&nbsp;Amostra</td>
							</tr>
						</table>
					</td>
					<td class="borda center"><span class="bold">RQ 22-01</span><br/><span class="bold">REV.:04</span><br/><span class="bold">Tempo arq.:</span> 2 anos<br/>7 anos auto.<br/><span class="bold">Index:</span> junto ao pedido ou P&D</td>
				</tr>
			</table>
		
			<table>
				<tr>
					<td class="titulo" colspan="9" >1 - dados de entrada</td>
				</tr>
				<tr>
					<td class="bold">Fim pretendido:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td class="bold">&nbsp;MOBÍLIA</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td class="bold">&nbsp;AUTOMOTIVO</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td class="bold">&nbsp;CALÇADO</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td class="bold">&nbsp;ARTEFATOS</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="80px">Cliente:</td>
					<td width="200px"><?php echo $pedido->cliente_nome(); ?></td>
					<td>&nbsp;</td>
					<td class="right" width="100px">Data Entrada:&nbsp;</td>
					<td><?php echo data_br($pedido->created_at); ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="80px">Agente:</td>
					<td><?php echo $pedido->representante_nome(); ?></td>
					<td class="right">Mercado:</td>
					<td class="borda center" width="30px" height="30px">ME</td>
					<td>&nbsp;</td>
					<td class="borda center" width="30px" height="30px">MI</td>
					<td>&nbsp;</td>
					<td class="right" width="115px">Previsão Entrega:&nbsp;</td>
					<td><?php echo data_br($pedido->data_entrega) ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="90px">Pedido/DM:</td>
					<td width="100px" class="linha">&nbsp;</td>
					<td class="right" width="230px">Requisitos regulam.e estatutários:&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="90px">Solicitante:</td>
					<td width="150px">Eurico Representações</td>
					<td class="bold" width="100px">&nbsp;Pedido Eurico:</td>
					<td class="bold" width="50px"><?php echo $pedido->id; ?></td>
					<td class="right">Objetivo:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Custo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Processo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Insumos</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Artigo</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="60px" class="bold">Artigo:</td>
					<td class="bold"><?php echo trim($pedido->artigo_nome()); ?></td>
					<td class="right" width="60px">Classe:</td>
					<td><?php echo $pedido->classificacao ?>&nbsp;</td>
					<td class="right" width="60px">Espessura:</td>
					<td><?php echo $pedido->espessura ?>&nbsp;</td>
				</tr>
			</table>

			<table class="cores">
				<tr>
					<td class="bold right" width="100px">Cor:</td>
					<td class="bold" width="100px"><?php echo $a->get_cor(); ?></td>
					<td class="right" width="50px">Qtd:</td>
					<td width="50px"><?php echo double_br($a->quantidade); ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="120px">Tipo de embarque:</td>
					<td width="30%" class="linha">&nbsp;</td>
					<td class="right" width="120px">Tipo de embalagem:</td>
					<td width="30%" class="linha">&nbsp;</td>
				</tr>
			</table>
			
			<table>
				<tr>
					<td class="bold" colspan="2">Couros:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Inteiros</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Meios</td>
					<td class="right bold" width="20px" height="20px">Raspas:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Meios</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Grupon Duplo</td>
				</tr>
			</table>
		</div>
		
		<?php //tabela dados financeiros
		if($usuario != USUARIO_CURTUME_PROGRAMACAO): ?>
		<div class="borda">
			<table>
				<tr>
					<td class="titulo" colspan="4">2 - dados financeiros</td>
				</tr>
				<tr>
					<td width="100px">Cliente:</td>
					<td><?php echo $pedido->cliente_nome(); ?></td>
					<td class="right" width="80px">Razão social:</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td width="100px">Inscrição estadual:</td>
					<td width="150px" class="linha">&nbsp;</td>
					<td class="right" width="80px">CNPJ/ CPF:</td>
					<td width="150px" class="linha">&nbsp;</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="80px">Endereço:</td>
					<td width="300px" class="linha">&nbsp;</td>
					<td class="right" width="50px">Bairro:</td>
					<td class="linha" width="100px">&nbsp;</td>
					<td class="right" width="50px">CEP:</td>
					<td class="linha">&nbsp;</td>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td width="80px">Município:</td>
					<td class="linha">&nbsp;</td>
					<td class="right" width="30px">UF:</td>
					<td class="linha">&nbsp;</td>
					<td class="right" width="50px">País:</td>
					<td class="linha" width="100px">&nbsp;</td>
					<td class="right" width="90px">Fone/ fax:</td>
					<td class="linha" width="100px">&nbsp;</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="100px">Preço venda:</td>
					<td width="300px" class="linha">&nbsp;</td>
					<td class="right" width="100px">Faturamento:</td>
					<td width="300px" class="linha">&nbsp;</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="100px">Cond. de pagamento:</td>
					<td width="300px" class="linha">&nbsp;</td>
				</tr>
			</table>
		</div>
		<?php endif; ?>

		<?php //3 - REQUISITOS TÉCNICOS (1 tabela para cada quadro) ?>
		<?php ($usuario == USUARIO_CURTUME_COMERCIAL)?$nmrTabela='3':$nmrTabela='2'; ?>
		<div class="borda">
			<table>
				<tr>
					<td class="titulo" colspan="5"><?php echo $nmrTabela ?> - requisitos técnicos</td>
				</tr>
				<tr>
					<td class="bold">Matéria-prima:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Verde/Salgado/Salmorado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Gaúcho</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Wet Blue</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Brasil Central</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Semi-acabado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Acabado</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
			
			<table class="borda">
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="50px">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="bold" colspan="6">Semi-Acabado</td>
				</tr>
				<tr>
					<td width="150px">Recurtimento/ fórmula:</td>
					<td class="linha" width="20%">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="2">Tingimento</td>
					<td colspan="2">Secagem</td>
					<td colspan="2">Toque</td>
					<td colspan="2">Carac. Flor</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Cartela</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Grampo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Firme</td>
				</tr>
				<tr>
					<td>Espessura de rebaixe:</td>
					<td class="linha">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Carnal</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Vácuo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Solta</td>
				</tr>

				<tr>
					<td colspan="3">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Afio</td>
					<td colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Intermediário</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Flor</td>
					<td colspan="4">&nbsp;</td>
					<td colspan="2">Tipo de flor</td>
				</tr>
				<tr>
					<td colspan="9">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Integral</td>
				</tr>
				<tr>
					<td colspan="9">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Lixado</td>
				</tr>
			</table>

			<table class="borda">
				<tr>
					<td class="bold" width="300px">Cartela padrão artigo cliente:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sim</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Não</td>
					<td width="450px">&nbsp;</td>
				</tr>
			</table>

			<table class="borda">
				<tr>
					<td class="bold" colspan="13">Características acabamento:</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="bold" colspan="2">Flor</td>
					<td class="bold" colspan="2">Brilho</td>
					<td class="bold" colspan="2">Toque</td>
					<td class="bold" colspan="4">Especificação do Toque</td>
					<td class="bold" colspan="2">Tipo Acabamento</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Firme</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Fosco</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sedoso</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Áspero</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Anilina</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Solta</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Brilho Médio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Ceroso</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Travado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Semi-anilina</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Intermediário</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Alto Brilho</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Graxoso</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Liso</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Pigmentado</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Siliconado</td>
					<td>&nbsp;</td><td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Efeito</td>
				</tr>
				<tr>
					<td class="bold" colspan="3">Tipo de lâmpada:</td>
					<td class="linha" colspan="5">&nbsp;</td>
					<td colspan="5">&nbsp;</td>
				</tr>
			</table>

			<table class="borda">
				<tr>
					<td width="150px" class="bold">Testes Laboratoriais:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Especificações requeridas cliente</td>
					<td width="100px">Espec./ Norma:</td>
					<td class="linha" width="100px">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>MET - MINUANO</td>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>

			<div class="page-break">&nbsp;</div>

			<table class="borda">
				<tr>
					<td class="bold">Observações:</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
			</table>

			<table class="borda" cellspacing="0" cellpadding="0">
				<tr>
					<td class="bold borda" colspan="3">Aceite Pedido:</td>
					<td class="bold color borda" colspan="4">&nbsp;&nbsp;Estes campos são obrigatórios para análise de pedidos de produção</td>
				</tr>
				<tr>
					<td class="borda center" width="15%">Comercial</td>
					<td class="borda center" colspan="2" width="30%">Técnico</td>
					<td class="borda" width="13.75%">Matéria-prima</td>
					<td class="borda" width="13.75%">PPCP</td>
					<td class="borda" width="13.75%">Custos</td>
					<td class="borda" width="13.75%">Produção</td>
				</tr>
				<tr>
					<td class="borda">&nbsp;</td>
					<td class="borda" colspan="2">&nbsp;</td>
					<td class="borda">&nbsp;</td>
					<td class="borda">&nbsp;</td>
					<td class="borda">&nbsp;</td>
					<td class="borda">&nbsp;</td>
				</tr>
				<tr>
					<td class="borda center">____/____/____<br/>____:____</td>
					<td class="borda center" colspan="2">____/____/____<br/>____:____</td>
					<td class="borda center">____/____/____<br/>____:____</td>
					<td class="borda center">____/____/____<br/>____:____</td>
					<td class="borda center">____/____/____<br/>____:____</td>
					<td class="borda center">____/____/____<br/>____:____</td>
				</tr>
			</table>
		</div>
		<br/>

<!--		<div class="page-break">&nbsp;</div> -->

		<div class="borda">
			<table cellspacing="0px" cellpadding="0px" >
				<tr class="normal">
					<td width="100px" class="borda titulo"><img src="<?php echo base_url() ?>assets/img/minuano_logo.gif" alt="logo" /></td>
					<td width="70%" class="borda titulo">verificação da amostra</td>
					<td class="borda center"><span class="bold">RQ 22-01</span><br/><span class="bold">REV.:04</span><br/><span class="bold">Tempo arq.:</span> 2 anos<br/>7 anos auto.<br/><span class="bold">Index:</span> junto ao pedido ou P&D</td>
				</tr>
			</table>
		</div><br/>
		(quando tratar-se de amostra preencher os campos abaixo)
		<div class="borda">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="linha rborda">&nbsp;DATA</td>
					<td class="linha">&nbsp;COMENTÁRIOS, OBSERVAÇÕES, ALTERAÇÕES</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="linha rborda">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
				<tr>
					<td class="rborda">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>

		<div class="borda">
			<table>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td class="borda">
						<table>
							<tr>
								<td colspan="4" class="linha titulo">verificação técnica da amostra</td>
							</tr>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td class="borda" width="20px" height="20px">&nbsp;</td>
								<td>APROVADA</td>
								<td>DATA</td>
								<td>____/____/____</td>
							</tr>
							<tr>
								<td class="borda" width="20px" height="20px">&nbsp;</td>
								<td>REPROVADA</td>
								<td width="100px">TÉCNICO RESP:</td>
								<td class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td width="20px">Obs.:</td>
								<td colspan="3" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td class="borda">
						<table>
							<tr>
								<td colspan="4" class="linha titulo">disposição cliente/comercial</td>
							</tr>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>
							<tr>
								<td class="borda" width="20px" height="20px">&nbsp;</td>
								<td>APROVADA</td>
								<td>DATA</td>
								<td>____/____/____</td>
							</tr>
							<tr>
								<td class="borda" width="20px" height="20px">&nbsp;</td>
								<td>REPROVADA</td>
								<td width="100px">Analisada por:</td>
								<td class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td width="20px">Obs.:</td>
								<td colspan="3" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" class="linha">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<?php if($contador < count($artigos)): ?>
			<div class="page-break">&nbsp;</div>
		<?php endif; ?>
<?php endforeach; ?>
	</body>
</html>