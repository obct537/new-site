<?php

include("../global.php");
$Page = new Page("Member Info", 1);

$level = $Mem->getLevel($Sess->username);

echo $Page->content;
$issue = new issue();
$issue->catch_action();

if($Sess->logged_in == 1) {
?>

<div class='displayBox'>
	<div class='displayContent'>
		<p>
		<?php
		if( $level == 1 ) {
		?>

		<div class="displayTitle">
			<h2>Notebook Control Panel</h2>
			<h3>Topics</h3>
		</div>
		<a href="<?php echo WS_HELP;?>list_topics.php">View Topics</a><br />
		<a href="<?php echo WS_HELP;?>create_topic.php">Create a Topic</a><br />

		<h3>Issues</h3>
		<a href="<?php echo WS_HELP;?>index.php">View Issues</a><br />
		<a href="<?php echo WS_HELP;?>create.php">Create an Issue</a><br />


		<?php
		}else{
			errorBox("Only important people can edit the notebook");
		}
		?>

		</p>
	</div>
</div>

<?php 
}else{
	errorBox("You need to be logged in to edit the notebook.");
}
	
