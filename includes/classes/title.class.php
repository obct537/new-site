<?php

class title extends super {

	public $table = DB_TBL_TITLES;

	public $create_success = "Title successfully created";
	public $edit_success = "Title successfully edited";
	
	public $form_options = array('title' => 1, 'active' => 1);
	
	private function getMax($titles) {
	
		if( is_array( $titles ) ) {
			return count($titles);
		}
	
	}

	public function pickTitle() {
		
		//- 1 is just to offset the DB starting at 1
		$titles = $this->getAll();
		$num = rand(0, ($this->getMax($titles) - 1 ) );
		
		if(!empty ( $titles ) ) {
			return $titles[$num];
		}
	}

	public function set_view_options() {
		$info['order']['keys'] = array("title");

		return $info;
	}	
}
