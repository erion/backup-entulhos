<?php
/**
 * Description of FormBuilder
 *
 * @author Erion
 */
class ConfigFilter {

	private $CI;

	function ConfigFilter() {
		$this->CI = &get_instance();
	}

	function get_artigo_in() {
		$cf = new Config_filter_model();
		$cf->where('campo','artigo_in')->get_by_usuario_id($this->CI->session->userdata('id'));
		$artigo_in = $cf->valor;
		if(!empty($artigo_in)) return explode(',',$artigo_in);
		else				   return false;
	}

	function get_artigo_not_in() {
		$cf = new Config_filter_model();
		$cf->where('campo','artigo_not_in')->get_by_usuario_id($this->CI->session->userdata('id'));
		$artigo_not_in = $cf->valor;
		if(!empty($artigo_not_in)) return explode(',',$artigo_not_in);
		else					   return false;
	}

	function get_artigo_in_URL() {
		$cf = new Config_filter_model();
		$cf->where('campo','artigo_in')->get_by_usuario_id($this->CI->session->userdata('id'));
		$artigo_in = $cf->valor;
		if(!is_array($artigo_in) && !empty($artigo_in))
			$artigo_in = "&artigo_in[]=".$artigo_in;
		if(!empty($artigo_in)) return str_replace(',', '&artigo_in[]=', $artigo_in);
		else				   return false;
	}

	function get_artigo_not_in_URL() {
		$cf = new Config_filter_model();
		$cf->where('campo','artigo_not_in')->get_by_usuario_id($this->CI->session->userdata('id'));
		$artigo_not_in = $cf->valor;
		if(!is_array($artigo_not_in) && !empty($artigo_not_in))
			$artigo_not_in = "&artigo_not_in[]=".$artigo_not_in;
		if(!empty($artigo_not_in)) return str_replace(',', '&artigo_not_in[]=', $artigo_not_in);
		else					   return false;
	}

	function change_filter($new_value,$field_name) {
		if(empty($new_value) || $new_value == null)
			return false;
		if(is_array($new_value))
			sort($new_value);
		else
			$new_value = array(0=>$new_value);

		$cf = new Config_filter_model();
		$cf->where('campo',$field_name)->get_by_usuario_id($this->CI->session->userdata('id'));
		$old_value = explode(',',$cf->valor);
		sort($old_value);

		if(count($new_value) >= count($old_value))
			$var = array_intersect($new_value,$old_value);
		else
			$var = array_intersect($old_value,$new_value);

		$cont1 = count($var);
		$cont2 = count($new_value);
		$cont3 = count($old_value);
		if($cont1 == $cont2 && $cont1 == $cont3)
			return false; //filtro não mudou
		else
			return true; //filtro mudou

	}

	function insere_filtro($value,$field) {
		$cf = new Config_filter_model();
		$usuario_id = $this->CI->session->userdata('id');
		$cf->where('campo',$field)->get_by_usuario_id($usuario_id);
		if(empty($cf->id))
			$cf = new Config_filter_model();
		$cf->campo = $field;
		$cf->valor = implode(',',$value);
		$cf->usuario_id = $usuario_id;
		$cf->save();
	}

	function limpa_filtro($field) {
		$cf = new Config_filter_model();
		$usuario_id = $this->CI->session->userdata('id');
		$cf->where('campo',$field)->get_by_usuario_id($usuario_id);
		$cf->campo = $field;
		$cf->valor = '';
		$cf->usuario_id = $usuario_id;
		$cf->save();
	}
}
?>
