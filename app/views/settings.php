<div id="main_content_rhs_wide">
	<h2>Settings</h2>
	<!--<h3>Basics</h3>-->
	<hr />
	<div id="settings">
		<h3>Defaults</h3>
		<form method="post">
			<select name="goto" id="pg">
				<option>Choose page to edit defaults for...</option>
				<?php foreach(Report::$contents_ids as $id=>$content): ?>
					<option value="<?php h($id) ?>"><?php h($id) ?> - <?php h($content['title']) ?></option>
				<?php endforeach; ?>
			</select>
			<script>
			$(function() {
				$("#pg").change(function() {
					$(this).parents("form").submit();
				})
			});
			</script>
			<?php if($page): ?>
				<hr />
				<?php $settings_default_context = TRUE; ?>
				<?php $params["section"] = $params["page"]; ?>
				<?php include("views/edit/dispatch.php"); ?>
			<?php endif; ?>
		</form>
	</div>
</div>