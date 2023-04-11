<?php // THE SETTINGS PAGE

	$cols = (int) get_option('db_tagcloud_cols');
	$fontsize = esc_html ( get_option('db_tagcloud_fontsize') );
	$fontweight = (int) get_option('db_tagcloud_fontweight');
	$borderwidth = esc_html ( get_option('db_tagcloud_borderwidth') );
	$color = sanitize_hex_color ( get_option('db_tagcloud_color') );

	if ( isset ( $_POST['submit'] ) )
	{

		if ( function_exists('current_user_can') &&
			 !current_user_can('manage_options') )
				die( _e('Error: You do not have the permission to update the value' , 'dbTagCloud') );

		if ( function_exists('check_admin_referrer') )
			check_admin_referrer('db_tagcloud_form');

		// Columns
		$cols = (int) $_POST['cols'];
		update_option( 'db_tagcloud_cols', $cols );

		// Font size
		if ( $_POST['fontsize'] !== '' )
			$fontsize = (float) $_POST['fontsize'];
		else
			$fontsize = '';
		update_option ( 'db_tagcloud_fontsize', $fontsize );

		// Font weight
		$fontweight = (int) $_POST['fontweight'];
		update_option ( 'db_tagcloud_fontweight', $fontweight );

		// Border width
		if ( $_POST['borderwidth'] !== '' )
			$borderwidth = (float) $_POST['borderwidth'];
		else
			$borderwidth = '';
		update_option ( 'db_tagcloud_borderwidth', $borderwidth );

		// Color
		$color = sanitize_hex_color ( $_POST['color'] );
		update_option( 'db_tagcloud_color', $color );

		require_once('css/custom.php');

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

		<table class="form-table" width="100%">
			<tr valign="top">
				<th scope="row" colspan="2" width="20%">
					<?php _e('Default number of columns' , 'dbTagCloud') ?>
					<div class="db-tgcl-field-description">The default number of columns will appear in the shortcode</div>
				</th>
				<td width="10%">
					<input type="text" name="cols" id="db_tgcl_cols"
							size="5" value="<?php echo $cols; ?>" />
				</td>
				<th scope="col" width="70%">
					<?php _e('Preview' , 'dbTagCloud') ?>
				</th>
			</tr>
			<tr valign="top">
				<th scope="rowgroup" rowspan="4" width="10%">
					<?php _e('Styling' , 'dbTagCloud') ?>
					<div class="db-tgcl-field-description">Customization of the appearance of the DB Tagcloud</div>
				</th>
				<th scope="row" width="10%">
					<?php _e('Font Size' , 'dbTagCloud') ?>
				</th>
				<td>
					<input type="text" name="fontsize" id="db_tgcl_fontsize"
							size="3" value="<?php echo $fontsize; ?>" /> px
				</td>
				<td rowspan="4" id="db_tgcl_preview">
					<ul class="db-tagcloud db-cols-<?php echo $cols; ?>">
						<li><a href="#">Black</a></li>
						<li><a href="#">White</a></li>
						<li><a href="#">Red</a></li>
						<li><a href="#">Orange</a></li>
						<li><a href="#">Yellow</a></li>
						<li><a href="#">Green</a></li>
						<li><a href="#">Blue</a></li>
						<li><a href="#">Purple</a></li>
					</ul>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="db-tgcl-after-rowspan">
					<?php _e('Font Weight' , 'dbTagCloud') ?>
				</th>
				<td>
					<select type="text" name="fontweight" id="db_tgcl_fontweight">
						<option value="0" <?php selected( $fontweight, '0' ); ?>><?php _e('normal' , 'dbTagCloud') ?></option>
						<option value="1" <?php selected( $fontweight, '1' ); ?>><?php _e('bold' , 'dbTagCloud') ?></option>
						<option value="2" <?php selected( $fontweight, '2' ); ?>><?php _e('italic' , 'dbTagCloud') ?></option>
						<option value="3" <?php selected( $fontweight, '3' ); ?>><?php _e('bold italic' , 'dbTagCloud') ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="db-tgcl-after-rowspan">
					<?php _e('Border Width' , 'dbTagCloud') ?>
				</th>
				<td>
					<input type="text" name="borderwidth" id="db_tgcl_borderwidth"
							size="3" value="<?php echo $borderwidth; ?>" /> px
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" class="db-tgcl-after-rowspan">
					<?php _e('Color' , 'dbTagCloud') ?>
				</th>
				<td id="db_tgcl_color_inner">
					<input type="text" name="color" id="db_tgcl_color" class="db-tgcl-color"
							size="7" value="<?php echo $color; ?>" data-default-color="#333333" />
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="action" value="update" />
		
		<input type="hidden" name="page_options" value="db_tagcloud_cols" />
		
		<?php submit_button(); ?>

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