<?php

function expects($expects, $redir_to = "index.php") {
	global $params;
	if(!is_array($params)) {
		$params = array();
	}
	
	foreach($expects as $k=>$v) {
		$optional = false;
		if(substr($v, strlen($v) -1, 1) == "?") {
			$optional = true;
			$v = rtrim($v, "?");
		}
		$fn = "is_$v";
		if($v == "int" || $v == "float") {
			$fn = "is_numeric";
		}
		if(!isset($_REQUEST[$k]) || !$fn($_REQUEST[$k])) {
			if(!$optional)
				redirect($redir_to);
			$params[$k] = NULL;
		} else {
			$params[$k] = $_REQUEST[$k];
			settype($params[$k], $v);
		}
	}
}

function view($name, $vars = array(), $use_layout = true) {
	extract($vars);
	error_reporting(E_ALL ^ E_NOTICE);
	if($use_layout) {
		$__page = "views/$name.php";
		include "views/layout.php";
	} else {
		include "views/$name.php";
	}
	exit;
}

function render($name, $vars = array(), $use_layout = true) {
	extract($vars);
	$__level = error_reporting();
	error_reporting(E_ALL ^ E_NOTICE);
	ob_start();
	if($use_layout) {
		$__page = "views/$name.php";
		include "views/layout.php";
	} else {
		include "views/$name.php";
	}
	error_reporting($__level);
	return ob_get_clean();
}

function redirect($uri, $params = array()) {
	if(count($params)) {
		$uri .= "?";
	}
	foreach($params as $k=>$v) {
		$uri .= "&$k=" . urlencode($v);
	}
	header("Location: $uri");
	exit;
}

function h($str) {
	echo htmlspecialchars($str);
}