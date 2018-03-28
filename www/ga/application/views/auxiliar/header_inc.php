
<?php $pagina_atual = strrchr($_SERVER['REQUEST_URI'],'/'); ?>
<header>
	<?php if ($pagina_atual == '/'){ ?>
	<h1 class="logo"><a href="/" title="" class=""><?=$config['h1logo']?> </a></h1>
	<?php  }else { ?>
	<div class="logo"><a href="/" title="<?=$config['h1logo']?>" class=""><?=$config['h1logo']?></a></div>
	<?php }?>
	<nav class="navigation">
		<ul>
			<li class="sites"><a href="<?php echo site_url('analise') ?>" title="Sites">Sites</a></li>
		</ul>	
	</nav>
</header>
	