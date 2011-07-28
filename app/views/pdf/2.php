<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Introduction</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['introduction_opening_paragraph']);
$pdf->Ln(16);

$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> About The Survey</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['introduction_about_the_survey']);
$pdf->Ln(16);

$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> Methodology</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['introduction_methodology']);
$pdf->Ln(16);

$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> The Report</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['introduction_the_report']);
$pdf->Ln(16);

$pdf->SetFontSize(14);
$pdf->WriteHTML("<b> Findings/Recommendations</b>");
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['introduction_findings_recomendations']);