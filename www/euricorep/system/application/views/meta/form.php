<?php
    echo $meta->error->string;
    if ($this->uri->segment(2) == 'detalhes'){
        $new_uri = 'metas/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,"class='form_cadastro'");
    } else {
        echo form_open('metas/cadastrar',"class='form_cadastro'");
    }
?>
<dl>
    <dt><label>Fornecedor:</label></dt>
    <dd><?php echo form_dropdown('metas[fornecedor_id]',$fornecedores,$meta->fornecedor_id,'id="fornecedor_id"') ?></dd>
</dl>
<dl>
    <dt><label>Meta (em metros):</label></dt>
    <dd><?php echo form_input('metas[meta]',$meta->meta,'id="meta"') ?></dd>
</dl>
<dl>
    <dt><label>Data de inicio:</label></dt>
    <dd><?php echo form_input('metas[data_inicio]',data_br($data_inicio),'id="data_inicio"') ?></dd>
</dl>
<dl>
    <dt><label>Data de fim:</label></dt>
    <dd><?php echo form_input('metas[data_fim]',data_br($data_fim),'id="data_fim"') ?></dd>
</dl>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor($this->input->server('HTTP_REFERER'),'Cancelar');
        echo form_close();
?>
    </dt>
</dl>