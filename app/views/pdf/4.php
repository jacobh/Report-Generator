<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Rising / Penetrating Dampness Inspection</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['damp_inspec_opening_paragraph']);

$pdf->Ln(4);
$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> External Observations</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['damp_inspec_external_observations']);
$pdf->Ln(16);

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 167, 143);
$paddings = $pdf->getCellPaddings();
$pdf->setCellPaddings(2, 2, 2, 2);
$pdf->MultiCell(0, 0, trim($data['damp_inspec_moisture_infobox']), 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->setCellPaddings($paddings['L'], $paddings['T'], $paddings['R'], $paddings['B']);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> Internal Observations</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['damp_inspec_internal_observations']);
$pdf->Ln(16);