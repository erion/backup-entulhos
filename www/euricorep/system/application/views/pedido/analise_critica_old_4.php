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
<?php foreach($artigos as $artigo_pedido): 
$total_artigos--;

$producao = ($artigo_pedido->amostra == '0')?'X':'&nbsp;';
$amostra = ($artigo_pedido->amostra == '1')?'X':'&nbsp;';
?>
		<div class="borda">
			<table cellspacing="0px" cellpadding="0px" >
				<tr class="normal">
					<td width="100px" class="borda titulo"><img src="<?php echo base_url() ?>assets/img/minuano_logo.gif" alt="logo" /></td>
					<td width="300px" class="borda">
						<table>
							<tr>
								<td class="titulo" colspan="5">ANÁLISE CRÍTICA ENTRADA PEDIDO</td>
							</tr>
							<tr><td colspan="5">&nbsp;</td></tr>
							<tr>
								<td class="right" width="70px"><small>Pedido agente:</small></td>
								<td class="linha"><small><?php echo $pedido->id ?></small></td>
								<td>&nbsp;</td>
								<td class="right" width="70px"><small>Pedido cliente:</small></td>
								<td class="linha"><small><?php echo $pedido->ordem_servico ?></small></td>
							</tr>
						</table>
					</td>
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
							<tr>
								<td class="borda center" width="30px" height="30px"><?php echo "&nbsp;"; ?></td>
								<td>&nbsp;DM</td>
							</tr>
						</table>
					</td>
					<td width="100px" class="borda titulo"><img width="70px" height="70px" src="<?php echo base_url() ?>assets/img/logo2.gif" alt="logo" /></td>
				</tr>
			</table>
		
			<table>
				<tr>
					<td class="titulo" colspan="11" >1 - dados de entrada</td>
				</tr>
				<tr>
					<td class="bold">Fim pretendido:</td>
					<td class="borda center" width="20px" height="20px"><?php echo $mobilia ?>&nbsp;</td><td class="bold">&nbsp;MOBÍLIA</td>
					<td class="borda center" width="20px" height="20px"><?php echo $automotivo ?>&nbsp;</td><td class="bold">&nbsp;AUTOMOTIVO</td>
					<td class="borda center" width="20px" height="20px"><?php echo $aeronautico ?>&nbsp;</td><td class="bold">&nbsp;AERONÁUTICO</td>
					<td class="borda center" width="20px" height="20px"><?php echo $calcado ?>&nbsp;</td><td class="bold">&nbsp;CALÇADO</td>
					<td class="borda center" width="20px" height="20px"><?php echo $artefatos ?>&nbsp;</td><td class="bold">&nbsp;ARTEFATOS</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="40px">Cliente:</td>
					<td class="linha" width="200px"><?php echo limit_char($pedido->cliente_nome(),40); ?></td>
					<td class="right" width="60px">Divisão:</td>
					<td class="linha" width="100px"><?php echo $pedido->divisao ?>&nbsp;</td>
					<td class="right" width="60px">Revisor:</td>
					<td class="linha" width="100px"><?php echo $pedido->revisor ?>&nbsp;</td>
					<td class="right" width="100px">Data Entrada:&nbsp;</td>
					<td class="linha"><?php echo data_br($pedido->created_at); ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="40px">Agente:</td>
					<td class="linha"><?php echo $pedido->representante_nome(); ?></td>
					<td class="right">Mercado:</td>
					<td class="borda center <?php echo ($pedido->mercado == 'ME')?'Xbg':'' ?>" width="25px" height="25px">ME</td>
					<td>&nbsp;</td>
					<td class="borda center <?php echo ($pedido->mercado == 'MI')?'Xbg':'' ?>" width="25px" height="25px">MI</td>
					<td>&nbsp;</td>
					<td class="right" width="115px">Previsão Entrega:&nbsp;</td>
					<td class="linha"><?php echo data_br($pedido->data_entrega) ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="50px">Pedido/DM:</td>
					<td width="100px" class="linha">&nbsp;</td>
					<td class="right" width="90px">Qtde:</td>
					<td class="linha" width="80px"><?php echo $artigo_pedido->quantidade; ?>&nbsp;</td>
					<?php
					if($cliente->rr_estatutarios == 0) {
						$sim = '&nbsp;';
						$nao = 'X';
					} else {
						$sim = 'X';
						$nao = '&nbsp;';
					}
					?>
					<td class="right">Requisitos cliente,regulam.e estatutários:&nbsp;</td>
					<td class="linha" width="100px">&nbsp;</td>
				</tr>
			</table>
<?php
	if($pedido->cupim > 0) {
		$cupimS = 'X';
		$cupimN = '&nbsp;';
		$cupimPercent = $pedido->cupim;
	} else {
		$cupimS = '&nbsp;';
		$cupimN = 'X';
		$cupimPercent = '&nbsp;';
	}
?>
			<table>
				<tr>
					<td width="50px">Solicitante:</td>
					<td class="linha">Eurico Representações</td>
					<td class="right" width="50px">Cupim:</td>
					<td class="borda center" width="20px" height="20px"><?php echo $cupimN ?></td><td width="25px">Não</td>
					<td class="borda center" width="20px" height="20px"><?php echo $cupimS ?></td><td width="25px">Sim</td>
					<td class="linha right" width="10px"><?php echo $cupimPercent ?>&nbsp;</td>
					<td>%</td>
					<td class="right" width="140px">Tamanho médio do couro:</td>
					<td class="linha" width="150px"><?php echo $pedido->tamanho_peca; ?>&nbsp;</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="40px" class="bold">Artigo:</td>
					<td class="bold linha"><?php echo trim($pedido->artigo_nome()); ?></td>
					<td class="right" width="50px">Classe:</td>
					<td class="linha"><?php echo $pedido->classificacao ?>&nbsp;</td>
					<td class="right" width="60px">Espessura:</td>
					<td class="linha"><?php echo $pedido->espessura ?>&nbsp;</td>
					<td class="right" width="30px">Cor:</td>
					<td class="linha"><?php echo $artigo_pedido->cor; ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="75px">Tipo de embarque:</td>
					<td width="20%" class="linha"><?php echo $pedido->tipo_embarque ?>&nbsp;</td>
					<td class="right" width="120px">Tipo de embalagem:</td>
					<td width="20%" class="linha"><?php echo $pedido->tipo_embalagem ?>&nbsp;</td>
					<td class="right" width="110px">Tolerância metragem:</td>
					<td class="linha" width="10%">&nbsp;<?php echo (!empty($cliente->tolerancia_metragem))?$cliente->tolerancia_metragem:$pedido->tolerancia_metragem ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td>Tipo de lâmpada:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Padrão Minuano (fluorescente)</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Outra</td>
					<td class="linha" width="100px">&nbsp;</td>
					<td width="45%">&nbsp;</td>
				</tr>
			</table>
<?php
	if($pedido->couro == 'INTEIROS') {
		$couro_inteiro = 'X';
		$couro_meio = '&nbsp;';
	} else {
		$couro_inteiro = '&nbsp;';
		$couro_meio = 'X';
	}
	if($pedido->raspa == 'MEIOS') {
		$raspa_meio = 'X';
		$raspa_grupon = '&nbsp;';
	} else {
		$raspa_meio = '&nbsp;';
		$raspa_grupon = 'X';
	}
?>
			<table>
				<tr>
					<td class="bold" colspan="2">Couros:</td>
					<td class="borda center" width="20px" height="20px"><?php echo $couro_inteiro ?></td><td>Inteiros</td>
					<td class="borda center" width="20px" height="20px"><?php echo $couro_meio ?></td><td>Meios</td>
					<td class="right bold" width="20px" height="20px">Raspas:</td>
					<td class="borda center" width="20px" height="20px"><?php echo $raspa_meio ?></td><td>Meios</td>
					<td class="borda center" width="20px" height="20px"><?php echo $raspa_grupon ?></td><td>Grupon Duplo</td>
				</tr>
			</table>
		</div>
		
		<?php //tabela dados financeiros
		if($usuario != USUARIO_CURTUME_PROGRAMACAO): ?>
		<div class="borda">
			<table>
				<tr>
					<caption class="titulo">2 - dados financeiros</caption>
				</tr>
				<tr>
					<td width="50px">Cliente:</td>
					<td class="linha">&nbsp;<?php echo $pedido->cliente_nome(); ?></td>
					<td class="right" width="80px">Razão social:</td>
					<td class="linha" width="100px">&nbsp;<?php echo $cliente->razao_social ?></td>
					<td class="right" width="80px">CNPJ/ CPF:</td>
					<td width="100px" class="linha">&nbsp;<?php echo $cliente->cnpj ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="100px">Inscrição estadual:</td>
					<td class="linha">&nbsp;<?php echo $cliente->incs_estadual ?></td>
					<td class="right" width="80px">Endereço:</td>
					<td width="300px" class="linha">&nbsp;<?php echo $cliente->endereco ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="40px">Bairro:</td>
					<td class="linha" width="150px">&nbsp;<?php echo $cliente->bairro ?></td>
					<td class="right" width="20px">CEP:</td>
					<td class="linha" width="100px">&nbsp;<?php echo $cliente->cep ?></td>
					<td class="right" width="60px">Município:</td>
					<td class="linha" width="150px">&nbsp;<?php echo $cliente->cidade ?></td>
					<td class="right" width="15px">UF:</td>
					<td class="linha" width="25px">&nbsp;<?php echo $cliente->uf ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="25px">País:</td>
					<td class="linha" width="100px">&nbsp;<?php echo $cliente->pais ?></td>
					<td class="right" width="60px">Fone/ fax:</td>
					<td class="linha" width="100px">&nbsp;<?php echo (!empty($cliente->fone))?$cliente->fone:$cliente->fax ?></td>
					<td class="right" width="80px">Preço venda:</td>
					<td width="100px" class="linha">&nbsp;<?php echo (!empty($artigo_pedido->valor_unitario_corrigido))?$artigo_pedido->valor_unitario_corrigido:$artigo_pedido->valor_unitario; ?></td>
					<td class="right" width="80px">Faturamento:</td>
					<td width="100px" class="linha">&nbsp;<?php echo $pedido->faturamento ?></td>
					<td class="right" width="100px">Cond.pagamento:</td>
					<td width="100px" class="linha">&nbsp;</td>
				</tr>
			</table>
		</div>
		<?php endif; ?>

		<?php //3 - REQUISITOS TÉCNICOS (1 tabela para cada quadro) ?>
		<?php ($usuario != USUARIO_CURTUME_PROGRAMACAO)?$nmrTabela='3':$nmrTabela='2'; ?>
		<div class="borda">
			<table>
				<tr>
					<td class="titulo" colspan="9"><?php echo $nmrTabela ?> - requisitos técnicos</td>
				</tr>
				<tr>
					<td class="bold">Matéria-prima:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Verde/Salgado/Salmorado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Semi-acabado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Gaúcho</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Wet White</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Acabado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Brasil Central</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Wet Blue</td>
					<td colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha" width="100px">&nbsp</td>
				</tr>
			</table>
			
			<table>
				<tr>
					<td class="bold" width="120px">Recurtimento/ fórmula</td>
					<td class="linha" width="25%" colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="5">Tingimento</td>
					<td colspan="4">Secagem</td>
					<td colspan="2">Carac. Flor</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Cartela</td>
					<td colspan="3">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Grampo</td>
					<td class="linha" width="80px" colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Firme</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Carnal</td>
					<td colspan="3">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Vácuo</td>
					<td class="linha" width="80px" colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Intermediário</td>
				</tr>
				<tr>
					<td class="bold" width="120px">Espessura de rebaixe:</td>
					<td class="linha" width="25%" colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Afio</td>
					<td colspan="5">&nbsp;</td>
					<td colspan="2">Toque</td>
					<td colspan="2">Tipo de flor</td>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Flor</td>
					<td colspan="5">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Integral</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Última produção</td>
					<td colspan="5">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Lixado</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Padrão</td>
					<td colspan="5" class="linha">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Estucado</td>
				</tr>
			</table>

			<table class="borda">
				<tr>
					<td class="bold" width="200px">Cartela padrão artigo cliente:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sim</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Não</td>
					<td width="120px">Registro propriedade n°:</td>
					<td class="linha" width="100px">&nbsp;</td>
				</tr>
			</table>

			<div class="borda">
				<table>
					<tr>
						<td class="bold" colspan="8">Acabamento:&nbsp;<small>(Para produção, seguir conforme cartela padrão)</small></td>
						<td colspan="6"><small>(DM e amostra, recomenda-se preenchimento dos campos abaixo)</small></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="bold" colspan="2">Batido</td>
						<td class="bold" colspan="3">Toque</td>
						<td class="bold" colspan="4">Brilho</td>
						<td class="bold" colspan="4">Especificação do Toque</td>
						<td class="bold" colspan="2">Tipo Acabamento</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sim</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Fosco</td>
						<td colspan="2">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sedoso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Áspero</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Anilina</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Não</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
						<td colspan="2">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Ceroso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Travado</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Semi-anilina</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Alto brilho</td>
						<td colspan="2">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Graxoso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Liso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Pigmentado</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Softímetro</td>
						<td class="linha" width="80px">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Cfe cartela</td>
						<td colspan="2">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Siliconado</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Efeito</td>
					</tr>
					<tr>
						<td colspan="6">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Brilhometro n°:</td>
						<td colspan="2" class="linha" width="80px">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha">&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td colspan="8">
							<table>
								<tr>
									<td class="right">Estampa:</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td>Não</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td width="20px">Sim</td>
									<td class="linha" width="150px">&nbsp;</td>
								</tr>
							</table>
						</td>
						<td colspan="6">&nbsp;</td>
					</tr>
				</table>
			</div>

			<table class="borda">
				<tr>
					<td width="150px" class="bold">Testes Laboratoriais:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Especificações requeridas cliente</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>MET - MINUANO</td>
					<td colspan="2">&nbsp;</td>
					<td width="100px">Espec./ Norma:</td>
					<td class="linha" width="100px">&nbsp;</td>
				</tr>
			</table>

			<table class="borda">
				<tr>
					<td class="bold">Observações:</td>
				</tr>
<?php
foreach($observacoes as $obs) {
	echo "<tr><td class='linha' width='100%'>".$obs->msg."</td></tr>";
}
$l = new Log();
$l->where(array('relation_table' => 'artigos_pedidos', 'relation_id' => $artigo_pedido->id))->order_by('created_at','desc')->get()->all;
?>				
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

		<div class="page-break">&nbsp;</div>

		<table cellspacing="0px" cellpadding="0px" >
			<tr class="normal">
				<td width="100px" class="borda titulo"><img src="<?php echo base_url() ?>assets/img/minuano_logo.gif" alt="logo" /></td>
				<td width="300px" class="borda titulo">ANÁLISE DE DESENVOLVIMENTO</td>
				<td width="100px" class="borda titulo"><img width="70px" height="70px" src="<?php echo base_url() ?>assets/img/logo2.gif" alt="logo" /></td>
			</tr>
		</table>

		<table>
			<tr>
				<td class="center titulo color bold" colspan="6">verificação do desenvolvimento</td>
			</tr>
			<tr>
				<td class="center" colspan="6">
					<small>A verificação é executada para confirmação de que o produto atende aos requisitos de entrada do desenvolvimento</small>
					<br/>
					<small>Anexar este RQ, os documentos abaixo:</small>
				</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
			<tr>
				<td class="right" width="150px">Fórmula recurtimento:</td>
				<td class="linha" colspan="2" width="100px">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="right" width="150px">Fórmula acabamento:</td>
				<td class="linha" width="100px">&nbsp;</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
			<tr>
				<td class="right" colspan="2">Fluxo de WB e Semi-acabado:</td>
				<td class="linha" width="100px">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="right">Fluxo de acabado:</td>
				<td class="linha" width="100px">&nbsp;</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
			<tr>
				<td class="right">Cartela amostra:</td>
				<td class="linha" colspan="2" width="100px">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="right">Teste laboratoriais:</td>
				<td class="linha" width="100px">&nbsp;</td>
			</tr>
			<tr>
				<td class="right" colspan="3">(cartela tamanho A4 preferencialmente)</td>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
			<tr>
				<td class="right">Estimativa de rendimento:</td>
				<td class="linha" colspan="2" width="100px">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="right" colspan="2">Enviado couro para o cliente?:</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
				<td>&nbsp;</td>
				<td class="right">( ) Não</td>
				<td width="120px">( ) Sim  Qtde:__________</td>
			</tr>
			<tr><td colspan="6">&nbsp;</td></tr>
			<table>
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
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
			</table>
			<tr><td colspan="6">&nbsp;</td></tr>
			<table>
				<tr>
					<td width="200px">Aprovação do(s) técnico(s) reponsável:</td>
					<td class="linha" width="150px">&nbsp;</td>
					<td class="right">Data:</td>
					<td>____/____/____</td>
					<td>&nbsp;</td>
				</tr>
				<tr><td colspan="5">&nbsp;</td></tr>
			</table>
		</table>
		<table>
			<tr>
				<td class="titulo center color bold">validação do desenvolvimento</td>
			</tr>
			<tr>
				<td class="center">
					<small>Quando entrar em produção o primeiro lote, este deve ter OF específica e deverá receber acompanhamento técnico</small>
					<br/>
					<small>Se houver necessidade de alteração, esta deverá ser registrada</small>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
		</table>
		<table>
			<tr>
				<td width="120px">Formulário recurtimento</td>
				<td>( ) Sim</td>
				<td>( ) Não</td>
				<td>&nbsp;</td>
				<td width="120px">Fórmula acabamento:</td>
				<td>( ) Sim</td>
				<td>( ) Não</td>
			</tr>
			<tr>
				<td colspan="7">&nbsp;</td>
			</tr>
		</table>
		<table>
			<tr>
				<td width="150px">Fluxo de WB e semi-acabado:</td>
				<td>( ) Sim</td>
				<td>( ) Não</td>
				<td>&nbsp;</td>
				<td width="100px">Fluxo de acabado:</td>
				<td>( ) Sim</td>
				<td>( ) Não</td>
			</tr>
			<tr>
				<td colspan="7">&nbsp;</td>
			</tr>
		</table>
		<table>
			<tr>
				<td width="100px">Rendimento:</td>
				<td class="linha" width="150px">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
		</table>
		<table>
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
				<tr>
					<td class="linha" width="100%">&nbsp;</td>
				</tr>
			<tr><td>&nbsp;</td></tr>
		</table>
		<table>
			<tr>
				<td width="200px">Aprovação do(s) técnico(s) reponsável:</td>
				<td class="linha" width="150px">&nbsp;</td>
				<td class="right">Data:</td>
				<td>____/____/____</td>
				<td>&nbsp;</td>
			</tr>
		</table>

		<?php if($total_artigos > 0): ?>
			<div class="page-break">&nbsp;</div>
		<?php endif; ?>
<?php endforeach; ?>
	</body>
</html>