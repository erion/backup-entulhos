<?php
	class Log_bd extends datamapper {

		var $table = 'logs_bd';

		function log_bd($data = null) {
			parent::DataMapper($data);
		}
	}
?>