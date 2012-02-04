<?php 

include("../global.php");
$Page = new Page("Page Details", 2);

includeMCE();
echo $Page->content;

?>

<div class='formz'>
	<div class='displayTitle'>
		<h2>Talk about stuff</h2>
	</div>
	<form action="view.php?action=create" method="post">
		<label for='name'>Article Name:</label>
		<input type='text' class='textz' name='title'  />
		<label for='active'>Active:</label>
		<select name='active' class='textz'>
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
		<label for='content'>Content:</label>
		<textarea name='content' class='formbox' ></textarea>
		<input type='submit' class='butten' value='submit' />
	</form>
</div>

