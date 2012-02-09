<?php

/////////////////////////////AUTOLOADER//////////////////////
spl_autoload_register(null, false);

// Courtesy of phppro.org
/*** specify extensions that may be loaded ***/
spl_autoload_extensions('.class.php');

/*** class Loader ***/
function classLoader($class)
{
	$filename = strtolower($class) . '.class.php';
	$file = FS_CLASSES . $filename;
	if (!file_exists($file) || $filename=='config.php')
	{
		return false;
	}
	include $file;
}

/*** register the loader functions ***/
spl_autoload_register('classLoader');

////////////////////////////////////////////////////////////

function pre($str) {
	echo "<pre>";
	echo $str;
	echo "</pre>";
}

function print_array($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function errorBox($string = NULL) {

	if( $string == NULL ) {
		$string = "There was a problem, please try again.";
	}

	echo "<div class=\"response error\">";
	echo "<p>" . $string . "</p>";
	echo "</div>";
}

function successBox($string) {
	if( !empty($string) ) {
		echo "<div class=\"response success\">";
		echo "<p>" . $string . "</p>";
		echo "</div>";
	}
}

function includeMCE() {

echo '<script type="text/javascript" src="' . WS_JAVASCRIPT . '/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",

	});
</script>';

}

function parseYN($num) {

	if($num == 1) {
	
		return "Yes";
		
	}elseif($num == 0){
	
		return "No";
		
	}else{
		return "Invalid";
	}
}

function cleanText($string) {
	$bad = array("'", '"', "<", ">", "(", ")");
	$good = array("&#37;", "&quot;", "&lt;", "&gt;", "&#40;", "&#41;");
	str_replace($bad, $good, $string);
	$string = mysql_real_escape_string($string);
	return $string;
}

function dupe($number, $string, $start = NULL) {

	//The start variable is to choose whether or not
	//an the first element in a list should be duped.
	//
	//For an example, compare the topic lists on topics.php
	//to the dropbown box on the issue create page
	//
	if( $start != NULL ){
		$counter = 0;
	}else{
		$counter = 1;
	}

	while( $counter != $number ) {
		echo $string;
		$counter++;
	}
}

function deny() {
	header("Location: " . WS_DENIED);
}

function buildYN($name, $selected) {
	echo "<select name=\"" . $name . "\" class=\"textz\">";

	if( $selected == 1 ) {
		echo "<option value=\"1\" selected=\"selected\">Yes</option>";
		echo "<option value=\"0\">No</option>";
	}else{
		echo "<option value=\"1\">Yes</option>";
		echo "<option value=\"0\" selected=\"selected\">No</option>";	
	}

	echo "</select>";
}

function snip( $name ) {
	include( FS_SNIPPETS . $name . ".php");
}

function gen_id() {
	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$num = strlen($characters);
	$length = rand(40,48);
	$id = "";
		
	for($i=0;$i<$length;$i++) {
		$id .= substr($characters,rand(0,$num-1),1);
	}
	
	return $id;
}
