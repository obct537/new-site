<?php

include("../global.php");
$Page = new Page("Member Info", 1);

echo $Page->content;
$issue = new issue();
$issue->catch_action();
?>

<div class='displayBox'>
	<div class='displayContent'>
		<p>
		<div class="displayTitle">
			<h2>Notebook Control Panel</h2>
			<h3>Topics</h3>
		</div>
		<a href="<?php echo WS_HELP;?>list_topics.php">View Topics</a><br />
		<a href="<?php echo WS_HELP;?>create_topic.php">Create a Topic</a><br />

		<h3>Issues</h3>
		<a href="<?php echo WS_HELP;?>index.php">View Issues</a><br />
		<a href="<?php echo WS_HELP;?>create.php">Create an Issue</a><br />
		</p>
	</div>
</div>
