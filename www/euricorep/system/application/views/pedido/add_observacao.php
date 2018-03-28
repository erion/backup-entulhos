<?php
    echo form_open("pedidos/observacao","id='obs'");
?>
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

    $(document).ready(function() {
        $('#TB_window img[title]').qtip({
           style: { border:{color:'#A9A9A9'}, name: 'light',tip:true },
           show: 'mouseover',
           hide: 'mouseout',
           onHide: function(){
                $(this).qtip('destroy');
           }
        });

        var obs = new Ext.form.HtmlEditor({
                name:'observacao',
                fieldLabel: 'Obs.',
                width: 400
            });
        obs.applyToMarkup('observacao');
    });

    function salvar(id,tabela,pedido_id) {
        $("img[name='salvar']").unbind();
        $("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
        $('#TB_load').show();
        $.post(getBaseURL()+'index.php/pedidos/observacao/'+id+'/'+tabela, get_form_fields_object('#obs'),function() {
           $('#TB_load').remove();
		   if (uri_segment2 != 'visualizar_resumo') {
				if(tabela == 'artigos_pedidos')
					tb_show("",getBaseURL()+"index.php/resumos/resumo_pedido/"+pedido_id+"/"+id+"?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=2");
				else
					tb_show("",getBaseURL()+"index.php/resumos/resumo_pedido/"+id+"?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=2");
		   } else
			    tb_remove();
        });
    }
</script>
<style type="text/css">
    #TB_window h1 {
        font:20px Georgia;
        padding:10px 0px 20px 0px;
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

    #TB_window div.obs {
        font:14px Georgia;
        padding-bottom:10px;
        width:85%;
		text-align:left;
    }

	#TB_window div.obs p {text-align:left;}
    #TB_window div.obs p span {font-weight:bold;}

    #TB_window dl.contatos dt {display:inline-block;}
    #TB_window dl.contatos dd {
        display:inline-block;
        padding-left:10px;
    }
</style>
<h1>Adicionar observação</h1>
<ul class="imagens">
    <li class="risco_fechar"><img src='<?php echo base_url() ?>assets/img/resumo_fechar.gif' onclick="tb_remove()" alt='' title="fechar" /></li>
	<?php
		if($tabela == 'pedidos')
			$relation_id = $pedido->id;
		else
			$relation_id = $artigo_pedido_id;
	?>
    <li><img onclick="salvar(<?php echo $relation_id.",'".$tabela."',".$pedido->id ?>)" src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' alt='' title="salvar" /></li>
</ul>
<div class="obs">
    <?php foreach ($log as $l): ?>
    <p><span><?php echo $l->usuario_nome()." - ".strip_tags($l->msg,"<i>") ?></span><?php echo " - ".date('d/m',strtotime($l->created_at)) ?></p>
    <?php endforeach; ?>
</div>
<?php if($this->session->userdata('tipo') == USUARIO_ADMINISTRADOR): ?>

<dl class="contatos">
    <?php
        if(!empty($contatos)) {
            foreach($contatos as $c) {
                echo "<script type=\"text/javascript\">addContato('".$c->nome."','".$c->email."')</script>";
            }
        }
    ?>
</dl>
<?php endif; ?>
<dl>
    <dt><label>Observação</label></dt>
    <dd><?php echo form_input('log[msg]','',"id='observacao'") ?></dd>
    <dd><?php echo form_hidden('log[relation_id]',$relation_id,"id='observacao'") ?></dd>
</dl>
<?php
    echo form_close();
?>
