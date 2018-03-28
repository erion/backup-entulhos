                <h3>Pedidos recentes<img class="resumo" src="<?php echo base_url() ?>/assets/img/relogio.gif" /></h3>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,"O.I.","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Cliente","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Fornecedor","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Artigo","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"O.C.","resumos/listar") ?></th>
                            <th width="75px"><?php echo ordenar_por($this,"Total","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Emissão","resumos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Entrega","resumos/listar") ?></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        $moeda = $this->config->item('moeda');
                        foreach($p as $pedido):
                            $i++;

                            if($pedido->cancelado == 1) {
                                echo "<tr class='cancelado'>";
                            } elseif($pedido->fechado == 1) {
                                echo "<tr class='finalizado'>";
                            } elseif($i % 2) {
                                echo "<tr class='cor'>";
                            } else echo "<tr>";
                    ?>
                            <td><?php echo $pedido->id ?></td>
                            <td><?php echo $pedido->cliente ?></td>
                            <td><?php echo $pedido->fornecedor ?></td>
                            <td><?php echo $pedido->artigo ?></td>
                            <td><?php echo $pedido->ordem_servico ?></td>
                            <td><?php echo $moeda[$pedido->moeda]." ".double_br($pedido->total_pedido); ?></td>
                            <td><?php echo data_br($pedido->created_at) ?></td>
                            <td><?php echo data_br($pedido->data_entrega) ?></td>
                            <td><?php
                                echo anchor("pedidos/detalhes/".$pedido->id."/".$this->uri->segment(3),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
                                echo anchor_confirm("pedidos/excluir/".$pedido->id."/".$this->uri->segment(3),"Tem certeza de que deseja cancelar este pedido?","<img src='".base_url()."assets/img/excluir.png' title='Cancelar pedido' />")
                                ?>
                            </td>
                            <td class="detalhes"><?php echo anchor(site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=".$this->input->get('amostrav'),"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>