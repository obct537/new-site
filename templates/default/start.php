<?php 

if(!isset($Sess)) {
	global $Sess;

}
global $Mem;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="stylesheet" type="text/css" href="<?php echo TPL_STYLES;?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo WS_JAVASCRIPT;?>/jqueryui/css/custom-theme/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo WS_JAVASCRIPT;?>/jquery-validation-1.9.0/jquery.validate.min.js" />
	<script src="<?php echo WS_URL; ?>/includes/javascript/js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script src="<?php echo WS_URL; ?>/includes/javascript/jqueryui/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<title>obct537 | <?php echo $newTitle['title'];?></title>
		<?php includeMCE(); ?>

</head>


<body>

<div id="topBar">
	<div id="topMenu">
		<a class="simplea" href="<?php echo WS_URL;?>">
			<h2 class="title">
				<div>
					<p>obct537.com</p>
				</div>
			</h2>
		</a>

		<?php		

			if( $Sess->logged_in == 1 ) { 
				$name = new Member($Sess->userid);
			?>
			
			<form action='?action=logout' method='post'>
				<input type='submit' name='logout' class='topLogin' value='Logout'>
			</form>
			<ul class="login"/>
				<li>
			
				<p class="welcome">Welcome, <a href="<?php echo WS_MEMBERSHIP;?>info.php"> 
				<?php echo $Sess->username;?></a></p>
				</li>
				</ul>

				<?php
			}elseif ( $Sess->logged_in == 0 ) {
			?>
				<form action="<?php echo WS_MEMBERSHIP;?>login.php" method='post'>
					<input type='submit' name='logout' class='topLogin' value='Login'>
				</form>
				
						
				</li>
			</ul>
			<?php
			}
			?>

		<ul class="navbar">
			<li><a class="simplea" href="<?php echo WS_ARTICLES;?>view.php">Blog</a></li>
			<li><a class="simplea" href="<?php echo WS_HELP?>">Info</a></li>
			<li><a class="simplea" href="<?php echo WS_URL;?>">Home</a></li>
		</ul>
</div>

<div id="wrapper">
	<div id="contentBox">
				
			
