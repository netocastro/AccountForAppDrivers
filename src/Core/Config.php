<?php

session_start();

define("BASE_PATH", "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? 's' : '') . "://{$_SERVER['HTTP_HOST']}/development/2021/AccountForAppDrivers");

define("LENGUAGE", "pt-br");
define("CHARACTER_ENCODING", "utf-8");

define('DATA_LAYER_CONFIG', [
	'driver' => 'mysql',
	'host' => 'localhost',
	'port' => '3306',
	'dbname' => 'uber_2021',
	'username' => 'root',
	'passwd' => '',
	'options' => [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::ATTR_CASE => PDO::CASE_NATURAL,
	],
]);
