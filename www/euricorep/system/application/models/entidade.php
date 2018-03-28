<?php   

    Class Entidade extends DataMapper {

        var $created_field = 'created_at';
        var $updated_field = 'updated_at';

        var $validation = array(
            array(
                'field'=>'nome',
                'label'=>'Nome',
                'rules'=>array('required','trim')
            ),
            array(
                'field'=>'endereco',
                'label'=>'Endereço',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'bairro',
                'label'=>'Bairro',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'cidade',
                'label'=>'Cidade',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'pais',
                'label'=>'País',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'uf',
                'label'=>'UF',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'cep',
                'label'=>'CEP',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'cnpj',
                'label'=>'CNPJ',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'insc_estadual',
                'label'=>'Inscrição Estadual',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'insc_municipal',
                'label'=>'Inscrição Municipal',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'fone',
                'label'=>'Fone',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'fax',
                'label'=>'Fax',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'ramo',
                'label'=>'Ramo',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'vendedor_id',
                'label'=>'Vendedor',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'programador_mi',
                'label'=>'Programador MI',
                'rules'=>array('trim')
            ),
            array(
                'field'=>'programador_importacao',
                'label'=>'Programador Importação',
                'rules'=>array('trim')
            )
        );

        function Entidade($data = null){
            parent::DataMapper($data);
        }

        function get_dropdown(){
            $this->where('invisivel','0')->select('id,nome');
            $dropdown = array();
            $dropdown[""] = "";
            foreach (parent::get()->all as $idnome){
                $dropdown[$idnome->id] = $idnome->nome;
            }
            return $dropdown;
        }

		function vendedor_nome() {
			$u = new Usuario();
			$u->get_by_id($this->vendedor_id);
			return $u->nome;
		}

		function _create_thumbnail($fileName) {
				$config['image_library'] = 'gd2';
				$config['source_image'] = $fileName;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 77;
				$config['height'] = 77;

				$CI = &get_instance();

				$CI->load->library('image_lib', $config);
				if(!$CI->image_lib->resize()) echo $CI->image_lib->display_errors();

		}

        function filtrar() {
            if (!empty($_GET['entidade_id']))
                $this->where('id',$_GET['entidade_id']);
            if (!empty($_GET['vendedor_id']))
                $this->where('vendedor_id',$_GET['vendedor_id']);
            if (!empty($_GET['ramo']) && $_GET['ramo'] != 'Ramo') {
				$where = "ramo LIKE '%".$_GET['ramo']."%'";
                $this->where($where);
            }
            if (!empty($_GET['programador_importacao']) && $_GET['programador_importacao'] != 'Programador de importação') {
				$where = "programador_importacao LIKE '%".$_GET['programador_importacao']."%'";
                $this->where($where);
            }
            if (!empty($_GET['programador_mi']) && $_GET['programador_mi'] != 'Programador MI') {
				$where = "programador_mi LIKE '%".$_GET['programador_mi']."%'";
                $this->where($where);
            }
        }

    }
?>
