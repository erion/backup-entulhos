<?php
/**
 * SQL class for CodeIgniter.
 * Helps you to write repeatelly SQL querys quickly
 * 
 * @package	CodeIgniter
 * @author	Endel Dreyer
 * @email	endel.dreyer@gmail.com
 * @link 	http://www.uppersoft.com.br
 * @version 0.2
 * 
 * Remember: All methods and attributes in this class are static.
 */

class SQL {
	
	static $CI = false;
	
	static $group_by = '';
	
	static $num_rows = 0;
	
	static function getCI() {
		if (!self::$CI) self::$CI=&get_instance();
	}
	
	static function result($table,$fields,$where=array(),$order='',$direction='',$start='',$limit='',$joins='',$group_by='') {
		self::getCI();
		
		if (is_array($fields)) $fields = implode(',',$fields);
		if (empty($fields)) $fields = '*';
		
		$where_string = (is_array($where)) ? self::get_where($where) : $where;
		
		$query = self::$CI->db->query('SELECT '.$fields.
										' FROM `'.$table.'` '.
										(!empty($joins) ? implode('',$joins) : '' ).
										(!empty($where_string) ? 'WHERE '.$where_string : '' ).
										(!empty($group_by) ? ' GROUP BY '.$group_by.' ' : '').
										(!empty($order) ? ' ORDER BY '.$order.' '.$direction : '').
										(!empty($limit) ? ' LIMIT '.$start.', '.$limit : ''));
		self::$num_rows = $query->num_rows;
		return $query->result_array();
	}
	
	static function id_value($table,$fields,$where=array(),$order='',$direction='',$limit='',$start='',$joins='') {
		self::getCI();
		if (is_array($fields)) $fields_string = implode(',',$fields);
		if (empty($fields)) $fields_string = '*';
		
		$where_string = '';
		if (!empty($where)) {
			foreach ($where as $field => $value) {
				$where_string.= $field.'="'.$value.'"';
			}
		}
		
		$query = self::$CI->db->query('SELECT '.$fields_string.
										' FROM `'.$table.'` '.
										(!empty($joins) ? implode('',$joins) : '' ).
										(!empty($where_string) ? 'WHERE '.$where_string : '' ).
										(!empty($order) ? ' ORDER BY '.$order.' '.$direction : '').
										(!empty($start) ? ' LIMIT '.$start.', '.$limit : ''));
		
		$return = array();
		foreach ($query->result_array() as $field) {
			$return[$field[$fields[0]]] = $field[$fields[1]];
		}
		return $return;
	}
	
	static function row($table,$fields,$where=array(),$order_by='',$direction='ASC',$joins=array(),$group_by='') {
		self::getCI();
		$fields_string = (is_array($fields)) ? implode(',',$fields) : $fields;
		$where_string = self::get_where($where);
		
		$query = self::$CI->db->query('SELECT '.$fields_string.
										' FROM `'.$table.'` '.
										(!empty($joins) ? ' '.implode(' ',$joins): '' ).
										(!empty($where_string) ? 'WHERE '.$where_string : '' ).
										(!empty($order_by) ? 'ORDER BY '.$order_by.' '.$direction : '' ).
										(!empty($group_by) ? 'GROUP BY '.$group_by : '' )
									);
		return $query->row_array();
	}
	
	static function get_where($array = array()) {
		$where_string = array();
		if (!empty($array)) {
			foreach ($array as $field => $value) {
				$where_string[] = $field.'="'.$value.'"';
			}
		}
		return implode(' AND ',$where_string);
	}
	
	static function json($table,$fields,$where,$order='',$direction='',$limit='',$start='',$joins='') {
		self::getCI();
		return array(
			'totalCount' => self::total($table,$where),
			'childs' => self::result($table,$fields,$where,$order,$direction,$limit,$start,$joins)
		);
	}
	
	static function total($table,$where=array()) {
		self::getCI();
		$where_string = self::get_where($where);
		$query = self::$CI->db->query('SELECT COUNT(*) as `total` FROM `'.$table.'` '.
										(!empty($where_string) ?'WHERE '.$where_string : '' ));
		$data = $query->row_array();
		return $data['total'];
	}
	
	static function insert($table, $data) {
		self::getCI();
		self::$CI->db->insert($table,$data);
		return self::$CI->db->insert_id();
	}
	
	static function update($table,$data,$where) {
		self::getCI();
		return self::$CI->db->update($table,$data,$where);
	}
	
	static function query($query)
	{
		self::getCI();
		return self::$CI->db->query($query);
	}
	
	static function delete($from,$where=array()) {
		self::getCI();
		self::$CI->db->query("DELETE FROM {$from} ".(!empty($where) ? "WHERE ".self::get_where($where) : ''));
		return self::$CI->db->affected_rows();
	}
	
	static function num_rows() {
		return self::$num_rows;
	}
	
	static function set($var,$val) {
		self::$var = $val;
	}
	
	static function get($var) {
		if (isset(self::$var)) return self::$var;
		else return false;
	}
	
}
?>
