<?php 

include("../global.php");
$Page = new Page("Page Details", 2);

includeMCE();
echo $Page->content;

$topic = new help_topic();
$issue = new issue();

?>

<div class='formz'>
<div class='displayTitle'>
<h2>TYPE NOW FOOL</h2>
</div>
<form action="control_panel.php?action=create" method="post">
	<div class="form_group">
		<label for='name'>Title:</label>
		<input type='text' class='textz' name='title'  />
	</div>
	<div class="form_group">
		<label for='active'>Active:</label>
		<select name='active' class='textz'>
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
	</div>
	<div class="form_group">
		<label for="topic_id">Topic:</label>
		<select name="topic_id" class="textz">
			<?php $topic->buildTopicList();?>
		</select>
		<input type="hidden" value="<?php echo time();?>" name="create_date"/>
		<input type="hidden" value="<?php echo $Sess->username;?>" name="create_by"/>
	</div>			
	<div class="form_group">
		<label for='content'>Content:</label>
		<textarea name='content' class='formbox' ></textarea>
		<input type='submit' class='butten' value='submit' />
	</div>



<?php

echo "</form>";
echo "</div>";
