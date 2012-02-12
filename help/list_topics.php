<?php 

include("../global.php");
$Page = new Page("View Help Issues",2);

echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:1;

$topic = new help_topic($id);
$topic->catch_action();

?>

	<div class='formz' >
		<div class="displayTitle top">
		<h2>
			Topics
		</h2>
	</div>
		<a href="<?php echo WS_HELP;?>create_topic.php">Create</a><p />
		</div>
<?php
	$topics = $topic->getChildTopics(0, "edit_topic.php");	
	
	echo "<br /><br />";


