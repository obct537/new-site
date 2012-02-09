<?php

class Member_model extends Model {


	function __construct() {
		parent::__construct();

	}

	public function level() {
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS ."` WHERE `username`='" . $name . "'";
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

	public function getLevel($name) {
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS ."` WHERE `username`='" . $name . "'";
		if($res = query($sql)) {
		
			$row = mysql_fetch_assoc($res);
			return $row['level'];
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

}