<?php
include('global.php');
$Page = new page("Home");

echo $Page->content;

require_once(FS_MODELS . "Model.php");

$asdf = new Member(1);
$asdf->load("Member");

Console::log($asdf);
?>


	
