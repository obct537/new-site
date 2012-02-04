<?php

if($output = exec('/bin/bash test.sh')){ 
	echo "WINCAKE";
}else{
	echo "FAILCAKE";
}
echo $output;
?>
