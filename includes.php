<?php

define('ROOT_PATH', dirname(__FILE__));
define('LIB_PATH', ROOT_PATH."/libs");
define('DEBUG_MODE', FALSE);

require_once(LIB_PATH."/adodb/adodb.inc.php");
require_once(LIB_PATH."/render.class.php");
require_once(LIB_PATH."/config.class.php");

global $DB;
global $ADODB_CACHE_DIR;
$ADODB_CACHE_DIR = ROOT_PATH."/adodb/cache";
$DB = NewADOConnection('mysql');
$DB->cacheSecs = 3600*24;

$DB->Connect("127.0.0.1:3306", "fold", "fold", "fold");
$DB->LogSQL();

session_start("fold");
session_write_close();

?>
