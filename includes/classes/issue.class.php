<?php

class issue extends super {

	public $id = '';	
	public $content = '';
	public $active = '';
	public $topic_id = '';
	public $title = '';
	public $created_by = '';
	public $created_date = '';

	public $table = DB_TBL_ISSUES;
	public $form_options = array(
		'title'=>1,
		'active'=>1,
		'topic_id'=>1,
		'content'=>1,
		'created_date'=>1,
		'created_by'=>1);
	public $create_success = "Issue created.";
	public $edit_success = "Issued successfully edited.";

	public function set_view_options($id) {
		$info['where']['topic_id'] = $id;

		return $info;
	}	
}
