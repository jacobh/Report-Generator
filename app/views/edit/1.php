<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Basics</h3>
	<hr />
	<form method="post">
		<input type="hidden" name="report_id" value="<?php h($report->id) ?>">
		<input type="hidden" name="section" value="1">
		<div class="form_fields">
			<label>Address</label>
				<input name="basics[street_address]" type="text" placeholder="Street Address Line 1" value="<?php h($report->street_address); ?>" />
				<input name="basics[city]" type="text" placeholder="City" value="<?php h($report->city); ?>" />
				<input name="basics[postcode]" type="text" placeholder="Postcode" value="<?php h($report->postcode); ?>" />
			<label>Client Name</label>
				<input name="basics[client_name]" type="text" value="<?php h($report->client_name) ?>" />
			<label>Date</label>
				<input name="date" type="text" value="<?php echo date("Y-m-d H:i:s", $report->created_at); ?>" />
				<span class="hint">Please adhere to the format <strong>YYYY-MM-DD HH:MM:SS</strong>, using 24 hour time</span>
		</div>
		<!--when an item is double clicked or the > is clicked it gets put onto the right side
		when an item on the right gets double clicked or the < is clicked it gets removed from the right

		this controls which subsequent menus show up, the table of contents will also be determined by this-->
		<select id="report_contents_all" size="10">
			<?php $carr = explode(",", $report->contents); ?>
			<?php foreach(Report::$contents_ids as $id=>$content): ?>
				<?php if(!in_array($id, $carr)): ?>
					<option value="<?php h($id) ?>"><?php h($content['title']) ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<div id="report_contents_controls">
			<a href="#" class="move_ltr">&#062;</a>
			<a href="#" class="move_rtl">&#060;</a>
		</div>
		<input type="hidden" name="basics[contents]" id="selected_items" value="<?php h($report->contents) ?>" />
		<select id="report_contents_selected" size="10">
			<?php foreach(Report::$contents_ids as $id=>$content): ?>
				<?php if(in_array($id, $carr)): ?>
					<option value="<?php h($id) ?>"><?php h($content['title']) ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<script>
		$(document).ready(function() {
			function sortBox(box) {
				var options = box.find("option");
				options.sort(function($a, $b) {
					var a = parseInt($($a).val());
					var b = parseInt($($b).val());
					if(a > b) return 1;
					if(a < b) return -1;
					return 0;
				});
				box.empty().append(options);
				var opts = [];
				$("#report_contents_selected").children().map(function() {
					opts.push($(this).val());
				});
				$("#selected_items").val(opts.join(","));
			}
			$(".move_ltr").click(function() {
				$("#report_contents_all option:selected").appendTo($("#report_contents_selected"));
				sortBox($("#report_contents_selected"));
			});
			$(".move_rtl").click(function() {
				$("#report_contents_selected option:selected").appendTo($("#report_contents_all"));
				sortBox($("#report_contents_all"));
			});
			$("option").dblclick(function() {
				$(this).appendTo($("select").not($(this).parent()));
				sortBox($("select").not($(this).parent()));
			});
		});
		</script>
		<div id="report_edit_back_forward">
			<input type="submit" name="next" value="NEXT &gt;" />
		</div>
	</form>
</div>