<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Timber Survey</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->Write(0, $data['timber_serv_opening_paragraph']);
$pdf->Ln(16);

foreach($data['timber_surv_observations'] as $observation) {
	$pdf->SetFontSize(14);
	$pdf->WriteHTML("<b> " . htmlspecialchars($observation['type']) . "</b>");
	$pdf->Ln(4);
	$pdf->SetFontSize(11);
	$pdf->Write(0, $observation['description']);
	$pdf->Ln(16);
}