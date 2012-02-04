<?php 

include("../global.php");
$Page = new Page("View Articles");

echo $Page->content;
$art = new article();


?>

	<div class='formz'>
		<div class="displayTitle top">
		<h2>Look what you've done</h2>
		</div>
		
	<?php 
	
	if( $Sess->logged_in == 1 ) {
		$access = 1;
		$level = $Mem->getLevel($Sess->username);
	
		if( $level <= 2 ) {
		
			$options['where']['author'] = $Sess->username;
			$options['order']['keys'] =array( "createdDate");
			$articles = $art->getAll($options);

	?>
	
	<a href="<?php echo WS_ARTICLES;?>create.php">Create an article</a><p />
	
	<?php
		}
	}
	
	foreach($articles as $key=>$value) {
	?>
	
		<h3 class="underline"><?php echo $value['title'];?></h3>
		<p>
		Active: <?php echo parseYN($value['active']);?>
		<br />
	
		<?php if( $access == 1 ) {
			echo "<a href=\"" . WS_ARTICLES . "edit.php?id=". $value['id'] ."\">edit</a>";
		}
		?>
		</p>
	
	<?php
	}
	?>
		
		
	</div>
