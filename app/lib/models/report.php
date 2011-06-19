<?php

class Report extends ModelBase {
	public static $contents_ids = array(
		1 => array( "title" => "Introduction", "module" => "introduction" ),
		2 => array( "title" => "Property Information & Instructions", "module" => "information" ),
		3 => array( "title" => "Rising / Penetrating Dampness Inspection", "module" => "dampness" ),
		4 => array( "title" => "Condensation Report", "module" => "condensation" ),
		5 => array( "title" => "Sketch Plan", "module" => "sketch" ),
		6 => array( "title" => "Timber Survey", "module" => "timber" ),
		7 => array( "title" => "Summary & Recommendations", "module" => "summary" ),
		8 => array( "title" => "Your Quote", "module" => "quote" ),
		9 => array( "title" => "Coptionent Health & Safety Data Sheet", "module" => "datasheet" ),
		10 => array( "title" => "Terms & Conditions", "module" => "terms" ),
	);
	
	public function nextContentsAfter($id) {
		$carr = explode(",", $this->contents);
		foreach($carr as $next) {
			if($next > $id) {
				return $next;
			}
		}
		return NULL;
	}
	
	public function previousContentsBefore($id) {
		$carr = explode(",", $this->contents);
		$ret = NULL;
		foreach($carr as $next) {
			if($next >= $id) {
				return $ret;
			}
			$ret = $next;
		}
		return NULL;
	}
}