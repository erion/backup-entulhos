                <div class="add">
                    <?php echo anchor("perfis_clientes/cadastrar","Adicionar","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Artigo</th>
                            <th>Cadastrado em</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($pc as $perfil_cliente):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $perfil_cliente->cliente_nome() ?></td>
                            <td><?php echo $perfil_cliente->artigo_nome() ?></td>
                            <td><?php echo $perfil_cliente->created_at ?></td>
                            <td><?php
                                echo anchor("perfis_clientes/detalhes/".$perfil_cliente->id."/".$this->uri->segment(3),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
                                echo anchor_confirm("perfis_clientes/excluir/".$perfil_cliente->id."/".$this->uri->segment(3),"Tem certeza de que deseja excluir este perfil/interesse?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />") ?>
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
