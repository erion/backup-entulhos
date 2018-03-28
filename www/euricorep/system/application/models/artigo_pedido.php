<?php
    class Artigo_pedido extends DataMapper {

        var $table = 'artigos_pedidos';
        var $has_many = array('pedido');
        var $created_field = 'created_at';
        var $updated_field = 'updated_at';

        var $validation = array(
            array(
                'field'=>'cor',
                'label'=>'Cor',
                'rules'=>array('required')
            ),
            array(
                'field'=>'quantidade',
                'label'=>'Quantidade',
                'rules'=>array('required')
            )
        );

        function Artigo_pedido($data = null) {
            parent::DataMapper($data);
        }

        function get_faturamento($pedido_id,$projecao = null) {
            $faturamento = array();
            $ap = new Artigo_pedido();
            $artigo_pedido = $ap->get_by_pedido_id($pedido_id)->all;
            $fat = new Faturamento();
            foreach($artigo_pedido as $ap) {
                $a = $fat->get_by_artigos_pedidos_id($ap->id)->all;
				if($projecao == true)
					$index = $ap->cor;
				else
					$index = $ap->id;
                foreach($a as $f) {
                    $faturamento[$index][] = array(
                        'id' => $f->id,
                        'nota_fiscal' => $f->nota_fiscal,
                        'qtd' => $f->qtd,
                        'data' => data_br($f->data)
                    );                    
                }
            }
            return $faturamento;
        }

		function get_faturamento_projecao($pedido_id) {
			$p = new Pedido();
			$pedido = $p->get_by_projecao_id($pedido_id)->all;
			$faturamento = array();
			$fat = new Faturamento();
			foreach($pedido as $p) {
				$ap = new Artigo_pedido();
				$artigo_pedido = $ap->get_by_pedido_id($p->id)->all;
				foreach($artigo_pedido as $ap) {
					$a = $fat->get_by_artigos_pedidos_id($ap->id)->all;
					foreach($a as $f) {
						$faturamento[$ap->cor][] = array(
							'id' => $f->id,
							'nota_fiscal' => $f->nota_fiscal,
							'qtd' => $f->qtd,
							'data' => data_br($f->data)
						);
					}
				}
			}
			return $faturamento;
		}

		function get_amostra() {
			if ($this->amostra == 0) return "produção";
			else					 return "amostra";
		}

		function get_cor() {
			return $this->cor;
		}

    }
?>
