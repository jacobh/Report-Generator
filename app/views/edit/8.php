<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Summary &amp; Recommendations</h3>
	<hr />
	<form method="post">
		<div class="form_fields">
			<input type="hidden" name="report_id" value="<?php h($report->id) ?>">
			<input type="hidden" name="section" value="8">
			<label>Summary</label>
				<textarea name="data[summ_rec_summary]"><?php if($data['summ_rec_summary']): h($data['summ_rec_summary']) ?><?php else: ?>Overall the property appears to be in reasonable condition and there is no evidence to suggest that there is any areas which would be of major concern, we would suggest installing additional air vents to the areas indicated in the enclosed sketch plan to increase the ventilation to the sub floor timbers and have submitted a quotation for your information, however as access was limited in several areas we strongly suggest a further visit when full access is available.
				<?php endif; ?>
				</textarea>
			<hr />
			<h4>Recommendations</h4>
			<label>Add Existing Item</label>
				<select name="summ_rec_add_existing_item">
					<option price="199" descr="By increasing the ventilation, this will allow for a far more efficient way in which the air is circulated in this area which will decrease the amount of moisture which can be transferred to the sub floor timbers.">001 - install Additional Air Vents - $199</option>
					<option price="1337" descr="The survey highlighted that the existing damp proof course had failed in the areas highlighted in the enclosed sketch plan, therefore we would propose installing a new DPC in this area to prevent future outbreaks of reising dampness.">002 - Install Retrofit DPC - $1337</option>
				</select>
				<a class="summ_rec_button _preset_add" href="#">Add</a>
			<div class="clearfix"></div>
			
			<label>Add New item</label>
				<input name="summ_rec_add_new_item_name" type="text" placeholder="Item Name" />
				<input name="summ_rec_add_new_item_price" type="text" placeholder="Item Price" />
				<textarea name="summ_rec_add_new_item_description" placeholder="Item Description"></textarea>
				<a class="summ_rec_button _custom_add" href="#">Add</a>
			<div class="clearfix"></div>
			
			<h5>Current Items</h5>
			<table>
				<tbody id="summ_rec_current_items_table">
					<tr>
						<td width="100px"><p>Item Ref.</p></td>
						<td width="550px"><p>Description</p></td>
						<td></td>
					</tr>
					<?php $i = 0; ?>
					<?php if(is_array($data['current_items'])): ?>
						<?php foreach($data['current_items'] as $itm): ?>
							<tr>
								<input type="hidden" name="data[current_items][<?php h($i) ?>][id]" value="<?php h($itm['id']) ?>" />
								<input type="hidden" name="data[current_items][<?php h($i) ?>][name]" value="<?php h($itm['name']) ?>" />
								<input type="hidden" name="data[current_items][<?php h($i) ?>][description]" value="<?php h($itm['description']) ?>" />
								<input type="hidden" name="data[current_items][<?php h($i) ?>][price]" value="<?php h($itm['price']) ?>" />
								<td><p><?php h($itm['id']) ?></p></td>
								<td>
									<h4><?php h($itm['name']) ?></h4>
									<p><?php h($itm['description']) ?></p>
								</td>
								<td><a href="#" class="summ_rec_button _del">Delete</a></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<script>
						$(document).ready(function() {
							$("._del").parents("_del").click(function() { $(this).remove(); return false; });
							var i = <?php echo $i; ?>;
							function addSection(id, name, descr, price) {
								var el = $('<tr><input type="hidden" class="_id" name="data[current_items][' + i + '][id]" /><input class="_name" type="hidden" name="data[current_items][' + i + '][name]" /><input type="hidden" class="_descr" name="data[current_items][' + i + '][description]" /><input type="hidden" class="_price" name="data[current_items][' + i + '][price]" /<>td><p class="id"> </p></td><td><h4> </h4><p class="description"> </p></td><td><a href="#" class="summ_rec_button _del">Delete</a></td></tr>');
								el.find(".id").text(id);
								el.find(".description").text(descr);
								el.find("h4").text(name);
								el.find("._id").val(id);
								el.find("._descr").val(descr);
								el.find("._price").val(price);
								el.find("._name").val(name);
								el.find("._del").click(function() { el.remove(); return false; });
								el.insertAfter($("#summ_rec_current_items_table tr").last());
								i++;
							}
							$("._custom_add").click(function() {
								var name = $("[name=summ_rec_add_new_item_name]");
								var description = $("[name=summ_rec_add_new_item_description]");
								var price = $("[name=summ_rec_add_new_item_price]");
								addSection("N/A", name.val(), description.val(), price.val());
								name.val("");
								description.val("");
								price.val("");
								return false;
							})
							$("._preset_add").click(function() {
								var s = $("[name=summ_rec_add_existing_item] option:selected");
								var id = s.text().split(" - ")[0];
								var name = s.text().split(" - ")[1];
								var descr = s.attr("descr");
								var price = s.attr("price");
								addSection(id, name, descr, price);
								return false;
							});
						});
					</script>
				</tbody>
			</table>
		</div>
		<?php include "edit_nav.php" ?>
	</form>
</div>