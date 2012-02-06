<?php

class db {

	// I'll admit, this class is ripped off from the PhpQuickProfiler example
	// Since it's more or less how I would've written it, I didn't see a point to do so
	// Major thanks to ParticleTree for creating the PQP to begin with (particletree.com)
	//
	public $queryCount = 0;
	public $queries = array();
	public $conn;

	private $host = DB_HOST;			
	private $user = DB_USER;	
	private $password = DB_PASSWORD;	
	private $database = DB_NAME;	

	function __construct() {
		$this->connect(TRUE);
		$this->changeDatabase($this->database);
	}
	
	function connect($new = false) {
		$this->conn = mysql_connect($this->host, $this->user, $this->password, $new);
		if(!$this->conn) {
			return FALSE;
		}
	}

	function changeDatabase($database) {
		$this->database = $database;
		if($this->conn) {
			if(!mysql_select_db($database, $this->conn)) {
				return FALSE;
			}
		}
	}

	function lazyLoadConnection() {
		$this->connect(true);
		if($this->database) $this->changeDatabase($this->database);
	}

	function query($sql) {
			if(!$this->conn) $this->lazyLoadConnection();
			$start = $this->getTime();
			$rs = mysql_query($sql, $this->conn);
			$this->queryCount += 1;
			$this->logQuery($sql, $start);
			if(!$rs) {
				return FALSE;
			}
			return $rs;
	}
		
	function logQuery($sql, $start) {
		$query = array(
				'sql' => $sql,
				'time' => ($this->getTime() - $start)*1000
			);
		array_push($this->queries, $query);
	}
	
	function getTime() {
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$start = $time;
		return $start;
	}
	
	public function getReadableTime($time) {
		$ret = $time;
		$formatter = 0;
		$formats = array('ms', 's', 'm');
		if($time >= 1000 && $time < 60000) {
			$formatter = 1;
			$ret = ($time / 1000);
		}
		if($time >= 60000) {
			$formatter = 2;
			$ret = ($time / 1000) / 60;
		}
		$ret = number_format($ret,3,'.','') . ' ' . $formats[$formatter];
		return $ret;
	}
	
	function __destruct()  {
		@mysql_close($this->conn);
	}

}
