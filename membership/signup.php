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
	<script>
	$().ready(function() {
		$("#signup").validate({
			rules: {
				username: "required",
				email: {
					required: true,
					email: true
				},
				pass1: {
					required: true,
					minlength: 5,
				},
				pass2: {
					required: true,
					minlength: 5,
					equalTo: "#pass1"
				}
			}

		});
	});
	</script>
	<div class='displayBox'>
		<div class='displayTitle'>
			<h2>New Member Signup</h2>
		</div>
		<form action='?action=create' id="signup" method='post'>
			<label for='username'>Username:</label>
			<input type='text' class='textz' name='username' />
			<label for='email'>Email:</label>
			<input type='text' class='textz' name='email' />
			<label for='email'>Password:</label>
			<input type='password' class='textz' id="pass1" name='pass1' />
			<label for='email'>Re-type Password:</label>
			<input type='password' class='textz' id="pass2" name='pass2' />
			<input type='submit' class='butten' value='Submit' />
		</form>
	</div>
<?php 

}else{
	errorBox("You already have an account...");
}

?>
