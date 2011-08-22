<?php require_once("lib/init.php");

expects(array("page" => "int?", "goto" => "int?"));
if(!$params["page"]) {
	if($params["goto"]) {
		redirect("settings.php", array("page" => $params["goto"]));
	} else {
		view("settings");
	}
} elseif(isset(Report::$contents_ids[$params["page"]])) {
	expects(array("data" => "array?"));
	$def = _Default::find_by_section($params["page"]);
	if($def === NULL) {
		$def = _Default::create(array("section" => $params["page"], "data" => array()));
	}
	$data = $def->data !== NULL ? $def->data : array();
	if(is_array($params["data"])) {
		foreach($params["data"] as $k=>$v) {
			$def->data[$k] = $v;
		}
		$data = $def->data;
		$def->save();
	}
	if($params["goto"]) {
		redirect("settings.php", array("page" => $params["goto"]));
	} else {
		view("settings", array("page" => $params["page"], "data" => $data));
	}
} else {
	redirect("settings.php");
}