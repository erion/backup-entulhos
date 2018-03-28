<?php
    echo $mat_prima->error->string;
    if ($this->uri->segment(2) == 'detalhes'){
        $new_uri = 'materias_primas/detalhes/'.$this->uri->segment(3)."/".$this->uri->segment(4);
        echo form_open($new_uri,"class='form_cadastro' id='form_matprima'");
    } else {
        echo form_open('materias_primas/cadastrar',"class='form_cadastro' id='form_matprima'");
    }
?>
<dl>
    <dt><label>Mat.Prima:</label></dt>
    <dd><?php echo form_input('mat_prima[nome]',$mat_prima->nome,'id="nome" size="250" placeholder="Mat. Prima"') ?></dd>
</dl>
<dl>
    <dt>
<?php
        echo form_submit('salvar','Salvar',"id='btn_confirmar'");
        echo "|";
        echo anchor(site_url()."/materias_primas/listar?per_page=".$this->uri->segment(4),'Cancelar');
        echo form_close();
?>
    </dt>
</dl>