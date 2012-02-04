<?php 

include("../global.php");
$Page = new Page("View Titles");

echo $Page->content;

$title = new title();
$title->catch_action();
$titles = $title->view();
?>

	<div class='formz'>
		<div class="displayTitle top">
		<h2>Titles</h2>
		</div>
		
	<?php 
	
	if( $Sess->logged_in == 1 ) {
		$access = 1;
		$level = $Mem->getLevel($Sess->username);
	
		if( $level <= 2 ) {
	
	?>
	
	<a href="<?php echo WS_TITLES;?>create.php">Create a title</a><p />
	
	<?php
		}
	}
	
	foreach($titles as $key=>$value) {
		if( $value['active'] == 1) {
	?>
	
		<h3 class="underline"><?php echo $value['title'];?></h3>
			
		<?php if( $access == 1 ) {
			echo "<a href=\"" . WS_TITLES . "edit.php?id=". $value['id'] ."\">edit</a>";
		}
		?>
		</p>
	
	<?php
		}
	}
	?>
		
		
	</div>
