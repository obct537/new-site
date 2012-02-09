<?php

class Member_model extends Model {


	function __construct() {
		parent::__construct();

	}

	public function getLevel() {
		$sql = "SELECT * FROM `" . DB_TBL_MEMBERS ."` WHERE `username`='" . $name . "'";
		if($res = query($sql)) {
		
			$row = mysql_fetch_assoc($res);
			return $row['level'];
		}else{
			return FALSE;
		}
	}

}