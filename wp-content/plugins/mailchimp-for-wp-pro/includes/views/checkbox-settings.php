<div id="mc4wp-checkbox-settings">

	<form method="post" action="options.php">

		<?php settings_fields( 'mc4wp_checkbox_settings' ); ?>

		<h3>Checkbox Settings</h3>	

		<?php if(empty($opts['lists'])) { ?>
			<div class="updated"><p><b>Notice:</b> You must select atleast 1 list to subscribe to.</p></div>
		<?php } ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">Lists</th>
				
					<?php // loop through lists
					if(!$lists || empty($lists)) { 
						?><td colspan="2">No lists found, are you connected to MailChimp?</td><?php
					} else { ?>
					<td>
						<?php foreach($lists as $list) {
							?><input type="checkbox" id="mc4wp_checkbox_list_<?php echo $list->id ?>_cb" name="mc4wp_checkbox[lists][<?php echo $list->id; ?>]" value="<?php echo $list->id; ?>" <?php if(array_key_exists($list->id, $opts['lists'])) echo 'checked="checked"'; ?>> <label for="mc4wp_checkbox_list_<?php echo $list->id; ?>_cb"><?php echo $list->name; ?></label><br /><?php
						} ?>
					</td>
					<td class="desc">Select the MailChimp list(s) to subscribe to</td>
					<?php
				} ?>
				
			</tr>
			<tr valign="top">
				<th scope="row">Double opt-in?</th>
				<td class="nowrap"><input type="radio" id="mc4wp_checkbox_double_optin_1" name="mc4wp_checkbox[double_optin]" value="1" <?php if($opts['double_optin'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_double_optin_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_checkbox_double_optin_0" name="mc4wp_checkbox[double_optin]" value="0" <?php if($opts['double_optin'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_double_optin_0">No</label></td>
				<td class="desc"></td>
			</tr>
			<tr valign="top">
				<th scope="row">Add the checkbox to these forms</th>
				<td colspan="2">
					<?php foreach($checkbox_plugins as $code => $name) { ?>
						<label><input name="mc4wp_checkbox[show_at_<?php echo $code; ?>]" value="1" type="checkbox" <?php checked($opts['show_at_'.$code], 1); ?>> <?php echo $name; ?></label> &nbsp; 
					<?php } ?>
					<label><input name="mc4wp_checkbox[show_at_other_forms]" value="1" type="checkbox" <?php if($opts['show_at_other_forms']) echo 'checked '; ?>> Other forms (manual)</label> &nbsp; 
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc4wp_checkbox_label">Checkbox label text</label></th>
				<td colspan="2"><input type="text" class="widefat" id="mc4wp_checkbox_label" name="mc4wp_checkbox[label]" value="<?php echo esc_attr($opts['label']); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Pre-check the checkbox?</th>
				<td class="nowrap"><input type="radio" id="mc4wp_checkbox_precheck_1" name="mc4wp_checkbox[precheck]" value="1" <?php if($opts['precheck'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_precheck_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_checkbox_precheck_0" name="mc4wp_checkbox[precheck]" value="0" <?php if($opts['precheck'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checkbox_precheck_0">No</label></td>
				<td class="desc"></td>
			</tr>
			<tr valign="top">
				<th scope="row">Load some default CSS?</th>
				<td class="nowrap"><input type="radio" id="mc4wp_checbox_css_1" name="mc4wp_checkbox[css]" value="1" <?php if($opts['css'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_checbox_css_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_checbox_css_0" name="mc4wp_checkbox[css]" value="0" <?php if($opts['css'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_checbox_css_0">No</label></td>
				<td class="desc">Tick "yes" if the checkbox appears in a weird place.</td>
			</tr>
			<tr valign="top">
				<td colspan="3"><p>Additional styling can be done by applying CSS rules to <b>#mc4wp-checkbox</b> or its child elements. You can add CSS rules to your theme stylesheet using the <a href="theme-editor.php?file=style.css">theme editor</a> or using FTP by editing <code><?php echo get_stylesheet_directory() . '/style.css'; ?></code></p></td>
			</tr>
		</table>

		<?php submit_button(); ?>

		<?php if($selected_checkbox_hooks) { ?>
		<h3>Custom label texts</h3>
		<p>Override the default checkbox label text for any given checkbox using the fields below.</p>
		<table class="form-table">
			<?php foreach($selected_checkbox_hooks as $code => $name) { ?>
			<tr valign="top">
				<th scope="row"><?php echo $name; ?></th>
				<td><input type="text" name="mc4wp_checkbox[text_<?php echo $code; ?>_label]" placeholder="<?php echo esc_attr($opts['label']); ?>" class="widefat" value="<?php if(isset($opts['text_'.$code.'_label'])) echo esc_attr($opts['text_'.$code.'_label']); ?>" />
			</tr>
			<?php } ?>
		</table>

		<?php submit_button(); ?>

		<?php } ?>

	</form>
</div>