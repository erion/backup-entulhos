<div id="analytics-site">	
	<div id="wrapper">
		<!-- header -->
		<?php $this->load->view('auxiliar/header_inc.php'); ?>
		<!-- end:header -->
		<!-- main -->
		<section id="main">
			<?php //filtros
				$this->load->view('analytics/filtro');
				
				if($selectedProfile): //se tem profile selecionado, acho que não será mais usado e vai ficar tudo em ajax
			?>
				
				<div class="content">
					<h1 class="titresumo"><?php echo "Cliente: ".$profileName.": ".getMesAnalytics($mesanalise).$periodo; ?></h1>
					<?php 
					$periodo = '';
					if(!empty($filtroDataIni) && trim($filtroDataIni) != '')
						$periodo = ' - entre '.date('d/m/y',$filtroDataIni).' e '.date('d/m/y',$filtroDataFim);
					?>
					<div class="traffic" id="trafego-resumo">&nbsp;
						<?php
						//traffic
						try {
							$this->load->view('analytics/trafego_resumo',$traffic);
						} catch (Exception $e) { 
							echo "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5>";
						}						
						?>
					</div>
					
					<h5 class="titresumo">Resumo dados mês Análise: <?php echo getMesAnalytics($mesanalise); ?></h5>
					<div class="boxdados" id="resumo-mes">&nbsp;
						<?php //resumo mês
						try {
							$this->load->view('analytics/resumo_mes');
						} catch (Exception $e) { 
							echo "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5>";
						}						
						?>
					</div>
					
					<h5 class="titresumo">Resumo Anual</h5>
					<div class="boxdados" id="resumo-anual">&nbsp;
						<?php //resumo anual 
						try {
							$this->load->view('analytics/resumo_anual');
						} catch (Exception $e) { 
							echo "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5>";
						}
						?>
					</div>

					<h5 class="titresumo">Fontes de Tráfego</h5>
					<div class="boxdados" id="trafego">&nbsp;
						<?php //trafego 
						try {
							$this->load->view('analytics/trafego');
						} catch (Exception $e) { 
							echo "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5>";
						}
						?>	
					</div>
					
					<h5 class="titresumo">Keywords - URLS</h5>
					<div class="boxdados" id="keywords">&nbsp;
						<?php //keywords
						try {
							$this->load->view('analytics/keywords');
						} catch (Exception $e) { 
							echo "<h5 class='titresumo' >Ocorreu um erro, dados insuficientes para exibição. (".$e->getMessage().")</h5>";
						}					
						?>
					</div>
				</div>
			<?php else: ?>
				<div class="content">
					<div id="titulo1">
						<h1 class="titresumo"><?php echo "Selecione um cliente." ?></h1>
					</div>
					<?php 
					$periodo = '';
					if(!empty($filtroDataIni) && trim($filtroDataIni) != '')
						$periodo = ' - entre '.date('d/m/y',$filtroDataIni).' e '.date('d/m/y',$filtroDataFim);
					?>
					<div class="traffic" id="trafego-resumo">&nbsp;
					</div>
					
					<div id="titulo2">
						<h5 class="titresumo">Resumo dados mês Análise: <?php echo getMesAnalytics($mesanalise); ?></h5>
					</div>
					<div class="boxdados" id="resumo-mes">&nbsp;
						<!-- grafico deve ficar aqui para funcionar no ie -->
						<div class="grafico">
							<div id="grafresumo"></div>
							<div id="chart_div"></div>
						</div>			
					</div>
					
					<h5 class="titresumo">Resumo Anual</h5>
					<div class="boxdados" id="resumo-anual">&nbsp;
					</div>

					<h5 class="titresumo">Fontes de Tráfego</h5>
					<div class="boxdados" id="trafego">&nbsp;
					</div>
					
					<h5 class="titresumo">Keywords - URLS</h5>
					<div class="boxdados" id="keywords">&nbsp;
					</div>					
				</div>
			<?php endif; ?>
		</section>
		<!-- end:main -->
		<footer class="footer"></footer>
	</div>
</div>