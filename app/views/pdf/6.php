<?php

$pdf->writeHTMLCell(0, 0, '', '', '<table width="100%">
	<tr>
		<td width="80%"><span style="color:rgb(0, 167, 143); font-size:18pt; font-weight:bold;"><br/><br/>Sketch Plan</span></td>
		<td><img src="assets/logo.png" /></td>
	</tr>
</table>
<hr />', 0, 1, 0, true, '', true);
$pdf->Ln(4);
if(is_numeric($data['sketch'])) {
	$pdf->writeHTMLCell(0, 0, '', '', '<img src="upload/' . $data['sketch'] . '" />', 0, 1, 0, true, '', true);
}