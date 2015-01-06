<?php
	CONST DBADDR = "mysql_server_address";
	CONST DBNAME = "Database Name";
	CONST DBUSER = "Database User";
	CONST DBPASS = "Datebase Password";
	
	$connection = mysql_connect(DBADDR, DBUSER, DBPASS);
	if (!$connection) die('Could not connect: ' . mysql_error());
	$db = mysql_select_db(DBNAME, $connection);
	if (!$db) die('Could not select_db: ' . mysql_error());
	
	function dbQuery($query, $return=true) {
		global $connection;
		$result = mysql_query($query, $connection);
		if (!$result) die('Could not query: ' . mysql_error());
		if ($return) return mysql_fetch_assoc($result);
	}

?>