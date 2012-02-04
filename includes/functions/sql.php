<?php

//
// Simple function to build MySQL statement from array
//
// $separator is just the value to place between keys 
// This allows this function to be used in both WHERE and SET 
// portions of the query
//
// Example
// build_sql( $options['where'], $sql, 'AND' );

function build_seq($fields, $sql, $separator) {
	
	if( !empty( $fields ) && !empty( $sql ) && !empty( $separator ) ) {
		
		$counter = 1;
		foreach( $fields as $key=>$value ) {

			if( $counter == 1 ) {
				$sql .= " `" . $key . "`='" . cleanText($value) . "'";
			}else{
				$sql .= " " . $separator . " `" . $key . "`='" . cleanText($value) . "'";
			}
			$counter++;
		}
		return $sql;
	}else{
		return FALSE;
	}
}

//
// Gives you the ability to add in specific keys to the query 
// that you don't want the user to be able to touch in any way.
//
// Example input:
//
// $options['private']['created_by'] = 'username';
// $optoins['private']['user_level'] = 3;
//
//

function add_private_fields($options, $sql) {
	
	if( !empty( $options ) && is_array( $options ) ) {

		if( isset( $options['private'] ) ) {

			$counter = 1;

			foreach( $options['private'] as $key=>$value ) {
				$sql .= ", `" . $key . "`='" . cleanText($value) . "'";
				$counter++;
			}
			return $sql;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}	
}


//
// Allows you to input options to change the default MySQL queries
//
// Example input:
//
// $options['where']['id'] = 1;
// $options['where']['name'] = 'foobar';
//
//
function handle_where($options, $sql) {
	if( !empty( $options ) && is_array( $options ) ) {

		if( isset( $options['where'] ) ) {

			$sql .= " WHERE ";
			build_seq($options['where'], &$sql, 'AND');
			
			return $sql;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

//
// Allows you to set the ORDER BY section of a MySQL query
//
// Example input:
//
// $options['order']['keys'] = array('created_date', 'author');
// $options['order']['direction'] = 'DESC';
//
function handle_sort($options, $sql) {
	if( !empty( $options ) && is_array( $options ) ) {

		if( isset( $options['order']['keys'] ) ) {

			$sql .= " ORDER BY";

			foreach( $options['order']['keys'] as $key=>$value ) {
				$sql .= " " . $value . ",";
			}

			//This is just because there would be a trailing comma
			$sql = substr($sql, 0, -1);	
			$sql .= " ";

			if( isset( $options['order']['direction'] ) ) {

				$sql .= $options['order']['direction'];
			}
			
			return $sql;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

//
// Allows you to verify uniqueness of an array of elements
// and display a message if they aren't
//
// Example Input:
// 
// $options['unique']['username']['value'] = 'example';
// $options['unique']['username']['message'] = "That username is already taken.";
//

function check_value_unique($options, $table) {
	if( !empty( $options['unique'] ) ) {

		foreach( $options['unique'] as $key=>$value ) {

			$sql = "SELECT * FROM `" . $table . "` WHERE ";
			
			$sql .= "`" . $key . "`='" . $value['value'] . "'";

			if( $res = mysql_query($sql) ) {
				if( mysql_num_rows($res) > 0 ) {

					//There was a match, so error out.
					errorBox($value['message']);
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		//If we've gotten here, they all checked out.
		return TRUE;
	}else{ 
		return FALSE;
	}
}

function build_sql($options, $sql) {
	add_private_fields($options, &$sql);
	handle_where($options, &$sql);
	handle_sort($options, &$sql);

	return $sql;
}

