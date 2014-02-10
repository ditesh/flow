<?php

require_once "includes.php";

$echoval = 0;
$username = $_POST["username"];
$password = $_POST["password"];

if (strlen($username) > 0 && strlen($password) > 0) {

	$u = $DB->qstr($username);
	$p = $DB->qstr($password);
	$rs = $DB->Execute("SELECT * FROM users WHERE username=$u AND password=$p LIMIT 1");

	if ($rs->fields["username"] === $username)
		$echoval = 1;

	@session_start("fold");
	$_SESSION["user"] = $rs->fields;
	session_write_close();

}

echo json_encode(array(
	"status"=>$echoval
	));

?>
