<?php
    echo $artigo->error->string;
    if ($this->uri->segment(2) == 'detalhes') {
        $new_uri = 'artigos/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,'class="form_cadastro" id="form_artigo"');
    } else {
        echo form_open('artigos/cadastrar','class="form_cadastro" id="form_artigo"');
    }
?>
<dl>
    <dt><label>Artigo:</label></dt>
    <dd><?php echo form_input('artigo[nome]',$artigo->nome,'id="nome" size="250" placeholder="Artigo"') ?></dd>
</dl>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor(site_url()."/artigos/listar?per_page=".$this->uri->segment(4),'Cancelar');
        echo form_close();
?>
    </dt>
</dl>