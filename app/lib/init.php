<?php

session_start();

if(!file_exists("config.php")) {
	header("Location: install.php");
	exit;
}
require_once 'config.php';
date_default_timezone_set($config['timezone']);

error_reporting(E_ALL ^ E_NOTICE);

require_once 'helpers.php';

foreach(glob("lib/deps/*.php") as $dep)
	require $dep;
	
require_once 'models/base.php';
foreach(glob("lib/models/*.php") as $filter)
	require_once $filter;
	
foreach(glob("lib/filters/*.php") as $filter)
	require $filter;