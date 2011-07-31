<?php require_once("lib/init.php");

$report = Report::get();

$img = imagecreatefrompng("assets/thumb.png");
$font = 1;
imagestring($img, $font, (imagesx($img)-(imagefontwidth($font)*strlen($report->client_name))) / 2, 108, $report->client_name, 0);
imagestring($img, $font, (imagesx($img)-(imagefontwidth($font)*strlen($report->street_address))) / 2, 126, $report->street_address, 0);
$d = date("d/m/Y", $report->created_at);
imagestring($img, $font, (imagesx($img)-(imagefontwidth($font)*strlen($d))) / 2, 144, $d, 0);


header("Content-Type: image/png");
imagepng($img);
imagedestroy($img);