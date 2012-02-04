<?php

include("../global.php");
$Page = new Page("Member Edit");

if( $Sess->logged_in == 1) {
	$id = $Sess->userid;
	$userInfo = $Mem->getSingle($id);

	echo $Page->content;
	?>

	<div class='displayBox'>
		<div class='displayTitle'>
			<h2>Membership Info</h2>
		</div>
		<form action='info.php?action=edit' method='post'>
			<label for='username'>Username:</label>
			<input type='text' class='textz' name='username' value='<?php echo $userInfo['username'];?>' />
			<label for='email'>Email:</label>
			<input type='text' class='textz' name='email' value='<?php echo $userInfo['email'];?>' />
			<input type='submit' class='butten' value='Submit' />
		</form>
	</div>
<?php 

}else{
	errorBox("You need to be logged in to edit your contact info.");
}



?>
