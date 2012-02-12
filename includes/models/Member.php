<?php

class Member_model extends Model {


	function __construct() {
		parent::__construct();

	}

	public function level($id) {
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS ."` WHERE `id`='" . $id . "'";
		if($res = query($sql)) {
		
			$row = mysql_fetch_assoc($res);
			return $row['level'];
		}else{
			return FALSE;
		}
	}

	public function log_in($info){
		
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
		Console::log(mysql_error());
	}

	public function getID($username) { 
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

	private function createActivation($info) {
		$key = gen_id();

		$sql = "INSERT INTO `" . DB_TBL_ACTIVATE . "` SET ";
		$sql .= "`key`='" . $key . "', `username`='" . $info['username'];
		$sql .= "', `timeout`='" . (time() + 600) . "'";

		if( !($res = query( $sql )) ) {
			return FALSE;
		}
	}

	private function getActivation($key) {
		$sql = "SELECT * FROM `" . DB_TBL_ACTIVATE . "` WHERE ";
		$sql .= "`key`='" . $key . "'";

		if( $res = query($sql) ) {
			$record = mysql_fetch_assoc($res);
			return $record;
		}else{
			return FALSE;
		}
	}

	public function createReset($id) {

		$key = gen_id();
		Console::log($id);
		$sql = "INSERT INTO `" . DB_TBL_RESETS . "` SET ";
		$sql .= "`key`='" . $key . "', `timeout`='" . (time() + 3600) . "'";
		$sql .= ", `userid`='" . $id . "'";

		if( $res = query($sql) ) {
			return $key;
		}else{
			Console::log(mysql_error());
			return FALSE;
		}
	}

	public function resetAttempt($key) {
		$sql = "SELECT * FROM `" . DB_TBL_RESETS . "`";
		$sql .= "WHERE `key`='" . $key . "' LIMIT 1";

		if( $res = query($sql) ) {
			if( $record = mysql_fetch_assoc($res) ) {
				return $record;
			}else{
				Console::log(mysql_error());
				return FALSE;
			}
		}else{
			Console::log(mysql_error());
			return FALSE;
		}
	}

	public function clearAttempts($id) {
		$sql = "DELETE FROM `" . DB_TBL_RESETS . "` WHERE userid='" . $id . "'";

		if( $res = query($sql) ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getReset($key) {
		$sql = "SELECT * FROM `" . DB_TBL_RESETS . "` WHERE `key`='" . $key . "'";

		if( $res = query( $sql ) ) {
			if( $record = mysql_fetch_assoc($res) ) {
				return $record['userid'];
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function change_password($pass, $id) {
		$sql = "UPDATE `" . DB_TBL_MEMBERS . "` SET `password`='" . $pass . "'";
		$sql .= "WHERE `id`='" . $id . "'";

		if( $res = query($sql) ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

}