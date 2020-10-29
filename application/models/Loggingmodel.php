<?php

class Loggingmodel{
	public function email_sent($namaPeserta, $email, $result, $extraMessage = "-"){
		$filename = 'application/logs/log_email_'.date("Ymd").'.log';
		$log  = "Nama \t\t: {$namaPeserta}".PHP_EOL.
				"Email \t\t: {$email} | Status {$result}".PHP_EOL.
				"Tanggal \t: ".date("Y-m-d H:i:s").PHP_EOL.
				"Exception \t: {$extraMessage}".PHP_EOL.
				"-----------------------------------------------------------------------------------------------------------------------------".PHP_EOL;

		file_put_contents($filename, $log, FILE_APPEND);
	}
}

?>
