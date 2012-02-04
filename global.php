<?php

require_once("includes/config.php");
require_once( FS_FUNCTIONS . "includes.php");
include( FS_INCLUDES . "dbconnect.php");

$Mem = new Member();
$Sess = new Session();

$action = isset($_GET['action']) ? $_GET['action']:'';

if($action != 'login' && $action != 'logout') {

	if(isset($_COOKIE['sessionid']) && isset($_COOKIE['userid'])) {
	
		if($_COOKIE['sessionid'] != '' && $_COOKIE['userid'] != '' ) {

			if($Sess->checkSession($_COOKIE['sessionid'], $_COOKIE['userid'])) {
			
				$Sess->recreate($_COOKIE['userid'], $_COOKIE['sessionid'], $_COOKIE['username']);
				$Mem = new Member($_COOKIE['userid']);
			}else{
				$Sess = new Session();
			}
		}
	}
}

if( $action == 'login' ) {


	if( $Sess->logged_in == 0 ) {
		$pass =  md5(( isset($_POST['password']) ) ? $_POST['password'] : FALSE);
		$user = ( isset($_POST['username']) ) ? $_POST['username'] : FALSE;

		$user = stripslashes($user);
		
		$info['username'] = $user;
		$info['password'] = $pass;

		$id = $Mem->getMemberID($user);

		$info['id'] = $id;		

		if( $Mem->login($info) ) {
			$userInfo = $Mem->getSingle($id);
			$Sess->create($userInfo);
		}else{
			errorBox("Bad username or password");
		}
	}
}

if( $action == 'logout' ) {

	$Sess->destroy($_COOKIE['userid']);
	$Mem->logout();
}

?>



