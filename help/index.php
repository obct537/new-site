<?php 

include("../global.php");
$Page = new Page("View Help Systems");

echo $Page->content;

$topic = new help_topic();
$topics = $topic->view();

?>

	<div class='formz' >
		
	<?php 
	foreach($topics as $key=>$value) {
		if( $value['active'] == 1) {
	?>
			<h3><a href="<?php echo WS_HELP . "topic.php?id=" . $value['id'];?>"><?php echo $value['name'];?></a></h3>
	<?php
		}
	}

	if( $Sess->logged_in == 1 ) {
		$access = 1;
		$member = $Mem->getSingle($Sess->userid);
		$level = $member['level'];
	
		if( $level <= 2 ) {
	
?>
	<br />
	<br />
	<a href="<?php echo WS_HELP;?>create.php">Create an article</a>
	<?php
		}
	}
?>
</div>
