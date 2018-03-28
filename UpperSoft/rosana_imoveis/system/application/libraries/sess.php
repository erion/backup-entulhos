<?php
/**
 * Session abstraction class for CodeIgniter.
 * Helps you to manage session vars
 * 
 * @package	CodeIgniter
 * @author	Endel Dreyer
 * @email	endel.dreyer@gmail.com
 * @link 	http://www.uppersoft.com.br
 * @version 0.1
 * 
 * Remember: All methods and attributes in this class are static.
 */

class sess {
	
	static $CI = NULL;
	
	static function get($idx,$default_value=false) 
	{
		self::init();
		$value = self::$CI->session->userdata($idx);
		return ($value) ? $value : $default_value;
	}
	
	static function set($idx,$value)
	{
		self::init();
		return self::$CI->session->set_userdata($idx,$value);
	}
	
	static function init() {
		if (is_null(self::$CI)) self::$CI = &get_instance();
	}
	
	static function verify($idx,$redir='')
	{
		if (!self::get($idx)) redirect($redir);
	}
	
	static function destroy() {
		self::init();
		self::$CI->session->sess_destroy();
	}
	
}

?>