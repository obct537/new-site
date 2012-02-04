<?php 

include("../global.php");
$Page = new Page("Page Details", 2);

includeMCE();
echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:FALSE;
$issue = new issue($id);

$topic = new help_topic();
?>
<div class='formz'>
<div class='displayTitle'>
<h2>TYPE NOW FOOL</h2>
</div>
<form action="control_panel.php?action=edit&id=<?php echo $id;?>" method="post">
	<div class="form_group">
		<label for='name'>Title:</label>
		<input type='text' class='textz' name='title' value="<?php echo $issue->title;?>" />
	</div>
	<div class="form_group">
		<label for='active'>Active:</label>
		<?php buildYN("active", $issue->active);?>
	</div>
	<div class="form_group">
		<label for="topic_id">Topic:</label>
		<select name="topic_id" class="textz">
			<?php $topic->buildTopicList($issue->topic_id);?>
		</select>
	</div>			
	<div class="form_group">
		<label for='content'>Content:</label>
		<textarea name='content' class='formbox' ><?php echo $issue->content;?></textarea>
		<input type='submit' class='butten' value='submit' />
	</div>

<?php

echo "</form>";
echo "</div>";
