		<div class="form_fields">			
			<label>Opening Infobox</label>
			<?php render_edit_control("textarea", "data[conden_rep_opening_information]",
				$data['conden_rep_opening_information'], $defaults['conden_rep_opening_information']) ?>
				
			<label>Relative Humidity Readings Information</label>
			<?php render_edit_control("textarea", "data[conden_rep_relative_humidity_readings_information]",
				$data['conden_rep_relative_humidity_readings_information'], $defaults['conden_rep_relative_humidity_readings_information']) ?>
			
			<?php if($edit_ctx): ?>
				<hr />
				<h4>Readings</h4>
				<table id="conden_rep_table">
					<tr>
						<td width="200px"><p>Room</p></td>
						<td><p>Air Temperature</p></td>
						<td><p>Relative Humidity</p></td>
						<td><p>Dew Point</p></td>
					</tr>
					<?php $i = 0; ?>
					<?php if(is_array($data['conden_rows'])): ?>
						<?php foreach($data['conden_rows'] as $row): ?>
							<tr>
								<td><input name="data[conden_rows][<?php echo $i; ?>][name]" value="<?php h($row['name']) ?>" /></td>
								<td><input name="data[conden_rows][<?php echo $i; ?>][temp]" value="<?php h($row['temp']) ?>" /></td>
								<td><input name="data[conden_rows][<?php echo $i; ?>][humidity]" value="<?php h($row['humidity']) ?>" /></td>
								<td><input name="data[conden_rows][<?php echo $i; ?>][dew_point]" value="<?php h($row['dew_point']) ?>" /></td>
								<td><a href="#" class="summ_rec_button" id="delete_button">Delete</a></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<tr id="add_row">
						<td colspan="4"></td>
						<td>
						<!--when this is clicked it adds another blank row to the table-->
							<a href="#" class="summ_rec_button" id="add_button">Add</a>
						</td>
				</table>
				<script>
				$(function() {
					var i = <?php echo $i; ?>;
					$("#delete_button").live('click', function() {
						$(this).parents("tr").remove();
						return false;
					});
					$("#add_button").click(function() {
						$("<tr><td><input name='data[conden_rows][" + i + "][name]' /></td><td><input name='data[conden_rows][" + i + "][temp]' /></td><td><input name='data[conden_rows][" + i + "][humidity]' /></td><td><input name='data[conden_rows][" + i + "][dew_point]' /></td><td><a href='#' class='summ_rec_button' id='delete_button'>Delete</a></td></tr>").insertBefore($("#add_row"));
						i++;
						return false;
					});
				});
				</script>
				<hr />
				<label>Conclusion</label>
				<textarea name="data[conden_rep_conclusion]"><?php h($data['conden_rep_conclusion']) ?></textarea>
			<?php endif; ?>
		</div>