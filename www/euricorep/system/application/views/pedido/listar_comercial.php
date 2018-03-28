<style type="text/css">
    .listar tr td img {float:right;}
    #editar_oi_curtume{display:none;visibility:hidden;}
    #editar_valor_unitario{display:none;visibility:hidden;}
    #TB_window #editar_oi_curtume{display:block;visibility:visible;}
    #TB_window #editar_valor_unitario{display:block;visibility:visible;}
    #TB_window form{display:inline;}
    .editar a img {visibility:hidden;}
    .editar:hover img{visibility:visible;}
</style>
<script type="text/javascript">
<?php if($this->input->get('imprimir')) : ?>
    $(document).ready(function(){
        window.print();
        window.close();
    });
<?php endif; ?>
    var new_oi;
    $(document).ready(function(){
        $('#edit_oi_curtume, #edit_valor_unitario').submit(function(){
            return false;
        });
    });

    function editar_oi(id) {
        $("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
        $('#TB_load').show();
        $.post(getBaseURL()+'index.php/pedidos_comercial/editar_oi/'+id, {oi_curtume: $('#new_oi_curtume').val()} ,function(data) {
           var oi_curtume = $(new_oi);
           var link = "<a class='thickbox' href='"+getBaseURL()+"index.php/pedidos_comercial/listar#TB_inline?height=40&width=385&inlineId=editar_oi_curtume' onclick='show_thickbox_oi("+id+",$(this).parent(),\""+data+"\" )'><img src='"+getBaseURL()+"assets/img/editar.png' title='editar pedido interno' /></a>";
           oi_curtume.html(data+link);
           oi_curtume.addClass('detalhes');
           $('#TB_load').remove();
           tb_remove();
        });
    }

    function editar_valor(id,moeda) {
        $("body").append("<div id='TB_load'><img src='"+getBaseURL()+"assets/img/loadingAnimation.gif' /></div>");
        $('#TB_load').show();
        $.post(getBaseURL()+'index.php/pedidos_comercial/editar_valor/'+id, {valor_unitario_corrigido: $('#valor_unitario_corrigido').val()} ,function(data) {
           var valor_unitario = $(new_valor);
           var link = "<a class='thickbox' href='"+getBaseURL()+"index.php/pedidos_comercial/listar#TB_inline?height=40&width=315&inlineId=editar_valor_unitario' onclick='show_thickbox_valor("+id+",$(this).parent(),\""+data+"\" )'><img src='"+getBaseURL()+"assets/img/editar.png' title='alterar preço' /></a>";
           valor_unitario.html(moeda+' '+data+link);
           valor_unitario.addClass('detalhes');
           $('#TB_load').remove();
           tb_remove();
        });
    }

    function show_thickbox_oi(id,parent,oi_curtume) {
        $("input[name='pedido_id']").val(id);
        new_oi = parent;
        $('#new_oi_curtume').val($.trim(oi_curtume));
        tb_show('',getBaseURL()+'index.php/pedidos_comercial/listar#TB_inline?height=40&width=385&inlineId=editar_oi_curtume');
        $('#new_oi_curtume').focus();
    }

    function show_thickbox_valor(id,parent,valor_unitario,moeda) {
        $("input[name='pedido_id']").val(id);
        $("input[name='moeda']").val(moeda);
        new_valor = parent;
        $('#valor_unitario_corrigido').val($.trim(valor_unitario.replace('.',',')));
        tb_show('',getBaseURL()+'index.php/pedidos_comercial/listar#TB_inline?height=40&width=315&inlineId=editar_valor_unitario');
        $('#valor_unitario_corrigido').focus();
    }
</script>
<?php $this->load->view('layout/filtros',$this->data); ?>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,"O.I.","pedidos_comercial/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Cliente","pedidos_comercial/listar") ?></th>
                            <th><?php echo ordenar_por($this,"O.C.","pedidos_comercial/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Artigo","pedidos_comercial/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Qtd","pedidos_comercial/listar") ?></th>
                            <th width="75px"><?php echo ordenar_por($this,"Total","pedidos_comercial/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Entrega","pedidos_comercial/listar") ?></th>
                            <th>&nbsp;
                                <?php echo anchor(keep_current_gets('pedidos_comercial/listar?imprimir=1'),"<img src='".base_url()."/assets/img/imprimir_tabela.gif' title='Imprimir' />","target='blank'") ?>
                            </th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        $moeda = $this->config->item('moeda');
                        foreach($p as $pedido):
                            $i++;

                            $tr_classes = array();
                            if(!$this->input->get('imprimir')) {
                                if ($pedido->impresso_curtume == 0)
                                    $tr_classes[] = 'a_imprimir';
                                if($pedido->cancelado == 1) {
                                    $tr_classes[] = 'cancelado';
                                } elseif ($i % 2 == 0)
									$tr_classes[] = 'cor';
                            } else {
								if ($i % 2 == 0)
									$tr_classes[] = 'cor';
								elseif($i % 25 == 0)
									$tr_classes[] = 'break';
							}
                            echo (count($tr_classes)>0) ? "<tr class='".implode(' ',$tr_classes)."'>" : "<tr>";
                    ?>

                            <td<?php echo " id='".$pedido->id."'>".$pedido->id ?></td>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo double_br($pedido->qtd_total) ?>&nbsp;</td>
                            <td><?php echo $moeda[$pedido->moeda]." ".double_br($pedido->total_pedido) ?></td>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <?php if(!$this->input->get('imprimir')): ?>
								<?php if(!$this->input->get('projecao')): ?>
									<td class="detalhes"><?php echo anchor(site_url().'/pedidos_comercial/editar/'.$pedido->id."/0/".$this->input->get('per_page'),"<img src='".base_url()."assets/img/editar.png' title='editar pedido' />") ?></td>
								<?php else: echo "<td>&nbsp;</td>"; endif; ?>
                                <td class="detalhes"><?php echo anchor(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&modal=true&amostrav=".$this->input->get('amostrav')."&projecao=".$this->input->get('projecao'),"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <div id="editar_oi_curtume">
                    <?php
                        echo form_open('',"id='edit_oi_curtume'");
                        echo "<label>Editar pedido interno:</label>";
                        echo form_input('oi_curtume','',"id='new_oi_curtume'");
                        echo form_hidden('pedido_id');
                        echo form_close();
                    ?>
                    <img style='float:right;cursor:pointer;cursor:*hand;' onclick='editar_oi($("input[name=pedido_id]").val())' src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' />
                </div>
                <div id="editar_valor_unitario">
                    <?php
                        echo form_open('',"id='edit_valor_unitario'");
                        echo "<label>Editar:</label>";
                        echo form_input('valor_unitario_corrigido','',"id='valor_unitario_corrigido'");
                        echo form_hidden('pedido_id');
                        echo form_hidden('moeda');
                        echo form_close();
                    ?>
                    <img style='float:right;cursor:pointer;cursor:*hand;' onclick='editar_valor($("input[name=pedido_id]").val(),$("input[name=moeda]").val())' src='<?php echo base_url() ?>assets/img/resumo_finalizar.gif' />
                </div>
                <?php if(!$this->input->get('imprimir')): ?>
                <ul class="paginacao">
                    <?php echo $this->pagination->create_links();?>
                </ul>
                <?php endif; ?>