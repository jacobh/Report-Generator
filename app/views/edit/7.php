<div id="main_content_rhs_wide">
	<h2>Report Edit</h2>
	<h3>Timber Survey</h3>
	<hr />
	<form method="post">
		<div class="form_fields">
			<label>Opening Paragraph</label>
			<textarea name="timber_serv_opening_paragraph"><?php if($data['timber_serv_opening_paragraph']): h($data['timber_serv_opening_paragraph']) ?><?php else: ?>A detailed examination was carried out to determine the presence of any wood boring insects and/or wood rotting fungi, the results of this survey are as follows:
			<?php endif; ?>
			</textarea>
			<hr />
			<h4>Observations</h4>
			<div class="timber_surv_observation"></div>
			<?php $i = 0; ?>
			<?php if(is_array($data['timber_surv_observations'])): ?>
				<?php foreach($data['timber_surv_observations'] as $obs): ?>
					<div class="timber_surv_observation">
						<label>Area Type</label>
						<input type="text" name="data[timber_surv_observations][<?php echo $i; ?>][type]" value="<?php h($obs['type']) ?>" />
						<label>Description</label>
						<textarea name="data[timber_surv_observations][<?php echo $i; ?>][description]" placeholder="insert description here..."><?php h($obs['description']) ?></textarea>
					</div>
					<hr />	
				<?php endforeach;?>
			<?php endif; ?>

			<!--this will add another timber-surver_observation div-->
			<p class="list_add_new"><a href="#">Add</a></p>
			<script>
			$(function() {
				var i = <?php echo $i; ?>;
				$(".list_add_new").click(function() {
					$('<div class="timber_surv_observation"><label>Area Type</label><input type="text" name="data[timber_surv_observations][' + i + '][type]" /><label>Description</label><textarea name="data[timber_surv_observations][' + i + '][description]" placeholder="insert description here..."></textarea><hr /></div>').insertAfter($(".timber_surv_observation").last());
					i++;
					return false;
				});
			});
			</script>
		</div>
		<div id="report_edit_back_forward">
			<input type="submit" name="prev" value="&lt; PREV" />
			<input type="submit" name="next" value="<?php echo $report->nextContentsAfter($params['section']) ? 'NEXT &gt;' : 'FINISH' ?>" />
		</div>
	</form>
</div>