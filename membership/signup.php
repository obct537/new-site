<?php 

include("../global.php");
$Page = new Page("Member Signup");

$Mem = new Member();
$Mem->catch_action();

if( $Sess->logged_in == 0 ) {
	$id = $Mem->getMemberID($Sess->username);
	$userInfo = $Mem->getSingle($id);

	echo $Page->content;
	?>

	<div class='displayBox'>
		<div class='displayTitle'>
			<h2>New Member Signup</h2>
		</div>
		<form action='?action=create' method='post'>
			<label for='username'>Username:</label>
			<input type='text' class='textz' name='username' />
			<label for='email'>Email:</label>
			<input type='text' class='textz' name='email' />
			<label for='email'>Password:</label>
			<input type='password' class='textz' name='pass1' />
			<label for='email'>Re-type Password:</label>
			<input type='password' class='textz' name='pass2' />
			<input type='submit' class='butten' value='Submit' />
		</form>
	</div>
<?php 

}else{
	errorBox("You already have an account...");
}

?>
