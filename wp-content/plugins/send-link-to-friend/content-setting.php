<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2>Send link to friend</h2>	
    <?php
	$gSendtofriend_title = get_option('gSendtofriend_title');
	$gSendtofriend_title_sm = get_option('gSendtofriend_title_sm');
	$gSendtofriend_fromname = get_option('gSendtofriend_fromname');
	$gSendtofriend_fromemail = get_option('gSendtofriend_fromemail');
	$gSendtofriend_On_Homepage = get_option('gSendtofriend_On_Homepage');
	$gSendtofriend_On_Posts = get_option('gSendtofriend_On_Posts');
	$gSendtofriend_On_Pages = get_option('gSendtofriend_On_Pages');
	$gSendtofriend_On_Search = get_option('gSendtofriend_On_Search');
	$gSendtofriend_On_Archives = get_option('gSendtofriend_On_Archives');
	
	if (isset($_POST['gSendtofriend_form_submit']) && $_POST['gSendtofriend_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('gSendtofriend_form_setting');
	
		$gSendtofriend_title = stripslashes(trim($_POST['gSendtofriend_title']));
		$gSendtofriend_title_sm = stripslashes(trim($_POST['gSendtofriend_title_sm']));
		$gSendtofriend_fromname = stripslashes(trim($_POST['gSendtofriend_fromname']));
		$gSendtofriend_fromemail = stripslashes(trim($_POST['gSendtofriend_fromemail']));
		$gSendtofriend_On_Homepage = stripslashes(trim($_POST['gSendtofriend_On_Homepage']));
		$gSendtofriend_On_Posts = stripslashes(trim($_POST['gSendtofriend_On_Posts']));
		$gSendtofriend_On_Pages = stripslashes(trim($_POST['gSendtofriend_On_Pages']));
		//$gSendtofriend_On_Search = stripslashes(trim($_POST['gSendtofriend_On_Search']));
		//$gSendtofriend_On_Archives = stripslashes(trim($_POST['gSendtofriend_On_Archives']));
		
		update_option('gSendtofriend_title', $gSendtofriend_title );
		update_option('gSendtofriend_title_sm', $gSendtofriend_title_sm );
		update_option('gSendtofriend_fromname', $gSendtofriend_fromname );
		update_option('gSendtofriend_fromemail', $gSendtofriend_fromemail );
		update_option('gSendtofriend_On_Homepage', $gSendtofriend_On_Homepage );
		update_option('gSendtofriend_On_Posts', $gSendtofriend_On_Posts );
		update_option('gSendtofriend_On_Pages', $gSendtofriend_On_Pages );
		//update_option('gSendtofriend_On_Search', $gSendtofriend_On_Search );
		//update_option('gSendtofriend_On_Archives', $gSendtofriend_On_Archives );
		
		?>
		<div class="updated fade">
			<p><strong>Details successfully updated.</strong></p>
		</div>
		<?php
	}
	?>
	 <form name="cas_form" method="post" action="">
		<h3>Plugin setting</h3>
		
		<label for="tag-width">Widget title</label>
		<input name="gSendtofriend_title" type="text" value="<?php echo $gSendtofriend_title; ?>"  id="gSendtofriend_title" size="50" maxlength="100">
		<p>Please enter your widget title.</p>
		
		<label for="tag-width">Small description</label>
		<input name="gSendtofriend_title_sm" type="text" value="<?php echo $gSendtofriend_title_sm; ?>"  id="gSendtofriend_title_sm" size="100" maxlength="500">
		<p>Please enter your small description.</p>
		
		<label for="tag-width">From email name</label>
		<input name="gSendtofriend_fromname" type="text" value="<?php echo $gSendtofriend_fromname; ?>"  id="gSendtofriend_fromname" size="50" maxlength="500">
		<p>Please enter your email from name.</p>
		
		<label for="tag-width">From email address</label>
		<input name="gSendtofriend_fromemail" type="text" value="<?php echo $gSendtofriend_fromemail; ?>"  id="gSendtofriend_fromemail" size="50" maxlength="500">
		<p>Please enter your from email address.</p>
		
		<h3>Dsiplay option</h3>
		
		<label for="tag-width">Display on home page</label>
		<select name="gSendtofriend_On_Homepage" id="gSendtofriend_On_Homepage">
			<option value='YES' <?php if($gSendtofriend_On_Homepage == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gSendtofriend_On_Homepage == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in home page?.</p>
		
	    <label for="tag-width">Display on posts</label>
		<select name="gSendtofriend_On_Posts" id="gSendtofriend_On_Posts">
			<option value='YES' <?php if($gSendtofriend_On_Posts == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gSendtofriend_On_Posts == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in all posts?.</p>
		
		<label for="tag-width">Display on pages</label>
		<select name="gSendtofriend_On_Pages" id="gSendtofriend_On_Pages">
			<option value='YES' <?php if($gSendtofriend_On_Pages == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($gSendtofriend_On_Pages == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p>Do you want to show this widget in all pages?.</p>
		
		<p class="submit">
		<input type="hidden" name="gSendtofriend_form_submit" value="yes"/>
		<input name="gSendtofriend_submit" id="gSendtofriend_submit" class="button" value="Submit" type="submit" />&nbsp;
		<a class="button" target="_blank" href="http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/">Help</a>
		</p>
		<?php wp_nonce_field('gSendtofriend_form_setting'); ?>
    </form>
	 </div>
  <p class="description">Check official website for more information <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/">click here</a></p>
</div>