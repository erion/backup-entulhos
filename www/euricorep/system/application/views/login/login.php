<?php
    if($this->uri->segment(2) == 'visualizar_resumo') {//caso troquem links via msn, aceita pedidos/visualizar_pedido
        echo form_open('usuarios/login/0/'.$this->uri->segment(3));
    } elseif($this->uri->segment(4) != null) {
        echo form_open('usuarios/login/0/'.$this->uri->segment(4),"id='form_login'");
    } else {
        echo form_open('usuarios/login',"id='form_login'");
    }
?>
<dl>
    <dt><label>Email</label></dt>
    <dd><?php echo form_input('nome',"",'id="login" size="150" placeholder="Usuário"') ?></dd>
</dl>
<dl>
    <dt><label>Senha</label></dt>
    <dd><?php echo form_password('senha',"",'id="senha" size="150" placeholder=""') ?></dd>
</dl>
<?php
    echo form_submit('login','Entrar',"id='btn_confirmar_login'");
    echo form_close();
    echo "<span>".$erro."</span>";
?>