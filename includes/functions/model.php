<?php

function pop_values($id, $that) {
	if( $id != NULL ) {
		$sql = "SELECT * FROM `" . $that->table . "` WHERE `id`='" . $id . "' LIMIT 1";

		if($res = mysql_query($sql)) {

			$record = mysql_fetch_assoc($res);

			foreach($record as $key=>$value) {

				if(isset($that->$key)) {

					$that->$key = $value;
				}
			}
		}
	}
}

function edit($info, $table, $options) {

	if(!empty($info) && !empty($info['id'])) {

		if( !empty( $options['unique'] ) ) {
			if( !check_value_unique( $options, $table ) ) {
				return FALSE;
			}
		}
		
		$sql = "UPDATE `" . $table . "` SET ";
		$counter = 1;

		$sql = build_seq($info, $sql, ',');

		if( $options != NULL ) {
			add_private_fields($options, &$sql);
		}
			
		$sql .= " WHERE `id`='" . $info['id'] ."'";

		//echo $sql;

		if($res = mysql_query($sql)) {

			if( mysql_affected_rows() > 0 ) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			echo mysql_error();
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

function create($info, $table, $values, $options = NULL) {
	if(!empty($info)) {

		if( !check_unique($info, $table) ) {
			return FALSE;
		}

		if( !empty( $options['unique'] ) ) {
			if( !check_value_unique( $options, $table ) ) {
				return FALSE;
			}
		}
		
		$sql = "INSERT INTO `" . $table . "` SET ";
		$counter = 1;

		$sql = build_seq($info, $sql, ',');

		if( $options != NULL ) {
			add_private_fields($options, &$sql);
		}

		if($res = mysql_query($sql)) {
			return TRUE;
		}else{
			echo mysql_error();
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

function getAll($table, $options = NULL) {
		
	$sql = "SELECT * FROM `" . $table . "`";

	handle_where($options, &$sql);
	handle_sort($options, &$sql);

	//echo $sql;
	if( $res = mysql_query($sql) ) {
			
		while($record = mysql_fetch_assoc($res) ) {
			$all[] = $record;	
		}
		if( !empty( $all ) ) {
			return $all;
		}else{
			return FALSE;
		}
	}
}

function getSingle($id, $table) {
	$sql = "SELECT * FROM `" . $table . "` WHERE `id`='" . $id . "'";
	
	if( $res = mysql_query($sql) ) {
		
		$single = mysql_fetch_assoc($res);
		if( !empty( $single ) ){
			return $single;			
		}else{ 
			return FALSE;
		}
	}
}

function check_unique($info, $table) {
	$sql = "SELECT * FROM `" . $table . "` WHERE ";

	build_seq($info, &$sql, "AND");

	if( $res = mysql_query($sql) ) {
		if( mysql_num_rows($res) == 0 ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

