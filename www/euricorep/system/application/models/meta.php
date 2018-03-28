<?php
	class Meta extends DataMapper {

		var $table = 'metas';

        var $validation = array(
            array(
                'field'=>'fornecedor_id',
                'label'=>'Fornecedor',
                'rules'=>array('required','trim'),
            ),
			array(
                'field'=>'meta',
                'label'=>'Meta',
                'rules'=>array('required','trim'),
            ),
			array(
                'field'=>'data_inicio',
                'label'=>'Data de inicio',
                'rules'=>array('required','trim'),
            ),
            array(
                'field'=>'data_fim',
                'label'=>'Data de fim',
                'rules'=>array('required','trim')
            )
        );

		function meta($data = null) {
			parent::DataMapper($data);
		}

        function fornecedor_nome() {
            if(!empty($this->fornecedor_id)) {
                $f = new Fornecedor();
                $f->get_by_id($this->fornecedor_id);
                return $f->nome;
            } else return null;
        }

		function listar($pag = null, $limit = null) {
			$sql = "SELECT m.*, e.nome as fornecedor FROM metas m, entidades e ".
				   " WHERE m.fornecedor_id = e.id".
				   " ORDER BY m.data_inicio DESC";
			if ($pag != null && $limit != null)
				$sql .= " LIMIT ".$pag.",".$limit;
			return $this->query($sql);
		}

		function entradas_saidas() {
			$sql = 'SELECT * FROM metas';
			$metas = $this->query($sql);
			$return = array();
			foreach($metas as $m) {
				$return[$m->meta_id]['saidas'] = 0;
				$return[$m->meta_id]['entradas'] = 0;
				$sql_entradas = "SELECT id, projecao_id FROM pedidos ".
								" WHERE created_at BETWEEN '".data_mysql($m->data_inicio)."' AND '".data_mysql($m->data_fim)."'";
				$ent = $this->query($sql_entradas);
				foreach($ent as $e) {
					$sql_entradas = "SELECT SUM(quantidade) as total_m FROM artigos_pedidos ".
									" WHERE pedido_id = ".$e->id;
					$ent2 = $this->query($sql_entradas);
					$return[$m->meta_id]['entradas'] += $ent2[0]->total_m;

					$ap = new Artigo_pedido();
					if ($e->projecao_id > 0)
						$aux[$m->meta_id] = $ap->get_faturamento_projecao($e->id);
					else
						$aux[$m->meta_id] = $ap->get_faturamento($e->id);
					foreach($aux as $s) {
						foreach($s as $fat) {
							foreach ($fat as $ap) {
								extract($ap);
								$return[$m->meta_id]['saidas'] += $qtd;
							}
						}
					}
				}
			}
			return $return;
		}
	}
?>
