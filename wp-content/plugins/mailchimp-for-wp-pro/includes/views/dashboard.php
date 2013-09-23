<div id="mc4wp_admin" class="wrap">

	<h2><img src="<?php echo plugins_url('mailchimp-for-wp-pro/assets/img/menu-icon.png'); ?>" /> MailChimp for WordPress Pro</h2>

	<?php settings_errors(); ?>

	<h2 class="nav-tab-wrapper">  
		<a href="?page=mc4wp-pro" class="nav-tab <?php echo ($active_tab == 'general-settings') ? 'nav-tab-active' : ''; ?>">License & API Settings</a>  
		<?php if($this->has_valid_license()) { ?>
			<a href="?page=mc4wp-pro-checkbox-settings" class="nav-tab <?php echo ($active_tab == 'checkbox-settings') ? 'nav-tab-active' : ''; ?>">Checkbox Settings</a>
			<a href="?page=mc4wp-pro-form-settings" class="nav-tab <?php echo ($active_tab == 'form-settings') ? 'nav-tab-active' : ''; ?>">Form Settings</a>  
			<a href="?page=mc4wp-pro-subscribers-log" class="nav-tab <?php echo ($active_tab == 'log') ? 'nav-tab-active' : ''; ?>">Subscribers Log</a>  
			<?php if($this->options['log']['enable']) { ?><a href="?page=mc4wp-pro-statistics" class="nav-tab <?php echo ($active_tab == 'statistics') ? 'nav-tab-active' : ''; ?>">Statistics</a><?php } ?>
		<?php } ?>
	</h2> 

	<div class="content-wrapper">

		<?php require $active_tab .".php"; ?>

	</div>

	<div class="mc4wp-footer">
		<p>Need help? E-mail me directly at <a target="_blank" href="mailto:support@dannyvankooten.com?Subject=MailChimp+for+WP+Pro+Support&Body=Hi+Danny%2C%0D%0A%0D%0AMy+website%3A+<?php echo urlencode(site_url()); ?>%0D%0AWordPress+version%3A+<?php bloginfo('version'); ?>%0D%0APHP+Version%3A+<?php echo phpversion(); ?>%0D%0A%0D%0A">support@dannyvankooten.com</a>. Please include your website URL and as many details as possible in the e-mail. Use the link if you're lazy. :)</p>
	</div>

</div>