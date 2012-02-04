<?php 

include("../global.php");
$Page = new Page("Page Details");

includeMCE();
echo $Page->content;

$art = new article();

$id = isset($_GET['id'])? $_GET['id']:FALSE;

$article = $art->getSingle($id);

?>

<div class='formz'>
	<div class='displayTitle'>
		<h2>Talk about stuff</h2>
	</div>
	<form action="view.php?action=edit&id=<?php echo $article['id'];?>" method="post">
		<label for='name'>Article Name:</label>
		<input type='text' class='textz' name='title' value='<?php echo $article['title'];?>' />
		<label for='active'>Active:</label>
		<select name='active' class='textz' value='<?php echo $article['active'];?>'>
			<option value='1'>Yes</option>
			<option value='0'>No</option>
		</select>
		<label for='content'>Content:</label>
		<textarea name='content' class='formbox' ><?php echo $article['content'];?></textarea>
		<input type='submit' class='butten' value='submit' />
	</form>
</div>
