<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Index</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);

$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(1, 4);

$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFontSize(14);
$pdf->Cell(40, 7, "Page", 0, 0, "L", 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(2, 4);

$pdf->SetFillColor(96, 96, 96);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFontSize(14);
$pdf->Cell(135, 7, "Subject", 0, 0, "L", 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('', 'B');
$pdf->SetFontSize(12);

$pdf->Ln(12);

foreach($sectionPages as $p) {
	$pdf->Cell(1, 4);
	$pdf->Cell(40, 7, $p["page"], 0, 0, "L", 1);
	$pdf->Cell(2, 4);
	$pdf->Cell(135, 7, $p["subject"], 0, 0, "L", 1);
	$pdf->Ln(12);
}