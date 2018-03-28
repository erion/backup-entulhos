<?php $this->load->view('layout/filtros',$this->data); ?>
				<div class="add">
                    <?php echo anchor("entidades/cadastrar/".$titulo,"Adicionar","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th width="15%"><?php echo ordenar_por($this,'Clientes','entidades/listar/'.singular($titulo)) ?></th>
                            <th width="40%"><?php echo ordenar_por($this,'Ramo','entidades/listar/'.singular($titulo)) ?></th>
                            <th width="20%"><?php echo ordenar_por($this,'Vendedor','entidades/listar/'.singular($titulo)) ?></th>
                            <th width="20%"><?php echo ordenar_por($this,'Prog. MI','entidades/listar/'.singular($titulo)) ?></th>
							<th width="20%"><?php echo ordenar_por($this,'Prog. Importação','entidades/listar/'.singular($titulo)) ?></th>
                            <th width="5%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($e as $entidade):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $entidade->nome ?></td>
                            <td><?php echo $entidade->ramo ?></td>
                            <td><?php echo $entidade->vendedor_nome(); ?></td>
                            <td><?php echo $entidade->programador_mi ?></td>
							<td><?php echo $entidade->programador_importacao ?></td>
                            <td><?php
								echo "<table padding='0px'><tr><td>";
                                echo anchor("entidades/detalhes/".$titulo."/".$entidade->id."/".$this->input->get('per_page'),"<img src='".base_url()."assets/img/editar.png' title='editar' />");
								echo "</td><td>";
                                echo anchor_confirm("entidades/excluir/".$titulo."/".$entidade->id."/".$this->uri->segment(4),"Tem certeza de que deseja excluir este ".singular($titulo)."?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />");
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