<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Rising / Penetrating Dampness Inspection</h3>
	<hr />
	<form method="post">
		<div class="form_fields">
			<input type="hidden" name="report_id" value="<?php h($report->id) ?>">
			<input type="hidden" name="section" value="4">
		
			<label>Opening Paragraph</label>
			<textarea name="data[damp_inspec_opening_paragraph]"><?php if($data['damp_inspec_opening_paragraph']): h($data['damp_inspec_opening_paragraph']) ?><?php else: ?>A visual inspection of the exterior of the property was undertaken to identify any obvious defects which could be a contributory factor to any areas requiring specific attention as detailed in the client's instructions, such as faulty rainwater goods, broken/missing roof tiles, cracked brickwork or rendering or high exterior ground levels.
				<?php endif; ?>
			</textarea>
		
			<label>External Observations</label>
			<textarea name="data[damp_inspec_external_observations]"><?php h($data['damp_inspec_external_observations']) ?></textarea>
		
			<label>Moisture Infobox</label>
			<textarea name="data[damp_inspec_moisture_infobox]"><?php if($data['damp_inspec_moisture_infobox']): h($data['damp_inspec_moisture_infobox']) ?><?php else: ?>Moisture profiles are the most effective non destructive method of establishing the cause of dampness in buildings, electrical resistance of the materials are measured using a conductivity meter, along with sub surface measurements, the results are recorded on a chart and the patterns analysed, and along with any other significant findings a diagnosis is reached, when the results are inconclusive we will recommend further tests, the most common being salt analysis.
				<?php endif; ?>
			</textarea>

			<label>Internal Observations</label>
			<textarea name="data[damp_inspec_internal_observations]"><?php h($data['damp_inspec_internal_observations']) ?></textarea>
		</div>
	
		<?php include "edit_nav.php" ?>
	</form>
</div>