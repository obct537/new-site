<?php

$DB = new db(DB_HOST,DB_USER,DB_PASSWORD);

if( $DB->connect() ) {
	errorBox("Database Error");
	Console::log(mysql_error());
}

if( $DB->changeDatabase(DB_NAME) ) {
	errorBox("Database Error");
}