<?php 

include("../global.php");
$Page = new Page("Page Details", 1);

includeMCE();
echo $Page->content;

$id = (isset($_GET['id']))? $_GET['id']:FALSE;

$title = new title();
$oldTitle = $title->getSingle($id);

?>

<div class='formz'>
	<div class='displayTitle'>
		<h2>Edit title</h2>
	</div>
	<form action="list.php?action=edit&id=<?php echo $oldTitle['id'];?>" method="post">
		<label for='name'>Title:</label>
		<input type='text' class='textz' name='title' value='<?php echo str_replace("'", "&#39;", $oldTitle['title']);?>' />
		<label for='active'>Active:</label>
		<select name='active' class='textz' value='<?php echo $oldTitle['active'];?>'>
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
		<input type='submit' class='butten' value='submit' />

	</form>
</div>
