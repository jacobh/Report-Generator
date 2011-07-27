<?php

if(!isset($_SESSION['pass']) || $_SESSION['pass'] !== $config['login']['pass']) {
	expects(array( "user" => "string?", "pass" => "string?" ));
	if($params["user"] !== NULL || $params["pass"] !== NULL) {
		if($params["user"] === $config["login"]["user"] && $params["pass"] === $config["login"]["pass"]) {
			$_SESSION["pass"] = $config["login"]["pass"];
			redirect($_SERVER['REQUEST_URI']);
		} else {
			view("login", array("error" => true), false);
		}
	} else {
		view("login", array(), false);
	}
}