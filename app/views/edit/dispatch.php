<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3><?php h(Report::$contents_ids[$params["section"]]["title"]) ?></h3>
	<hr />
	<form method="post">
		<input type="hidden" name="report_id" value="<?php h($report->id) ?>" />
		<input type="hidden" name="section" value="<?php h($params["section"]) ?>" />
		<?php
		$defaults = _Default::load($params["section"]);
		if(is_array($defaults)) {
			foreach($defaults as $k=>$v) {
				if(!isset($data[$k]) || empty($data[$k])) {
					$data[$k] = $defaults[$k];
				}
			}
		}
		if(!isset($settings_default_context)) {
			$edit_ctx = TRUE;
		}
		include("views/edit/$params[section].php");
		?>
		<?php if($params["section"] == 1): ?>
			<div id="report_edit_back_forward">
				<input type="submit" name="next" value="NEXT &gt;" />
				<input type="submit" name="quit" value="SAVE AND QUIT" />
			</div>
		<?php else: ?>
			<?php include "edit_nav.php"; ?>
		<?php endif; ?>
	</form>
</div>