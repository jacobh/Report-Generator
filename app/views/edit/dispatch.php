<?php
global $edit_ctx;

if(!isset($settings_default_context)) {
	$edit_ctx = TRUE;
}

function render_edit_control($type, $name, $value, $defaults) {
	global $edit_ctx;
	global $__rendered_defaults_edit_script;
	
	$uniq = uniqid();
	if($edit_ctx) {
		// on a report edit page
		?>
		<select rg-uniq="<?php h($uniq) ?>" name="<?php h($name) ?>">
			<?php if(!in_array($value, $defaults)): ?>
				<option value="<?php h($value) ?>" selected><?php h($value) ?></option>
			<?php endif; ?>
			<?php foreach($defaults as $d): ?>
				<option value="<?php h($value) ?>" <?php if($value == $d) { h("selected"); } ?>><?php h($d) ?></option>
			<?php endforeach; ?>
			<option rg-special="custom">Custom...</option>
		</select>	
		<script>
		$(function() {
			$("select[rg-uniq=<?php h($uniq) ?>]").change(function() {
				if($(this).find("option:selected").attr("rg-special")) {
		<?php
		if($type == "input"):
			?>
					$("<input>").attr({
						"name": "<?php h($name) ?>",
						"type": "text",
						"value": "<?php h($value) ?>"
					}).insertAfter($(this));
			<?php
		elseif($type == "textarea"):
			?>
					$("<textarea>").attr({
						"name": "<?php h($name) ?>"
					}).val("<?php h($value) ?>").insertAfter($(this));
			<?php
		endif;
		?>		
					$(this).remove();
				}
			});
		});
		</script>
		<?php
	} else {
		// editing default options
		if(!$__rendered_defaults_edit_script) {
			$__rendered_defaults_edit_script = true;
			?>
			<script>
			$(function() {
				$(".__add_preset").click(function() {
					var li = $("<li>").css({
						"list-style": "disc !important"
					});
					var typ = $(this).parents("ul").attr("rg-type");
					if(typ == "textarea") {
						li.css({
							"margin-bottom": "12px",
							"padding-bottom": "12px",
							"border-bottom": "1px solid #cccccc",
						});
						li.append($("<div>").text("Preset Text:"));
						li.append($("<textarea>").css({ "width": "400px", "padding": "4px" }).attr("name", $(this).parents("ul").attr("rg-name") + "[]"));
						li.append($("<br>"));
					} else if(typ == "input") {
						li.append($("<input>").css({ "width": "600px", "padding": "4px" }).attr("name", $(this).parents("ul").attr("rg-name") + "[]"));
					}
					li.append($("<a>").attr({ "href": "#" }).click(function() { $(this).parents("li").remove(); }).text("delete"));
					li.insertBefore($(this).parents("li"));
					return false;
				});
				$(".__delete_this_present").click(function() {
					$(this).parents("li").remove();
					return false;
				});
				$(".__edit_this_preset").click(function() {
					var _li = $(this).parents("li");
					_li.hide();
					var li = $("<li>");
					var typ = $(this).parents("ul").attr("rg-type");
					if(typ == "textarea") {
						li.css({
							"list-style": "disc !important",
							"margin-bottom": "12px",
							"padding-bottom": "12px",
							"border-bottom": "1px solid #cccccc",
						});
						li.append($("<div>").text("Preset Text:"));
						li.append($("<textarea>").css({ "width": "400px", "padding": "4px" }).attr("name", $(this).parents("ul").attr("rg-name") + "[]").val(_li.find("input").val()));
						li.append($("<br>"));
					} else if(typ == "input") {
						li.append($("<input>").css({ "width": "600px", "padding": "4px" }).attr("name", $(this).parents("ul").attr("rg-name") + "[]").val(_li.find("input").val()));
					}
					li.append($("<a>").attr({ "href": "#" }).click(function() { $(this).parents("li").remove(); }).text("delete"));
					li.insertBefore(_li);
					_li.remove();
					return false;
				});
			});
			</script>
			<?php
		}
		?>
		<ul rg-type="<?php h($type) ?>" rg-name="<?php h($name) ?>" style="padding-left:24px; list-style:disc; margin-bottom:24px;">
			<?php if(!is_array($defaults)) { $defaults = array(); } ?>
			<?php foreach($defaults as $d): ?>
				<li style="list-style:disc !important; margin-bottom:8px;">
					<input type="hidden" name="<?php h($name) ?>[]" value="<?php h($d) ?>" />
					<?php h($d) ?>
					(<a href="#" class="__delete_this_present">delete</a> - <a href="#" class="__edit_this_preset">edit</a>)
				</li>
			<?php endforeach; ?>
			<li style="list-style:disc !important;">(<a href="#" class="__add_preset" rg-name="<?php h($name) ?>">add new default</a>)</li>
		</ul>
		<div style="clear:both;"></div>
		<?php
	}
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
		/*
		if(is_array($defaults)) {
			foreach($defaults as $k=>$v) {
				if(!isset($data[$k]) || empty($data[$k])) {
					$data[$k] = $defaults[$k];
				}
			}
		}
		*/
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