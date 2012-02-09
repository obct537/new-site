<?php
include('../global.php');
$Page = new Page("Password Reset");

$Mem->catch_reset();

if( $Sess->logged_in == 0 ) {
	echo $Page->content;
	?>
		<div class="box_content formz">
		<form action="?action=send" method='post' class='login' >
			<label for='username'>Username:</label>
			<input type='text' class='loginBox' name='username'>
			<input type='submit' class='butten' value="Submit">
		</form>
	</div>
<?php
}else{
	deny();
}