<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Client Health & Safety Data Sheet</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);

$pdf->SetFontSize(14);
$pdf->Cell(1, 0, "");
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->MultiCell(177, 7, "Safety Precautions To Be Aware Of Before, During And After Our Proposed Works", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(5, $data['safety_precautions']);
$pdf->Ln(12);


$pdf->SetFontSize(14);
$pdf->Cell(1, 0, "");
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(255, 0, 0);
$pdf->MultiCell(177, 0, "The DO NOTs", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(5, $data['donts']);
$pdf->Ln(12);


$pdf->SetFontSize(14);
$pdf->Cell(1, 0, "");
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 192, 128);
$pdf->MultiCell(177, 0, "The DOs", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(5, $data['dos']);
$pdf->Ln(12);

$pdf->SetFont('', 'B');
$pdf->Write(0, "Should you have any further queries, please do not hesitate to contact our offices");
$pdf->SetFont('', '');