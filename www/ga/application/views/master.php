<!DOCTYPE html>
<html lang="pt-br">
<head>        
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title><?php echo setTitulo($title) ?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="nl">
	<meta name="robots" content="noindex, nofollow" />
	
	<script type="text/javascript"> var BASE_URL = "<?php echo base_url() ?>"; </script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?=jsSkin('jquery-ui-1.8.7.custom.min.js') ?>" ></script>
	<script type="text/javascript" src="<?=jsSkin('jquery.tablesorter.js')?>"></script>
	<script type="text/javascript" src="<?=jsSkin('functions.js')?>"></script>
	<script type="text/javascript" src="<?=jsSkin('loader.js')?>"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="<?=jsSkin('jquery.site.js')."?".now()?>"></script>
	
	
	<!-- CSS -->
	<link href="<?=base_url()?>comum/css/jquery-ui-1.8.7.custom.css" rel="stylesheet" type="text/css">
	<link type="text/css" rel="stylesheet" href="<?=cssSkin('site.css')."?".now()?>">
	<!--/ CSS -->
	
	<script>
	
	$(document).ready(function() {

		$(".tablesorter").tablesorter({
			debug: true
			})		
		
	});
	
	</script>
	
	
	
</head>
<body id="<?=$idpagina?>">
	<?php $this->load->view($conteudo); ?>
</body>
</html>
