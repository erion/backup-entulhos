<html>
    <head>
        <title>Pedidos - Eurico Representações</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/extjs.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/css_principal.css" />
		<!--[if IE ]>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ie.css" media="screen" />
		<![endif]-->
        <script type="text/javascript"  src="<?php echo base_url() ?>assets/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-jquery-adapter.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-all.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/pkg-forms.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
        <?php
        if (isset($jsatual)) {
            foreach ($jsatual as $js) {
                echo "<script type='text/javascript' src='".base_url()."assets/js/".$js.".js'></script>";
            }
        }
        ?>
        <script type="text/javascript"><?php echo "function getBaseURL() { return '".base_url()."'}"; ?></script>
        <style type="text/css">
            h1 {border-bottom:1px solid rgb(166,122,0);padding-left:0px;margin-bottom:30px;}
            .cabecalho{height:170px;}
        </style>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <span>&nbsp;</span>
        <div id="todo">
            <div class="cabecalho">
                <img src="<?php echo base_url() ?>assets/img/logo.gif" alt="logo" />
            </div>
            <h1>Sistema de pedidos - Identifique-se</h1>
            <div class="login">