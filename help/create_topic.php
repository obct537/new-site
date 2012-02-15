<?php 

include("../global.php");
$Page = new Page("Page Details", 2);

echo $Page->content;

$topic = new help_topic();
$issue = new issue();

		?>
		<script>
			$().ready(function() {
				$("#createTopic").validate({
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
		<form action="list_topics.php?action=create" id="createTopic" method="post">
			<div class="form_group">
				<label for='name'>Name:</label>
				<input type='text' class='textz' name='name'  />
			</div>
			<div class="form_group">
				<label for='active'>Active:</label>
				<select name='active' class='textz'>
					<option value='1'>Yes</option>
					<option value='0'>No</option>
				</select>
			</div>
			<div class="form_group">
				<label for="parent_id">Parent:</label>
				<select name="parent_id" class="textz">
					<?php $topic->buildTopicList();?>
				</select>
			</div>			
			<div class="form_group">
				<input type='submit' class='butten' value='submit' />
			</div>
		
		
		
		<?php
		
		echo "</form>";
		echo "</div>";
