<?php require_once('lib/init.php');

expects(array("prev" => "string?", "next" => "string?", "section" => "int"));
$report = Report::get();
$viewdata = array("report" => $report);

if($params["section"] == 1) {
	if($params['prev'] || $params['next']) {
		expects(array("basics" => "array", "date" => "string"));
		foreach($params['basics'] as $k=>$v) {
			$report->$k = $v;
		}
		$date = date_parse($params['date']);
		$report->created_at = mktime($date['hour'], $date['minute'], $date['second'], $date['month'], $date['day'], $date['year']);
		$report->save();

		if($params['next']) {
			redirect("edit_report.php", array("report_id" => $report->id, "section" => $report->nextContentsAfter(1)));
		}
	}
} elseif(in_array($params['section'], ReportContents::$data_crud)) {
	expects(array("date" => "string?"));
	if(isset($params['date'])) {
		$date = date_parse($params['date']);
		$report->created_at = mktime($date['hour'], $date['minute'], $date['second'], $date['month'], $date['day'], $date['year']);
		$report->save();
	}
	$data = $report->find_contents($params['section']);
	if($data === NULL) {
		$data = ReportContents::create(array( "report_id" => $report->id, "type" => $params['section'], "data" => array() ));
	}
	$viewdata['data'] = $data->data;
	if($params['prev'] || $params['next']) {
		expects(array("data" => "array", "other_data" => "array?"));
		foreach($params['data'] as $k=>$v) {
			$data->data[$k] = $v;
		}
		foreach($_FILES as $k=>$v) {
			$f = File::upload($k);
			if($f !== NULL) {
				$data->data[$k] = $f->id;
			}
		}
		$data->save();
		if(is_array($params['other_data'])) {
			foreach($params['other_data'] as $cid=>$d) {
				if($cid == 1) {
					foreach($d as $k=>$v) {
						$report->$k = $v;
					}
					$report->save();
				} else {
					$c = $report->find_contents($cid);
					foreach($d as $k=>$v) {
						$data->data[$k] = $v;
					}
					$c->save();
				}
			}
		}
		
		if($params['next']) {
			redirect("edit_report.php", array("report_id" => $report->id, "section" => $report->nextContentsAfter($params['section'])));
		}
		if($params['prev']) {
			redirect("edit_report.php", array("report_id" => $report->id, "section" => $report->prevContentsBefore($params['section'])));
		}
	}
}

view("edit/$params[section]", $viewdata);