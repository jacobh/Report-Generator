<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Introduction</h3>
	<hr />
	<form method="post">
		<input type="hidden" name="report_id" value="<?php h($report->id) ?>">
		<input type="hidden" name="section" value="2">
		<div class="form_fields">
			<label>Opening Paragraph</label>
			<textarea name="data[introduction_opening_paragraph]"><?php h($data['introduction_opening_paragraph']) ?></textarea>
			<label>About The Survey</label>
			<textarea name="data[introduction_about_the_survey]"><?php h($data['introduction_about_the_survey']) ?></textarea>
			<label>Methodology</label>
			<textarea name="data[introduction_methodology]"><?php h($data['introduction_methodology']) ?></textarea>
			<label>The Report</label>
			<textarea name="data[introduction_the_report]"><?php h($data['introduction_the_report']) ?></textarea>
			<label>Findings / Recomendations</label>
			<textarea name="data[introduction_findings_recomendations]"><?php h($data['introduction_findings_recomendations']) ?></textarea>
		</div>
		<?php include "edit_nav.php" ?>
	</form>
</div>