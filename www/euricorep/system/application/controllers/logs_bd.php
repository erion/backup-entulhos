<?php
	class Logs_bd extends Controller {

		function Logs_bd() {
			parent::Controller();
			$this->load->model('log_bd');
		}

		function new_log($campos) {
			if(isarray($campos)) {
				$l = new logs_bd($campos);
				$l->usuario_id = $this->session->userdata('id');
				$l->save();
			}
		}
	}
?>
