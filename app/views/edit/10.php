		<div class="form_fields">
			<label>Safety Precautions</label>
			<?php render_edit_control("textarea", "data[safety_precautions]",
				$data['safety_precautions'], $defaults['safety_precautions']) ?>
		
			<label>The Don'ts</label>
			<?php render_edit_control("textarea", "data[donts]",
				$data['donts'], $defaults['donts']) ?>
		
			<label>The Do's</label>
			<?php render_edit_control("textarea", "data[dos]",
				$data['dos'], $defaults['dos']) ?>
		</div>