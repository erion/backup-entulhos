                <div class="add">
                    <?php echo anchor("artigos/cadastrar","Adicionar","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th width="15%"><?php echo ordenar_por($this,'Código','artigos/listar') ?></th>
                            <th width="80%"><?php echo ordenar_por($this,'Artigo','artigos/listar') ?></th>
                            <th width="5%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($a as $artigo):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $artigo->id ?></td>
                            <td><?php echo $artigo->nome ?></td>
                            <td><?php
								echo "<table padding='0px'><tr><td>";
                                echo anchor("artigos/detalhes/".$artigo->id."/".$this->input->get('per_page'),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
								echo "</td><td>";
                                echo anchor_confirm("artigos/excluir/".$artigo->id."/".$this->uri->segment(3),"Tem certeza de que deseja excluir este artigo?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />");
								echo "</td></tr></table>";
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