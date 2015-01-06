<?php
	session_start();	// if they were logged in...
	session_destroy();	// log them out
	require_once("connection.php");
	$DBoldemail = mysql_real_escape_string(urldecode(strtolower($_GET['oldemail']))); // this is the url-encoded email forced lowercase and escaped
	$DBnewemail = mysql_real_escape_string(urldecode(strtolower($_GET['newemail']))); // so is this, but it's the email the are wanting to change it to
	$userkey = mysql_real_escape_string(urldecode($_GET['userkey']));
	do {
		if(!dbQuery("select email from users where email='$DBoldemail' and userkey='$userkey'") || hash_hmac(sha256, $_GET['newemail'], DBPASS) != $_GET['hmac']){ // if email/userkey or email/hamc mismatch
			$notify = "<font color='red'>url expired or invalid</font>";
			break;
		}
		$userkey = mt_rand(1000000000, 9999999999); // make current url expire
		dbQuery("update users set email='$DBnewemail', userkey='$userkey' where email='$DBoldemail'", false);
		$notify = "<font color='green'>email updated </font><a href='login.php'>login</a>";
	} while(0);
?>

<html>
	<head>
		<title>update email</title>
	</head>
	<body>
		<?php print $notify ?>
	</body>
</html>