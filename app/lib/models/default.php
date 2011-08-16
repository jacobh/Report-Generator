<?php

class _Default extends ModelBase {
	protected $on_save = array("data" => "json_encode");
	protected $on_restore = array("data" => "legit_json_decode");

	public static $sections = array();
	public static function load($section) {
		if(!isset($sections[$section])) {
			$m = _Default::find_by_section($section)->data;
			$sections[$section] = $m;
		}
		return $sections[$section];
	}
}