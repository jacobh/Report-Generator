<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Property Information &amp; Instructions</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->Cell(0, 0, 'Instructing Client(s)                              ', 0, 1, 'R', 1);
$pdf->Ln();
if(is_numeric($data['photo'])) {
	$pdf->Image("upload/$data[photo]", 15, 45, ($pdf->getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT) / 2, '', '', '', '', 'L');
}
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFontSize(11);
$pdf->writeHTMLCell(0, 0, ($pdf->getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT) / 2 + 20, 45, "
	<table>
		<tr>
			<td><strong>Name:</strong></td>
			<td>" . htmlspecialchars($report->client_name) . "</td>
		</tr>
		<tr>
			<td><strong>Address:</strong></td>
			<td>" . htmlspecialchars($report->street_address) . "</td>
		</tr>
		<tr>
			<td><strong>Date:</strong></td>
			<td>" . date("d/m/Y", $report->created_at) . "</td>
		</tr>
		<tr>
			<td><strong>Reference:</strong></td>
			<td>" . htmlspecialchars($data['client_ref']) . "</td>
		</tr>
	</table>", 0, 2);
$pdf->Ln(4);
$pdf->writeHTMLCell(0, 0, ($pdf->getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT) / 2 + 20, '', "
	<table>
		<tr>
			<td><strong>Date of Survey:</strong></td>
			<td>" . date("d/m/Y", $report->created_at) . "</td>
		</tr>
		<tr>
			<td><strong>Weather Condition:</strong></td>
			<td>" . htmlspecialchars($data['weather']) . "</td>
		</tr>
		<tr>
			<td><strong>Thickness of Walls:</strong></td>
			<td>" . htmlspecialchars($data['wall_thickness']) . "</td>
		</tr>
		<tr>
			<td><strong>Type of Survey:</strong></td>
			<td>" . htmlspecialchars($data['survey_type']) . "</td>
		</tr>
		<tr>
			<td><strong>Surveyor:</strong></td>
			<td>" . htmlspecialchars($data['surveyer']) . "</td>
		</tr>
	</table>
", 0, 2);
$pdf->SetY(50 + ($pdf->getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT) / 2);

$pdf->SetFontSize(14);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(0, 0, "Re: $report->street_address $report->city $report->postcode", 0, 1, 'L', 1);
$pdf->Ln(4);

foreach(array(
		'prop_descr' => "Property Description",
		'clients_instructions' => "Client's Instructions",
		'point_of_reference' => "Point of Reference",
		'nomenclature' => "Nomenclature",
		'limitations' => "Limitations/Restrictions"
	) as $sect=>$title) {
	$pdf->SetFontSize(14);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->SetFillColor(96, 96, 96);
	$pdf->Cell(0, 0, $title, 0, 1, 'L', 1);
	$pdf->Ln(4);
	$pdf->SetFontSize(11);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->Write(0, $data[$sect]);
	$pdf->Ln(10);
}