<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Your Quote</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);

$pdf->Ln(4);

$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->MultiCell(84, 0, "Your Details", 0, 1, 'L', 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(10, 0, " ", 0, 0, 'L', 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 0, 0);
$pdf->MultiCell(84, 0, "Our Details", 0, 1, 'L', 0);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Ln(8);

function quoteWriteLineOfTable($t1, $d1, $t2, $d2) {
	global $pdf;
	
	$d1 = trim($d1);
	
	$pdf->SetFont('', 'B');
	$pdf->MultiCell(25, 0, $t1, 0, 1, 'L', 0);
	$pdf->SetFont('', '');
	$pdf->MultiCell(59, 0, $d1, 0, 1, 'L', 0);
	
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->MultiCell(10, 0, " ", 0, 0, 'L', 0);
	
	$pdf->SetFont('', 'B');
	$pdf->MultiCell(25, 0, $t2, 0, 1, 'L', 0);
	$pdf->SetFont('', '');
	$pdf->MultiCell(59, 0, $d2, 0, 1, 'L', 0);
	
	$pdf->Ln(
		max(
			max($pdf->getStringHeight(25, $t1), $pdf->getStringHeight(25, $t2)),
			max($pdf->getStringHeight(59, $d1), $pdf->getStringHeight(59, $d2))) + 1);
}

$other_3_obj = $report->find_contents(3);
if(is_object($other_3_obj)) {
	$other_3 = $other_3_obj->data;
} else {
	$other_3 = array();
}
quoteWriteLineOfTable("Name:", $report->client_name, "Surveyor:", $other_3['surveyer']);
quoteWriteLineOfTable("Address:", $report->street_address . "\n" . $report->city . "\n" . $report->postcode, "Address:", "$data[our_address]\n$data[our_city]\n$data[our_postcode]");
quoteWriteLineOfTable("Quote Date:", date("d/m/Y", $report->created_at), "Company:", $data['our_company']);
quoteWriteLineOfTable("Client Ref:", $other_3['client_ref'], "Telephone:", "$data[our_telephone]");
quoteWriteLineOfTable("Quote Ref:", $data['quote_ref'], "Fax:", "$data[our_fax]");
quoteWriteLineOfTable("", "", "Email:", "$data[our_email]");
$pdf->Ln(4);


$pdf->SetFontSize(14);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(96, 96, 96);
$pdf->Cell(0, 0, "Message from the Surveyor", 0, 1, 'L', 1);
$pdf->Ln(4);
$pdf->SetFontSize(11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFontSize(11);
$pdf->Write(0, $data['message']);
$pdf->Ln(16);


$pdf->SetTextColor(255, 255, 255);
$pdf->SetFillColor(0, 167, 143);
$pdf->Cell(40, 7, "Item Ref.", 0, 0, 'L', 1);
$pdf->Cell(115, 7, "Description", 0, 0, 'L', 1);
$pdf->Cell(25, 7, "Price", 0, 0, 'L', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->Ln();

$other_8_obj = $report->find_contents(8);
$other_8 = $other_8_obj ? $other_8_obj->data : array();

$total = 0;
if(is_array($other_8['current_items'])) {
	foreach($other_8['current_items'] as $item) {
		$pdf->Cell(40, 7, $item['id'], 0, 0, 'L', 1);
		$pdf->Cell(115, 7, $item['name'], 0, 0, 'L', 1);
		$pdf->Cell(25, 7, "£" . (int)$item['price'] . ".00", 0, 0, 'R', 1);
		$total += (int)$item['price'];
		$pdf->Ln();
	}
}

$pdf->Ln(1);

$pdf->SetFontSize(8);
$pdf->SetFont('', 'B');
$pdf->Cell(80, 7, "IMPORTANT NOTES", 0, 0, 'L', 1);
$pdf->SetFontSize(11);
$pdf->Cell(40, 7, "Total Price", 0, 0, 'R', 1);
$pdf->SetFont('', '');
$pdf->Cell(60, 7, "£$total.00", 0, 0, 'R', 1);
$pdf->SetFontSize(8);
$pdf->Ln(5);
$pdf->Cell(80, 1, "All prices are subject to our terms and", 0, 0, 'L', 1);
$pdf->Ln(4);
$pdf->Cell(80, 1, "conditions enclosed in this report", 0, 0, 'L', 1);
$pdf->SetFontSize(11);
$pdf->Ln(4);