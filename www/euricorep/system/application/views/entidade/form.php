<?php
    echo $entidade->error->string;
    if ($this->uri->segment(2) == 'detalhes') {
        $new_uri = 'entidades/detalhes/'.$titulo.'/'.$this->uri->segment(4)."/".$this->uri->segment(5);
        echo form_open($new_uri,"class='form_entidade' id='form_entidade'");
    } else {
        echo form_open('entidades/cadastrar/'.$titulo,"class='form_entidade' id='form_entidade'");
    }
?>
<dl>
    <dt><label>Nome:</label></dt>
    <dd><?php echo form_input('entidade[nome]',$entidade->nome,"id='nome' size='200' placeholder='Nome' class='valida'") ?></dd>
</dl>
<dl>
    <dt><label>Razão Social:</label></dt>
    <dd><?php echo form_input('entidade[razao_social]',$entidade->razao_social,"id='razao_social' size='200' placeholder='Razão Social'") ?></dd>
</dl>
<dl>
    <dt><label>Endereço</label></dt>
    <dd><?php echo form_input('entidade[endereco]',$entidade->endereco,"id='endereco' size='300' placeholder='Endereço'") ?></dd>
</dl>
<dl>
    <dt><label>Bairro</label></dt>
    <dd><?php echo form_input('entidade[bairro]',$entidade->bairro,"id='bairro' size='200' placeholder='Bairro'") ?></dd>
</dl>
<dl>
    <dt><label>Cidade:</label></dt>
    <dd><?php echo form_input('entidade[cidade]',$entidade->cidade,"id='cidade' size='200' placeholder='Cidade'") ?></dd>
</dl>
<dl>
    <dt><label>UF:</label></dt>
    <dd><?php echo form_input('entidade[uf]',$entidade->uf,"id='uf' size='50' placeholder='UF'") ?></dd>
</dl>
<dl>
    <dt><label>País:</label></dt>
    <dd><?php echo form_input('entidade[pais]',$entidade->pais,"id='pais' size='150' placeholder='País'") ?></dd>
</dl>
<dl>
    <dt><label>CEP:</label></dt>
    <dd><?php echo form_input('entidade[cep]',$entidade->cep,"id='cep' size='100' placeholder='CEP'") ?></dd>
</dl>
<dl>
    <dt><label>CNPJ:</label></dt>
    <dd><?php echo form_input('entidade[cnpj]',$entidade->cnpj,"id='cnpj' size='100' placeholder='CNPJ'") ?></dd>
</dl>
<dl>
    <dt><label>Insc.Estadual:</label></dt>
    <dd><?php echo form_input('entidade[insc_estadual]',$entidade->insc_estadual,"id='insc_estadual' size='150' placeholder='Inscrição Estadual'") ?></dd>
</dl>
<dl>
    <dt><label>Insc.Municipal:</label></dt>
    <dd><?php echo form_input('entidade[insc_municipal]',$entidade->insc_municipal,"id='insc_municipal' size='150' placeholder='Inscrição Municipal'") ?></dd>
</dl>
<dl>
    <dt><label>Fone:</label></dt>
    <dd><?php echo form_input('entidade[fone]',$entidade->fone,"id='fone' size='150' placeholder='Telefone'") ?></dd>
</dl>
<dl>
    <dt><label>Fax:</label></dt>
    <dd><?php echo form_input('entidade[fax]',$entidade->fax,"id='fax' size='150' placeholder='Fax'") ?></dd>
</dl>
<?php if(strtoupper($titulo) == strtoupper('clientes')): ?>
	<dl>
		<dt>Ramo:</dt>
		<dd><?php echo form_input('entidade[ramo]',$entidade->ramo,"id='ramo' size='100' placeholder='Ramo'") ?></dd>
	</dl>
	<dl>
		<dt>Vendedor:</dt>
		<dd><?php echo form_dropdown('entidade[vendedor_id]',$vendedores,$entidade->vendedor_id,"id='vendedor_id' size='150' placeholder='Vendedor'") ?></dd>
	</dl>
	<dl>
		<dt>Programador MI:</dt>
		<dd><?php echo form_input('entidade[programador_mi]',$entidade->programador_mi,"id='programador_mi' size='200' placeholder='Programador MI'") ?></dd>
	</dl>
	<dl>
		<dt>Prog. de importação:</dt>
		<dd><?php echo form_input('entidade[programador_importacao]',$entidade->programador_importacao,"id='programador_importacao' size='200' placeholder='Programador de importação'") ?></dd>
	</dl>
<?php endif; ?>
<dl>
    <dt><?php echo form_hidden('entidade[tipo]',strtoupper($titulo)) ?></dt>
</dl>
<dl>
    <dt><label>Logo:</label></dt>
    <dd><?php echo form_input('foto','',"id='foto' size='200' placeholder='Logo-tipo' rel='file'") ?></dd>
</dl>
<h3>Padrão de análise crítica</h3>
<dl>
	<dt>Req. reg. estatutários:</dt>
	<dd><?php echo "Sim ".form_radio('entidade[rr_estatutarios]',"1",($entidade->rr_estatutarios == '1'?"checked":""),"id='sim' rel='nao_valida'")." Não ".form_radio('entidade[rr_estatutarios]',"0",($entidade->rr_estatutarios == '0'?"checked":""),"id='nao' rel='nao_valida'") ?></dd>
</dl>
<dl>
	<dt>Tolerância metragem:</dt>
	<dd><?php echo form_input('entidade[tolerancia_metragem]',$entidade->tolerancia_metragem,"id='tolerancia_metragem' size='100' placeholder='Tolerância m'") ?></dd>
</dl>
<?php
        if (!$this->input->get('modal')) {
            echo "<dl><dt>";
            echo form_button('salvar','Salvar',"id='btn_confirmar' onclick='salvar_entidade(".$entidade_id.")'");
            echo "|";
            echo anchor(site_url()."/entidades/listar/".singular($titulo)."?per_page=".$this->uri->segment(5),'Cancelar');
            echo "</dt></dl>";
            
        }
        echo form_close();
?>