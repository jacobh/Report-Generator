<div id="report_edit_back_forward">
	<select name="goto" id="goto_page" style="width:200px;">
		<option value="">Save and go to...</option>
		<option value="1">1 - Basics</option>
		<?php foreach(explode(",", $report->contents) as $cid): ?>
			<option value="<?php h($cid) ?>"><?php h($cid) ?> - <?php h(Report::$contents_ids[$cid]['title']) ?></option>
		<?php endforeach; ?>
	</select>
	<script>
		$(document).ready(function() {
			$("#goto_page").change(function() {
				$(this).parents("form").submit();
			});
		});
	</script>
	<input type="submit" name="prev" value="&lt; PREV" />
	<input type="submit" name="next" value="<?php echo $report->nextContentsAfter($params['section']) ? 'NEXT &gt;' : 'FINISH' ?>" />
	<input type="submit" name="quit" value="SAVE AND QUIT" />
</div>