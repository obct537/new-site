<?php

class Session_model extends Model {
	
	function __construct() {
		parent::__construct();

	}

	public function deleteUserSessions($user) {
		$sql = "DELETE FROM `" . DB_TBL_SESSIONS . "` WHERE `userid`='" . $user . "'";
		
		if( $result = query($sql) ) {
			return TRUE;
		}else{
			echo mysql_error();
			return FALSE;
		}
	}

	public function createSession($id, $info, $username){
		$sql = "INSERT INTO `" . DB_TBL_SESSIONS . "` SET `id`='". $id ."' , `userid`='". $info['id'] ."'";
		$sql .= ", `username`='" . $username ."', `expire`='". (time() + COOKIE_TIMEOUT) ."'";
		
		if( query($sql) ) {
			return TRUE;
		}else{
			Console::log(mysql_error());
			return FALSE;
		}
		
	}

	public function getSession($id) {
		$sql = "SELECT * FROM `" . DB_TBL_SESSIONS . "` WHERE `id`='" . $id . "' LIMIT 1";
		if($result = query($sql)) {
		
			if($row = mysql_fetch_assoc($result)) {
				return $row;
			}else{
				return FALSE;
			}
		}else{
			Console::log(mysql_error());
			return FALSE;
		}
	}
}