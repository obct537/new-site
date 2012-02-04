<?php

class Session {

public $username = '';
public $logged_in = 0;
public $sessionid = '';
public $userid = '';
	
	public function checkSession($id, $userid) {
		
		$sql = "SELECT * FROM `" . DB_TBL_SESSIONS . "` WHERE `id`='" . $id . "' AND `userid`='" . $userid . "' LIMIT 1";
		if($result = mysql_query($sql)) {
		
			$row = mysql_fetch_assoc($result);

			if( $row['expire'] > time() ) {
				return TRUE;
			}elseif( $row['expire'] < time() ) {
				$this->cleanSessions($userid);
			}else{
				return FALSE;
			}

		}else{
			return FALSE;
		}
	}
	
	public function cleanSessions($user) {

		$sql = "DELETE FROM `" . DB_TBL_SESSIONS . "` WHERE `userid`='" . $user . "'";
		
		if( $result = mysql_query($sql) ) {
			return TRUE;
		}else{
			echo mysql_error();
			return FALSE;
		}
	}
	
	function gen_id() {
		$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$num = strlen($characters);
		$length = rand(40,48);
		$id = "";
		
		for($i=0;$i<$length;$i++) {
			$id .= substr($characters,rand(0,$num-1),1);
		}
		
		return $id;
	}
	
	function create($info = NULL){
		$id = $this->gen_id();
		
		$this->username = $info['username'];
				
		setcookie("sessionid", $id, time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
		setcookie("userid", $info['id'], time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
		setcookie("username", $info['username'], time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);

		$sql = "INSERT INTO `" . DB_TBL_SESSIONS . "` SET `id`='". $id ."' , `userid`='". $info['id'] ."'";
		$sql .= ", `username`='" . $this->username ."', `expire`='". (time() + COOKIE_TIMEOUT) ."'";
		
		mysql_query($sql);
		echo mysql_error();


		$this->logged_in = 1;
	}
	
	function destroy($id = NULL){

		$this->cleanSessions($id);

		setcookie("sessionid", "asdf", time() - COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
		setcookie("userid", "234", time() - COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
		setcookie("username", "234", time() - COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);

		$sql = "DELETE FROM `" . DB_TBL_SESSIONS . "` WHERE `id`='" . $this->sessionid . "'";
		$result = mysql_query($sql);
		echo mysql_error();
		
		$this->logged_in = 0;
	}
	
	function recreate($user, $sess, $username) {
	
		$this->logged_in = 1;
		$this->userid = $user;
		$this->sessionid = $sess;
		$this->username = $username;
		
		$time = time() + COOKIE_TIMEOUT;
		
		$sql = "UPDATE `sessions` SET `expire`='" . $time . "'";
		$sql .= " WHERE `userid`='" . $user . "' AND `id`='" . $sess . "'";

		if($result = mysql_query($sql)) {
			setcookie("sessionid", $sess, time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
			setcookie("userid", $this->userid, time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);
			setcookie("username", $username, time() + COOKIE_TIMEOUT, COOKIE_PATH, COOKIE_DOMAIN);

			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}
