<?php

class article extends super {
	
	public $title = '';
	public $content = '';
	public $active = '';
	public $author = '';
	public $createdDate = '';

	public $table = DB_TBL_ARTICLES;
	public $form_options = array( 'title'=>1, 'content'=>1, 'active'=>1 );
	public $create_success = "Article created.";
	public $edit_success = "Article edited.";

	public function set_create_options($info) {

		global $Sess;
		
		$info['private']['createdDate'] = time();
		$info['private']['author'] = $Sess->username;

		return $info;
	}

	public function set_edit_options($info) {

		global $Sess;

		$info['private']['modified_date'] = time();
		$info['private']['modified_by'] = $Sess->username;

		return $info;

	}

	public function set_view_options($info) {
		$info['order']['keys'] = array( 'createdDate' );
		$info['order']['direction'] = 'DESC';

		return $info;
	}
}
