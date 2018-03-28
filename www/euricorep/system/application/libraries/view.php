<?php

class View {

	var $CI;

	function view() {
		$this->CI = &get_instance();
	}

        function listar_ultimos_pedidos() {
            $dois_meses_atras = date('Y-m-d', time() - (15 * 24 * 60 * 60));
            $sql = "SELECT `id`, `nome` FROM `entidades`".
                   " WHERE `tipo` = 'CLIENTE'";
            if ($this->CI->session->userdata('tipo') == 'ADM') {
                $sql .= " AND `entidades`.`id` IN (SELECT DISTINCT `cliente_id` FROM `pedidos` WHERE `created_at` >= '".$dois_meses_atras;
				if ($this->CI->session->userdata('ver_pedidos') == '1')
					$sql .= " AND pedidos.created_by = ".$this->CI->session->userdata('id')."')";
				else
					$sql .= "')";
			}
            if ($this->CI->session->userdata('tipo') != 'ADM')
                $sql .= " AND `entidades`.`id` IN (SELECT DISTINCT `cliente_id` FROM `pedidos` WHERE `created_at` >= '".$dois_meses_atras."' AND `fornecedor_id` = ".$this->CI->session->userdata('empresa').")";
            $sql .= " GROUP BY `entidades`.`id` ORDER BY nome ";
            $c = new Cliente();
            return $c->query($sql);
        }

	function load($view='',$vars=array(),$modal=false)
	{
            $logou = $this->CI->session->userdata('id');
            if (empty($logou)) {
                $this->CI->data['erro'] = "Você precisa se identificar para visualizar esta página.";
                $this->CI->load->view('login/header');
                $this->CI->load->view('login/login',$this->CI->data);
                $this->CI->load->view('login/footer');
            } elseif ($modal) {
                $this->CI->load->view('layout/modal_header',$vars);
                $this->CI->load->view($view,$vars);
            } else {
                $vars['ultimos_pedidos'] = $this->listar_ultimos_pedidos();
				$this->CI->load->view('layout/header',$vars);
				$this->CI->load->view($view,$vars);
				$this->CI->load->view('layout/footer',$vars);
            }
	}

}

?>
