<?php  // Use nonce for verification
  wp_nonce_field( 'mc4wp_save_form', '_mc4wp_nonce' );
?>

<p class="mc4wp-notice" style="display:none;"></p>

<h4>Lists this form subscribes to</h4>
<p>
<?php if(!$lists) { 
				?>No lists found, are you connected to MailChimp?<?php
		} else { ?>
			<ul id="mc4wp-lists">
				<?php foreach($lists as $list) {
					?><li><input type="checkbox" data-list-id="<?php echo $list->id; ?>" id="mc4wp-list-<?php echo $list->id; ?>-cb" name="mc4wp_form[lists][<?php echo $list->id; ?>]" value="<?php echo $list->id; ?>" <?php if(array_key_exists($list->id, $form_settings['lists'])) echo 'checked="checked"'; ?>> <label for="mc4wp-list-<?php echo $list->id; ?>-cb"><?php echo $list->name; ?></label></li><?php
				} ?>
			</ul>
		<?php
		} ?>
</p>

<hr />
<div id="mc4wp-fw" class="mc4wp-well">

	<h4>Add a new field</h4>
	<p>Use the tool below to help you add fields to your form mark-up.</p>
	<p>
		<select class="widefat" id="mc4wp-fw-type">
			<option value="">Select field type..</option>
			<option value="text">Text field</option>
			<option value="email">Email field (HTML5)</option>
			<option value="checkbox">Checkbox</option>
			<option value="radio">Radio button</option>
			<option value="hidden">Hidden field</option>
			<option value="submit">Submit button</option>
			<option value="url">URL field (HTML5)</option>
			<option value="date">Date field (HTML5)</option>
			<option value="tel">Phone no. field (HTML5)</option>
		</select>
	</p>

	<div class="mc4wp-fields">

		<p class="field-row row-preset">
			<label for="mc4wp-fw-preset">Preset (optional)</label>
			<select class="widefat" id="mc4wp-fw-preset">
				<option class="default" value="">Choose a preset..</option>
				<option class="group fieldType-hidden fieldType-checkbox fieldType-radio" value="group">Interest group</option>
			</select>
			<small>Helps by presetting some values</small>
		</p>

		<p class="field-row row-grouping">
			<label for="mc4wp-fw-grouping">Grouping</label>
			<select class="widefat" id="mc4wp-fw-grouping">
				<option class="default" value="">Select a grouping..</option>
			</select>
		</p>

		<p class="field-row row-grouping-groups">
			<label for="mc4wp-fw-grouping-groups">Groups</label>
			<select class="widefat" id="mc4wp-fw-grouping-groups" multiple>
				<option class="default" value="">Select a grouping first..</option>
			</select>
		</p>

		<p class="field-row row-name">
			<label for="mc4wp-fw-name">Field name*</label>
			<input class="widefat" type="text" id="mc4wp-fw-name" />
			<small>Should match your merge field tag</small>
		</p>

		<p class="field-row row-value">
			<label for="mc4wp-fw-value"><span id="mc4wp-fw-value-label">Initial value (optional)</span></label>
			<input class="widefat" type="text" id="mc4wp-fw-value" />
		</p>

		<p class="field-row row-placeholder">
			<label for="mc4wp-fw-placeholder">Placeholder (HTML5) <small>(optional)</small></label>
			<input class="widefat" type="text" id="mc4wp-fw-placeholder" />
		</p>

		<p class="field-row row-label">
			<label for="mc4wp-fw-label">Label <small>(optional)</small></label>
			<input class="widefat" type="text" id="mc4wp-fw-label" />
		</p>

		<p class="field-row row-p">
			<input type="checkbox" id="mc4wp-fw-p" value="1" checked /> 
			<label for="mc4wp-fw-p">Wrap in paragraph (<code>&lt;p&gt;</code>) tags?</label>
		</p>

		<p class="field-row row-req">
			<input type="checkbox" id="mc4wp-fw-req" value="1" /> 
			<label for="mc4wp-fw-req">Required field? (HTML5)</label>
		</p>

		<p>
			<textarea class="widefat" id="mc4wp-fw-preview" rows="5"></textarea>
		</p>

		<p>
			<input class="button button-large" type="button" id="mc4wp-fw-add-to-form" value="&laquo; add to form" />
		</p>

	</div>
</div>
<hr />

<h4>Form usage</h4>
<p class="mc4wp-form-usage">Use the shortcode <input type="text" onfocus="this.select();" readonly="readonly" value="[mc4wp-form id=&quot;<?php echo $post->ID; ?>&quot;]" class="mc4wp-shortcode-example"> to render this form inside a post, page or text widget.</p>