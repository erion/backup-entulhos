<style type="text/css">
    .listar tr td img {float:right;}
</style>
<?php /*
                <h3>Ofertas recentes<img class="resumo" src="<?php echo base_url() ?>/assets/img/relogio.gif" /></h3>
                    <?php
                        $i = 0;
                        foreach($o as $oferta):
                            $i++;
                    ?>
                    <ul class="resumo">
                        <li><?php echo date('d/m/Y',strtotime($oferta->created_at)) ?></li>
                        <li><?php echo $oferta->cliente_nome() ?></li>
                        <li><?php echo $oferta->id ?></li>
                        <li><?php echo $oferta->fornecedor_nome() ?></li>
                        <li><?php echo $oferta->artigo_nome() ?></li>
                        <li><?php echo $oferta->ordem_servico ?></li>
                        <li><?php echo $oferta->valor_unitario ?></li>
                        <li><?php echo date('d/m/Y',strtotime($oferta->data_entrega)) ?></li>
                    </ul>
                    <?php
                        endforeach;
                    ?>
 *
 */?>
                <?php if(count($p) > 0): ?>
                <h3>Pedidos pendentes<img class="resumo" src="<?php echo base_url() ?>/assets/img/visita.gif" /></h3>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,"O.I.","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Cliente","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"O.C.","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Artigo","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Qtd","resumos/listar") ?></th>
                            <th width="75px"><?php echo ordenar_por($this,"Total","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Entrega","resumos/listar") ?></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $moeda = $this->config->item('moeda');
                        $i = 0;
                        foreach($p as $pedido):
                            $i++;
                            if($pedido->cancelado == 1) {
                                echo "<tr class='cancelado'>";
                            } elseif($i % 2) {
                                echo "<tr class='cor'>";
                            } else echo "<tr>";
                    ?>

                            <td><?php echo $pedido->id ?></td>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo $pedido->qtd_total ?>&nbsp;</td>
                            <td><?php echo $moeda[$pedido->moeda]." ".double_br($pedido->total_pedido); ?></td>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <td class="detalhes"><?php echo anchor(site_url()."/pedidos_comercial/editar/".$pedido->id,"<img src='".base_url()."assets/img/editar.png' title='editar' />") ?></td>
                            <td class="detalhes"><?php echo anchor(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&modal=true&amostrav=".$this->input->get('amostrav'),"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <?php endif; ?>
<?php
/*
                    <h3>Diário de visitas<img class="resumo" src="<?php echo base_url() ?>/assets/img/visita.gif" /></h3>
                        $i = 0;
                        foreach($l as $log):
                            $i++;
                    ?>
                        <p class="resumo">
                        <?php echo data_br($log->created_at)." - ".
                              anchor("logs/listar?cliente_id=".$log->relation_id,$log->cliente_nome(),"class='resumo'")." - ".
 /                             $log->usuario_nome()." - ".$log->msg;
                        ?>
                        </p>
                    <?php
                        endforeach;*/
                    ?>
            <?php if(count($p_recente) > 0): ?>
            <h3>Pedidos recentes<img class="resumo" src="<?php echo base_url() ?>/assets/img/relogio.gif" /></h3>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,"O.I.","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Cliente","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"O.C.","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Artigo","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Qtd","resumos/listar") ?></th>
                            <th width="75px"><?php echo ordenar_por($this,"Total","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Entrega","resumos/listar") ?></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $moeda = $this->config->item('moeda');
                        $i = 0;
                        foreach($p_recente as $pedido):
                            $i++;
                            if($pedido->cancelado == 1) {
                                echo "<tr class='cancelado'>";
                            } elseif($i % 2) {
                                echo "<tr class='cor'>";
                            } else echo "<tr>";
                    ?>

                            <td><?php echo $pedido->id ?></td>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo double_br($pedido->qtd_total) ?>&nbsp;</td>
                            <td><?php echo $moeda[$pedido->moeda]." ".double_br($pedido->total_pedido); ?></td>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <td class="detalhes"><?php echo anchor(site_url()."/pedidos_comercial/editar/".$pedido->id,"<img src='".base_url()."assets/img/editar.png' title='editar' />") ?></td>
                            <td class="detalhes"><?php echo anchor(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&modal=true&amostrav=".$this->input->get('amostrav'),"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
            <?php endif; ?>