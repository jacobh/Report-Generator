<?php
if(!isset($settings_default_context)) {
	$edit_ctx = TRUE;
}		
?>
<?php if($edit_ctx): ?>
	<div id="main_content_rhs_wide">
<?php endif;?>
	<h2>Report Edit</h2>
	<h3><?php h(Report::$contents_ids[$params["section"]]["title"]) ?></h3>
	<hr />
	<form method="post">
		<?php if($edit_ctx): ?>
			<input type="hidden" name="report_id" value="<?php h($report->id) ?>" />
		<?php endif; ?>
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
		include("views/edit/$params[section].php");
		?>
		<?php if($edit_ctx): ?>
			<?php if($params["section"] == 1): ?>
				<div id="report_edit_back_forward">
					<input type="submit" name="next" value="NEXT &gt;" />
					<input type="submit" name="quit" value="SAVE AND QUIT" />
				</div>
			<?php else: ?>
				<?php include "edit_nav.php"; ?>
			<?php endif; ?>
		<?php else: ?>
			<div id="report_edit_back_forward">
				<input type="submit" name="save" value="SAVE" />
			</div>
		<?php endif; ?>
	</form>
<?php if($edit_ctx): ?>
	</div>
<?php endif; ?>