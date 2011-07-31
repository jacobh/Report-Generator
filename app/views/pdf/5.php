<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Condensation Report</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->SetFontSize(11);
$pdf->Ln(4);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 167, 143);
$paddings = $pdf->getCellPaddings();
$pdf->setCellPaddings(2, 2, 2, 2);
$pdf->MultiCell(0, 0, trim($data['conden_rep_opening_information']), 0, 1, 'L', 1);
$pdf->Ln(12);
$pdf->setCellPaddings($paddings['L'], $paddings['T'], $paddings['R'], $paddings['B']);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(96, 96, 96);
$pdf->Cell(0, 0, "Relative Humidity Readings", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(0, $data['conden_rep_relative_humidity_readings_information']);
$pdf->Ln(16);

// table header
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 167, 143);
foreach(array("Room" => 45, "Air Temperature" => 45, "Relative Humidity" => 45, "Dew Point" => 45) as $t=>$w) {
	$pdf->Cell($w, 7, $t, 0, 0, $t == "Room" ? 'L' : 'R', 1);
}
$pdf->Ln();

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
foreach($data['conden_rows'] as $row) {
	foreach(array("name" => 45, "temp" => 45, "humidity" => 45, "dew_point" => 45) as $t=>$w) {
		$pdf->Cell($w, 7, $row[$t], 0, 0, $t == "name" ? 'L' : 'R', 1);
	}
	$pdf->Ln();
}	
$pdf->Ln(12);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(96, 96, 96);
$pdf->Cell(0, 0, "Conclusion", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(0, $data['conden_rep_conclusion']);
$pdf->Ln(16);