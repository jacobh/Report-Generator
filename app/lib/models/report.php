<?php

class Report extends ModelBase {
	public static $contents_ids = array(
		2 => array( "title" => "Introduction", "module" => "introduction" ),
		3 => array( "title" => "Property Information & Instructions", "module" => "information" ),
		4 => array( "title" => "Rising / Penetrating Dampness Inspection", "module" => "dampness" ),
		5 => array( "title" => "Condensation Report", "module" => "condensation" ),
		6 => array( "title" => "Sketch Plan", "module" => "sketch" ),
		7 => array( "title" => "Timber Survey", "module" => "timber" ),
		8 => array( "title" => "Summary & Recommendations", "module" => "summary" ),
		9 => array( "title" => "Your Quote", "module" => "quote" ),
		10 => array( "title" => "Coptionent Health & Safety Data Sheet", "module" => "datasheet" ),
		11 => array( "title" => "Terms & Conditions", "module" => "terms" ),
	);
	
	protected $has_many = array("report_contents");
	
	public function find_contents($section) {
		foreach($this->report_contents as $c) {
			if($c->type == $section) {
				return $c;
			}
		}
		return NULL;
	}
	
	public function nextContentsAfter($id) {
		$carr = explode(",", $this->contents);
		foreach($carr as $next) {
			if($next > $id) {
				return $next;
			}
		}
		return NULL;
	}
	
	public function prevContentsBefore($id) {
		$carr = explode(",", $this->contents);
		$ret = 1;
		foreach($carr as $next) {
			if($next >= $id) {
				return $ret;
			}
			$ret = $next;
		}
		return 1;
	}
}