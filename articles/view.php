<?php 

include("../global.php");
$Page = new Page("View Articles");

echo $Page->content;
$art = new article();

$art->catch_action();
$articles = $art->view();

?>
<script>
$(function() {
	$("#accordion").accordion();
});
</script>

	<div class='formz' >
		<div class="displayTitle top">
		<h2>Welcome to my world....</h2>
		</div>
		
	<?php 
	
	if( $Sess->logged_in == 1 ) {
		$access = 1;
		$level = $Mem->getLevel($Sess->username);
	
		if( $level <= 2 ) {
	
	?>
	<a href="<?php echo WS_ARTICLES;?>create.php">Create an article</a><p />
	<?php
		}
	}
	?>
	<div id="accordion">
	<?php
	
	foreach($articles as $key=>$value) {
		if( $value['active'] == 1) {
	?>
			<h3><a href="#"><?php echo $value['title'];?></a></h3>
		<div>	
			<p><?php echo $value['author'] . ' ' . date('m-d-Y',$value['createdDate']);?></p>
			<p><?php echo $value['content'];?>
			<?php if( $access === 1 ) {
				echo "<a href=\"" . WS_ARTICLES . "edit.php?id=". $value['id'] ."\">edit</a>";
			}
			?>
			</p>
		</div>
	<?php
		}
	}
	?>
	</div>
</div>	
