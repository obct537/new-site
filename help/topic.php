<?php 

include("../global.php");
$Page = new Page("View Help Issues");

echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:1;

$topic = new help_topic($id);
$issue = new issue();

$options = $issue->set_view_options($id);
$issues = $issue->getAll($options);
?>

	<div class='formz' >
		<div class="displayTitle top">
			<p>
			<?php $topic->displayCrumbs($topic->id);?>
			</p>
		<h2>
			<?php echo $topic->name;?>
		</h2>
	</div>
		

	<?php
	if( $Sess->logged_in == 1 ) {
		if( $Mem->level <= 2 ) {

?>
		<a href="<?php echo WS_HELP;?>create.php">Create</a><p />
		</div>
<?php
		}
	}

	$topics = $topic->getChildTopics($topic->id, "topic.php");	
	
	echo "<br />";
	echo "<p><h3>Notes:</h3></p>";

	foreach($issues as $key=>$value) {
		if( $value['active'] == 1) {
	?>
			<a href="<?php echo WS_HELP . "issue.php?id=" . $value['id'];?>"><?php echo $value['title'];?></a><br />
			
	<?php
		}
	}


	?>
