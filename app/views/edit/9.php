<?php	
	$prop_obj = $report->find_contents(3);
	$prop = $prop_obj ? $prop_obj->data : array();
	
	$recc_obj = $report->find_contents(8);
	$recc = $recc_obj ? $recc_obj->data : array();
?>
<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Your Quote</h3>
	<hr />
	<form method="post">
		<div class="form_fields"><!--all values on this page are placeholder-->
			<input type="hidden" name="report_id" value="<?php h($report->id) ?>">
			<input type="hidden" name="section" value="9">
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
			<h3>Our Details</h3><!--probably base this on some options on the settings page-->
				<label>Surveyor</label>
					<input name="other_data[3][our_surveyer]" type="text" value="<?php h(isset($prop['surveyer']) ? $prop['surveyer'] : 'Bryan Campbell C.S.R.T.'); ?>" />
				<label>Company</label>
					<input name="data[our_company]" type="text" value="<?php h(isset($data['our_company']) ? $data['our_company'] : 'Ambient Property Solutions Ltd'); ?>" />
				<label>Address</label>
					<input name="data[our_address]" type="text" value="<?php h(isset($data['our_address']) ? $data['our_address'] : 'Unit 152'); ?>" />
					<input name="data[our_city]" type="text" value="<?php h(isset($data['our_city']) ? $data['our_city'] : 'Birmingham'); ?>" />
					<input name="data[our_postcode]" type="text" value="<?php h(isset($data['our_postcode']) ? $data['our_postcode'] : 'B3 2EW'); ?>" />
				<label>Telephone</label>
					<input name="data[our_telephone]" type="text" value="<?php h(isset($data['our_telephone']) ? $data['our_telephone'] : '0845 434 7772'); ?>" />
				<label>Fax</label>
					<input name="data[our_fax]" type="text" value="<?php h(isset($data['our_fax']) ? $data['our_fax'] : '0121 460 1027'); ?>" />
				<label>Email</label>
					<input name="data[our_email]" type="text" value="<?php h(isset($data['our_email']) ? $data['our_email'] : 'info@ambientpropertysolutions.co.uk'); ?>" />
			<hr />
			<h3>Message from the Surveyor</h3>
			<textarea name="data[message]"><?php if(isset($data['message'])) { h($data['message']); } else {
	?>Condensation is usually caused by a combination of circumstances, and so a single factor remedy is unlikely to resolve the problem completely, the methods described will all assist in reducing the conditions where sub floor condensation can occur, however I would suggest a further discussion in which we can discuss the options or alternatives in further detail.<?php } ?></textarea>
			<hr />
			<h3>Recommended Items</h3>
			<table><tbody  id="summ_rec_current_items_table"><!--this table is based on what was selected on the previous page-->
				<tr>
					<td width="100px"><p>Item Ref.</p></td>
					<td width="550px"><p>Description</p></td>
					<td></td>
				</tr>
				<?php $total_price = 0; ?>
				<?php if(is_array($recc['current_items'])): ?>
					<?php foreach($recc['current_items'] as $itm): ?>
						<?php $total_price += $itm['price']; ?>
						<tr>
							<td><p><?php h($itm['id']); ?></p></td>
							<td>
								<h4><?php h($itm['name']); ?></h4>
								<p><?php h($itm['descr']); ?></p>
							</td>
							<td><p>&pound;<?php h($itm['price']); ?></p></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>	
				<tr><!--a bit of simple math to figure this bit out-->
					<td></td>
					<td>Sub Total</td>
					<td>&pound;<?php h($total_price); ?></td>
				</tr>
			</tbody></table>
		</div>
		<div id="report_edit_back_forward">
			<input type="submit" name="prev" value="&lt; PREV" />
			<input type="submit" name="next" value="<?php echo $report->nextContentsAfter($params['section']) ? 'NEXT &gt;' : 'FINISH' ?>" />
		</div>
	</form>
</div>