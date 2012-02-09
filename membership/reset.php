<?php
include('../global.php');
$Page = new Page("Password Reset");

$key = $Mem->catch_reset();

if( $Sess->logged_in == 0 ) {
	echo $Page->content;

	if( $key == "change" ) {
		
		?>
	<div class="box_content formz">
		<form action="?action=reset" method='post' class='login' >
			<label for='username'>New passsword:</label>
			<input type='password' class='loginBox' name='pass1'>
			<label for='username'>Repeat the passsword:</label>
			<input type='password' class='loginBox' name='pass2'>
			<input type='submit' class='butten' value="Submit">
		</form>
	</div>


		<?php
	}else{
	?>
	<div class="box_content formz">
		<form action="?action=request" method='post' class='login' >
			<label for='username'>Username:</label>
			<input type='text' class='loginBox' name='username'>
			<input type='submit' class='butten' value="Submit">
		</form>
	</div>
<?php
	}
}else{
	deny();
}