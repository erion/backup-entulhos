<?php
include_once('./include/class.input.php');
include_once('./include/class.phpmailer.php');

if (input::post()) {
	
	$mail             = new PHPMailer();
	
	$body             = input::post('conteudo');
	$body             = eregi_replace("[\]",'',$body);
	$body             .= "<br /><br /><b>Fone: </b>".input::post('fone');
	
	$mail->From       = input::post('email');
	$mail->FromName   = input::post('nome');
	
	$mail->Subject    = 'Formulario - '.input::post('assunto');
	$mail->MsgHTML($body);
	$mail->AddAddress("erion.dreyer@gmail.com", "Erion");
	
	$enviado = $mail->Send();
}

?>
<img src="images/CONTATO.jpg"/>
<?php echo $conteudo_arquivo; ?>
<div id="foto_todo">
	<?php if (isset($enviado)): ?>
		<?php if ($enviado): ?>
	<p>Muito obrigado. Seu email foi enviado com sucesso. Em breve entraremos em contato.</p>
		<?php else: ?>
	<p>Ocorreu um erro ao enviar, tente novamente mais tarde.</p>
		<?php endif; ?>
	<?php else: ?>
	<form  id="form1" method="post">
		Nome:<br>  
		<input type="text" name="nome"><br>
		Fone/Fax:<br>
		<input type="text" name="fone"><br>
		E-mail:<br>    
		<input type="text" name="email"><br>
		Assunto:<br> 
		<input type="text" name="assunto"><br>
		Texto:<br>
		<label>
		<textarea name="conteudo" id="textarea" cols="45" rows="5"></textarea>
		</label><br>
		<input type="submit" value="Enviar">
	</form>
	<?php endif; ?>
</div>