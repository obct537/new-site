<?php 

include("../global.php");
$Page = new Page("Page Details", 1);

includeMCE();
echo $Page->content;

$title = new title();
?>

<div class='formz'>
	<div class='displayTitle'>
		<h2>Create title</h2>
	</div>
	<form action="list.php?action=create" method="post">
		<label for='name'>Title:</label>
		<input type='text' class='textz' name='title' />
		<label for='active'>Active:</label>
		<select name='active' class='textz'>
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
		<input type='submit' class='butten' value='submit' />


	</form>
</div>
