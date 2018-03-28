<?php
    echo $log->error->string;
    if ($this->uri->segment(2) == 'detalhes') {
        $new_uri = 'logs/detalhes/'.$this->uri->segment(3);
        echo form_open($new_uri,'class="form_cadastro" id="form_log"');
    } else {
        echo form_open('logs/cadastrar','class="form_cadastro" id="form_log"');
    }
?>
<dl>
    <dt><label>Cliente:</label></dt>
    <dd><?php echo form_dropdown('log[relation_id]',$clientes,$log->relation_id,"id='cliente' size='335'") ?></dd>
</dl>
<div class="obs">
    <label>Mensagem:</label>
    <?php echo form_textarea('log[msg]',$log->msg,'id="mensagem" size="500"') ?>
</div>
<dl>
<?php
    echo form_submit('salvar','Salvar',"id='btn_confirmar'");
    echo "|";
    echo anchor(site_url()."/logs/listar?per_page=".$this->uri->segment(4),'Cancelar');
    echo form_close();
?>
</dl>