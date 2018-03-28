                <div class="add">
                    <?php echo anchor("usuarios/cadastrar","Adicionar","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th width="15%"><?php echo ordenar_por($this,'Código','usuarios/listar') ?></th>
                            <th width="25%"><?php echo ordenar_por($this,'Nome','usuarios/listar') ?></th>
                            <th width="30%"><?php echo ordenar_por($this,'E-mail','usuarios/listar') ?></th>
                            <th width="25%"><?php echo ordenar_por($this,'Tipo','usuarios/listar') ?></th>
                            <th width="5%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($u as $usuario):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $usuario->id ?></td>
                            <td><?php echo $usuario->nome ?></td>
                            <td><?php echo $usuario->email ?></td>
                            <td><?php echo $user_tipo[$usuario->tipo] ?></td>
                            <td><?php
								echo "<table padding='0px'><tr><td>";
                                echo anchor("usuarios/detalhes/".$usuario->id."/".$pag = $this->input->get('per_page'),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
								echo "</td><td>";
                                echo anchor_confirm("usuarios/excluir/".$usuario->id."/".$this->uri->segment(3),"Tem certeza de que deseja excluir este usuário?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />");
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