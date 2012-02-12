<?php

class Session extends super {

public $username = '';
public $logged_in = 0;
public $sessionid = '';
public $userid = '';
	
	public function checkSession($id) {
		
		$this->load("Session");
		if( $row = $this->Session->getSession($id)) {

			if( $row['expire'] > time() ) {
				return $row;
			}elseif( $row['expire'] < time() ) {
				$this->cleanSessions($row['id']);
				return FALSE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}

	}
	
	public function cleanSessions($user) {
		$this->load("Session");
		if($this->Session->deleteUserSessions($user)) {
			return TRUE;
		}else{
			return FALSE;
		}

	}
	
	function create($info = NULL){
		$id = gen_id();

		if( empty($info) ) {
			return FALSE;
		}
		
		$this->username = $info['username'];
				
		setcookie("sessionid", $id, time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);

		$this->load("Session");
		$this->Session->createSession($id, $info, $this->username);

		$this->logged_in = 1;
	}
	
	function destroy($userid = NULL){

		$this->cleanSessions($userid);

		setcookie("sessionid", "asdf", time() - COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
		
		$this->logged_in = 0;
	}
	
	function recreate($session) {

		$this->sessionid = $session['id'];
		$this->username = $session['username'];
		$this->userid = $session['userid'];
		$this->logged_in = 1;
		
		$time = time() + COOKIE_TIMEOUT;
		
		$sql = "UPDATE `sessions` SET `expire`='" . $time . "'";
		$sql .= " WHERE `id`='" . $session['id'] . "'";

		if($result = query($sql)) {
			setcookie("sessionid", $session['id'], $time, COOKIE_PATH, COOKIE_DOMAIN);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function setSession($id) {
		if( $session = $this->checkSession($id) ) {
			$this->recreate($session);
			$Mem = new Member($this->username);
		}		
	}
	
}
