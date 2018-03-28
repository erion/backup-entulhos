<?php $this->load->view('layout/filtros',$this->data); ?>
                <div class="add">
                    <?php echo anchor("logs/cadastrar","Nova visita","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Cliente</th>
                            <th>Mensagem</th>
                            <th>Criado em</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($l as $log):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $log->usuario_nome() ?></td>
                            <td><?php echo $log->cliente_nome() ?></td>
                            <td><?php echo $log->msg ?></td>
                            <td><?php echo data_br($log->created_at) ?></td>
                            <td>
                                <?php
                                //echo anchor("logs/detalhes/".$log->id,"<img src='".base_url()."assets/img/editar.png' />");
                                echo anchor_confirm("logs/excluir/".$log->id."/".$this->uri->segment(3),"Tem certeza de que deseja excluir este diário de visita?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />");
                                ?>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <ul class="paginacao">
                    <?php echo $this->pagination->create_links();?>
                </ul>