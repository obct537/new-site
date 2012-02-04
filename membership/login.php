<?php
include("../global.php");
$Page = new Page("Member Info");
$Mem->catch_activate();

if ( $Sess->logged_in == 0 ) {
?>


<div class="box_content formz">
	<form action="<?php echo WS_URL;?>?action=login" method='post' class='login' >
		<label for='username'>Username:</label>
		<input type='text' class='loginBox' name='username'>
		<label for='password'>Password:</label>
		<input type='password' class='loginBox' name='password'>
		<input type='submit' class='butten' value="Login">
	</form>
	
	<p><a href="<?php echo WS_MEMBERSHIP;?>signup.php">No account? Register</a></p>
</div>

<?php
}elseif ( $Sess->logged_in == 1 ){

	print_array($Sess);
	?>
	<p>Welcome <a href="<?php echo WS_MEMBERSHIP;?>info.php"><?php echo $Sess->username;?></a></p>
	<form action='?action=logout' method='post' class='login'>
		<input type='submit' name='logout' class='butten' value='Logout'>
	</form>
<?php 
}else{
	errorBox("You need to be logged in to view your information.");
}
?>
