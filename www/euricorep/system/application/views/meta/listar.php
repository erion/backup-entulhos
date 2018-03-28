				<div class="add">
                    <?php echo anchor("metas/cadastrar","Adicionar","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th><?php echo 'Fornecedor' ?></th>
                            <th><?php echo 'Início' ?></th>
                            <th><?php echo 'Fim' ?></th>
							<th><?php echo 'Meta' ?></th>
                            <th><?php echo 'Entradas' ?></th>
							<th><?php echo 'Saídas' ?></th>
                            <!--<th>Excluir</th>-->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($metas as $m):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $m->fornecedor;  ?></td>
                            <td><?php echo data_br($m->data_inicio); ?></td>
                            <td><?php echo data_br($m->data_fim); ?></td>
							<td><?php echo $m->meta ?></td>
                            <td><?php echo (array_key_exists('entradas',$in_out[$m->meta_id])) ? $in_out[$m->meta_id]['entradas'] : '0' ?></td>
							<td><?php echo (array_key_exists('saidas',$in_out[$m->meta_id])) ? $in_out[$m->meta_id]['saidas'] : '0' ?></td>
                            <!--<td><?php //echo anchor_confirm("metas/excluir/".$m->meta_id,"Tem certeza de que deseja excluir essa meta?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />"); ?></td>-->
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
                <ul class="paginacao">
                    <?php echo $this->pagination->create_links();?>
                </ul>