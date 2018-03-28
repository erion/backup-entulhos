<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<?php
    $singular = array(
        'Pedidos' => 'pedido',
        'Diário de visitas' => 'nova visita',
        'Interesses de clientes' => 'interesse de cliente',
        'Clientes' => 'cliente',
        'Fornecedores' => 'fornecedor',
        'Usuários' => 'usuário',
        'Artigos' => 'artigo',
        'Matérias primas' => 'matéria prima',
	'Projeções' => 'projeção',
	'Metas' => 'meta'
    );
    $listar_pedidos = $this->config->item('listar_pedidos');
//	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
?>
<html>
    <head>
        <title>Pedidos - Eurico Representações</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/extjs.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css" media="screen" />
        <?php if(isset($custom_css)): ?>
            <?php foreach($custom_css as $filename => $media) : ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/<?php echo $filename ?>.css" media="<?php echo $media ?>" />
            <?php endforeach; ?>
        <?php else: ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/css_principal.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/impressao.css" media="print" />
        <?php endif; ?>
		<!--[if IE ]>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ie.css" media="screen" />
		<![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/thickbox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajaxfileupload.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/superboxselect.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-cookie.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.qtip-1.0.0-rc3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-jquery-adapter.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-all.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/pkg-forms.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-upload.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/monthpicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/extjs/ext-lang-pt_BR.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/thickbox.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/SuperBoxSelect.js"></script>
		<link rel="shortcut icon"  href="<?php echo base_url() ?>assets/img/favicon.gif" type="image/x-icon" sizes="48x48" />
        <?php
        if (isset($jsatual)) {
            foreach ($jsatual as $js) {
                echo "<script type='text/javascript' src='".base_url()."assets/js/".$js.".js'></script>";
            }
        }
        ?>
        <script type="text/javascript">
            var uri_segment1 = '<?php echo $this->uri->segment(1);?>';
            var uri_segment2 = '<?php echo $this->uri->segment(2);?>';
            var uri_segment3 = '<?php echo $this->uri->segment(3);?>';
            var uri_segment4 = '<?php echo $this->uri->segment(4);?>';

            $(document).ready(function(){
                $("#buscar").focus(function(){
                    $(this).val("");
                });
            });
        <?php echo "function getBaseURL() { return '".base_url()."'}"; ?>
        </script>
        <style type="text/css">
            /*override Extjs*/
            .x-field-empty-text {
                color: gray !important;
                padding: 3px 4px 0 !important;
                position: absolute !important;
                visibility: hidden !important;
                overflow: hidden !important;
                -moz-user-select: none !important;
                -khtml-user-select: none !important;
            }
        </style>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div id="todo">
            <div class="cabecalho">
                <div class="usuario">
                    <?php if(($tipo_usuario != 'ADM' || $tipo_usuario != 'SAD') && $this->session->userdata('logo')): ?>
                    <span><img src="<?php echo base_url().$this->session->userdata('logo') ?>" alt="logo" /></span>
                    <span>Logado como: <strong><?php echo ucfirst($usuario_logado) ?></strong></span>
                    <a href="<?php echo site_url() ?>/usuarios/login/1">Sair do Sistema</a>
                    <?php else: ?>
                    <span class="adm">Logado como: <strong><?php echo ucfirst($usuario_logado) ?></strong></span>
                    <a href="<?php echo site_url() ?>/usuarios/login/1">Sair do Sistema</a>
                    <?php endif; ?>
                </div>
                <img src="<?php echo base_url() ?>assets/img/logo.gif" alt="logo" />
            </div>
            <div id="esconder_menu">
                <div class="menu">
                    <div class="busca">
                        <form name="busca" action="<?php echo site_url() ?>/pedidos/listar" method="get" id="busca">
                            <?php if($this->input->get('buscar')): ?>
                                <input name="buscar" type="text" value="<?php echo $this->input->get('buscar') ?>" id="buscar" />
                            <?php else: ?>
                                <input name="buscar" type="text" value="Busca rápida" id="buscar" />
                            <?php endif; ?>
                        </form>
                        <a href="#"><img src="<?php echo base_url() ?>assets/img/lupa.gif" alt="busca" onclick="$('#busca').submit()"/></a>
                    </div>
                    <ul>
                    <?php if ($tipo_usuario != 'CPR'): ?>
                        <li><a <?php echo $resumo_menu; ?> href="<?php echo site_url() ?>/resumos/listar">Resumo</a></li>
                    <?php endif; ?>
                    <?php if ($tipo_usuario == 'CCM'): ?>
                        <li><a <?php echo $cadastro_menu; ?> href="<?php echo site_url() ?>/usuarios/listar">Usuários</a></li>
                    <?php elseif($tipo_usuario == 'CPR'): ?>
                        <li><a <?php echo $cadastro_menu; ?> href="<?php echo site_url() ?>/usuarios/programacao">Meus dados</a></li>
						<li><a <?php echo $finalizado_prog_menu; ?> href="<?php echo site_url()."/".$listar_pedidos[$tipo_usuario] ?>/listar/0<?php echo LISTAGEM_PADRAO.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL() ?>">Prog. Encerrada</a></li>
                    <?php endif; ?>
                        <li><a <?php echo $pedidos_menu; ?> href="<?php echo site_url()."/".$listar_pedidos[$tipo_usuario] ?>/listar<?php echo LISTAGEM_PADRAO.$this->configfilter->get_artigo_in_URL().$this->configfilter->get_artigo_not_in_URL() ?>">Pedidos</a></li>
					<?php if ($tipo_usuario != 'CPR' || $tipo_usuario == 'ADM' || $tipo_usuario == 'SAD'): ?>
						<li><a <?php echo $projecao_menu; ?> href="<?php echo site_url()."/".$listar_pedidos[$tipo_usuario] ?>/listar<?php echo LISTAGEM_PADRAO."&projecao=1" ?>">Projeções</a></li>
                    <?php
					endif;
                    if ($tipo_usuario == 'ADM' || $tipo_usuario == 'SAD'): ?>
<?php //                        <li><a  echo $oferta_menu;  href=" echo site_url() /ofertas/listar"><span>Ofertas</span></a></li>   ?>
<?php //                        <li><a  echo $interesse_menu;  href=" echo site_url() /perfis_clientes/listar"><span>Interesses</span></a></li> ?>
                        <li><a <?php echo $diario_menu; ?> href="<?php echo site_url() ?>/logs/listar">Diário de Visitas</a></li>
                        <li><a <?php echo $cadastro_menu; ?> href="<?php echo site_url() ?>/cadastros/listar">Cadastros</a></li>
			<li><a <?php echo $meta_menu; ?> href="<?php echo site_url() ?>/metas/listar">Metas</a></li>
			<li><a <?php echo $clientes_menu; ?> href="<?php echo site_url() ?>/entidades/listar/cliente/1">Clientes</a></li>
                    <?php endif;
                    if ($tipo_usuario == 'SAD'): ?>
                        <li><a <?php echo $pedido_cliente_menu; ?> href="<?php echo site_url() ?>/entidades/pedidos">Pedidos X Clientes</a></li>
                        <li><a <?php echo $financeiro_menu; ?> href="<?php echo site_url() ?>/pedidos/financeiro/listar/">Financeiro</a></li>
                    <?php endif; ?>
                    </ul>
                </div>
                <div class="ultimos_pedidos">
        	    <?php if(!empty($ultimos_pedidos)): ?>
                    <ul>
                        <li class="title"><span>Listar pedidos por cliente:</span></li>
                    <?php     foreach($ultimos_pedidos as $c) {
                                echo "<li".(($this->input->get('cliente_id') == $c->id) ? ' class="selecionado"' : '').">".anchor($listar_pedidos[$tipo_usuario]."/listar".LISTAGEM_PADRAO."&cliente_id=".$c->id,$c->nome)."</li>";
                              }
					?>
					</ul>
		         <?php endif; ?>
                </div>
            </div>
            <a id="contrair" href="#" onclick="esconder_menu()">&nbsp;</a>
            <div id="conteudo"<?php echo (isset($printable)) ? ' class="printable"' : '' ?> >
                <?php
                if($this->uri->segment(2) == 'cadastrar') {
                    echo "<h1>Adicionar ".$singular[$titulo]."</h1>";
                } elseif($this->uri->segment(2) == 'detalhes') {
                    echo "<h1>Editar ".$singular[$titulo]."</h1>";
				} elseif (!empty($titulo))
                    echo "<h1>".$titulo."</h1>";
                ?>