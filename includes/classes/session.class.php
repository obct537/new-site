<?php

class Session {

public $username = '';
public $logged_in = 0;
public $sessionid = '';
public $userid = '';
	
	public function checkSession($id) {
		
		$sql = "SELECT * FROM `" . DB_TBL_SESSIONS . "` WHERE `id`='" . $id . "' LIMIT 1";
		if($result = query($sql)) {
		
			$row = mysql_fetch_assoc($result);

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

		$sql = "DELETE FROM `" . DB_TBL_SESSIONS . "` WHERE `userid`='" . $user . "'";
		
		if( $result = query($sql) ) {
			return TRUE;
		}else{
			echo mysql_error();
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
		
		$sql = "INSERT INTO `" . DB_TBL_SESSIONS . "` SET `id`='". $id ."' , `userid`='". $info['id'] ."'";
		$sql .= ", `username`='" . $this->username ."', `expire`='". (time() + COOKIE_TIMEOUT) ."'";
		
		query($sql);
		echo mysql_error();


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
