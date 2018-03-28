<?php

class input {

    function input() {
    }
    
    static function post($indice = null) {
    	if ($indice) {
	    	if (isset($_POST[$indice]))
	    		return $_POST[$indice];
	    	else
	    		return false;    		
    	} else return count($_POST) > 0;	
    }
}
?>