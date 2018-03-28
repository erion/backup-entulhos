<?php 
/**
 * Post data and validation error helper class.
 *
 * @package    CodeIgniter
 * @author     Endel Dreyer
 * @copyright  (c) 2009 Uppersoft
 * @license    http://www.opensource.org/licenses/mit-license.php
 */
class form_post {
	
	private static $errors;
	
	private static $error_delimiters = array(' ',' ');
	
	private static $CI = NULL;
	
	private static $array_post_counter = array();
	
	private static $default_values_data_index = NULL;
	private static $array_default_values = NULL;
	
	private static function getCI() {
		if (is_null(self::$CI)) self::$CI = get_instance();
	}
	
	private static function post($name,$post_index='') {
		self::getCI();
		$real_name = self::get_name($name);
		
		$post = self::$CI->input->post($real_name);
		if (empty($post_index)) {
			return $post;
		} else {
			return (is_array($post)) ? $post[$post_index] : $post;
		}
	}
	
	public static function valid($config='') {
		self::getCI();
		if ($_POST) {
			self::$CI->load->library('form_validation');
			return self::$CI->form_validation->run($config);
		} else {
			return false;
		}
	}
	
	public static function input($name, $extra = '', $double_encode = TRUE) {
		return form_input($name,self::value($name),$extra,$double_encode).self::error($name);
	}
	
	public static function password($name, $extra = '') {
		return form_password($name,'',$extra).self::error($name);
	}
	
	public static function textarea($data, $extra = '', $double_encode = TRUE ) {
		return form_textarea($data, self::value($data), $extra, $double_encode).self::error($data);;
	}
	
	public static function dropdown($name,$options,$extra='',$default_value='',$post_index='') {
		$get_value =  self::value($name,$post_index,true);
		$value = $get_value ? $get_value : $default_value;
		return form_dropdown($name,$options,$value,$extra).self::error($name);;
	}
	public static function dropdown_multiple($name,$options,$extra='',$default_value='',$post_index='') {
		$value = self::value($name);
		return form_dropdown($name,$options,$value,$extra).self::error($name);;
	}
	
	public static function checkbox($data, $value = '', $checked = FALSE, $extra = '')
	{
		$checked = self::value($data) == $value;
		return form_checkbox($data, $value, $checked, $extra).self::error($data);
	}
	
	public static function radio($data, $value = '', $checked = FALSE, $extra = '')
	{
		$checked = self::value($data) == $value;
		return form_radio($data, $value, $checked, $extra).self::error($data);
	}
	
	public static function submit($label='Submit',$extra='') {
		return form_submit('',$label,$extra);
	}
	
	public static function set_errors($e)
	{
		self::$errors = $e;
	}
	
	public static function set_error_delimiters($begin,$end='') {
		self::$error_delimiters[0] = $begin;
		self::$error_delimiters[1] = $end;
	}
	
	public static function error($idx)
	{
		$error_string = form_error(self::get_name($idx));
		if (!empty($error_string)) $error_string = self::$error_delimiters[0].$error_string.self::$error_delimiters[1];
		return $error_string;
		//return isset(self::$errors[(string)$idx]) ? self::$error_delimiters[0].(self::$errors[$idx]).self::$error_delimiters[1] : '';
	}
	
	public static function get_errors()
	{
		return self::$errors;
	}
	
	public static function set_values_index($idx) {
		self::$default_values_data_index = $idx;
	}
	
	public static function set_default_values($arr) {
		self::$array_default_values = $arr;
	}
	
	public static function value($idx,$post_index='',$not_return_array = false) {
		$name = self::get_name($idx);
		$real_name = (strpos($name,'[') > 0) ? substr($idx,0,strpos($name,'[')) : $name;
		$post = self::post($idx,$post_index);
		if (empty($post)) {
			
			//verify value index to return correctly
			if (is_string($idx))
			{
				$pos = strpos($idx,'[');
				if ($pos !== false) $post_index = substr($idx,$pos+1,(strpos($idx,']')-1)-$pos);
			}
			if ($post_index == '') {
				return self::$array_default_values[$real_name];
				/*if (!isset($post_index)) {//if "[" not found in name field (it means, the value will be not an array)
					//return strings
					
				} else {
					//
					if ($pos > 0) {
						if ($not_return_array) {
							if (isset(self::$array_default_values[self::$default_values_data_index][$post_index])) {
								return self::$array_default_values[self::$default_values_data_index][$post_index];
							} else {
								return '';
							}
						} else {							
							if (isset(self::$array_default_values[self::$default_values_data_index])) {
								return self::$array_default_values[self::$default_values_data_index];
							} else {
								return '';
							}
						}
					} else {
						if (isset(self::$array_default_values[self::$default_values_data_index][$real_name])) {
							return self::$array_default_values[self::$default_values_data_index][$real_name];
						} else {
							return '';
						}
					}
				}*/
			} else {
				return isset(self::$array_default_values[self::$default_values_data_index][$post_index]) 
				? self::$array_default_values[self::$default_values_data_index][$post_index]
				: '';
			}
		} else {
			return $post;
		}
	}
	private static function get_name($data)
	{
		if (is_array($data)) {
			return $data['name'];
		}
		return (strpos($data,'[') && !strpos($data,'[]')) ? substr($data,0,strpos($data,'[')) : $data;
	}

	
}