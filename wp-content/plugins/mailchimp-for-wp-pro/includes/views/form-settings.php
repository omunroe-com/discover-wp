<div id="mc4wp-form-settings">

	<h2>Sign-up forms <a href="<?php echo admin_url('post-new.php?post_type=mc4wp-form'); ?>" class="add-new-h2">Create New Form</a></h2>

	<?php $table->display(); ?>


	<form method="post" action="options.php">

		<?php settings_fields( 'mc4wp_form_settings' ); ?>

		<h3>General form settings</h3>				
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Load some default CSS?</th>
				<td class="nowrap"><input type="radio" id="mc4wp_form_css_1" name="mc4wp_form[css]" value="1" <?php if($opts['css'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_css_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_form_css_0" name="mc4wp_form[css]" value="0" <?php if($opts['css'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_css_0">No</label></td>
				<td class="desc">Choose "yes" to have some basic form formatting applied to your sign-up forms.</td>
			</tr>
		</table>

		<br class="clear" />
		<h3>Default MailChimp settings</h3>
		<p>The following settings apply to <strong>all</strong> forms but can be overridden on a per-form basis.</p>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="mc4wp_form_hide_after_success">Double opt-in?</label></th>
				<td class="nowrap">
					<input type="radio" id="mc4wp_form_double_optin_1" name="mc4wp_form[double_optin]" value="1" <?php if($opts['double_optin'] == 1) echo 'checked="checked"'; ?> /> 
					<label for="mc4wp_form_double_optin_1">Yes</label> &nbsp; 
					<input type="radio" id="mc4wp_form_double_optin_0" name="mc4wp_form[double_optin]" value="0" <?php if($opts['double_optin'] == 0) echo 'checked="checked"'; ?> /> 
					<label for="mc4wp_form_double_optin_0">No</label>
				</td>
				<td class="desc">Tick "yes" if you want users to confirm their email address.</td>
			</tr>
			<tr valign="top">
				<th scope="row">Update existing subscribers?</th>
				<td class="nowrap">
					<input type="radio" id="mc4wp_form_update_existing_1" name="mc4wp_form[update_existing]" value="1" <?php checked($opts['update_existing'], 1); ?> /> 
					<label for="mc4wp_form_update_existing_1">Yes</label> &nbsp; 
					<input type="radio" id="mc4wp_form_update_existing_0" name="mc4wp_form[update_existing]" value="0" <?php checked($opts['update_existing'], 0); ?> /> 
					<label for="mc4wp_form_update_existing_0">No</label> &nbsp; 
				</td>
				<td class="desc">Tick "yes" if you want to update existing subscribers instead of showing the "already subscribed" message.</td>
			</tr>
			<tr id="mc4wp-replace-interests" valign="top" <?php if(!$opts['update_existing']) { echo 'style="display:none;"'; } ?>>
				<th scope="row">Replace interest groups?</th>
				<td class="nowrap">
					<input type="radio" id="mc4wp_form_replace_interests_1" name="mc4wp_form[replace_interests]" value="1" <?php checked($opts['replace_interests'], 1); ?> /> 
					<label for="mc4wp_form_replace_interests_1">Yes</label> &nbsp; 
					<input type="radio" id="mc4wp_form_replace_interests_0" name="mc4wp_form[replace_interests]" value="0" <?php checked($opts['replace_interests'], 0); ?> /> 
					<label for="mc4wp_form_replace_interests_0">No</label> 
				</td>
				<td class="desc">Tick "yes" if you want to replace the interest groups with the groups provided instead of adding the provided groups to the member's interest groups (when updating a subscriber).</td>
			</tr>
			<tr id="mc4wp-send-welcome"  valign="top" <?php if($opts['double_optin']) { echo 'style="display:none;"'; } ?>>
				<th scope="row">Send Welcome Email?</th>
				<td class="nowrap">
					<input type="radio" id="mc4wp_form_send_welcome_1" name="mc4wp_form[send_welcome]" value="1" <?php checked($opts['send_welcome'], 1); ?> />
					<label for="mc4wp_form_send_welcome_1">Yes</label> &nbsp; 
					<input type="radio" id="mc4wp_form_send_welcome_0" name="mc4wp_form[send_welcome]" value="0" <?php checked($opts['send_welcome'], 0); ?> />
					<label for="mc4wp_form_send_welcome_0">No</label> &nbsp; 
				</td>
				<td class="desc">Tick "yes" if you want to send your lists Welcome Email if a subscribe succeeds.</td>
			</tr>
		</table>

		<h3>Default form settings</h3>
		<p>The following settings apply to <strong>all</strong> forms but can be overridden on a per-form basis.</p>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">Enable AJAX form submission?</th>
				<td class="nowrap"><input type="radio" id="mc4wp_form_ajax_1" name="mc4wp_form[ajax]" value="1" <?php if($opts['ajax'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_ajax_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_form_ajax_0" name="mc4wp_form[ajax]" value="0" <?php if($opts['ajax'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_ajax_0">No</label></td>
				<td class="desc">Tick "yes" if you want the form to submit without causing the page to reload.</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc4wp_form_hide_after_success">Hide form after a successful sign-up?</label></th>
				<td class="nowrap"><input type="radio" id="mc4wp_form_hide_after_success_1" name="mc4wp_form[hide_after_success]" value="1" <?php if($opts['hide_after_success'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_hide_after_success_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_form_hide_after_success_0" name="mc4wp_form[hide_after_success]" value="0" <?php if($opts['hide_after_success'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_form_hide_after_success_0">No</label></td>
				<td class="desc">Tick "yes" to only show the success message after a successful sign-up.</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc4wp_form_redirect">Redirect to this URL after a successful sign-up</label></th>
				<td colspan="2">
					<input type="text" class="widefat" name="mc4wp_form[redirect]" id="mc4wp_form_redirect" value="<?php echo $opts['redirect']; ?>" />
					<small>Leave empty or enter <strong>0</strong> (zero) if you don't want to redirect.</small>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="mc4wp_form_text_success">Success message</label></th>
					<td colspan="2" ><input type="text" class="widefat" id="mc4wp_form_text_success" name="mc4wp_form[text_success]" value="<?php echo esc_attr($opts['text_success']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="mc4wp_form_text_error">General error message</label></th>
					<td colspan="2" ><input type="text" class="widefat" id="mc4wp_form_text_error" name="mc4wp_form[text_error]" value="<?php echo esc_attr($opts['text_error']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="mc4wp_form_text_invalid_email">Invalid email address message</label></th>
					<td colspan="2" ><input type="text" class="widefat" id="mc4wp_form_text_invalid_email" name="mc4wp_form[text_invalid_email]" value="<?php echo esc_attr($opts['text_invalid_email']); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="mc4wp_form_text_already_subscribed">Email address is already on list message</label></th>
					<td colspan="2" ><input type="text" class="widefat" id="mc4wp_form_text_already_subscribed" name="mc4wp_form[text_already_subscribed]" value="<?php echo esc_attr($opts['text_already_subscribed']); ?>" /></td>
				</tr>
				<tr>
					<th></th>
					<td colspan="2"><p><small>HTML tags like &lt;a&gt; and &lt;strong&gt; etc. are allowed in the message fields.</small></p></td>
				</tr>
			</table>

			<?php submit_button(); ?>

		</form>


	</div>