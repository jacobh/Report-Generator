<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Summary & Recommendations</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->Cell(0, 0, "Summary", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(0, $data['summ_rec_summary']);
$pdf->Ln(16);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->Cell(0, 0, "Recommendations", 1, 1, 'L', 1);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);


$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 167, 143);
$pdf->Cell(40, 7, "Item Ref.", 0, 0, 'L', 1);
$pdf->Cell(140, 7, "Description", 0, 0, 'L', 1);
$pdf->Ln();

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

foreach($data['current_items'] as $item) {
	$pdf->SetFont('', 'B');
	$pdf->Cell(40, 7, $item['id'], 0, 0, 'L', 1);
	$pdf->Cell(140, 7, $item['name'], 0, 0, 'L', 1);
	$pdf->Ln();
	$pdf->SetFont('', '');
	$pdf->Cell(40, 7, "", 0, 0, 'L', 1);
	$pdf->MultiCell(140, 7, $item['description'], 0, 'L');
}

$pdf->Ln();