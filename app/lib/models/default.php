<?php

class _Default extends ModelBase {
	public static $sections = array();
	public static function load($section) {
		if(!isset($sections[$section])) {
			$sections[$section] = self::find_by_section($section);
		}
		return $sections[$section];
	}
}