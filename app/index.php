<?php require_once('lib/init.php');

$reports = Report::all("updated_at DESC");
view("index", array("reports" => $reports));