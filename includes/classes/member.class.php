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
		
		$this->load("Member");
		if( $this->Member->log_in($info) ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getMemberID($username) {
		$this->load("Member");
		if( $id = $this->Member->getID($username) ) {
			return $id;
		}else{
			return FALSE;
		}
	}
	
	public function logout() {
		$this->logged_in = 0;
		$this->username = '';
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

	public function getLevel($id) {
		$this->load("Member");
		if( $level = $this->Member->level($id) ) {
			return $level;
		}else{
			return FALSE;
		}
	}

	public function signup_email($info) {
		$this->load("Member");

		if( !($this->Member->createActivation($into)) ) {
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

	public function catch_reset_attempt() {
		$key = isset($_GET['key']) ? $_GET['key']:FALSE;

		if( $key != FALSE ) {
			$this->load("Member");
			if( $reset = $this->Member->resetAttempt($key) ) {
				if( $reset['timeout'] > time() ) {
					return TRUE;
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

	private function changePassword() {
		if( isset($_POST['pass1']) && isset( $_POST['key']) )	{
			if( $_POST['pass1'] == $_POST['pass2'] ) {
				$pass = md5($_POST['pass1']);

				$this->load("Member");
				
				//Gets userid, plus it double-checks the reset attempt
				if( !($id = $this->Member->getReset($_POST['key']) ) ) {
					errorBox();
					return FALSE;
				}

				$this->Member->clearAttempts($id);

				if( $this->Member->change_password($pass, $id) ) {
					successBox("Password changed.");
					return FALSE;
				}else{
					errorBox("There was a problem, please try again");
					return FALSE;
				}
			} 
		}
	}

	public function catch_reset() {
		$action = isset($_GET['action']) ? $_GET['action']: FALSE;

		if( $action == "reset") {
			if( $this->changePassword() ) {
				return FALSE;
			}
		}elseif( $action == "attempt" ) {
			if( $this->catch_reset_attempt() ) {
				return "change";
			}
		}elseif( $action == "request" ) {
			if( $this->resetEmail() ) {
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	private function resetEmail() {

		$username = isset( $_POST['username'] ) ? $_POST['username']:FALSE;

		$this->load("Member");
		$id = $this->Member->getID($username);
		$member = new Member($id);

		if( $key = $this->Member->createReset($id) ) {
			$message = "To reset your password, click the link below:\n";
			$message .= "Note: This reset attempt will be valid for 1 hour.\n";
			$message .= WS_MEMBERSHIP . "reset.php?action=attempt&key=" . $key;

			$headers = "From: obct537@gmail.com";

			if( mail( $member->email, "Password Reset", $message, $headers ) ) {
				successBox("Success, check your email inbox.");
				return TRUE;
			}else{
				errorBox("There was a problem, please try again");
				return FALSE;
			}

		}else{
			return FALSE;
		}

	}

	public function catch_activate() {
		$action = isset($_GET['action']) ? $_GET['action']:FALSE;
		$key = isset($_GET['key']) ? $_GET['key']:FALSE;

		if( $action == "activate" && $key != FALSE ) {

			$this->load("Member");
			if( $record = $this->Member->getActivation($key) ) {

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
