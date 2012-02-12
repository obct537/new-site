<?php 

include("../global.php");
$Page = new Page("View Titles", 1);

echo $Page->content;

$title = new title();
$title->catch_action();
$titles = $title->view();
?>

	<div class='formz'>
		<div class="displayTitle top">
		<h2>Titles</h2>
	</div>
	
	<a href="<?php echo WS_TITLES;?>create.php">Create a title</a><p />
	
	<?php
	
	foreach($titles as $key=>$value) {
		if( $value['active'] == 1) {
	?>
	
		<h3 class="underline"><?php echo $value['title'];?></h3>
			
		<?php 
			echo "<a href=\"" . WS_TITLES . "edit.php?id=". $value['id'] ."\">edit</a>";
		?>
		</p>
	
	<?php
		}
	}
	?>
		
		
	</div>
