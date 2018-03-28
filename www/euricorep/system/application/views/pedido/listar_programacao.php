<script type="text/javascript">
<?php if($this->input->get('imprimir')) : ?>
    $(document).ready(function(){
        window.print();
        window.close();
    });
<?php endif; ?>
</script>
<?php
	$this->load->view('layout/filtros',$this->data);
	$this->load->view('pedido/editar_programacao',$this->data);
	if($this->session->userdata('tipo') == USUARIO_ADMINISTRADOR || $this->session->userdata('tipo') == USUARIO_SUPER_ADMINISTRADOR):
?>
                <div class="add">
                    <?php echo anchor(keep_current_gets("pedidos/cadastrar?"),$add_button,"class='background'") ?>
                </div>
<?php endif; ?>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo ordenar_por($this,'O.I.','pedidos_programacao/listar') ?></th>
                            <?php if($tipo_usuario != USUARIO_ADMINISTRADOR && $this->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR): ?>
                                <th><?php echo ordenar_por($this,'P.I.','pedidos_programacao/listar') ?></th>
                            <?php endif; ?>
                            <th><?php echo ordenar_por($this,'Cliente','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'O.C.','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Artigo','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Cor','pedidos_programacao/listar') ?></th>
                            <th><?php echo ordenar_por($this,'Qtde.','pedidos_programacao/listar') ?></th>
                            <?php if($tipo_usuario != USUARIO_CURTUME_PROGRAMACAO): ?>
                                <th><?php echo ordenar_por($this,'Valor','pedidos_programacao/listar') ?></th>
                            <?php endif; ?>
                            <th><?php echo ordenar_por($this,'Entrega','pedidos_programacao/listar') ?></th>
                            <?php if($tipo_usuario != USUARIO_ADMINISTRADOR  && $this->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR): ?>
                                <th width="100px"><?php echo ordenar_por($this,'Reprog.','pedidos_programacao/listar') ?></th>
                            <?php else: ?>
                                <th width="75px"><?php echo ordenar_por($this,'Reprog.','pedidos_programacao/listar') ?></th>
                            <?php endif; ?>
                            <?php if($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO): ?>
                                <th>&nbsp;</th>
                            <?php endif; ?>
                            <th>&nbsp;
                                <?php echo anchor(keep_current_gets('pedidos_programacao/listar?imprimir=1'),"<img src='".base_url()."/assets/img/imprimir_tabela.gif' title='Imprimir' />","target='blank'") ?>
                            </th>
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
                            <?php if($tipo_usuario != USUARIO_ADMINISTRADOR  && $this->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR): ?>
                                <td><?php echo $pedido->oi_curtume ?>&nbsp;</td>
                            <?php endif; ?>
                            <td><?php echo $pedido->cliente ?>&nbsp;</td>
                            <td><?php echo $pedido->ordem_servico ?>&nbsp;</td>
                            <td><?php echo $pedido->artigo ?>&nbsp;</td>
                            <td><?php echo $pedido->cor ?>&nbsp;</td>
                            <td><?php echo double_br($pedido->quantidade) ?>&nbsp;</td>
                            <?php if($tipo_usuario != USUARIO_CURTUME_PROGRAMACAO): ?>
                                <td><?php echo double_br($pedido->valor_unitario_corrigido) ?></td>
                            <?php endif; ?>
                            <td><?php echo data_br($pedido->data_entrega) ?>&nbsp;</td>
                            <?php
                                if(($tipo_usuario != USUARIO_ADMINISTRADOR  && $this->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR) && $abertos == true) {
                                    if ($pedido->data_reprogramacao == 0) {
                                        echo "<td>".anchor('#TB_inline?height=55&width=315&inlineId=editar_reprogramacao',"<img src='".base_url()."assets/img/editar.png' title='reprogramar' />","class='thickbox' onclick=\"show_thickbox(".$pedido->cod.",$(this).parent(),'".$pedido->data_reprogramacao."')\"")."</td>";
                                    } else {
                                        echo "<td class='detalhes'>".data_br($pedido->data_reprogramacao).anchor('#TB_inline?height=55&width=315&inlineId=editar_oi_curtume',"<img src='".base_url()."assets/img/editar.png' title='reprogramar' />","class='thickbox' onclick=\"show_thickbox(".$pedido->cod.",$(this).parent(),'".$pedido->data_reprogramacao."')\"")."</td>";
                                    }
                                } else {
                                    echo "<td>".data_br($pedido->data_reprogramacao)."</td>";
                                }
                            ?>
                            <?php if(!$this->input->get('imprimir')):
                                        if($this->input->get('artigos_pedidos') == 'artigos' || $tipo_usuario == USUARIO_CURTUME_PROGRAMACAO)
                                            $url_modal = site_url()."/resumos/resumo_pedido/".$pedido->id."/".$pedido->artigo_id."?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=".$this->input->get('amostrav');
                                        else
                                            $url_modal = site_url()."/resumos/resumo_pedido/".$pedido->id."?height=469&width=620&inlineId=hiddenModalContent&modal=true&amostrav=".$this->input->get('amostrav');
                             ?>
                                <?php if($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO): ?>
                                    <td><?php echo anchor_confirm('pedidos_programacao/finalizar_programacao/'.$pedido->cod,"Tem certeza de que deseja finalizar este artigo?","<img src='".base_url()."assets/img/excluir.png'","title='finalizar programação'"); ?></td>
                                <?php endif; ?>
                                <td class="detalhes"><?php echo anchor($url_modal,"<img src='".base_url()."assets/img/detalhes_pedido.png' title='ver detalhes' />", "class='thickbox'"); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <?php if(!$this->input->get('imprimir')): ?>
                <ul class="paginacao">
                    <?php echo $this->pagination->create_links();?>
                </ul>
                <?php endif; ?>