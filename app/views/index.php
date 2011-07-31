<div id="main_content_mid" class="col">
	<ul id="report_list">
		<?php foreach($reports as $report): ?>
		<li>
			<a href="#overview_<?php h($report->id) ?>">
				<p class="street"><?php h($report->street_address) ?>,</p>
				<p class="suburb"><?php h($report->city) ?></p>
			</a>
			<div class="report_list_controls">
				<a href="render.php?report_id=<?php h($report->id) ?>"><img src="style/images/download.png"></img></a>
				<a href="edit_report.php?section=1&amp;report_id=<?php h($report->id) ?>"><img src="style/images/edit.png"></img></a>
				<a href="delete_report.php?report_id=<?php h($report->id) ?>" onclick="return confirm('Are you sure? This action is permanent.');"><img src="style/images/delete.png"></img></a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<script>
	$(document).ready(function() {
		$("#report_list li").click(function() {
			$("#main_content_rhs > *").hide();
			$("#main_content_rhs " + $(this).find("a").first().attr("href")).fadeIn();
		});
	});
	</script>
</div>
<div id="main_content_rhs" class="col">
	<?php foreach($reports as $report): ?>
		<div style="display:none;" id="overview_<?php h($report->id) ?>">
			<h2><?php h($report->street_address) ?><br /><br /><?php h($report->city) ?></h2>
			<hr />
			<img src="thumbnail.php?report_id=<?php h($report->id) ?>" />
			<hr />
			<p class="report_metainfo">Created On: <?php echo date("jS F Y", $report->created_at) ?> at <?php echo date("g:ia", $report->created_at) ?></p>
			<p class="report_metainfo">Last Edited: <?php echo date("jS F Y", $report->updated_at) ?> at <?php echo date("g:ia", $report->updated_at) ?></p>
			<hr></hr>
			<h3>Contents</h3>
			<ul id="report_contents">
				<?php if($report->contents !== ""): ?>
					<?php foreach(explode(",", $report->contents) as $content): ?>
						<li><?php h(Report::$contents_ids[$content]['title']) ?></li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	<?php endforeach; ?>
</div>