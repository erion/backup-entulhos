<?php if($this->input->get('imprimir')) : ?>
    <script type='text/javascript'>
        $(document).ready(function(){
            window.print();
            window.close();
        });
    </script>
<?php endif; ?>
<?php $this->load->view('layout/filtros',$this->data); ?>
                <div class="add">
                    <?php echo anchor(keep_current_gets("pedidos/cadastrar?"),$add_button,"class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,"O.I.","pedidos/listar") ?></th>
                            <th class="ie"><?php echo ordenar_por($this,"Cliente","pedidos/listar") ?></th>
                            <th class="ie"><?php echo ordenar_por($this,"Fornecedor","pedidos/listar") ?></th>
                            <th class="ie"><?php echo ordenar_por($this,"Artigo","pedidos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"O.C.","pedidos/listar") ?></th>
                            <th width="75px"><?php echo ordenar_por($this,"Total","pedidos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Emissão","pedidos/listar") ?></th>
                            <th><?php echo ordenar_por($this,"Entrega","pedidos/listar") ?></th>
                            <th>&nbsp;
                                <?php echo anchor(keep_current_gets('pedidos/listar?imprimir=1'),"<img src='".base_url()."/assets/img/imprimir_tabela.gif' title='Imprimir' />","target='blank'") ?>
                            </th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        $moeda = $this->config->item('moeda');
                        foreach($p as $pedido) :
                            $i++;


                            $tr_classes = array();
							$quebra_pagina_chrome_open = "";
							$quebra_pagina_chrome_close = "";
                            if(!$this->input->get('imprimir')) {
                                if ($pedido->impresso_adm == 0)
                                    $tr_classes[] = 'a_imprimir';
                                if($pedido->cancelado == 1) {
                                    $tr_classes[] = 'cancelado';
                                } elseif($pedido->email_enviado_fornecedor == 1) {
                                    $tr_classes[] = 'enviado';
                                } elseif ($i % 2 == 0)
									$tr_classes[] = 'cor';
                            } else {
								if ($i % 2 == 0)
									$tr_classes[] = 'cor';
								elseif($i % 25 == 0) {
									$quebra_pagina_chrome_open = "<div class='break'>";
									$quebra_pagina_chrome_close = "</div>";
								}
							}
							echo $quebra_pagina_chrome_open;
                            echo (count($tr_classes)>0) ? "<tr class='".implode(' ',$tr_classes)."'>" : "<tr>";
                    ?>
                            <td<?php echo " id='".$pedido->id."'>".$pedido->id ?>&nbsp;</td>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->fornecedor ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $moeda[$pedido->moeda]." ".double_br($pedido->total_pedido) ?>&nbsp;</td>
                            <td><?php echo data_br($pedido->created_at) ?>&nbsp;</td>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <?php if(!$this->input->get('imprimir')): ?>
								<td><?php
									if($this->input->get('artigos_pedidos') == 'artigos')
										$url_modal = site_url()."/resumos/resumo_pedido/".$pedido->id."/".$pedido->artigo_id."?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=".$this->input->get('amostrav')."&projecao=".$this->input->get('projecao');
									else
										$url_modal = site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=".$this->input->get('amostrav')."&projecao=".$this->input->get('projecao');
									echo "<table padding='0px'><tr><td>";
                                    echo anchor("pedidos/detalhes/".$pedido->id."/".$this->uri->segment(3)."?".$this->input->server('QUERY_STRING'),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
									echo "</td><td>";
                                    echo anchor_confirm("pedidos/excluir/".$pedido->id."/".$this->uri->segment(3),"Tem certeza de que deseja cancelar este pedido?","<img src='".base_url()."assets/img/excluir.png' title='Cancelar pedido' />");
									echo "</td></tr></table>";
                                    ?>
                                </td>
                                <td class="detalhes"><?php echo anchor($url_modal,"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'") ?></td>
                            <?php endif; ?>
                        </tr>
						<?php echo $quebra_pagina_chrome_close ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if(!$this->input->get('imprimir')): ?>
                <ul class="paginacao">
                    <?php echo $this->pagination->create_links();?>
                </ul>
                <?php endif; ?>