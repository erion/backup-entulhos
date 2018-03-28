<script type="text/javascript">
    $(document).ready(function() {
        var tipo = Ext.ComponentMgr.get('tipo');
        tipo.addListener('select',function(){
            if(this.value == 'ADM') {
                $('#usuario_opcoes').css('visibility','visible');
                $('#usuario_empresa').css('visibility','hidden');
            } else {
                $('#usuario_empresa').css('visibility','visible');
                $('#usuario_opcoes').css('visibility','hidden');
            }
        });
        tipo.fireEvent('select');

        $('#representante').change(function() {
            var checked = $(this).attr('checked');
            $('#nao_ver_todos').attr('checked',checked);
        })

    });
</script>
<?php
echo $usuario->error->string;
if ($this->uri->segment(2) == 'detalhes') {
    $new_uri = 'usuarios/detalhes/' . $this->uri->segment(3) . "/" . $this->uri->segment(4);
    echo form_open($new_uri, 'class="form_cadastro" id="form_usuario"');
} elseif ($this->uri->segment(2) == 'programacao') {
    echo form_open('usuarios/detalhes/' . $this->session->userdata('id'), 'class="form_cadastro" id="form_usuario"');
} else {
    echo form_open('usuarios/cadastrar', 'class="form_cadastro" id="form_usuario"');
}
?>
<dl>
    <dt><label>Nome:</label></dt>
    <dd><?php echo form_input('usuario[nome]', $usuario->nome, 'id="nome" size="250" placeholder="Nome"') ?></dd>
</dl>
<dl>
    <dt><label>E-mail:</label></dt>
    <dd><?php echo form_input('usuario[email]', $usuario->email, 'id="email"  size="250" placeholder="E-mail"') ?></dd>
</dl>
<?php if ($this->uri->segment(2) == 'detalhes' || $tipo_usuario == 'CPR'): ?>
    <dl>
        <dt><label>Senha:</label></dt>
        <dd><?php echo form_password('usuario[senha]', "", 'id="senha"  size="200" placeholder=""') ?></dd>
    </dl>
    <dl>
        <dt><label>Confirmar Senha:</label></dt>
        <dd><?php echo form_password('usuario[confirma_senha]', "", 'id="confirma_senha"  size="200" placeholder=""') ?></dd>
    </dl>
<?php endif; ?>
    <dl>
        <dt><label>Tipo:</label></dt>
        <dd><?php echo form_dropdown('usuario[tipo]', $user_tipo, $usuario->tipo, 'id="tipo"  size="135" placeholder="Tipo Usuário"') ?></dd>
    </dl>
    <dl>
        <dt><label for="receber_email">Receber email?:</label></dt>
        <dd><?php echo form_checkbox('usuario[receber_email]', '1', ($usuario->receber_email == '1') ? 'checked' : '', 'id="receber_email" rel="nao_valida"') ?>&nbsp;<label for="receber_email">Sim</label></dd>
    </dl>
    <dl>
        <dt><label>Estado:</label></dt>
        <dd>
            <label for="ativo">Ativo</label>
        <?php echo form_radio('usuario[invisivel]', '0', ($usuario->invisivel == '0') ? 'checked' : '', 'id="ativo"') ?>
        <label for="inativo">Inativo</label>
        <?php echo form_radio('usuario[invisivel]', '1', ($usuario->invisivel == '1') ? 'checked' : '', 'id="inativo"') ?>
    </dd>
</dl>
<?php if ($tipo_usuario == 'ADM'): //style="visibility:hidden" ?>
            <div id="usuario_empresa">
                <dl>
                    <dt><label>Empresa:</label></dt>
                    <dd><?php echo form_dropdown('usuario[entidade_id]', $entidades, $usuario->entidade_id, 'id="entidade"  size="135" placeholder="Empresa"') ?></dd>
                </dl>
            </div>
            <div id="usuario_opcoes">
                <dl>
                    <dt><label>Visualização:</label></dt>
                    <dd>
                        <label for="ver_todos">Todos os pedidos</label>
            <?php echo form_radio('usuario[ver_todos_pedidos]', '1', ($usuario->ver_todos_pedidos == '1') ? 'checked' : '', 'id="ver_todos"') ?>
            <label for="nao_ver_todos">Somente os que cadastrei</label>
            <?php echo form_radio('usuario[ver_todos_pedidos]', '0', ($usuario->ver_todos_pedidos == '0') ? 'checked' : '', 'id="nao_ver_todos"') ?>
        </dd>
    </dl>
    <dl>
        <dt><label for="representante">Representante:</label></dt>
        <dd><?php echo form_checkbox('usuario[representante]', '1', ($usuario->representante == '1') ? 'checked' : '', 'id="representante"'); ?>&nbsp;<label for="representante">Sim</label></dd>
    </dl>
</div>
<?php
            else:
                echo form_hidden('usuario[entidade_id]', $empresa);
            endif;
?>
            <dl>
                <dt>
        <?php
            echo form_submit('salvar', 'Salvar', "id='btn_confirmar'");
            echo "|";
            if ($tipo_usuario == 'CPR') {
                echo anchor(site_url() . '/pedidos_programacao/listar?per_page=' . $this->uri->segment(4), 'Cancelar');
            } else {
                echo anchor(site_url() . '/usuarios/listar?per_page=' . $this->uri->segment(4), 'Cancelar');
            }
            echo form_close();
        ?>
    </dt>
</dl>