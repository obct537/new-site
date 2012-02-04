<?php

class Mailer {
	
	public $toAddress = '';
	public $fromAddress = '';
	public $body = '';
	public $subject = '';
	
	public function send($info) {
	
		$headers = 'From: obct537@gmail.com' . "\r\n" .
   		'Reply-To: obct537@gmail.com' . "\r\n" .
   		'X-Mailer: PHP/' . phpversion();
	
		if( mail($info['to'], $info['subject'], $info['message'], $headers ) ) {
			return TRUE;		
		}else{
			return FALSE;
		}	
	}
}

?>
