<?php // THE SETTINGS PAGE

	$cols = get_option('db_tagcloud_cols');

	if ( isset($_POST['submit']) )
	{

		if ( function_exists('current_user_can') &&
			 !current_user_can('manage_options') )
				die( _e('Error: You do not have the permission to update the value' , 'dbTagCloud') );

		if ( function_exists('check_admin_referrer') )
			check_admin_referrer('db_tagcloud_form');

		$cols = $_POST['cols'];

		update_option('db_tagcloud_cols', $cols);

	}

?>
<div class='wrap db-tgcl-admin'>

	<h1><?php _e('DB Tag Cloud', 'dbTagCloud'); ?></h1>

	<h2><?php _e('Settings', 'dbTagCloud'); ?></h2>

	<form name="db-tagcloud" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=db-tagcloud&amp;updated=true">

		<?php
			if (function_exists ('wp_nonce_field') )
				wp_nonce_field('db_tagcloud_form');
		?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row" class="db-tgcl-admin-cols-default">
					<?php _e('Default number of columns' , 'dbTagCloud') ?>
					<div class="td-tgcl-field-description">The default number of columns will appear in the shortcode</div>
				</th>
				<td>
					<input type="text" name="cols"
							size="5" value="<?php echo $cols; ?>" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="action" value="update" />
		
		<input type="hidden" name="page_options" value="db_tagcloud_cols" />
		
		<p class="submit">
			<input type="submit" name="submit" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>

	<h2><?php _e('Shortcode', 'dbTagCloud'); ?></h2>
	
	<p>Example: [tagcloud attr="color" cols="<?php 
	
		if ( $cols > 0 )
			echo $cols;
		else
			echo '8';
	
	?>"]</p>
	
	<p>In this example you will want to change the name of a woocommerce attribute and the number of columns.</p>

	<h2><?php _e('Examples', 'dbTagCloud'); ?></h2>
	
	<p>There are two DB taglouds in this picture. The first one is an 8-columns tagclound. The second one has 4 columns.</p>
	
	<p><img src="/wp-content/plugins/db-tagcloud/img/example.png" width="614" height="418" alt="2 examples of tag clouds" /></p>

</div>