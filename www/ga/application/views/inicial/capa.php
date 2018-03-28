<div id="login">
	<h1>Login</h1>	
    <form method="post" action="<?=base_url()?>analise">
    	<p>
    		<label for="username">E-mail</label>
    		<input type="text" name="username" id="username">
    	</p>
        <p>
        	<label for="password">Password</label>
        	<input type="password" name="password" id="password">
        	<input type="submit" id="submit" value="Log in">
        </p>
    </form>
</div>