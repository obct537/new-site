<?php

class help_topic extends super {

	public $id = '';	
	public $parent_id = '';
	public $active = '';
	public $name = '';

	public $table = DB_TBL_TOPICS;
	public $form_options = array('parent_id'=>1,
	       			'name'=>1, 
				'active'=>1);

	public $create_success = "Topic successfully created.";
	public $edit_success = "Topic successfully edited.";

	public function getChildTopics($parent, $page = NULL, $topics = NULL, $counter = NULL){

		$sql = "SELECT * FROM `". DB_TBL_TOPICS . "` WHERE `parent_id`='" . $parent ."'";
		
		if( $page == "topic.php" ) {
			$sql .= " AND `active`='1'";
		}

		if($res = mysql_query($sql)) {

			$counter++;
			if( mysql_num_rows($res) > 0 ){

				while($record = mysql_fetch_assoc($res)) {
					$topics[] = $record;

					echo "|";
					dupe($counter,"&middot;&middot;&middot;", 1);

					echo "<a href=\"". WS_HELP . 
						$page . "?id=" . $record['id'] . "\">" .
						$record['name'] . " (" .
						$this->getIssueCount($record['id']) . ")" .
						"</a><br />";

					$topics = $this->getChildTopics($record['id'], $page, $topics, $counter);
				}
				return $topics;
			}else{
				return $topics;
			}
		}
	}

	public function getIssueCount($id) {
		$sql = "SELECT * FROM `" . DB_TBL_ISSUES . "` WHERE `topic_id`='" . $id . "'";
		$count = 0;

		if($res = mysql_query($sql)) {
			while($record = mysql_fetch_assoc($res)) {
				$count++;
			}
		}else{
			echo mysql_error();
			return FALSE;
		}

		return $count;
	}

	private function createCrumbs($id, $crumbs = NULL, $counter = 0) {
	
		$sql = "SELECT * FROM `" . $this->table . "` WHERE `id`='" . $id . "' LIMIT 1";

		if($res = mysql_query($sql) ) {
			if( mysql_num_rows($res) > 0 ) {

				$record = mysql_fetch_assoc($res);
				$crumbs[$counter]['name'] = $record['name'];
				$crumbs[$counter]['id'] = $record['id'];

				$counter++;
				return $this->createCrumbs($record['parent_id'], $crumbs, $counter);

			}else{
				return $crumbs;
			}
		}else{
			echo mysql_error();
			return FALSE;
		}

	}

	public function displayCrumbs($id, $issue = NULL) {
		//Get's the parent topics, then reverses the list
		//It's just simpler to work with that way
		//
		//The $issue variable is to display the crumb
		//trail on the issue pages. Otherwise the 
		//issues parent wouldn't be a link
		//
		$crumbs = $this->createCrumbs($id);
		$crumbs = array_reverse($crumbs);

		if( count($crumbs) <= 1 && $issue == NULL ) {
			return FALSE;
		}

		foreach( $crumbs as $key=>$value ) {

			if( $value['id'] != $id ) {

				echo "<a href=\"" . WS_HELP . "topic.php?id=" . 
					$value['id'] . "\">" . $value['name'] .
					"</a>&nbsp;&raquo;&nbsp;";	

			}elseif( $issue == 1 ) {

				echo "<a href=\"" . WS_HELP . "topic.php?id=" . 
					$value['id'] . "\">" . $value['name'] . "</a>";	

			}else{
				echo $value['name'];
			}
		}
	}
	
	public function buildTopicList($default = NULL, $parent = 0, $topics = NULL, $counter = NULL){

		$sql = "SELECT * FROM `". DB_TBL_TOPICS . "` WHERE `parent_id`='" . $parent ."'";

		if($res = mysql_query($sql)) {

			$counter++;
			if( mysql_num_rows($res) > 0 ){

				if( $counter == 1 ) {
					//The counter is need to prevent repeats...this function is recursive
					echo "<option value=\"0\">None (root topic)</option>";
				}

				while($record = mysql_fetch_assoc($res)) {
					$topics[] = $record;

					echo "<option value=\"" . $record['id'] . "\"";
					if( $default == $record['id'] ) {
						echo " selected=\"selected\">";
					}else{
						echo ">";
					}
					

					dupe($counter,"&nbsp;&nbsp;&nbsp;");
					echo $record['name'] . "</option>";

					$topics = $this->buildTopicList($default, $record['id'],$topics, $counter);
				}
				return $topics;
			}else{
				return $topics;
			}
		}
	}

	public function set_view_options() {
		$info['where']['parent_id'] = 0;
		return $info;
	}
}
