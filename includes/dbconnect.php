<?php

$DB = new db();

if( $DB->connect() ) {
	errorBox("Database Error");
	Console::log(mysql_error());
}

if( $DB->changeDatabase(DB_NAME) ) {
	errorBox("Database Error");
}