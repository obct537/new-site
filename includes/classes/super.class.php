<?php

class super {

	public $table = "fake";
	public $create_success = "Success.";
	public $edit_success = "Success.";

	//
	// initalization function
	// If the $id is passed, all the object
	// properties will be set
	//
	// PARAMS:
	// string $id
	//		id of the object being created
	//
	public function __construct($id = NULL) {

		if( pop_values($id, &$this) ) {
			return TRUE;
		}else{
			return FALSE;
		}	
	}

	//
	// As the name suggests, this is the default edit query
	// The $options['unique'] array is for fields that need 
	// to be unique (like a username, email, etc)
	//
	// PARAMS:
	// array $info
	//		array of key & values to be edited
	// array $options
	// 		array of options to tack onto the query
	//
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

	//
	// Query that returns a single object
	//
	// PARAMS: 
	// string $id:
	//		The ID of the object
	//
	public function getSingle($id) {
		$single = getSingle($id, $this->table);
		if( !empty( $single ) ) {
			//print_array($single);
			return $single;
		}else{
			return FALSE;
		}
	}

	// 
	// Default create function.
	// See edit() for info the on the $options['unique'] array
	//
	// PARAMS:
	// array $info 
	//		array of key & values to be edited
	// array $options
	// 		array of options to tack onto the query
	//
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

	//
	// function to get all the records of the object type
	// view() is the default function to use, but getAll()
	// can be used in special situations
	//
	// PARAMS: 
	// array $options
	//		array of options to tack onto the query
	//
	public function getAll( $options = NULL ) {
		if( $all = getAll($this->table, $options) ) {
			return $all;
		}else{
			return FALSE;
		}
	}

	//
	// This is the default view function.
	// getAll() is a sub-function of this.
	// It can also be used on it's on in special situations
	//	
	// PARAMS: 
	// array $options
	//		array of options to tack onto the query
	//
	public function view($options = NULL) {
		if( $all = view(&$this, $options) ) {
			return $all;
		}else{
			return FALSE;
		}
	}

	//
	// This function is placed on a page to catch POST 
	// submissions for create/edit
	//
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

	//
	// This function loads in a specified model.
	// Eventually this should be fleshed out a bit, but
	// for now, it'll get the job done.
	// 
	// PARAMS:
	// 	string $name
	//		The name of the model to load (just the name, no extension)	
	public function load($name) {

		require_once(FS_MODELS . $name . ".php");

		$classes = get_declared_classes();
		//This is kinda  terrible, looking for a better way 
		// to go about this
		$class_name = end($classes);
		$class_alias = str_replace('_model', '', $class_name);

		$this->$class_alias = new $class_name;
		
	}

	public function __destruct() {

	}
}


