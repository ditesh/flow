<?php

require_once "includes.php";

$echoval = 0;
$username = $_POST["username"];
$password = $_POST["password"];

if (strlen($username) > 0 && strlen($username) < 255 && strlen($password) > 0 && strlen($password) < 255) {

	$u = $DB->qstr($username);
	$p = $DB->qstr($password);
	$rs = $DB->Execute("SELECT * FROM users WHERE username=$u");
	
	if (strlen($rs->fields["username"]) === 0) {

		$record = array();
		$record["username"] = $username;
		$record["password"] = $password;

		$retval = $DB->AutoExecute("users", $record, "INSERT");

		if ($retval) {

			$echoval = 1;
			$rs = $DB->Execute("SELECT * FROM users WHERE username=$u AND password=$p LIMIT 1");
			@session_start("fold");
			$_SESSION["user"] = $rs->fields;
			session_write_close();

		}
	}
}

echo json_encode(array(
	"status"=>$echoval
	));

?>
