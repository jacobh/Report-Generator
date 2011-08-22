		<div class="form_fields">		
			<label>Opening Paragraph</label>
			<?php render_edit_control("textarea", "data[damp_inspec_opening_paragraph]",
				$data['damp_inspec_opening_paragraph'], $defaults['damp_inspec_opening_paragraph']) ?>
			
			<?php if($edit_ctx): ?>
				<label>External Observations</label>
				<textarea name="data[damp_inspec_external_observations]"><?php h($data['damp_inspec_external_observations']) ?></textarea>
			<?php endif; ?>
		
			<label>Moisture Infobox</label>
			<?php render_edit_control("textarea", "data[damp_inspec_moisture_infobox]",
				$data['damp_inspec_moisture_infobox'], $defaults['damp_inspec_moisture_infobox']) ?>
			
			<?php if($edit_ctx): ?>
				<label>Internal Observations</label>
				<textarea name="data[damp_inspec_internal_observations]"><?php h($data['damp_inspec_internal_observations']) ?></textarea>
			<?php endif; ?>
		</div>