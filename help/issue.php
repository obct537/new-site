<?php 

include("../global.php");
$Page = new Page();

echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:FALSE;
$issue = new issue($id);
$topic = new help_topic();
?>
	<div class='formz' >
		<div class="displayTitle top">
			<?php $topic->displayCrumbs($issue->topic_id, 1);?>
			<br /><br />
			<h2><?php echo $issue->title;?></h2>
<?php	
			if( $Sess->logged_in == 1 ) {
				$level = $Mem->getLevel($Sess->username);
	
				if( $level <= 2 ) {
?>
				<a href="<?php echo WS_HELP;?>edit.php?id=<?php echo $issue->id;?>">Edit</a><br /><br />
<?php
				}
			}
?>
	</div>

	<p><?php echo $issue->content;?></p>


</div>
