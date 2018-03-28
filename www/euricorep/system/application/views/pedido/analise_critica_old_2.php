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
		<div class="borda">
			<table cellspacing="0px" cellpadding="0px" >
				<tr class="normal">
					<td width="100px" class="borda titulo"><img src="<?php echo base_url() ?>assets/img/minuano_logo.gif" alt="logo" /></td>
					<td width="100px" class="borda titulo"><img width="70px" height="70px" src="<?php echo base_url() ?>assets/img/logo2.gif" alt="logo" /></td>
					<td width="300px" class="borda titulo">ANÁLISE CRÍTICA ENTRADA PEDIDO<br/><small><?php echo " O.I. ".$pedido->id."<br/>O.C.".$pedido->ordem_servico ?></small></td>
					<td class="borda">
						<?php //Produção ou Amostra (mais fácil alinhar em table)?>
						<table>
							<tr>
								<td class="borda center" width="30px" height="30px"><?php echo $producao ?></td>
								<td>&nbsp;Produção</td>
								<td class="borda center" width="30px" height="30px"><?php echo "&nbsp;"; ?></td>
								<td>&nbsp;DM</td>
							</tr>
							<tr>
								<td class="borda center" width="30px" height="30px"><?php echo $amostra ?></td>
								<td>&nbsp;Amostra</td>
								<td colspan="2">&nbsp;</td>
							</tr>
						</table>
					</td>
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
					<td class="linha" width="200px"><?php echo $pedido->cliente_nome(); ?></td>
					<td class="right" width="60px">Divisão:</td>
					<td class="linha" width="100px">&nbsp;</td>
					<td class="right" width="60px">Revisor:</td>
					<td class="linha" width="100px">&nbsp;</td>
					<td class="right" width="100px">Data Entrada:&nbsp;</td>
					<td class="linha"><?php echo data_br($pedido->created_at); ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="80px">Agente:</td>
					<td class="linha"><?php echo $pedido->representante_nome(); ?></td>
					<td class="right">Mercado:</td>
					<td class="borda center" width="30px" height="30px">ME</td>
					<td>&nbsp;</td>
					<td class="borda center" width="30px" height="30px">MI</td>
					<td>&nbsp;</td>
					<td class="right" width="115px">Previsão Entrega:&nbsp;</td>
					<td class="linha"><?php echo data_br($pedido->data_entrega) ?></td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="90px">Pedido/DM:</td>
					<td width="100px" class="linha">&nbsp;</td>
					<td class="right" width="90px">Solicitante:</td>
					<td class="linha" width="150px">Eurico Representações</td>
					<td class="right">Objetivo:</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Custo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Processo</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Insumos</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Artigo</td>
				</tr>
			</table>

			<table>
				<tr>
					<?php
					if($cliente->rr_estatutarios == 0) {
						$sim = '&nbsp;';
						$nao = 'X';
					} else {
						$sim = 'X';
						$nao = '&nbsp;';
					}
					?>
					<td width="200px">Requisitos regulam.e estatutários:&nbsp;</td>
					<td class="borda center" width="20px" height="20px"><?php echo $sim ?></td>
					<td width="50px">&nbsp;Sim</td>
					<td class="borda center" width="20px" height="20px"><?php echo $nao ?></td>
					<td width="50px">&nbsp;Não</td>
					<td class="right" width="80px">Quais:</td>
					<td class="linha">&nbsp;</td>
				</tr>
			</table>

			<table>
				<tr>
					<td width="50px" class="bold">Artigo:</td>
					<td class="bold linha"><?php echo trim($pedido->artigo_nome()); ?></td>
					<td class="right" width="50px">Classe:</td>
					<td class="linha"><?php echo $pedido->classificacao ?>&nbsp;</td>
					<td class="right" width="60px">Espessura:</td>
					<td class="linha"><?php echo $pedido->espessura ?>&nbsp;</td>
				</tr>
			</table>
			<table>
				<tr>
					<th class="bold right" width="50px" scope="row">Cor:</th>
					<?php foreach($at1 as $a): ?>
					<td class="bold" scope="col"><?php echo $a->get_cor(); ?></td>
					<?php endforeach; ?>
				</tr>
				<tr>
					<th class="bold right" scope="row">Qtd:</th>
					<?php foreach($at1 as $a): ?>
					<td width="50px" scope="col"><?php echo double_br($a->quantidade); ?></td>
					<?php endforeach; ?>
				</tr>
			</table>
			<?php if(count($at2)>0): ?>
				<table>
					<tr>
						<th class="bold right" width="50px" scope="row">Cor:</th>
						<?php foreach($at2 as $a): ?>
						<td class="bold" scope="col"><?php echo $a->get_cor(); ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th class="bold right" scope="row">Qtd:</th>
						<?php foreach($at2 as $a): ?>
						<td width="50px" scope="col"><?php echo double_br($a->quantidade); ?></td>
						<?php endforeach; ?>
					</tr>
				</table>
			<?php endif; ?>
			<?php if(count($at3)>0): ?>
				<table>
					<tr>
						<th class="bold right" width="50px" scope="row">Cor:</th>
						<?php foreach($at3 as $a): ?>
						<td class="bold" scope="col"><?php echo $a->get_cor(); ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th class="bold right" scope="row">Qtd:</th>
						<?php foreach($at3 as $a): ?>
						<td width="50px" scope="col"><?php echo double_br($a->quantidade); ?></td>
						<?php endforeach; ?>
					</tr>
				</table>
			<?php endif; ?>
			<?php if(count($at4)>0): ?>
				<table>
					<tr>
						<th class="bold right" width="50px" scope="row">Cor:</th>
						<?php foreach($at4 as $a): ?>
						<td class="bold" scope="col"><?php echo $a->get_cor(); ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th class="bold right" scope="row">Qtd:</th>
						<?php foreach($at4 as $a): ?>
						<td width="50px" scope="col"><?php echo double_br($a->quantidade); ?></td>
						<?php endforeach; ?>
					</tr>
				</table>
			<?php endif; ?>
			<?php if(count($at5)>0): ?>
				<table>
					<tr>
						<th class="bold right" width="50px" scope="row">Cor:</th>
						<?php foreach($at5 as $a): ?>
						<td class="bold" scope="col"><?php echo $a->get_cor(); ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th class="bold right" scope="row">Qtd:</th>
						<?php foreach($at5 as $a): ?>
						<td width="50px" scope="col"><?php echo double_br($a->quantidade); ?></td>
						<?php endforeach; ?>
					</tr>
				</table>
			<?php endif; ?>

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
					<td width="110px">Tolerância metragem:</td>
					<td class="linha"><?php echo $cliente->tolerancia_metragem ?></td>
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
					<caption class="titulo">2 - dados financeiros</caption>
				</tr>
				<tr>
					<td width="50px">Cliente:</td>
					<td class="linha"><?php echo $pedido->cliente_nome(); ?></td>
					<td class="right" width="80px">Razão social:</td>
					<td class="linha" width="100px"><?php echo $cliente->razao_social ?></td>
					<td class="right" width="80px">CNPJ/ CPF:</td>
					<td width="100px" class="linha"><?php echo $cliente->cnpj ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="100px">Inscrição estadual:</td>
					<td class="linha"><?php echo $cliente->incs_estadual ?></td>
					<td class="right" width="80px">Endereço:</td>
					<td width="300px" class="linha"><?php echo $cliente->endereco ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="40px">Bairro:</td>
					<td class="linha" width="150px"><?php echo $cliente->bairro ?></td>
					<td class="right" width="20px">CEP:</td>
					<td class="linha" width="100px"><?php echo $cliente->cep ?></td>
					<td class="right" width="60px">Município:</td>
					<td class="linha" width="150px"><?php echo $cliente->cidade ?></td>
					<td class="right" width="15px">UF:</td>
					<td class="linha" width="25px"><?php echo $cliente->uf ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="25px">País:</td>
					<td class="linha" width="100px"><?php echo $cliente->pais ?></td>
					<td class="right" width="60px">Fone/ fax:</td>
					<td class="linha" width="100px"><?php echo (!empty($cliente->fone))?$cliente->fone:$cliente->nome ?></td>
					<td class="right" width="80px">Preço venda:</td>
					<td width="100px" class="linha">&nbsp;</td>
					<td class="right" width="80px">Faturamento:</td>
					<td width="100px" class="linha"><?php echo $pedido->faturamento ?></td>
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
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Verde/Salgado/Salmorado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Semi-acabado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Acabado</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Gaúcho</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Wet Blue</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Wet White</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td>Brasil Central</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td>
					<td class="linha">&nbsp;</td>
				</tr>
			</table>
			
			<table class="borda">
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="bold center" colspan="11">Semi-Acabado</td>
				</tr>
				<tr>
					<td class="bold" width="120px">Recurtimento/ fórmula</td>
					<td class="linha" width="25%" colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td colspan="5">Tingimento</td>
					<td colspan="4">Secagem</td>
					<td colspan="2">Tipo de flor</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Cartela</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Flor</td><td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Grampo</td>
					<td class="linha" width="80px" colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Integral</td>
				</tr>
				<tr>
					<td class="bold">Espessura de rebaixe:</td>
					<td class="linha" colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Carnal</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td colspan="2">Última produção</td>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Lixado</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Afio</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Padrão</td>
					<td class="linha" width="50px">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Vácuo</td>
					<td class="linha" colspan="2">&nbsp;</td>
					<td class="borda" width="20px" height="20px">&nbsp;</td><td>Estucado</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="7">
						<table>
							<tr>
								<td class="bold">Toque:</td>
								<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
								<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
								<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
							</tr>
						</table>
					</td>
					<td colspan="7">
						<table>
							<tr>
								<td class="bold">Carac.Flor:</td>
								<td class="borda" width="20px" height="20px">&nbsp;</td><td>Firme</td>
								<td class="borda" width="20px" height="20px">&nbsp;</td><td>Intermediário</td>
							</tr>
						</table>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
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
						<td class="bold" colspan="2">Toque</td>
						<td class="bold" colspan="5">Brilho</td>
						<td class="bold" colspan="4">Especificação do Toque</td>
						<td class="bold" colspan="2">Tipo Acabamento</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Macio</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Fosco</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Brilhometro n</td>
						<td class="linha" width="50px">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sedoso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Áspero</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Anilina</td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Médio</td>
						<td colspan="3">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Ceroso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Travado</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Semi-anilina</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Armado</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Alto brilho</td>
						<td colspan="3">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Graxoso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Liso</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Pigmentado</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Softímetro</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Cfe cartela</td>
						<td colspan="3">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Siliconado</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha">&nbsp;</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td>Efeito</td>
					</tr>
					<tr>
						<td colspan="12">
							<table>
								<tr>
									<td class="bold right">Estampa:</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td>N/A</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha" width="100px">&nbsp;</td>
									<td class="bold right">Batido:</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td>Sim</td>
									<td class="borda" width="20px" height="20px">&nbsp;</td><td>Não</td>
								</tr>
							</table>
						</td>
						<td class="borda" width="20px" height="20px">&nbsp;</td><td class="linha" width="100px">&nbsp;</td>
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
	</body>
</html>