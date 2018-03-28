<?php
    echo $pc->error->string;
    if ($this->uri->segment(2) == 'detalhes') {
        $new_uri = 'perfis_clientes/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,'class="form_cadastro" id="form_diario"');
    } else {
        echo form_open('perfis_clientes/cadastrar','class="form_cadastro" id="form_diario"');
    }
?>
<dl>
    <dt><label>Cliente:</label></dt>
    <dd><?php echo form_dropdown('perfil_cliente[cliente_id]',$clientes,$pc->cliente_id,'id="cliente"') ?></dd>
</dl>
<dl>
    <dt><label>Artigo:</label></dt>
    <dd><?php echo form_dropdown('perfil_cliente[artigo_id]',$artigos,$pc->artigo_id,'id="artigo"') ?></dd>
</dl>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor(site_url()."/perfis_clientes/listar?per_page=".$this->uri->segment(4),'Cancelar');
        echo form_close();
?>
    </dt>
</dl>