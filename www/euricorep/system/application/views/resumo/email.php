<script type="text/javascript">
    
    var contador = 0;

    function addContato(nome,email){
        if (nome != '' && email != '') {
           $('.contatos').append("<div id='contato"+contador+"'><dt><label for='"+email+"'>"+nome+" &#60;"+email+"&#62;</label></dt><dd>"+
               "<input type='checkbox' name='selecao_email[]' value='"+contador+"' id='"+email+"'>&nbsp;"+
               "<a href='#' id='"+email+"' onclick=\"excluir_contato('contato"+contador+"','"+email+"')\"><img src='"+getBaseURL()+"assets/img/resumo_excluir_obs.gif' alt='' title='excluir' /></a></dd><br />"+
               "<input type='hidden' name='contato_nomes[]' value='"+nome+"' />"+
               "<input type='hidden' name='contato_emails[]' value='"+email+"' /></div>");
           $('#nome').val("");
           $('#email').val("");
           contador += 1;
        }
        return false;
    }

    $('.form_contato').submit(function(){
        return false;
    });

    function salvar(id,entidade) {
        $("img[name='salvar']").unbind('click');
		
        $("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
        $('#TB_load').show();
        $.post(getBaseURL()+'index.php/resumos/email/'+id+'/'+entidade, get_form_fields_object('.form_contato'),function() {
           //$('#TB_load').remove();
			var tr_add_classe = '#'+id;
			$(tr_add_classe).parent().removeClass('cor');
			$(tr_add_classe).parent().addClass('enviado');
			if (uri_segment2 != 'visualizar_resumo')
				tb_show("",getBaseURL()+"index.php/resumos/resumo_pedido/"+id+"?height=469&width=620&inlineId=hiddenModalContent&modal=true");
			else
			    tb_remove();
        });
    }

    $(document).ready(function() {
        $('#TB_window img[title]').qtip({
           style: { border:{color:'#A9A9A9'}, name: 'light',tip:true },
           show: 'mouseover',
           hide: 'mouseout',
           onHide: function() {
                $(this).qtip('destroy');
           }
        });

        var conteudo_email = new Ext.form.HtmlEditor({
                name:'contato[conteudo_email]',
				cssRules:'img{visibility:hidden;}a{text-decoration:none !important;}',
				stylesheet:[getBaseURL()+'assets/css/resumo.css'],
                fieldLabel: 'E-mail',
                width: 550,
                height: 250
            });
        conteudo_email.applyToMarkup('conteudo_email');

        var nome = new Ext.form.TextField({
            name: 'contato[nome]',
            fieldLabel: 'Nome',
            emptyText: 'Nome',
            width: 100
        });
        nome.applyToMarkup("nome");

        var email = new Ext.form.TextField({
            name: 'contato[email]',
            fieldLabel: 'E-mail',
            emptyText: 'e-mail',
            width: 200
        });
        email.applyToMarkup("email");

        var assunto = new Ext.form.TextField({
            name: 'contato[assunto]',
            fieldLabel: 'Assunto',
            emptyText: 'Assunto',
            width: 550
        });
        assunto.applyToMarkup("assunto");

    });
</script>
<style type="text/css">
    #TB_window h1 {
        font:20px Georgia;
        padding:10px 0px 20px 0px;
        display:inline-block;
    }

    #TB_window h1 span {
        font-size:14px;
        font-weight:normal;
        display:inline-block;
    }

    #TB_window ul.imagens {
        float:right;
        cursor:pointer;cursor:hand;
    }

    #TB_window ul.imagens li.risco_fechar {
        border-bottom:1px solid;
        padding-bottom:5px;
        margin-bottom:10px;
    }

    #TB_window .add_contato {width:330px;margin-bottom:10px;}
    #TB_window .add_contato input {margin-left:5px;}
    #TB_window .add_contato img {float:right;padding-top:3px;cursor:pointer;cursor:hand;}

    #TB_window ul.dados {
        font:14px Georgia;
        display:inline-block;
        padding-bottom:10px;
        width:85%;
    }

    #TB_window ul.dados li span {font-weight:bold;display:inline-block;}

    #TB_window dl, #TB_window dl.contatos {
        display:block;
        padding-bottom:15px;
    }

    #TB_window dl.contatos dt {display:inline-block;}
    #TB_window dl.contatos dd {
        display:inline-block;
        padding-left:10px;
    }
</style>
<?php
    $codigos = array();
    if(!empty($pedido->ordem_servico))
		$codigos[] = "O.C.".$pedido->ordem_servico;
    if(!empty($pedido->nota_fiscal))
		$codigos[] = "NF.".$pedido->nota_fiscal;
?>
<h1>O.I.<?php echo $pedido->id ?><span><?php echo (!empty($codigos) ? ' - '.implode(' | ', $codigos) : '') ?>&nbsp;</span></h1>
<ul class="imagens">
    <li class="risco_fechar"><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' title="fechar" /></li>
    <li><img onclick="salvar(<?php echo $pedido->id.",'".$tipo_entidade."'" ?>)" src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' alt='' title="salvar contatos e enviar e-mail" /></li>
</ul>
<ul class="dados">
    <li>Enviar para o <?php echo $tipo_entidade ?></li>
    <li><span><?php echo $entidade ?></span></li>
</ul>
<h1>Contatos</h1>
<?php
    echo form_open('',"class='form_contato'");
?>
<div class="add_contato">
<?php 
    echo form_input('contato[nome]','',"id='nome'");
    echo form_input('contato[email]','',"id='email'");
?>
    <img onclick="addContato($('#nome').val(),$('#email').val())" src="<?php echo base_url() ?>assets/img/add_modal.gif" alt="" />
</div>
<dl class="contatos">
    <?php
        if(!empty($contatos)) {
            foreach($contatos as $c) {
                echo "<script type=\"text/javascript\">addContato('".$c->nome."','".$c->email."')</script>";
            }
        } 
    ?>
</dl>
<?php
    echo "<p>".form_input('contato[assunto]','',"id='assunto'")."</p>";

    $mensagem_padrao = "";
    if ($tipo_entidade == 'fornecedor') {
        /* EMAIL antigo
        $mensagem_padrao .= "<b>Cliente: </b>".$dados_cliente->nome."<br />";
        if (!empty($dados_cliente->endereco))
            $mensagem_padrao .= "<b>Endereço: </b>".$dados_cliente->endereco."<br />";
        if (!empty($dados_cliente->bairro))
            $mensagem_padrao .= "<b>Bairro: </b>".$dados_cliente->bairro."<br />";
        if (!empty($dados_cliente->cidade))
            $mensagem_padrao .= "<b>Cidade: </b>".$dados_cliente->cidade." ";
        if (!empty($dados_cliente->cep))
            $mensagem_padrao .= "<b>CEP: </b>".$dados_cliente->cep." ";
        if (!empty($dados_cliente->uf))
            $mensagem_padrao .= "<b>UF: </b>".$dados_cliente->uf." ";
        if (!empty($dados_cliente->pais))
            $mensagem_padrao .= "<b>País: </b>".$dados_cliente->pais."<br />";
        if (!empty($dados_cliente->cnpj))
            $mensagem_padrao .= "<b>CNPJ: </b>".$dados_cliente->cnpj."<br />";
        if (!empty($dados_cliente->insc_estadual))
            $mensagem_padrao .= "<b>Insc. estadual: </b>".$dados_cliente->insc_estadual."<br />";
        if (!empty($dados_cliente->insc_municipal))
            $mensagem_padrao .= "<b>Insc. municipal: </b>".$dados_cliente->insc_municipal."<br />";
        if (!empty($dados_cliente->fone))
            $mensagem_padrao .= "<b>Fone: </b>".$dados_cliente->fone."<br />";
        if (!empty($dados_cliente->fax))
            $mensagem_padrao .= "<b>Fax: </b>".$dados_cliente->fax."<br />";
        */
        $mensagem_padrao = $conteudo;
        $mensagem_padrao .= "<br /><br />";
        //$mensagem_padrao .= "<p><a href='".site_url()."/usuarios/login/0/".$pedido->visualizar."'>Visualize pelo sistema</a></p>";
    } else {
        $moeda = $this->config->item('moeda');
        $mensagem_padrao .= "<b>Artigo: </b>".$artigo." - ".$mat_prima."<br />";
        if (!empty($pedido->classificacao))
            $mensagem_padrao .= "<b>Classificação: </b>".$pedido->classificacao."<br />";
        if (!empty($pedido->valor_unitario_corrigido))
            $mensagem_padrao .= "<b>Valor unitário: </b>".$moeda[$pedido->moeda].double_br($pedido->valor_unitario_corrigido)."<br />";
        if (!empty($pedido->tamanho_peca))
            $mensagem_padrao .= "<b>Tamanho da peça: </b>".$pedido->tamanho_peca."<br />";
        if (!empty($pedido->espessura))
            $mensagem_padrao .= "<b>Espessura: </b>".$pedido->espessura."<br />";
        $mensagem_padrao .= "<br /><b>Cor / Quantidade </b><br />";
        foreach ($cor_quantidade as $cq) {
            $mensagem_padrao .= $cq->cor." / ".double_br($cq->quantidade).' '.$pedido->unidade_medida."<br />";
        }
    }
    echo form_textarea('contato[conteudo_email]',$mensagem_padrao,"id='conteudo_email'");
    echo form_close();
?>