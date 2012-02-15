<?php 

include("../global.php");
$Page = new Page("Page Details", 2);

echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:FALSE;

$topic = new help_topic($id);

?>
<script>
$().ready(function() {
	$("#editTopic").validate({
		rules: {
			name: "required"
		}

	});
});
</script>
<div class='formz'>
<div class='displayTitle'>
<h2>TYPE NOW FOOL</h2>
</div>
<form action="list_topics.php?action=edit&id=<?php echo $topic->id;?>" id="editTopic" method="post">
	<div class="form_group">
		<label for='name'>Name:</label>
		<input type='text' class='textz' name='name' value="<?php echo $topic->name;?>"/>
	</div>
	<div class="form_group">
		<label for='active'>Active:</label>
		<select name='active' class='textz' value="<? echo $topic->active;?>">
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
	</div>
	<div class="form_group">
		<label for="parent_id">Parent:</label>
		<select name="parent_id" class="textz">
			<?php $topic->buildTopicList($topic->parent_id);?>
		</select>
	</div>			
	<div class="form_group">
		<input type='submit' class='butten' value='submit' />
	</div>



<?php

echo "</form>";
echo "</div>";
