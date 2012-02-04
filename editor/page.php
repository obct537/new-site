<?php 

include("../global.php");
$Page = new Page("Page Details", 1);

includeMCE();
echo $Page->content;
$id = (isset($_GET['id']))? $_GET['id']:FALSE;
$page = new page();

$pagez = $page->getSingle($id);

?>

<div class='formz'>
<div class='displayTitle'>
<h2>Talk about stuff</h2>
</div>
<form action="list.php?action=edit&id=<?php echo $pagez['id'];?>" method="post">
	<label for='name'>Page Name:</label>
	<input type='text' class='textz' name='name' value='<?php echo $pagez['name'];?>' />
	<label for='active'>Active:</label>
	<select name='active' class='textz' value='<?php echo $pagez['active'];?>'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>
	</select>
	<label for='content'>Content:</label>
	<textarea name='content' class='formbox' ><?php echo $pagez['content'];?></textarea>
	<input type='submit' class='butten' value='submit' />



<?php

echo "</form>";
echo "</div>";
