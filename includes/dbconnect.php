<?php

	$conn = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD) or die     ('Error connecting to mysql');
	
	mysql_select_db(DB_NAME);