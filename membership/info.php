<?php

include("../global.php");
$Page = new Page("Member Info");


$id = $Sess->userid;
$Mem->catch_action($id);
$Member = new Member($id);

echo $Page->content;

if($Sess->logged_in == 1) {
?>

<div class='displayBox'>
	<div class='displayTitle'>
		<h2>Member Info</h2>
	</div>
	<div class='displayContent'>
		<p>
		Username: <?php echo "\t" . $Member->username; ?><br />
		E-mail:   <?php echo "\t" . $Member->email; ?><br />
		<a href="<?php echo WS_MEMBERSHIP;?>edit.php">Edit</a>
		<br />
		<br />
		<br />
		<?php
		if( $Member->level == 1 ) {
		?>
	
		<a href="<?php echo WS_ARTICLES;?>user_articles.php">View your articles</a>
		<div class='displayTitle'>
			<h2>Admin Panel</h2>
		</div>
		<a href="<?php echo WS_EDITOR;?>list.php">Page editor</a><br />
		<a href="<?php echo WS_TITLES;?>list.php">Titles</a><br />
		<a href="<?php echo WS_HELP;?>control_panel.php">Notebook</a><br />


		<?php
		}
		?>

		</p>
	</div>
</div>

<?php 
}else{
	errorBox("You need to be logged in to view your information.");
}
	
