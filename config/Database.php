<?php 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=utf-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With, X-Auth-User ");

	date_default_timezone_set("Asia/Manila");

	define("USER", "root");
	define("DB", "db_brgycovidtracker");
	define("PWORD", "");
	define("HOST", "localhost");
	define("CHARSET", "utf8");

	$conString = "mysql:host=".HOST.";dbname=".DB.";charset=".CHARSET;
	$options = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		\PDO::ATTR_EMULATE_PREPARES => false
	];

	$pdo = new \PDO($conString, USER, PWORD, $options);
?>