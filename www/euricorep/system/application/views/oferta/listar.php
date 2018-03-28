                <div id="filtro">
                    <h2><a href="#" onclick="esconder_filtro()" >Filtrar<img src="<?php echo base_url()."assets/img/seta_dir.gif" ?>" name="filtro" alt="" /></a></h2>
                    <div id="form_filtro">
                        <?php
                            echo form_open("ofertas/listar","method='get'");
                        ?>
                        <div class="campos">
                            <dl>
                                <dd><?php echo form_dropdown('cliente',$clientes,$this->input->get('cliente_id'),'id="cliente"'); ?></dd>
                            </dl>
                        </div>
                        <div class="box_datas">
                            <div class="datas">
                                <dl>
                                    <dt><label>Criado em</label></dt>
                                    <dd><?php echo form_input('criado_ini',$this->input->get('entrega_ini'),'id="criado_ini"') ?></dd>
                                    <dt><label>até</label></dt>
                                    <dd><?php echo form_input('criado_fim',$this->input->get('entrega_fim'),'id="criado_fim"') ?></dd>
                                </dl>
                            </div>
                            <div class="aplicar_filtro">
                            <?php
                                if (filtrado($this))
                                    echo anchor("ofertas/listar","Limpar |","style='margin-top:30px !important'");
                                echo form_submit('filtrar','Aplicar',"id='btn_confirmar_filtro' style='margin-top:35px !important' ");;
                            ?>
                            </div>
                        </div>
                        <div class="campos">
                            <dl class="oferta">
                                <dd><label>Contendo o texto</label></dd>
                                <dd><?php echo form_input('texto',$this->input->get('texto'),'id="texto"'); ?></dd>
                            </dl>
                        </div>
                        <?php
                            //echo form_submit('filtrar','Aplicar',"id='btn_confirmar_filtro'");
                            echo form_close();
                        ?>
                    </div>
                </div>
                <div class="add">
                    <?php echo anchor("ofertas/cadastrar","Nova oferta","class='background'") ?>
                </div>
                <table class="listar" cellpadding="0px" cellspacing="0px">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Usuário</th>
                            <th>E-mail</th>
                            <th>Data Criação</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($o as $oferta):
                            $i++;
                    ?>
                        <tr <?php echo ($i % 2) ? "class='cor'" : '' ?>>
                            <td><?php echo $oferta->cliente_nome() ?></td>
                            <td><?php echo $oferta->usuario_nome() ?></td>
                            <td><?php echo $oferta->email ?></td>
                            <td><?php echo data_br($oferta->created_at) ?></td>
                            <td><?php
                                //echo anchor("ofertas/detalhes/".$oferta->id,"<img src='".base_url()."assets/img/editar.png' />");
                                echo anchor_confirm("ofertas/excluir/".$oferta->id,"Tem certeza de que deseja excluir esta oferta?","<img src='".base_url()."assets/img/excluir.png' title='excluir' />")
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