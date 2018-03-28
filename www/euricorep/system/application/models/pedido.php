<?php
    Class Pedido extends DataMapper {

        var $titulo = 'Pedidos';
        var $has_one = array('cliente','fornecedor','materia_prima');
        var $has_many = array('artigo','log','artigo_pedido');
        //var $created_field = 'created_at';

        var $validation = array(
            array(
                'field'=>'cliente_id',
                'label'=>'Cliente',
                'rules'=>array('required','trim'),
            ),
            array(
                'field'=>'fornecedor_id',
                'label'=>'Fornecedor',
                'rules'=>array('required','trim')
            )
        );

        function Pedido($data = null) {
            parent::DataMapper($data);
        }

		function get_dropdown_projecao() {
            $this->select('id,artigo_id,cliente_id,created_at');
            $this->where('projecao','1');
            $this->order_by('id desc')->limit('15');
            $dropdown = array();
            $dropdown[""] = "";
            foreach($this->get()->all as $idnome){
                $dropdown[$idnome->id] =  date('d/m',strtotime($idnome->created_at))." - ".$idnome->artigo_nome()." - ".$idnome->cliente_nome();
            }
            return $dropdown;
		}

		function usuario_nome() {
			$u = new Usuario();
			$u->get_by_id($this->created_by);
			return $u->nome;
		}

		function representante_nome() {
			$u = new Usuario();
			$u->get_by_id($this->representante_id);
			return $u->nome;
		}

        function cliente_nome() {
            $c = new Cliente();
            $c->get_by_id($this->cliente_id);
            return $c->nome;
        }

        function fornecedor_nome() {
            if(!empty($this->fornecedor_id)) {
                $f = new Fornecedor();
                $f->get_by_id($this->fornecedor_id);
                return $f->nome;
            } else return null;
        }

        function artigo_nome() {
            if(!empty($this->artigo_id)) {
                $a = new Artigo();
                $a->get_by_id($this->artigo_id);
                return $a->nome;
            } else return null;
        }

        function materia_prima_nome() {
            if(!empty($this->materia_prima_id)) {
                $m = new Materia_prima();
                $m->get_by_id($this->materia_prima_id);
                return $m->nome;
            } else return null;
        }

        function linha_producao_nome() {
            if(!empty($this->linha_producao_id)) {
                $l = new Linhas_producoe();
                $l->get_by_id($this->linha_producao_id);
                return $l->nome;
            } else return null;
        }

        function salvar_artigo($nome) {
            if(!is_numeric($nome)) {
                if(trim($nome) != '') {
                    $a = new Artigo();
                    $a->nome = ucfirst($nome);
                    $a->save();
					$id = $a->id;
					unset($a);
                    return $id;
                }
            } else return $nome;
        }

        function salvar_linha_producao($nome) {
            if(!is_numeric($nome)) {
                if(trim($nome) != '') {
                    $lp = new Linhas_producoe();
                    $lp->nome = ucfirst($nome);
                    $lp->save();
					$id = $lp->id;
					unset($lp);
                    return $id;
                }
            } else return $nome;
        }

        function salvar_materia_prima($nome) {
            if(!is_numeric($nome)) {
                if(trim($nome) != '') {
                    $m = new Materia_prima();
                    $m->nome = ucfirst($nome);
                    $m->save();
					$id = $m->id;
					unset($m);
                    return $id;
                }
            } else return $nome;
        }

        function registro($sql) {
            $this->filtrar($sql);
            $result = $this->query($sql);
            return count($result) >= 1 ? $result[0] : false;
        }

        function set_sql_count(&$sql,$para_quem,$empresa_id = null,$pedidos_fechados = false) {
            switch($para_quem) {
                case (USUARIO_ADMINISTRADOR || USUARIO_SUPER_ADMINISTRADOR):
                    $CI = &get_instance();
                    if(isset($_GET['artigos_pedidos']))
                        $sql = "SELECT COUNT(pedidos.id) as total ";
                    else
                        $sql = "SELECT COUNT(DISTINCT pedidos.id) as total ";
                    $sql .=" FROM pedidos LEFT JOIN artigos_pedidos on (pedidos.id = artigos_pedidos.pedido_id),".
			   " entidades c, entidades f, artigos".
                           " WHERE pedidos.cliente_id = c.id".
                           " AND pedidos.fornecedor_id = f.id".
                           " AND pedidos.artigo_id = artigos.id ";
                    if($CI->session->userdata('ver_pedidos') == '0' && !$CI->input->get('ver_pedidos')) {
                        if($para_quem == USUARIO_ADMINISTRADOR) {
                            if($CI->session->userdata('representante') == '1')
                                $sql .=" AND pedidos.representante_id = ".$CI->session->userdata('id');
                            else
                                $sql .=" AND pedidos.created_by = ".$CI->session->userdata('id');
                        }
                    }
                break;
                case USUARIO_CURTUME_COMERCIAL:
                    if(isset($_GET['artigos_pedidos']))
                        $sql = "SELECT COUNT(pedidos.id) as total";
                    else
                        $sql = "SELECT COUNT(DISTINCT pedidos.id) as total";
                    $sql .=" FROM pedidos,artigos,artigos_pedidos, entidades c".
                           " WHERE pedidos.id = artigos_pedidos.pedido_id".
                           " AND pedidos.artigo_id = artigos.id".
                           " AND pedidos.cliente_id = c.id".
                           " AND pedidos.fornecedor_id = ".$empresa_id.
                           " AND pedidos.email_enviado_fornecedor = 1 ";
                break;
                case USUARIO_CURTUME_PROGRAMACAO:
                    $CI = &get_instance();
                    $sql = "SELECT COUNT(pedidos.id) as total".
                           " FROM pedidos LEFT JOIN artigos on (pedidos.artigo_id = artigos.id),".
                           " artigos_pedidos, entidades c".
                           " WHERE pedidos.id = artigos_pedidos.pedido_id".
                           " AND pedidos.cliente_id = c.id";
                    if($pedidos_fechados == true && $CI->session->userdata('tipo') == USUARIO_CURTUME_PROGRAMACAO)
                        $sql.=" AND artigos_pedidos.programacao_finalizada = 1";
                    elseif($CI->session->userdata('tipo') == USUARIO_CURTUME_PROGRAMACAO)
                        $sql.=" AND artigos_pedidos.programacao_finalizada = 0";
                    if($CI->session->userdata('tipo') != USUARIO_ADMINISTRADOR && $CI->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR)
                        $sql.=" AND pedidos.fornecedor_id = ".$empresa_id;
                    else if($CI->session->userdata('ver_pedidos') == '0' && !$CI->input->get('ver_pedidos')) {
                        if($para_quem == USUARIO_ADMINISTRADOR) {
                            if($CI->session->userdata('representante') == '1')
                                $sql .=" AND pedidos.representante_id = ".$CI->session->userdata('id');
                            else
                                $sql .=" AND pedidos.created_by = ".$CI->session->userdata('id');
                        }
                    }
                    $sql .=" AND pedidos.email_enviado_fornecedor = 1 ";
                break;
            }
        }

        function set_sql(&$sql,$para_quem,$empresa_id = null,$pedidos_fechados = false) {
            switch($para_quem) {
                case (USUARIO_ADMINISTRADOR || USUARIO_SUPER_ADMINISTRADOR):
                    $CI = &get_instance();
                    $sql = "SELECT pedidos.id,c.nome as cliente,f.nome as fornecedor,artigos.nome as artigo,".
                           " pedidos.moeda,pedidos.ordem_servico,artigos_pedidos.valor_unitario,pedidos.created_at,".
                           " pedidos.data_entrega, pedidos.cancelado,artigos_pedidos.valor_unitario_corrigido,".
                           " SUM((artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade)) as total_pedido,".
                           " pedidos.fechado, artigos_pedidos.amostra, pedidos.visualizar, pedidos.impresso_adm, SUM(artigos_pedidos.quantidade) as qtd_total,".
			   " pedidos.email_enviado_fornecedor, artigos_pedidos.id as artigo_id, pedidos.impresso_curtume, artigos_pedidos.id as cod,".
                           " artigos_pedidos.data_reprogramacao, artigos_pedidos.cor, artigos_pedidos.quantidade, artigos_pedidos.oi_curtume".
                           " FROM pedidos LEFT JOIN artigos_pedidos on (pedidos.id = artigos_pedidos.pedido_id),".
			   " entidades c, entidades f, artigos".
                           " WHERE pedidos.cliente_id = c.id".
                           " AND pedidos.fornecedor_id = f.id".
                           " AND pedidos.artigo_id = artigos.id";
                            if($CI->session->userdata('ver_pedidos') == '0' && !$CI->input->get('ver_pedidos')) {
                                if($para_quem == USUARIO_ADMINISTRADOR) {
                                    if($CI->session->userdata('representante') == '1')
                                        $sql .=" AND pedidos.representante_id = ".$CI->session->userdata('id');
                                    else
                                        $sql .=" AND pedidos.created_by = ".$CI->session->userdata('id');
                                }
                            }
                break;
                case USUARIO_CURTUME_COMERCIAL:
                    $sql = "SELECT pedidos.id,artigos_pedidos.oi_curtume, pedidos.cliente_id,".
                           " pedidos.ordem_servico,pedidos.artigo_id,pedidos.moeda,artigos_pedidos.amostra,".
                           " c.nome as cliente, artigos.nome as artigo,artigos_pedidos.valor_unitario_corrigido,".
                           " SUM(artigos_pedidos.quantidade) as qtd_total,artigos_pedidos.valor_unitario,pedidos.visualizar,".
                           " pedidos.data_entrega,artigos_pedidos.data_reprogramacao, pedidos.cancelado,pedidos.fechado, pedidos.impresso_curtume,".
						   " artigos_pedidos.id as artigo_id,";
                    if (!empty($_GET['artigos_pedidos']))
                        $sql .=" (artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade) as total_pedido ";
                    else
                        $sql .=" SUM((artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade)) as total_pedido ";
                    $sql .=" FROM pedidos,artigos,artigos_pedidos, entidades c".
                           " WHERE pedidos.id = artigos_pedidos.pedido_id".
                           " AND pedidos.artigo_id = artigos.id".
                           " AND pedidos.cliente_id = c.id".
                           " AND pedidos.fornecedor_id = '".$empresa_id."'".
                           " AND pedidos.email_enviado_fornecedor = 1";
                break;
                case USUARIO_CURTUME_PROGRAMACAO://comercial e adm pode ter a mesma visualização
                    $CI = &get_instance();
                    $sql = "SELECT pedidos.id,pedidos.cancelado,pedidos.fechado,artigos_pedidos.oi_curtume,".
                           " c.nome as cliente,pedidos.ordem_servico,artigos.nome as artigo,pedidos.moeda,".
                           " artigos_pedidos.quantidade,artigos_pedidos.cor,artigos_pedidos.id as cod,pedidos.visualizar,".
                           " pedidos.data_entrega,artigos_pedidos.data_reprogramacao,artigos_pedidos.amostra,pedidos.impresso_curtume,".
						   " artigos_pedidos.id as artigo_id";
                    if($CI->session->userdata('tipo') != USUARIO_CURTUME_PROGRAMACAO)
                        $sql.= ",artigos_pedidos.valor_unitario_corrigido";
                    $sql .=" FROM pedidos LEFT JOIN artigos on (pedidos.artigo_id = artigos.id),".
                           " artigos_pedidos, entidades c".
                           " WHERE pedidos.id = artigos_pedidos.pedido_id".
                           " AND pedidos.cliente_id = c.id";
                    if($pedidos_fechados == true && $CI->session->userdata('tipo') == USUARIO_CURTUME_PROGRAMACAO)
                        $sql.=" AND artigos_pedidos.programacao_finalizada = 1";
                    elseif($CI->session->userdata('tipo') == USUARIO_CURTUME_PROGRAMACAO)
                        $sql.=" AND artigos_pedidos.programacao_finalizada <> 1";
                    if($CI->session->userdata('tipo') != USUARIO_ADMINISTRADOR && $CI->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR)
                        $sql.=" AND pedidos.fornecedor_id = '".$empresa_id."'";
                    elseif($CI->session->userdata('ver_pedidos') == '0' && !$CI->input->get('ver_pedidos')) {
                        if($CI->session->userdata('tipo') != USUARIO_SUPER_ADMINISTRADOR) {
                            if($para_quem == USUARIO_ADMINISTRADOR) {
                                if($CI->session->userdata('representante') == '1')
                                    $sql .=" AND pedidos.representante_id = ".$CI->session->userdata('id');
                                else
                                    $sql .=" AND pedidos.created_by = ".$CI->session->userdata('id');
                            }
                        }
                    }
                    $sql .=" AND pedidos.email_enviado_fornecedor = 1";
                break;
            }
        }

        function filtrar(&$sql,$tipo_usuario = null,$cont = false) {
            if (!empty($_GET['entrega_ini'])) {
                if(empty($_GET['entrega_fim'])) {
                    $_GET['entrega_fim'] = $_GET['entrega_ini'];
                }
                $sql .= " AND pedidos.data_entrega >='".data_mysql(trim($_GET['entrega_ini'])).' 00:00:00'."'";
                $sql .= " AND pedidos.data_entrega <='".data_mysql(trim($_GET['entrega_fim'])).' 23:59:59'."'";
            }
            if (!empty($_GET['reprogramado_ini'])) {
                if(empty($_GET['reprogramado_fim'])) {
                    $_GET['reprogramado_fim'] = $_GET['reprogramado_ini'];
                }
                $sql .= " AND artigos_pedidos.data_reprogramacao >= '".data_mysql(trim($_GET['reprogramado_ini'])).' 00:00:00'."'";
                $sql .= " AND artigos_pedidos.data_reprogramacao <= '".data_mysql(trim($_GET['reprogramado_fim'])).' 23:59:59'."'";
            }
            if (!empty($_GET['emitido_em'])) {
                $sql .= " AND pedidos.created_at >= '".data_mysql(trim("01/".$_GET['emitido_em'])).' 00:00:00'."'";
                $sql .= " AND pedidos.created_at <= LAST_DAY('".data_mysql(trim("01/".$_GET['emitido_em'])).' 23:59:59'."')";
            }
            if (!empty($_GET['cliente_id']))
                $sql .= " AND pedidos.cliente_id =".$_GET['cliente_id'];
            if (!empty($_GET['fornecedor_id']))
                $sql .= " AND pedidos.fornecedor_id =".$_GET['fornecedor_id'];
            if (!empty($_GET['artigo_id']))
                $sql .= " AND pedidos.artigo_id =".$_GET['artigo_id'];
            if (!empty($_GET['linha_producao_id']))
                $sql .= " AND pedidos.linha_producao_id =".$_GET['linha_producao_id'];
            if (isset($_GET['amostrav'])) {
				if(is_array($_GET['amostrav'])) {
					if(count($_GET['amostrav']) > 1)
						$_GET['amostrav'] = 2;
					else {
						$amostrav = $_GET['amostrav'];
						$new_amostrav = 0;
						foreach($amostrav as $a) {
							if(!empty($a))
								$new_amostrav++;
						}
						$_GET['amostrav'] = $new_amostrav;
					}
				}
                switch ($_GET['amostrav']) {
                    case  AMOSTRA_PEDIDO: $sql .= " AND artigos_pedidos.amostra <> 1";break;
                    case AMOSTRA_AMOSTRA: $sql .= " AND artigos_pedidos.amostra = 1";break;
                }
            }
            if (!empty($_GET['buscar'])) {
                $sql .= " AND (pedidos.id = '".$_GET['buscar']."' OR".
                        "      pedidos.ordem_servico ='".$_GET['buscar']."' OR".
                        "      artigos_pedidos.oi_curtume = '".$_GET['buscar']."')";
            } else { //se busca rapida nao filtra por projecao e busca tudo
				if(!empty($_GET['projecao'])) {//lista projecoes mestre somente
					$sql .= " AND pedidos.projecao = 1"; //projecao mestre nao liga com outro pedido
				} else {
					$sql .= " AND ((pedidos.projecao_id <> 0) OR (pedidos.projecao_id = 0 AND pedidos.projecao = 0))"; //projecao filha liga com a mestre
				}
			}
            if (isset($_GET['status'])) {
                switch ($_GET['status']) {
                    case STATUS_EM_ANDAMENTO:
						$sql .= " AND artigos_pedidos.fechado <> 1";
                        $sql .= " AND pedidos.fechado <> 1 ";
                        $sql .= " AND pedidos.cancelado <> 1 ";
                    break;
                    case STATUS_FINALIZADO:
						$sql .= " AND artigos_pedidos.fechado = 1";
                        $sql .= " AND pedidos.fechado = 1 ";
                        $sql .= " AND pedidos.cancelado <> 1 ";
                    break;
                    case STATUS_CANCELADO:
						$sql .= " AND artigos_pedidos.fechado <> 1";
                        $sql .= " AND pedidos.fechado <> 1 ";
                        $sql .= " AND pedidos.cancelado = 1 ";
                    break;
                }
            }
			if (isset($_GET['artigo_in'])) {
				if($_GET['artigo_in'][0] != 'Digite o nome de um artigo' && $_GET['artigo_in'] != 'Array')
					$sql .= " AND pedidos.artigo_id IN(".implode(',',$_GET['artigo_in']).")";
			}
			if (isset($_GET['artigo_not_in'])) {
				if($_GET['artigo_not_in'][0] != 'Digite o nome de um artigo' && $_GET['artigo_not_in'] != 'Array')
					$sql .= " AND pedidos.artigo_id NOT IN(".implode(',',$_GET['artigo_not_in']).")";
			}
            if(!$cont) {
                if (!empty($_GET['artigos_pedidos']))
                    $sql .= " GROUP BY artigos_pedidos.id";
				elseif($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO)
                    $sql .= " GROUP BY artigos_pedidos.id";
				else
                    $sql .= " GROUP BY pedidos.id";
            }
            if (!empty($_GET['order'])) {
                switch ($_GET['campo']) {
                    case       'pedido': $sql.=" ORDER BY pedidos.id ";break;
                    case      'cliente': $sql.=" ORDER BY c.nome ";break;
                    case   'fornecedor': $sql.=" ORDER BY f.nome ";break;
                    case       'artigo': $sql.=" ORDER BY artigos.nome ";break;
                    case 'ordem_compra': $sql.=" ORDER BY pedidos.ordem_servico ";break;
                    case        'total':
                        if (!empty($_GET['artigos_pedidos']))
                            $sql.=" ORDER BY (artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade) ";
                        else
                            $sql.=" ORDER BY SUM((artigos_pedidos.valor_unitario_corrigido * artigos_pedidos.quantidade)) ";
                    break;
                    case      'emissao': $sql.=" ORDER BY pedidos.created_at ";break;
                    case      'entrega': $sql.=" ORDER BY pedidos.data_entrega ";break;
                    case          'qtd':
                        if ($tipo_usuario == USUARIO_CURTUME_PROGRAMACAO)
                            $sql.=" ORDER BY artigos_pedidos.quantidade ";
                        else
                            $sql.=" ORDER BY SUM(artigos_pedidos.quantidade) ";
                    break;
                    case   'oi_curtume': $sql.=" ORDER BY artigos_pedidos.oi_curtume ";break;
                    case'reprogramacao': $sql.=" ORDER BY artigos_pedidos.data_reprogramacao ";break;
                    case          'cor': $sql.=" ORDER BY artigos_pedidos.cor ";break;
		    case'valor_unitario_corrigido':$sql.=" ORDER BY artigos_pedidos.valor_unitario_corrigido ";break;
                }
                $sql .= $_GET['order'];
            } else $sql .= " ORDER BY pedidos.data_entrega DESC";
        }

        function paginacao($sql,$pag,&$controller) {
            if($pag ==null) $pag = 0;
            $CI = &get_instance();
            $pedidos_por_pagina = $CI->config->item('pedidos_por_pagina');
            $sql .= " LIMIT ".$pag.", ".$pedidos_por_pagina;
            $controller->data['p'] = $this->query($sql);
        }

        function get_dados_resumo($pedido_id,$artigo_pedido_id = null) {
            $p = new Pedido();
            $data['pedido'] = $p->get_by_id($pedido_id);
            $data['cliente'] = $p->cliente_nome();
            $data['fornecedor'] = $p->fornecedor_nome();
            $data['artigo'] = $p->artigo_nome();
            $data['mat_prima'] = $p->materia_prima_nome();
			$fp = new Pedido();
			$data['filhos'] = $fp->order_by('created_at DESC')->get_by_projecao_id($p->id)->all;
			if((int)$p->projecao_id > 0) {
				$data['pai'] = $p->projecao_id;
			}

			$ap = new Artigo_pedido();
			$CI = &get_instance();
			if($CI->input->get('amostrav') != 2 && $CI->uri->segment(2) != 'visualizar_resumo' && $CI->uri->segment(2) != 'email')
				$ap->where('amostra',$CI->input->get('amostrav'));
			$ap->order_by('quantidade');

            $f = new Faturamento();
			$l = new Log();
			if ($artigo_pedido_id == null) {
				$data['artigo_pedido'] = $ap->get_by_pedido_id($pedido_id)->all;
				if($CI->input->get('projecao'))
					$data['faturamento'] = $ap->get_faturamento_projecao($pedido_id);
				else
					$data['faturamento'] = $ap->get_faturamento($pedido_id);
				//$data['observacao'] = $l->where('relation_table','pedidos')->order_by('created_at','desc')->get_by_relation_id($pedido_id)->all;
				$data['observacao'] = $p->get_obs();
			} else {
				$data['artigo_pedido'] = $ap->get_by_id($artigo_pedido_id);
				$data['faturamento'] = $f->get_by_artigos_pedidos_id($artigo_pedido_id)->all;
				$data['observacao'] = $l->where('relation_table','artigos_pedidos')->order_by('created_at','desc')->get_by_relation_id($artigo_pedido_id)->all;
			}

            return $data;
        }

		function get_obs() {
			$sql = "SELECT logs.relation_table, logs.relation_id, logs.id, usuarios.nome as usuario, logs.msg, logs.created_at, 1 as cor, 1 as ap_id FROM logs, usuarios".
				   " WHERE relation_table = 'pedidos' AND usuarios.id = logs.usuario_id AND relation_id = ".$this->id;
			$ap = new Artigo_pedido();
			$artigo_pedido = $ap->get_by_pedido_id($this->id)->all;
			$artigos_pedido_id = array();
			foreach($artigo_pedido as $ap)
				array_push($artigos_pedido_id,$ap->id);
			$sql .= " UNION ".
					" SELECT logs.relation_table, logs.relation_id, logs.id, usuarios.nome as usuario, logs.msg, logs.created_at, artigos_pedidos.cor, artigos_pedidos.id as ap_id FROM logs, artigos_pedidos, usuarios".
					" WHERE logs.relation_id = artigos_pedidos.id".
					" AND logs.relation_table = 'artigos_pedidos'".
					" AND logs.usuario_id = usuarios.id".
					" AND logs.relation_id in (".implode(",",$artigos_pedido_id).")".
					"ORDER BY created_at DESC";
			$l = new Log();
			return $l->query($sql);
		}

		function get_campos_cadastro($id) {
			$p = new Pedido();
			$p->get_by_id($id);
			$dados['cliente_id'] = $p->cliente_id;
			$dados['fornecedor_id'] = $p->fornecedor_id;
			$dados['representante_id'] = $p->representante_id;
			$dados['icms'] = $p->icms;
			$dados['moeda'] = $p->moeda;
			$dados['faturamento'] = $p->faturamento;
			$dados['artigo_id'] = $p->artigo_id;
			$dados['materia_prima_id'] = $p->materia_prima_id;
			$dados['ordem_servico'] = $p->ordem_servico;
			$dados['nota_fiscal'] = $p->nota_fiscal;
			$dados['tamanho_peca'] = $p->tamanho_peca;
			$dados['espessura'] = $p->espessura;
			$dados['unidade_medida'] = $p->unidade_medida;
			$dados['classificacao'] = $p->classificacao;
			$dados['linha_producao_id'] = $p->linha_producao_id;
			$dados['data_entrega'] = data_br($p->data_entrega);
			return $dados;
		}

		function get_nao_reprogramado() {
			$p = new Pedido();
			$sql = "SELECT pedidos . * , artigos_pedidos.cor, artigos_pedidos.quantidade, artigos.nome AS artigo_nome".
				   " FROM pedidos, artigos_pedidos, artigos".
				   " WHERE pedidos.id = artigos_pedidos.pedido_id".
				   " AND pedidos.artigo_id = artigos.id".
				   " AND pedidos.fechado <>1".
				   " AND (".
				   "   artigos_pedidos.data_reprogramacao IS NULL".
				   "   OR artigos_pedidos.data_reprogramacao =  ''".
				   " )".
				   " AND pedidos.created_at".
				   " BETWEEN (".
				   "   DATE_ADD( NOW( ) , INTERVAL -4 DAY ))".
				   "   AND (DATE_ADD( NOW( ) , INTERVAL -2 DAY )".
				   " )".
				   " GROUP BY pedidos.created_at, pedidos.id ORDER BY pedidos.created_by";
			return $p->query($sql);
		}

		function get_relacao_clientes($tipo_usuario,$mes_selecao) {
			$forca_ano_passado = false;
			$p = new Pedido();
			$sql = "SELECT e.id,".
				   "	CASE UPPER(p.unidade_medida) ".
				   "	  WHEN 'M²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*valor_unitario),SUM(ap.quantidade*valor_unitario_corrigido))".
				   "	  WHEN 'PÉ²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*0.3048*valor_unitario),SUM(ap.quantidade*0.3048*valor_unitario_corrigido))".
				   "	  WHEN 'PÉS²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*0.3048*valor_unitario),SUM(ap.quantidade*0.3048*valor_unitario_corrigido))".
				   "	  WHEN 'PEÇA' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*2)*(valor_unitario),SUM(ap.quantidade*2*valor_unitario_corrigido*2))".
				   "	END  as vlrTotal,".
                                   " SUM(ap.quantidade) as qtdTotal".
				   " FROM pedidos p, artigos_pedidos ap, entidades e".
				   " WHERE p.cliente_id = e.id".
				   " AND p.id = ap.pedido_id".
                                   " AND p.cancelado = 0".
                                   " AND MONTH(p.created_at) = '".$mes_selecao."'";
			if($mes_selecao > strftime("%m")) { //se selecionar um mes no futuro, pega valores do ano anterior
				$sql .= " AND YEAR(p.created_at) = YEAR(NOW())-1 ";
			} else {
				$sql .= " AND YEAR(p.created_at) = YEAR(NOW()) ";
			}
			if($tipo_usuario != USUARIO_ADMINISTRADOR && $tipo_usuario != USUARIO_SUPER_ADMINISTRADOR) {
				$CI = &get_instance();
				$sql .= " AND p.fornecedor_id = ".$CI->session->userdata('empresa');
			}
			$sql.= " GROUP BY e.id ";

			$total = $p->query($sql);
			$totalGeral = 0;
                        $qtdTotal = 0;
			foreach($total as $t) {
				$totalGeral += $t->vlrTotal;
                                $qtdTotal += $t->qtdTotal;
			}

			$sql = "SELECT e.id, p.id, e.nome,".
				   "	CASE UPPER(p.unidade_medida)".
				   "	  WHEN 'M²' THEN SUM(ap.quantidade)".
				   "	  WHEN 'PÉ²' THEN SUM(ap.quantidade*0.3048)".
				   "	  WHEN 'PÉS²' THEN SUM(ap.quantidade*0.3048)".
				   "	  WHEN 'PEÇA' THEN SUM(ap.quantidade*2)".
				   "	END  as qtdTotal,".
				   "	CASE UPPER(p.unidade_medida) ".
				   "	  WHEN 'M²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*valor_unitario),SUM(ap.quantidade*valor_unitario_corrigido))".
				   "	  WHEN 'PÉ²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*0.3048*valor_unitario),SUM(ap.quantidade*0.3048*valor_unitario_corrigido))".
				   "	  WHEN 'PÉS²' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*0.3048*valor_unitario),SUM(ap.quantidade*0.3048*valor_unitario_corrigido))".
				   "	  WHEN 'PEÇA' THEN IF(valor_unitario_corrigido is null,SUM(ap.quantidade*2*valor_unitario),SUM(ap.quantidade*2*valor_unitario_corrigido))".
				   "	END  as vlrTotal,".
				   "	CASE UPPER(p.unidade_medida) ".
				   "	  WHEN 'M²' THEN IF(valor_unitario_corrigido is null,(SUM(ap.quantidade*valor_unitario))*100/".$totalGeral.",(SUM(ap.quantidade*valor_unitario_corrigido))*100/".$totalGeral.")".
				   "	  WHEN 'PÉ²' THEN IF(valor_unitario_corrigido is null,(SUM(ap.quantidade*0.3048*valor_unitario))*100/".$totalGeral.",(SUM(ap.quantidade*0.3048*valor_unitario_corrigido))*100/".$totalGeral.")".
				   "	  WHEN 'PÉS²' THEN IF(valor_unitario_corrigido is null,(SUM(ap.quantidade*0.3048*valor_unitario))*100/".$totalGeral.",(SUM(ap.quantidade*0.3048*valor_unitario_corrigido))*100/".$totalGeral.")".
				   "	  WHEN 'PEÇA' THEN IF(valor_unitario_corrigido is null,(SUM(ap.quantidade*2*valor_unitario))*100/".$totalGeral.",(SUM(ap.quantidade*2*valor_unitario_corrigido))*100/".$totalGeral.")".
				   "	END  as vlrPercentual,".
				   "	CASE UPPER(p.unidade_medida)".
				   "	  WHEN 'M²' THEN SUM(ap.quantidade)*100/".$qtdTotal.
				   "	  WHEN 'PÉ²' THEN SUM(ap.quantidade*0.3048)*100/".$qtdTotal.
				   "	  WHEN 'PÉS²' THEN SUM(ap.quantidade*0.3048)*100/".$qtdTotal.
				   "	  WHEN 'PEÇA' THEN SUM(ap.quantidade*2)*100/".$qtdTotal.
				   "	END  as qtdPercentual".
				   " FROM pedidos p, artigos_pedidos ap, entidades e".
				   " WHERE p.cliente_id = e.id".
				   " AND p.id = ap.pedido_id".
                                   " AND p.cancelado = 0".
                                   " AND MONTH(p.created_at) = '".$mes_selecao."'";
			if($mes_selecao > strftime("%m") || $forca_ano_passado) { //se selecionar um mes no futuro, pega valores do ano anterior
				$sql .= " AND YEAR(p.created_at) = YEAR(NOW())-1 ";
			} else {
				$sql .= " AND YEAR(p.created_at) = YEAR(NOW()) ";
			}
			if($tipo_usuario != USUARIO_ADMINISTRADOR && $tipo_usuario != USUARIO_SUPER_ADMINISTRADOR) {
				$CI = &get_instance();
				$sql .= " AND p.fornecedor_id = ".$CI->session->userdata('empresa');
			}
			$sql.= " GROUP BY e.id ".
			       " ORDER BY vlrTotal DESC";
			return $p->query($sql);
		}
    }
?>
