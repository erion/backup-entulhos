<?php
/**
 * Javascript helper class for CodeIgniter.
 * Simple way to include your JS files and framework
 * 
 * @package	CodeIgniter
 * @author	Endel Dreyer
 * @email	endel.dreyer@gmail.com
 * @link 	http://www.uppersoft.com.br
 * @version 0.3
 * 
 * Remember: All methods and attributes in this class are static.
 * 
 * HOW TO USE: 
 * Inside your <head> tag, just insert javascript::output();
 * All javascript files loaded in yout controllers with 
 * javascript::load() will be included for you.
 * 
 */
class javascript {

	//All JS loaded
	private static $JS = '';
	
	//Javascript files repository
	private static $file_path = 'assets/js/';
	
	//Extension of javascript files
	private static $file_ext = '.js';
	
	//Last file loaded
	private static $last_file = false;
	
	private static $generate_url_functions = true;
	
	private static $populate = '';
	
	public static function framework($fw)
	{
		$file_path = self::get_file_name($fw);
		if (file_exists($file_path))
		self::$JS .= "\n".file_get_contents($file_path)."\n";
	}
	
	public static function load($file='')
	{
		if (empty($file)) $file = uri_string();
		$file_path = self::get_file_name($file);
		
		if (file_exists($file_path))
		self::$JS .= "\n".file_get_contents($file_path)."\n";
	}
	
	public static function inline($js)
	{
		self::$JS .= "\n".$js."\n";
	}
	
	public static function add_populate($content) {
		if (empty(self::$populate)) self::$populate = $content;
		else self::$populate.= $content;
	}
	
	public static function output()
	{
		$output = '';
		if (!empty(self::$JS))
		{
			$output.= '<script type="text/javascript"><!--'."\n";
			if (self::$generate_url_functions)
			{
				$output.= 'function base_url(){return "'.base_url().'"}'."\n";
				$output.= 'function site_url(segments){return base_url()+"index.php/"+segments}'."\n";
				$output.= 'function redirect(segments){location.href = site_url(segments);}'."\n";
			}
			$output.= self::$JS;
			$output.= '--></script>';
		}
		return $output;
	}
	
	public static function populate()
	{
		$output = '';
		$output.= '<script type="text/javascript"><!--'."\n";
		$output.= self::$populate."\n";
		$output.= '--></script>';
		return $output;
	}
	
	private static function get_file_name($file='')
	{
		return self::$last_file = !empty($file) ? self::$file_path.$file.self::$file_ext : '';
	}
}