<?php require_once('lib/init.php');

expects(array("prev" => "string?", "next" => "string?"));
$report = Report::get();

if($params['prev'] || $params['next']) {
	expects(array("basics" => "array", "date" => "string"));
	foreach($params['basics'] as $k=>$v) {
		$report->$k = $v;
	}
	$date = date_parse($params['date']);
	$report->created_at = mktime($date['hour'], $date['minute'], $date['second'], $date['month'], $date['day'], $date['year']);
	$report->save();
	
	if($params['next']) {
		redirect("edit_report_" . $report->nextContentsAfter(1) . ".php?report_id=" . $report->id);
	}
}

view("edit/1", array("report" => $report));