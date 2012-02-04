<?php

class Member extends super {

	public $username = '';	
	public $logged_in = 0;
	public $email = '';
	public $level = '';
	public $id = 0;

	public $unique = array( 
		'username'=>"That username is already taken", 
		'email'=>"That email is already taken" );

	public $table = DB_TBL_MEMBERS;
	public $form_options = array('username' => 1, 'email' => 1, 'pass1'=>1, 'pass2'=>1);
	public $create_success = "Account Created. Contact the Webmaster to get it activated.";
	public $edit_success = "Account successfully modified.";

	
	public function login($info){
		
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS . "` WHERE `username`='" . $info['username'] . "' AND `active`='1' AND `password`='" . $info['password'] . "'";

		
		$result = query($sql);
		
		if( mysql_num_rows($result) > 0 ) {
			
			$member = mysql_fetch_assoc($result);
			$this->logged_in = 1;
			$Mem = new Member($member['id']);
			return TRUE;
		}else{ 
			echo mysql_error();
			return FALSE;
		}
		echo mysql_error();	
	}
	
	public function logout() {
		$this->logged_in = 0;
		$this->username = '';
	}
	
	public function getMemberID($username) { 
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS . "` WHERE `username`='" . $username . "'";
		
		$result = query($sql);
		echo mysql_error();
		
		if( mysql_num_rows($result) > 0 ) {
			$row = mysql_fetch_assoc($result);
			$id = $row['id'];
			return $id;
		}else{
			return FALSE;
		}
	}	
	
	public function getLevel($name) {
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS ."` WHERE `username`='" . $name . "'";
		if($res = query($sql)) {
		
			$row = mysql_fetch_assoc($res);
			return $row['level'];
		}else{
			return FALSE;
		}
	}

	public function create($info, $options) {
		if( !empty( $this->unique ) ) {
			foreach( $this->unique as $key=>$value ) {
				$options['unique'][$key]['value'] = $info[$key];
				$options['unique'][$key]['message'] = $value;
			}
		}

		if( $info['pass1'] == $info['pass2'] ) {
			$info['password'] = MD5($info['pass1']);
			unset($info['pass1']);
			unset($info['pass2']);
		}else{
			errorBox("Password do not match.");
			return FALSE;
		}

		if( create($info, $this->table, $this->form_options, $options) ) {
			if( $this->signup_email( $info ) ) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function set_create_options() {
		$info['private']['level'] = 3;
		$info['private']['active'] = 0;
		$info['private']['join_date'] = time();
		return $info;
	}

	public function signup_email($info) {
		$key = gen_id();

		$sql = "INSERT INTO `" . DB_TBL_ACTIVATE . "` SET ";
		$sql .= "`key`='" . $key . "', `username`='" . $info['username'];
		$sql .= "', `timeout`='" . (time() + 600) . "'";

		if( !($res = query( $sql )) ) {
			return FALSE;
		}

		$message = 
			"Welcome to obct537.com! In order to log on, you need to activate your account. Click this link: ";

		$message .= WS_MEMBERSHIP ."login.php?action=activate&key=" . $key;
		
		$headers = "From: obct537@gmail.com";

		if( mail( $info['email'], "Activation Email", $message, $headers ) ) {
			Console::logSpeed();
			return TRUE;
		}else{
			return FALSE;
		}
			
	}

	public function catch_activate() {
		$action = isset($_GET['action']) ? $_GET['action']:FALSE;
		$key = isset($_GET['key']) ? $_GET['key']:FALSE;

		if( $action == "activate" && $key != FALSE ) {
			$sql = "SELECT * FROM `" . DB_TBL_ACTIVATE . "` WHERE ";
			$sql .= "`key`='" . $key . "'";

			if( $res = query($sql) ) {
				$record = mysql_fetch_assoc($res);

				if( $record['timeout'] > time() ) {
					if( set_single( &$this, "active", 1 ) ) {
						successBox("Account activated.");
						return TRUE;
					}else{
						errorBox("There was a problem, please try again");
						return FALSE;
					}
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

}
