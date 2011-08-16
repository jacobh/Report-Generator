	<?php if($edit_ctx): ?>
		<div class="form_fields">
			<label>Summary</label>
				<textarea name="data[summ_rec_summary]"><?php if($data['summ_rec_summary']): h($data['summ_rec_summary']) ?><?php else: ?>Overall the property appears to be in reasonable condition and there is no evidence to suggest that there is any areas which would be of major concern, we would suggest installing additional air vents to the areas indicated in the enclosed sketch plan to increase the ventilation to the sub floor timbers and have submitted a quotation for your information, however as access was limited in several areas we strongly suggest a further visit when full access is available.
				<?php endif; ?>
				</textarea>
			<hr />
			<h4>Recommendations</h4>
			<label>Add Existing Item</label>
				<select name="summ_rec_add_existing_item">
					<?php foreach(RecommendedItem::all("id ASC") as $item): ?>
						<option price="<?php h($item->price) ?>" descr="<?php h($item->description) ?>">
							<?php printf("%03d", $item->id) ?> - <?php h($item->name) ?> - &pound;<?php h($item->price) ?>
						</option>
					<?php endforeach; ?>
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
						<?php foreach($data['current_items'] as $itm_id): ?>
							<?php if(!is_numeric($itm_id)) { continue; } ?>
							<?php $itm = RecommendedItem::find($itm_id); ?>
							<?php if(!$itm) { continue; } ?>
							<tr>
								<input type="hidden" name="data[current_items][]" value="<?php h($itm->id) ?>" />
								<td><p><?php printf("%03d", $itm->id) ?></p></td>
								<td>
									<h4><?php h($itm->name) ?></h4>
									<p><?php h($itm->description) ?></p>
								</td>
								<td><a href="#" class="summ_rec_button _del">Delete</a></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<script>
						$(document).ready(function() {
							$("._del").parents("_del").click(function() { $(this).remove(); return false; });
							function addSection(id, name, descr, price) {
								id = parseInt(id);
								var el = $('<tr><input type="hidden" class="_id" name="data[current_items][]" /><td><p class="id"> </p></td><td><h4> </h4><p class="description"> </p></td><td><a href="#" class="summ_rec_button _del">Delete</a></td></tr>');
								el.find(".id").text(id);
								el.find(".description").text(descr);
								el.find("h4").text(name);
								el.find("._id").val(id);
								el.find("._del").click(function() { el.remove(); return false; });
								el.insertAfter($("#summ_rec_current_items_table tr").last());
							}
							$("._custom_add").click(function() {
								var name = $("[name=summ_rec_add_new_item_name]");
								var description = $("[name=summ_rec_add_new_item_description]");
								var price = $("[name=summ_rec_add_new_item_price]");
								$.post("ajax_new_recommended_item.php", {
									name: name.val(),
									description: description.val(),
									price: price.val()
								}, function(obj) {
									addSection(obj.id, obj.name, obj.description, obj.price);
								}, 'json');
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
	<?php else: ?>
		<h2>todo</h2>
	<?php endif;?>