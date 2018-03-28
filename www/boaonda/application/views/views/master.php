<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo setTitulo($title) ?></title>
	
	<!-- Metatags -->	
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta name="rating" content="general" />
	<meta name="robots" content="all" /> 
	<meta name="mssmarttagspreventparsing" content="true" />
	<meta name="description" content="<?php echo setMetaDescription($metaDescription) ?>" /> 
	<meta name="author" content="Gestão Digital de Afirma.cc" /> 
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo imgSkin('favicon.ico') ?>" />
	<!--/ Metatags -->
	
	<!-- Facebook -->
	<meta property="og:image" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<!--/ Facebook -->	
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo cssSkin("site.css")."?".now();  ?>" media="screen" type="text/css" />
	<link rel="stylesheet" href="<?php echo cssSkin("jquery.jscrollpane.css");  ?>" media="screen" type="text/css" />
	<link rel="stylesheet" href="<?php echo jsSkin("fancybox/jquery.fancybox-1.3.4.css");  ?>" media="screen" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<?php if($paginaID == 'campanha'): ?>
		<link rel="stylesheet" href="<?php echo site_url('comum/js/booklet/jquery.booklet.1.3.1.css');  ?>" media="screen" type="text/css" />
	<?php endif; ?>
	<!--/ CSS -->
	
	<!-- SCRIPTS -->
	<script type="text/javascript"> var BASE_URL = "<?php echo base_url() ?>"; </script>
	<script type="text/javascript" src="<?php echo jsSkin('jquery-1.6.2.min.js') ?>"></script>
	<?php if($paginaID == 'campanha'): ?>
		<script type="text/javascript" src="<?php echo site_url('comum/js/booklet/jquery-ui-1.8.18.custom.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('comum/js/booklet/jquery.easing.1.3.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('comum/js/booklet/jquery.booklet.1.3.1.min.js'); ?>"></script>
	<?php endif; ?>
	
	<?php
		if (isset($javascript)):
			foreach ($javascript as $js):
	?>
	<script type="text/javascript" src="<?php echo jsSkin($js)."?".now(); ?>"></script>
	<?php 
			endforeach;
		endif;
	?>
	
	<script type="text/javascript" src="<?php echo jsSkin('jquery.site.js')."?".now(); ?>"></script>
	<script type="text/javascript" src="<?php echo jsSkin('ie6_alerta/ie6_script.js') ?>"></script>
	<!--/ SCRIPTS -->
	
</head>

<?php $isHome = ($paginaID == 'home') ? true : false; ?>

<body id="<?php echo $paginaID; ?>" class="<?php if (!$isHome) echo 'interna'; ?>">
	
	<div id="header">
		<div class="container">
			<?php if ($isHome): ?>
				<h1 class="logo">Boaonda</h1>
			<?php else: ?>
				<a href="<?php echo site_url(); ?>" title="" class="logo">Boaonda</a>
			<?php endif; ?>
			
			<ul id="menu" class="clearfix">
				<li class="empresa"><a href="<?php echo site_url('empresa') ?>" title="Boaonda"><?php echo $menu['empresa']; ?></a></li>
				<li class="colecao"><a href="<?php echo site_url('colecao') ?>" title="Coleção"><?php echo $menu['colecao']; ?></a></li>
				<li class="campanha"><a href="<?php echo site_url('campanha') ?>" title="Campanha"><?php echo $menu['campanha']; ?></a></li>
				<li class="naOnda"><a href="http://www.boaonda.com.br/blog/" title="Na Onda"><?php echo $menu['blog']; ?></a></li>
				<li class="ondeEncontrar"><a href="<?php echo site_url('onde-encontrar') ?>" title="Onde Encontrar"><?php echo $menu['ondeecontrar']; ?></a></li>
				<li class="contato"><a href="<?php echo site_url('contato') ?>" title="Fale Conosco"><?php echo $menu['faleConosco']; ?></a></li>
			</ul>
			
			<ul class="languages clearfix">
				<?php 
					$currentUrl = str_replace('BR','',str_replace('SP','',str_replace('EN','',current_url())));
					$currentUrl = rtrim($currentUrl,'/');
				?>
				<li class="pt"><a href="<?php echo site_url($this->lang->switch_uri("pt"));?>" title="Português">Português</a></li>
				<li class="en"><a href="<?php echo site_url($this->lang->switch_uri("en")); ?>" title="English">English</a></li>
				<li class="sp"><a href="<?php echo site_url($this->lang->switch_uri("es")); ?>" title="Spañol">Spañol</a></li>
			</ul>
		</div>
	</div>
	
	<?php	
		if (!$isHome):
			$banners = $dadosComuns['banners'];
			shuffle($banners);
			$banner = imgUpload($banners[0]['Imagem'],1904,715,'size');
		endif;		
	?>
	
	<div id="main" style="background-image:url('<?php echo $banner ?>');">
		
		<?php if (!$isHome): ?>
			<div class="overlay"><!-- --></div>
		<?php endif; ?>
	
		<?php $this->load->view($conteudo); ?>
	</div>
	<div id="footer">
		<div class="container">
			<div class="block-destaque">
				<div class="col-blog">
					<h4 class="ttl-blt"><?php __('site','blog') ?></h4>
					<ul>
						<?php foreach($dadosComuns['footerBlog'] as $dadosBlog): ?>
						<li>
							<h3 class="ttl"><a href="<?php echo $dadosBlog['guid'] ?>" title=""><?php echo $dadosBlog['post_title'] ?></a></h3>
							<p><a href="<?php echo $dadosBlog['guid'] ?>" title=""><?php echo $dadosBlog['post_content'] ?></a></p>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-cadastro clearfix">
					<h4 class="ttl-blt"><?php __('site','cadastrese') ?></h4>
					<p class="intro"><?php echo $dadosComuns['footerCadastro']['Descricao'] ?></p>
					<ul>
						<form name="cadastro" method="post" action="<?php echo site_url('cadastro') ?>">
							<li>
								<label for=""><?php __('cadastro','nome') ?></label>
								<div class="input">
									<input type="text" name="site_nome" />
								</div>
							</li>
							<li>
								<label for=""><?php __('cadastro','email') ?></label>
								<div class="input">
									<input type="text" name="site_email" />
								</div>
							</li>
							<li class="clearfix">
								<input type="submit" value="" class="btn btn-cadastro" />
							</li>
						</form>
					</ul>
					<div class="redes">
						<span><?php __('site','siganos'); ?></span>
						<ul>
							<li class="facebook"><a href="#" title="Facebook">Facebook</a></li>
							<li class="twitter"><a href="#" title="Twitter">Twitter</a></li>
							<li class="plus"><a href="#" title="Google Plus">Google Plus</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="block-colecao" style="background:url(<?php echo imgUpload($dadosComuns['footerColecao']['Imagem'],326,171) ?>) no-repeat;">
				<div class="ttl">
					<h4 class="ttl-blt"><a href="<?php echo site_url('colecao') ?>" title="Coleção"><?php __('site','colecao') ?></a></h4>
				</div>
				<a href="<?php echo site_url('colecao') ?>" title="Coleção" class="lnk-img">Coleção</a>
			</div>
			<div class="block-campanha">
				<h4 class="ttl-blt"><a href="<?php echo site_url('campanha') ?>" title="Campanha"><?php __('site','campanha') ?></a></h4>
				<!--<a href="<?php echo site_url('campanha') ?>" title="Campanha" class="lnk-img">-->
					<!--<img src="<?php echo imgUpload($dadosComuns['footerCampanha']['Imagem'],260,150); ?>" alt="" />-->
					<iframe width="260" height="150" src="http://www.youtube.com/embed/<?php echo $dadosComuns['videoCampanha'] ?>" frameborder="0" allowfullscreen></iframe>
				<!--</a>-->
			</div>
			<address>Rodovia RS 239, 471 - KM 30 | Sapiranga, RS. Fone/Fax (051) 3529.8482</address>
			<a href="http://www.afirma.cc" title="Desenvolvido por Afirma" class="afirma">Afirma</a>
		</div>
		<div class="bg-predios"><!-- --></div>
	</div>
</body>
</html>