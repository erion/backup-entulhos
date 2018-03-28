<?php

    if ( ! function_exists('filtrado')) {
        function filtrado($controller) {
            if ($controller->input->get('cliente_id') != '' || $controller->input->get('artigo_id') != ''
            || $controller->input->get('linha_producao_id') != '' || $controller->input->get('entrega_ini') != ''
            || $controller->input->get('usuario_id') != '' || $controller->input->get('criado_ini') != ''
            || $controller->input->get('reprogramado_ini') != '' || $controller->input->get('emitido_em') != ''
            || $controller->input->get('buscar') != '' || $controller->input->get('artigos_pedidos') != ''
			|| $controller->input->get('artigo_in') != '' || $controller->input->get('artigo_not_in') != ''
			|| $controller->input->get('fornecedor_id') != '' || $controller->input->get('ver_pedidos') != ''
			|| $controller->input->get('entidade_id') != '' || $controller->input->get('vendedor_id') != ''
			|| $controller->input->get('ramo') != '') {
                return true;
            } else return false;
        }
    }

    if ( ! function_exists('data_br')) {
        function data_br($data) {
            if ($data == 0 || $data == null) {
                return null;
            } else {
                return date("d/m/Y",strtotime($data));
            }
        }
    }
    
    if ( ! function_exists('data_mysql')) {
        function data_mysql($data) {
            if ($data == 0 || $data == null) {
                return null;
            } else {
                return implode('-',array_reverse(explode('/',$data)));
            }
        }
    }

    if ( ! function_exists('double_br')) {
        function double_br($data) {
	    $data = round($data,2);
            if (strpos($data, ".") > 0) {
                return str_replace(".", ",", $data);
            } else {
                return $data;
            }
        }
    }

    if ( ! function_exists('double_mysql')) {
        function double_mysql($data) {
            if (strpos($data, ",") > 0) {
                return str_replace(",", ".", $data);
            } else {
                return $data;
            }
        }
    }
    
    if (!function_exists('anchor_confirm')) {
		function anchor_confirm($url,$confirm,$str,$extra=null) {
			return '<a '.$extra.' href="#" onclick="if (confirm(\''.$confirm.'\')){location.href=\''.site_url($url).'\';} return false;">'.$str.'</a>';
		}
    }

    if (!function_exists('seleciona_menu')) {
		function seleciona_menu($controller,$selecionado) {
				$menus = array('cadastro_menu','pedidos_menu','resumo_menu','oferta_menu','interesse_menu','projecao_menu','diario_menu','meta_menu','finalizado_prog_menu','clientes_menu','pedido_cliente_menu','financeiro_menu');
				foreach ($menus as $m)
					$controller->data[$m] = null;
				$controller->data[$selecionado] = "class='selecionado'";
		}
    }

    if(!function_exists('keep_current_gets')) {
        function keep_current_gets($url) {
            $qstr_pos = strpos($url, '?')+1;
            $keep_gets = array();
            foreach(explode('&', substr($url, $qstr_pos, strlen($url) - $qstr_pos)) as $param) {
                $keep_gets[] = current(explode('=', $param));
            }
			$vars = array();
            foreach ($_GET as $nome => $valor) {
				if(is_array($valor)) {
				$new_valor = $valor;
					foreach ($new_valor as $nome2 => $valor2) {
						if(!in_array($nome2, $keep_gets)) {
							$url .= '&'.$nome."[]".'='.$valor2;
							$vars[$nome] = true;
						}
					}
				}
                if (!in_array($nome, $keep_gets)) {
					if (!isset($vars[$nome]))
						$url .= '&'.$nome.'='.$valor;
                }
            }
            return $url;
        }
    }

    if (!function_exists('ordenar_por')) {
		function ordenar_por($controller,$campo,$link) {
				$campos = array(
					'O.I.' => 'pedido',
					'Cliente' => 'cliente',
					'Fornecedor' => 'fornecedor',
					'Artigo' => 'artigo',
					'O.C.' => 'ordem_compra',
					'Total' => 'total',
					'Emissão' => 'emissao',
					'Entrega' => 'entrega',
					'Código' => 'id',
					'Matéria Prima' => 'nome',
					'Nome' => 'nome',
					'E-mail' => 'email',
					'Tipo' => 'tipo',
					'Fone' => 'fone',
					'Fax' => 'fax',
					'Qtd' => 'qtd',
					'P.I.' => 'oi_curtume',
					'Reprog.' => 'reprogramacao',
					'Qtde.' => 'qtd',
					'Cor' => 'cor',
					'Valor' => 'valor_unitario_corrigido',
					'Clientes' => 'nome', // listagem de clientes
					'Ramo' => 'ramo',
					'Vendedor' => 'vendedor_id',
					'Prog. MI' => 'programador_mi',
					'Prog. Importação' => 'programador_importacao'
				);
				if($controller->input->get('campo') == $campos[$campo]) {
					if($controller->input->get('order') == 'ASC') {
						$link .="?order=DESC&campo=".$campos[$campo];
						$img = "<img src='".base_url()."/assets/img/order_asc.gif' />";
					} else {
						$link .="?order=ASC&campo=".$campos[$campo];
						$img = "<img src='".base_url()."/assets/img/order_desc.gif' />";
					}
				} else {
					$link .="?order=ASC&campo=".$campos[$campo];
					$img = "";
				}
				return anchor(keep_current_gets($link), $campo . $img);
		}
    }

    if (!function_exists('verificar_permissao')) {
        function verificar_permissao($tipo_usuario_logado,$permissoes) {
            if(empty($tipo_usuario_logado) || $tipo_usuario_logado == null || $tipo_usuario_logado == '') {
                redirect('usuarios/login');
            }
            $permissao = false;
            foreach ($permissoes as $u) {
                if($u == $tipo_usuario_logado)
                    $permissao = true;
            }
            if(!$permissao)
                redirect('usuarios/login');
        }
    }

    if (!function_exists('enviar_email')) {

        function enviar_email($email_to,$subject,$conteudo) {
            $CI = &get_instance();
            $config = array(
                  'mailtype' => 'html'
            );
            $CI->load->library('email',$config);
            $CI->email->from($CI->session->userdata('email'),$CI->session->userdata('nome'));
            $CI->email->to($email_to);
            $CI->email->subject($subject);
            $CI->email->message($conteudo);
            $CI->email->send();
        }
    }

    if (!function_exists('config_pagination')) {

        function config_pagination($base_url,$total_rows,$query_string = null,$entidades = null) {
            $CI = &get_instance();
            $pedidos_por_pagina = $CI->config->item('pedidos_por_pagina');

            if (!empty($query_string)) {
                $config['page_query_string'] = TRUE;
                $config['enable_query_strings'] = TRUE;
                $config['query_string_segment'] = $query_string;
            }
            $config['base_url'] = site_url($base_url);
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $pedidos_por_pagina;
            $config['num_tag_open'] = '<span>';
            $config['num_tag_close'] = '</span>';
            $config['cur_tag_open'] = "<span><a class='selecionado' href='#'>";
            $config['cur_tag_close'] = '</a></span>';
            $config['next_tag_open'] = '<span>';
            $config['next_tag_close'] = '</span>';
            $config['prev_tag_open'] = '<span>';
            $config['prev_tag_close'] = '</span>';
            $config['first_tag_open'] = '<span>';
            $config['first_tag_close'] = '</span>';
            $config['last_tag_open'] = '<span>';
            $config['last_tag_close'] = '</span>';
            $config['first_link'] = '<<';
            $config['last_link'] = '>>';
            return $config;
        }
    }

	if (!function_exists('get_month_name')) {
		function get_month_name($numero,$ucfirst = null) {
			switch ($numero) {
				case  1:$retorno = 'janeiro'; break;
				case  2:$retorno = 'fevereiro'; break;
				case  3:$retorno = 'março'; break;
				case  4:$retorno = 'abril'; break;
				case  5:$retorno = 'maio'; break;
				case  6:$retorno = 'junho'; break;
				case  7:$retorno = 'julho'; break;
				case  8:$retorno = 'agosto'; break;
				case  9:$retorno = 'setembro'; break;
				case 10:$retorno = 'outubro'; break;
				case 11:$retorno = 'novembro'; break;
				case 12:$retorno = 'dezembro'; break;
			}
			if($ucfirst)
				return ucfirst($retorno);
			else
				return $retorno;
		}
	}

	if (!function_exists('get_month_navigation')) {
		function get_month_navigation($current_month,$prior_next = 0) { //0 = anterior; 1 = proximo
			if($prior_next == 0) {
				if($current_month == 1)
					return 12;
				else
					return $current_month -1;
			} else {
				if($current_month == 12)
					return 1;
				else
					return $current_month +1;
			}
		}
	}

	if (!function_exists('limit_char')) {
		function limit_char($string,$limit) {
			if(strlen($string) > $limit) {
				return substr($string, 0, $limit);
			} else
				return $string;
		}
	}

        if (!function_exists('parseWord')) {
                function parseWord($userDoc) {
                    $fileHandle = fopen($userDoc, "r");
                    $line = @fread($fileHandle, filesize($userDoc));
                    $lines = explode(chr(0x0D),$line);
                    $outtext = "";
                    foreach($lines as $thisline)
                      {
                        $pos = strpos($thisline, chr(0x00));
                        if (($pos !== FALSE)||(strlen($thisline)==0))
                          {
                          } else {
                            $outtext .= $thisline." ";
                          }
                      }
                    //$outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
                    return $outtext;
                }
        }
?>