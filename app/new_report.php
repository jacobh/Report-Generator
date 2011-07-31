<?php require_once("lib/init.php");

redirect("edit_report.php", array("report_id" => Report::create()->id, "section" => 1));