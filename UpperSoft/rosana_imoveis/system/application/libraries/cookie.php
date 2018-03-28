<?php
/**
 * Cookie helper class for CodeIgniter.
 * Simple way to manage cookie infomation
 * 
 * @package	CodeIgniter
 * @author	Endel Dreyer
 * @email	endel.dreyer@gmail.com
 * @link 	http://www.uppersoft.com.br
 * @version 0.1
 * 
 * Remember: All methods and attributes in this class are static.
 * 
 * NOTE: You must auto-load the Cookie helper
 * 
 */

class cookie {
	
	static $prefix = 'rsempregos_';
	
	static $lifetime = 86400; //one day
	
	static function set_prefix($new_prefix='') {
		self::$prefix = $new_prefix;
	}
	
	static function set_lifetime($new_lifetime) {
		self::$lifetime = $new_lifetime;
	}
	
	static function set($name,$value)
	{
		if (self::get($name)) self::delete($name); 
		$data = array(
			'name' => $name,
			'value' => $value,
			'expire' => self::$lifetime,
			//'domain' => '.apol0829.dev',
			'prefix' => self::$prefix
		);
		set_cookie($data);
	}
	
	static function get($name)
	{
		return get_cookie(self::$prefix.$name);
	}
	
	static function delete($name)
	{
		return delete_cookie(self::$prefix.$name);
	}
	
}

?>