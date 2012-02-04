<?php 

include("../global.php");
$Page = new Page("Page Details");

echo $Page->content;

$topic = new help_topic();
$issue = new issue();

if( $Sess->logged_in == 1 ) {

	$level = $Mem->getLevel($Sess->username);
	
	if( $level <= 2 ) {
		$id = (isset($_GET['id']))? $_GET['id']:FALSE;
	
	
		//This stuff is out of the normal order...just being a bit paranoid
		$action = isset($_GET['action']) ? $_GET['action']:FALSE;
		
		if( $action == "create" ) {
		
			$accept = array('name' => 1, 'active' => 1, 'parent_id'=>1);
			$Info = array();
		
		
			foreach( $_POST as $key=>$value ) {
				if( array_key_exists($key, $accept) ) {
					
					$Info[$key] = stripslashes($value);
					
				}
			}
			
			
			if( $topic->create($Info) ) {
				successBox("Help topic created.");
			}else{
				errorBox("There was a problem, please try again.");
			}
		}

		?>
		
		<div class='formz'>
		<div class='displayTitle'>
		<h2>TYPE NOW FOOL</h2>
		</div>
		<form action="?action=create" method="post">
			<div class="form_group">
				<label for='name'>Name:</label>
				<input type='text' class='textz' name='name'  />
			</div>
			<div class="form_group">
				<label for='active'>Active:</label>
				<select name='active' class='textz'>
					<option value='1'>Yes</option>
					<option value='0'>No</option>
				</select>
			</div>
			<div class="form_group">
				<label for="parent_id">Parent:</label>
				<select name="parent_id" class="textz">
					<?php $topic->buildTopicList();?>
				</select>
			</div>			
			<div class="form_group">
				<input type='submit' class='butten' value='submit' />
			</div>
		
		
		
		<?php
		
		echo "</form>";
		echo "</div>";

		
	}else{
		errorBox("Access Denied");
	}
}else{
	errorBox("Access denied");
}
