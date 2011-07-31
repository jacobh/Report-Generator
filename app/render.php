<?php require_once("lib/init.php");

$report = Report::get();
expects(array("section" => "int?"));

class ReportPDF extends TCPDF {
	public function _setup() {
		$this->setPrintHeader(false);
		$this->setPrintFooter(true);
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->setImageScale(1.4);
		$this->setFontSubsetting(true);
		
		$this->SetFont('helvetica', '', 14, '', true);
	}
	public function Footer() {
		global $report;
		// Position at 15 mm from bottom
		$this->SetY(-15);
		$content3 = $report->find_contents(3);
		if($content3 !== NULL) {
			$client_ref = $content3->data['client_ref'];
		}
		// Page number
		$this->writeHTMLCell(0, 0, '', '', "
			<hr /><br /><table width=100% style='font-size:16pt'><tr><td align=left>REPORT REFERENCE: ".htmlspecialchars($client_ref)."</td><td width='50%' align='right'><p align=right>PAGE ".$this->getAliasNumPage()." OF ".$this->getAliasNbPages()."</p></td></tr></table>
		", 0, 1, 0, true, '', true);
	}
}

$pdf = new ReportPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->_setup();

$pdf->AddPage();
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', render("pdf/front", array( "report" => $report ), false), $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

foreach(explode(",", $params['section'] ? $params['section'] : $report->contents) as $cid) {
	$_contents = $report->find_contents($cid);
	$pdf->AddPage();
	$data = $_contents->data;
	require "views/pdf/$cid.php";
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
header("Content-Type: application/pdf");
$pdf->Output();