<?php
class Rel_faturamento extends Controller {

    function Rel_faturamento() {
        parent::Controller();
        $tipo_usuario = $this->session->userdata('tipo');
        $this->load->model('Rel_faturamento_model');
        $this->data['usuario_logado'] = $this->session->userdata('nome');
        $this->data['tipo_usuario'] = $tipo_usuario;
        verificar_permissao($tipo_usuario,array('SAD'));
    }

    function sortData($filename) {
        $dados = file_get_contents($filename);
        $registros = explode(';',$dados);

        foreach($registros as $r) {
            $row = explode('|',$r);
            $this->cadastrar($row);
        }
    }

    function cadastrar($dados) {
        $dados[0] = trim(substr($dados[0],8));//remove códigos dos artigos
        $r = new Rel_faturamento_model($dados);
        $r->data_processamento = date('Y-m-d',now());
        $r->save();
    }

    function editar($data) {
var_dump($_GET)        ;exit;
        $r = new Rel_faturamento_model($data);
        $r->id = $data['id'];
        $r->save();
    }

    function excluir($id) {
        $r = new Rel_faturamento_model();
        $r->get_by_id($id);
        $r->delete();
        $r->save();
    }

}
?>
