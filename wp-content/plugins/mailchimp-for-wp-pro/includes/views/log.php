<div id="mc4wp-log">

	<h3>Log Settings</h3>		

	<form method="post" action="options.php">

		<?php settings_fields( 'mc4wp_log_settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">Track subscribers?</th>
				<td><input type="radio" id="mc4wp_log_enable_1" name="mc4wp_log[enable]" value="1" <?php if($opts['enable'] == 1) echo 'checked="checked"'; ?> /> <label for="mc4wp_log_enable_1">Yes</label> &nbsp; <input type="radio" id="mc4wp_log_enable_0" name="mc4wp_log[enable]" value="0" <?php if($opts['enable'] == 0) echo 'checked="checked"'; ?> /> <label for="mc4wp_log_0">No</label></td>
				<td class="desc">Choose "no" if you want to disable logging and statistics. </td>
			</tr>
		</table>

		<?php submit_button(); ?>

	</form>

	<?php if($opts['enable']) { ?>
	<div id="mc4wp-log-table">
		<h2>Subscribers log</h2>

		<?php $table->views(); ?>
		<form method="get">
		  	<input type="hidden" name="page" value="mc4wp-pro-subscribers-log" />
		  	<?php $table->search_box('search', 'mc4wp-log-search'); ?>
			<?php $table->display(); ?>
		</form>
	</div>
	<?php } ?>
	
</div>