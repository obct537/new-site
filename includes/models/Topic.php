<?php

class Topic_model extends Model {
	
	function __construct() {
		parent::__construct();
	}

	public function getTopics($parent, $page = NULL) {
		

		$sql = "SELECT * FROM `". DB_TBL_TOPICS . "` WHERE `parent_id`='" . $parent ."'";
		
		if( $page == "topic.php" ) {
			$sql .= " AND `active`='1'";
		}

		if( $res = query($sql) ) {
			return $res;
		}else{
			return FALSE;
		}
	}

	public function issueCount($id) {
		$sql = "SELECT * FROM `" . DB_TBL_ISSUES . "` WHERE `topic_id`='" . $id . "' AND `active`='1'";
		$count = 0;

		if($res = query($sql)) {
			while($record = mysql_fetch_assoc($res)) {
				$count++;
			}
		}else{
			Console::log(mysql_error());
			return FALSE;
		}

		return $count;
	}
}