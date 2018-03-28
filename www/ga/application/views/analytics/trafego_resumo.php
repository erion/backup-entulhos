<div class="resumesite clearfix">
	<ul class="overview">
		<li class="visits">
			<h4>Visitas</h4>
			<ul id="visitas" class="summary">
			  <li class="previous">
				<p><?=number_format($visitasmesanterior,0,'.','.');?></p>
				<h5><?=$nommesanterior;?></h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($visitasmesanalise,0,'.','.');?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  <li class="change">
				<p <?php if($percvisitas > 0 ){echo 'class="up"';}else{echo 'class="down"';} ?>><span></span><?=$percvisitas?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  
			  <li class="previous">
				<p><?=number_format($visitasmesatual,0,'.','.');?></p>
				<h5><?=$nommes;?></h5>
			  </li>
			</ul>
		</li>
		<li>
			<h4>Visitantes Únicos</h4>								
			<ul id="visitors">
			  <li class="previous">
				<p><?=number_format($unvisitorsmesanterior,0,'.','.');?></p>
				<h5><?=$nommesanterior;?></h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($unvisitorsanalise,0,'.','.');?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  <li class="change">
				<p <?php if($percunvisitors > 0 ){echo 'class="up"';}else{echo 'class="down"';} ?>><span></span><?=$percunvisitors?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  
			  <li class="previous">
				<p><?=number_format($unvisitorsatual,0,'.','.');?></p>
				<h5><?=$nommes;?></h5>
			  </li>
			</ul>
		</li>
		<li>
			<h4>PageViews</h4>
			<ul id="visitors">
			  <li class="previous">
				<p><?=number_format($pvmesanterior,0,'.','.')?></p>
				<h5><?=$nommesanterior;?></h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($pvmesanalise,0,'.','.');?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  <li class="change">
				<p <?php if($percpv > 0 ){echo 'class="up"';}else{echo 'class="down"';} ?>><span></span><?=$percpv?></p>
				<h5><?=$nommesanalise?></h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($pvmes,0,'.','.');?></p>
				<h5><?=$nommes;?></h5>
			  </li>
			</ul>								  
		</li>
		<li>
			<h4>Redes Sociais</h4>
			<ul id="visitors">
			  <li class="previous">
				<p><?=number_format($twitter[$mesanalise],0,'.','.')?></p>
				<h5>twitter</h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($facebook[$mesanalise],0,'.','.');?></p>
				<h5>Facebook</h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($orkut[$mesanalise],0,'.','.');?></p>
				<h5>Orkut</h5>
			  </li>
			  <li class="previous">
				<p><?=number_format($ning[$mesanalise],0,'.','.');?></p>
				<h5>Ning</h5>
			  </li>
			  <li class="previous">
				<p><?=$percvisitassociais?></p>
				<h5>% Audiência</h5>
			  </li>
			</ul>								  
		</li>
	</ul>
</div>