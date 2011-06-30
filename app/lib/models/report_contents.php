<?php

function legit_json_decode($json) {
	return json_decode($json, true);
}

class ReportContents extends ModelBase {
	protected $belongs_to = array("report");
	protected $on_save = array("data" => "json_encode");
	protected $on_restore = array("data" => "legit_json_decode");
	
	
	public static $data_crud = array( 2, 4, 5, 7, 9, 10, 11 );
}