	<div class="form_fields">
		<h4>Instructing Client(s)</h4>
		<?php if($edit_ctx): ?>
			<label>Photo</label>
				<?php if(isset($data['photo'])): ?>
					<img src="file.php?file_id=<?php h($data['photo']) ?>" width="200" height="200" /><br />
				<?php endif; ?>
				<input name="photo" type="file" />
			<!--name, address and date can probably be grabbed from the front page and placed in here, they should be the same-->
			<label>Name</label>
				<input name="other_data[1][client_name]" type="text" value="<?php h($report->client_name) ?>"/>
			<label>Address</label>
				<input name="other_data[1][street_address]" type="text" value="<?php h($report->street_address) ?>"/>
				<input name="other_data[1][city]" type="text" value="<?php h($report->city) ?>"/>
				<input name="other_data[1][postcode]" type="text" value="<?php h($report->postcode) ?>"/>
			<label>Reference</label>
				<input name="data[client_ref]" type="text" value="<?php h(isset($data['client_ref']) ? $data['client_ref'] : 'Amb/review') ?>" />
			<hr />
			<label>Date of Survey</label>
				<input name="date" type="text" value="<?php echo date("Y-m-d H:i:s", $report->created_at); ?>" />
			<label>Weather Condition</label>
				<input name="data[weather]" type="text" value="<?php h($data['weather']) ?>" />
			<label>Thickness of Walls</label>
				<input name="data[wall_thickness]" type="text" value="<?php h($data['wall_thickness']) ?>" />
			<label>Type of Survey</label>
				<input name="data[survey_type]" type="text" value="<?php h($data['survey_type']) ?>" />
		<?php endif; ?>
			<label>Surveyor</label>
				<input name="data[surveyer]" type="text" value="<?php h(isset($data['surveyer']) ? $data['surveyer'] : 'Bryan Campbell C.S.R.T.') ?>" />
			<hr />	
		<?php if($edit_ctx): ?>
			<label>Property Description</label>
				<textarea name="data[prop_descr]"><?php h($data['prop_descr']) ?></textarea>
			<label>Clients Instructions</label>
				<textarea name="data[clients_instructions]"><?php h($data['clients_instructions']) ?></textarea>
			<label>Point of Reference</label>
				<textarea name="data[point_of_reference]"><?php h($data['point_of_reference']) ?></textarea>
		<?php endif; ?>
			<label>Nomenclature</label>
			<?php render_edit_control("textarea", "data[nomenclature]",
				$data['nomenclature'], $defaults['nomenclature']) ?>
			<label>Limitations/Restrictions</label>
			<?php render_edit_control("textarea", "data[limitations]",
				$data['limitations'], $defaults['limitations']) ?>
	</div>