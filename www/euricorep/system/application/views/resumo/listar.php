                <h3>Artigos com finalização pendente<img class="resumo" src="<?php echo base_url() ?>/assets/img/relogio.gif" /></h3>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,'O.I.','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'P.I.','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Cliente','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'O.C.','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Artigo','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Cor','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Qtde.','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Valor','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Entrega','pedidos_programacao/listar') ?></th>
							<th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
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
                            <td<?php echo " id='".$pedido->id."'>".$pedido->id ?>&nbsp;</td>
                            <td><?php echo $pedido->oi_curtume ?>&nbsp;</td>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo $pedido->cor ?>&nbsp;</td>
                            <td><?php echo double_br($pedido->quantidade) ?>&nbsp;</td>
							<td><?php echo double_br($pedido->valor_unitario_corrigido) ?></td>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <?php if(!$this->input->get('imprimir')): ?>
                                <td class="detalhes"><?php echo anchor(site_url()."/resumos/resumo_pedido/".$pedido->id."/".$pedido->artigo_id."?height=469&width=620&modal=true&amostrav=2","<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <h3>Diário de visitas<img class="resumo" src="<?php echo base_url() ?>/assets/img/visita.gif" /></h3>
                    <?php
                        $i = 0;
                        foreach($l as $log):
                            $i++;
                    ?>
                        <p class="resumo">
                        <?php echo data_br($log->created_at)." - ".
                              anchor("logs/listar?cliente_id=".$log->relation_id,$log->cliente_nome(),"class='resumo'")." - ".
                              $log->usuario_nome()." - ".$log->msg;
                        ?>
                        </p>
                    <?php
                        endforeach;
                    ?>