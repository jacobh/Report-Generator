<?php if($edit_ctx): ?>
	<?php	
		$prop_obj = $report->find_contents(3);
		$prop = $prop_obj ? $prop_obj->data : array();
	
		$recc_obj = $report->find_contents(8);
		$recc = $recc_obj ? $recc_obj->data : array();
	?>
<?php endif; ?>
		<div class="form_fields">
			<?php if($edit_ctx): ?>
				<h3>Your Details</h3><!--this should be doable from report edit 1 and report edit 3-->
					<label>Name</label>
						<input name="other_data[1][client_name]" type="text" value="<?php h($report->client_name) ?>" />
					<label>Address</label>
						<input name="other_data[1][street_address]" type="text" value="<?php h($report->street_address) ?>"/>
						<input name="other_data[1][city]" type="text" value="<?php h($report->city) ?>"/>
						<input name="other_data[1][postcode]" type="text" value="<?php h($report->postcode) ?>"/>
					<label>Client Reference</label>
						<input name="other_data[3][client_ref]" type="text" value="<?php h(isset($prop['client_ref']) ? $prop['client_ref'] : 'Amb/review'); ?>" />
					<label>Quote Reference</label>
						<input name="data[quote_ref]" type="text" value="<?php h(isset($data['quote_ref']) ? $data['quote_ref'] : 'Amb/review'); ?>" />
				<hr />
			<?php endif; ?>
			<h3>Our Details</h3><!--probably base this on some options on the settings page-->
				<?php if($edit_ctx): ?>
					<label>Surveyor</label>
						<input name="other_data[3][our_surveyer]" type="text" value="<?php h(isset($prop['surveyer']) ? $prop['surveyer'] : 'Bryan Campbell C.S.R.T.'); ?>" />
				<?php endif; ?>
				<label>Company</label>
					<?php render_edit_control("input", "data[our_company]",
						$data['our_company'], $defaults['our_company']) ?>
				<label>Address</label>
					<?php render_edit_control("input", "data[our_address]",
						$data['our_address'], $defaults['our_address']) ?>
					<?php render_edit_control("input", "data[our_city]",
						$data['our_city'], $defaults['our_city']) ?>
					<?php render_edit_control("input", "data[our_postcode]",
						$data['our_postcode'], $defaults['our_postcode']) ?>
				<label>Telephone</label>
					<?php render_edit_control("input", "data[our_telephone]",
						$data['our_telephone'], $defaults['our_telephone']) ?>
				<label>Fax</label>
					<?php render_edit_control("input", "data[our_fax]",
						$data['our_fax'], $defaults['our_fax']) ?>
				<label>Email</label>
					<?php render_edit_control("input", "data[our_email]",
						$data['our_email'], $defaults['our_email']) ?>
			<hr />
			<h3>Message from the Surveyor</h3>
			<?php render_edit_control("textarea", "data[message]",
				$data['message'], $defaults['message']) ?>
			<hr />
		<?php if($edit_ctx): ?>
			<h3>Recommended Items</h3>
			<table><tbody  id="summ_rec_current_items_table"><!--this table is based on what was selected on the previous page-->
				<tr>
					<td width="100px"><p>Item Ref.</p></td>
					<td width="550px"><p>Description</p></td>
					<td></td>
				</tr>
				<?php $total_price = 0; ?>
				<?php if(is_array($recc['current_items'])): ?>
					<?php foreach($recc['current_items'] as $itm_id): ?>
						<?php if(!is_numeric($itm_id)) continue; ?>
						<?php $itm = RecommendedItem::find($itm_id); ?>
						<?php if(!$itm) continue; ?>
						<?php $total_price += $itm->price; ?>
						<tr>
							<td><p><?php printf("%03d", $itm->id); ?></p></td>
							<td>
								<h4><?php h($itm->name); ?></h4>
								<p><?php h($itm->description); ?></p>
							</td>
							<td><p>&pound;<?php h($itm->price); ?></p></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>	
				<tr><!--a bit of simple math to figure this bit out-->
					<td></td>
					<td>Sub Total</td>
					<td>&pound;<?php h($total_price); ?></td>
				</tr>
			</tbody></table>
		<?php endif; ?>
		</div>