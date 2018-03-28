<style type="text/css">
    #TB_window img.edt_reprogramacao {float:right;}
    .listar tr td img {float:right;}
    #editar_reprogramacao{display:none;}
    #TB_window #editar_reprogramacao{display:inline !important;visibility:visible;}
    #TB_window form#edit_reprogramacao, #TB_window form#edit_reprogramacao input{display:inline !important;float:left;}
    #TB_ajaxContent #edit_reprogramacao {clear:none;}
</style>
<script type="text/javascript">
    var new_reprogramacao;

    function editar(id) {
        $("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
        $('#TB_load').show();
        $.post(getBaseURL()+'index.php/pedidos_programacao/editar/'+id, {data_reprogramacao: $('#reprogramacao').val()} ,function(data) {
           var reprogramacao = $(new_reprogramacao);
           var link = "<a class='thickbox' href='"+getBaseURL()+"index.php/pedidos_programacao/listar#TB_inline?height=55&width=315&inlineId=editar_reprogramacao' onclick='show_thickbox("+id+",$(this).parent(),\""+data+"\" )'><img src='"+getBaseURL()+"assets/img/editar.png' /></a>";
		   if(uri_segment2 != 'visualizar_resumo') {
				reprogramacao.html(data+link);
				reprogramacao.addClass('detalhes');
		   }
           $('#TB_load').remove();
           tb_remove();
        });
    }

    function show_thickbox(id,parent,reprogramacao) {
        $("input[name='pedido_id']").val(id);
        new_reprogramacao = parent;
        $('#reprogramacao').val($.trim(reprogramacao));
        tb_show('',getBaseURL()+'index.php/pedidos_programacao/listar#TB_inline?height=55&width=315&inlineId=editar_reprogramacao');
        $('#reprogramacao').focus();
        if (tb_modal == true) {
            var reprogramacao = new Ext.form.DateField ({
                name: 'data_reprogramacao',
                maxLength:100
            });
            reprogramacao.applyToMarkup('reprogramacao');
        }
    }
</script>
<div id="editar_reprogramacao">
	<?php
		echo form_open('',"id='edit_reprogramacao'");
		echo "<label>Editar data reprogramação:</label>";
		echo form_input('data_reprogramacao','',"id='reprogramacao' size='150px' rel='data'");
		echo form_hidden('pedido_id');
		echo form_close();
	?>
	<img class="edt_reprogramacao" style='cursor:pointer;cursor:*hand;' onclick='editar($("input[name=pedido_id]").val())' src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' />
</div>