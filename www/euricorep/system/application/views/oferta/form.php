<?php
    echo $oferta->error->string;
    if ($this->uri->segment(2) == 'detalhes') {
        $new_uri = 'ofertas/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,'class="form_cadastro"');
    } else {
        echo form_open('ofertas/cadastrar','class="form_cadastro"');
    }
?>
<dl>
    <dt><label>Cliente:</label></dt>
    <dd><?php echo form_dropdown('oferta[cliente]',$clientes,$oferta->cliente_id,'id="cliente"') ?></dd>
</dl>
<dl>
    <dt><label>Mensagem:</label></dt>
    <dd><?php echo form_textarea('oferta[email]',$oferta->email,'id="email"') ?></dd>
</dl>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor(site_url().'/ofertas/listar?per_page='.$this->uri->segment(4),'Cancelar');
        echo form_close();
?>
    </dt>
</dl>