<?php

//Client side info
define('WS_URL'		, 'http://www.obct537.com/');
define('WS_INCLUDES'	, WS_URL . 'includes/');
define('WS_JAVASCRIPT'	, WS_INCLUDES . 'javascript');
define('WS_IMAGES'	, WS_URL . 'img/');

//Server side info
define('FS_PATH'	, '/path/to/root');
define('FS_INCLUDES'	, FS_PATH . 'includes/');
define('FS_FUNCTIONS'	, FS_INCLUDES . 'functions/');
define('FS_CLASSES'	, FS_INCLUDES . 'classes/');
define('FS_SNIPPETS'	, FS_INCLUDES . 'snippets/');

//database
define('DB_USER'	, '');
define('DB_PASSWORD'	, '');
define('DB_HOST' 	, '');
define('DB_NAME'	, '');

//PQP
define('DEBUG'		, 'off');

//Email
define('MAIL_FROM'	, 'obct537@gmail.com');

//Directories
define('WS_EDITOR' 	, WS_URL . "editor/");
define('WS_ARTICLES'	, WS_URL . "articles/");
define('WS_MEMBERSHIP'	, WS_URL . "membership/");
define('WS_TITLES'	, WS_URL . "titles/");
define('WS_HELP'	, WS_URL . "help/");
define('WS_DENIED'	, WS_URL . "denied.php");

//templates
define('TPL_URL'	, WS_URL . '/templates/default/');
define('TPL_DIR'	, FS_PATH . '/templates/default/');
define('TPL_START'	, TPL_DIR . 'start.php');
define('TPL_STOP'	, TPL_DIR . 'stop.php');
define('TPL_STYLES'	, TPL_URL . 'styles/');
define('TPL_IMAGES'	, TPL_URL . '/images/');

//tables
define('DB_TBL_MEMBERS'	, 'users');
define('DB_TBL_SESSIONS', 'sessions');
define('DB_TBL_PAGES'	, 'pages');
define('DB_TBL_ARTICLES', 'articles');
define('DB_TBL_TITLES'	, 'titles');
define('DB_TBL_ISSUES'	, 'help_issues');
define('DB_TBL_TOPICS'	, 'help_topics');
define('DB_TBL_ACTIVATE', 'user_activations');

define('COOKIE_PATH'	, '/');
define('COOKIE_DOMAIN'	, '.obct537.com');
define('COOKIE_TIMEOUT'	, '3600'); //in seconds

