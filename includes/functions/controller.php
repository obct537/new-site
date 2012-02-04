<?php

function catch_edit($that, $id) {
	$accept = $that->form_options;
	$Info = array();

	$options = $that->set_edit_options();

	foreach( $_POST as $key=>$value ) {
		if( array_key_exists($key, $accept) ) {
			$Info[$key] = stripslashes($value);
		}
	}
	$Info['id'] = $id;
			
	if( $that->edit($Info, $options) ) {
		successBox($that->edit_success);
	}else{
		//It's probably best to be vague here, security through obscurity
		errorBox("There was a problem, please try again.");
	}
}

function catch_create($that) {
	$accept = $that->form_options;
	$Info = array();

	$options = $that->set_create_options();

	foreach( $_POST as $key=>$value ) {
		if( array_key_exists($key, $accept) ) {
			
			$Info[$key] = stripslashes($value);	
		}
	}

	if( $that->create($Info, $options) ) {
		successBox($that->create_success);
	}else{
		errorBox("There was a problem, please try again.");
	}
}

function view($that) {
	$options = $that->set_view_options();

	if( $all = $that->getAll( $options ) ) {
		return $all;
	}else{ 
		return FALSE;
	}

}

function set_single($that, $key, $value) {
	$sql = "UPDATE `" . $that->table . "`";

	$sql .= " SET `" . $key . "`='" . $value . "'";

	if( $res = mysql_query( $sql ) ) {
		return TRUE; 
	}else{
		return FALSE;
	}
}
