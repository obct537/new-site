<?php 

include("../global.php");
$Page = new Page("View Pages", 1);

echo $Page->content;
	
$action = (isset($_GET['action']))? $_GET['action']:FALSE;
$pages = $Page->view();
$Page->catch_action();

echo "<div class='displayBox'>";
echo "<div class='displayTitle'>";
echo "<h2>Pages</h2>";
echo "</div>";
echo "<ul>";

foreach($pages as $key=>$value ) {
	echo "<li><a href=\"" . WS_URL . "/editor/page.php?id=" . $value['id'] . "\">" . $value['name'] . "</a></li>";
}

echo "</ul>";
echo "</div>";
