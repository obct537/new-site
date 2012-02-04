<?php

if(isset($Sess)) {
	continue;
}else{
	global $Sess;
}

if ( $Sess->logged_in == 0 ) {

?>
	<script>
		$(function() { 
			$("input:submit").button();
		});
	</script>

<div class="box_content">
	<form action='?action=login' method='post' class='login' >
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
	?>
	<p>Welcome <a href="<?php echo WS_MEMBERSHIP;?>info.php"><?php echo $Sess->username;?></a></p>
	<form action='?action=logout' method='post' class='login'>
		<input type='submit' name='logout' class='butten' value='Logout'>
	</form>

<?php
}
?>
	
						
