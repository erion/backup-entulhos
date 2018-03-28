<style type="text/css">
    #TB_window ul.imagens {float:right;}
    #TB_window ul.imagens li {
        margin-top:8px;
        cursor:pointer;cursor:hand;
    }

    .form_cadastro dl {
        display:block;
        margin:5px 0px 0px 15px;
    }

    .form_cadastro dl {*width:auto;}
    .form_cadastro dt {position:absolute;}

    .form_cadastro dd {
        margin: 0px 0px 0px 140px;
    }

    .form_cadastro a {
        color:rgb(166,122,0);
        margin-left:5px;
    }
</style>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/entidade_cadastrar.js"></script>
<ul class="imagens">
    <li><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' /></li>
    <li><img src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' onclick="salvar_entidade(<?php echo $entidade_id ?>)" alt='' /></li>
</ul>
<h1>Novo <?php echo strtolower($tipo) ?></h1>