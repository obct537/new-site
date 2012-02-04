<?php

class super {

	public $table = "fake";
	public $create_success = "Success.";
	public $edit_success = "Success.";

	public function __construct($id = NULL) {
		if( pop_values($id, &$this) ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function edit($info, $options) {

		if( !empty($this->unique) ) {
			foreach( $this->unique as $key=>$value ) {
				$options['unique'][$key]['value']= $info[$key];
				$options['unique'][$key]['message'] = $value;
			}
		}

		if( !empty( $info ) ) {
			if( edit($info, $this->table, $options) ) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function getSingle($id) {
		$single = getSingle($id, $this->table);
		if( !empty( $single ) ) {
			//print_array($single);
			return $single;
		}else{
			return FALSE;
		}
	}

	public function create($info, $options = NULL) {

		if( !empty($this->unique) ) {
			foreach( $this->unique as $key=>$value ) {
				$options['unique'][$key]['value']= $info[$key];
				$options['unique'][$key]['message'] = $value;
			}
		}

		if( create($info, $this->table, $this->form_options, $options) ) { 
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getAll( $options = NULL ) {
		if( $all = getAll($this->table, $options) ) {
			return $all;
		}else{
			return FALSE;
		}
	}

	public function view($options = NULL) {
		if( $all = view(&$this, $options) ) {
			return $all;
		}else{
			return FALSE;
		}
	}

	public function catch_action($id = NULL) {

		$action = isset($_GET['action']) ? $_GET['action']:FALSE;

		if( $id == NULL ) {
			$id = (isset($_GET['id']))? $_GET['id']:FALSE;
		}
		
		if( $action == "edit" ) {

			catch_edit(&$this, $id);
		}elseif( $action == "create" ) {

			catch_create(&$this);
		}
	}			

	//
	// This function is intented to be overload
	// if it's actually needed
	public function set_edit_options() {

	}

	//
	// Ditto
	//
	public function set_create_options() {

	}

	//
	// Ditto
	//
	public function set_view_options() {
	
	}
}


