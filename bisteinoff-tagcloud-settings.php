<?php // THE SETTINGS PAGE

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$baseObj = new dbTagCloud();
	$d = $baseObj -> thisdir(); // domain for translate.wordpress.org

	$cols = (int) get_option('db_tagcloud_cols');
	$fontsize = (float) get_option('db_tagcloud_fontsize');
	$fontweight = (int) get_option('db_tagcloud_fontweight');
	$borderwidth = (float) get_option('db_tagcloud_borderwidth');
	$underlined = (int) get_option('db_tagcloud_underlined');
	$underlined_hover = (int) get_option('db_tagcloud_underlined_hover');
	$color = get_option('db_tagcloud_color');
	$color_hover = get_option('db_tagcloud_color_hover');
	$background = get_option('db_tagcloud_background');
	$background_hover = get_option('db_tagcloud_background_hover');

	if ( isset ( $_POST['submit'] ) && 
		 isset( $_POST[ $d . '_nonce' ] ) &&
		 wp_verify_nonce( $_POST[ $d . '_nonce' ], $d ) )
	{

		if ( function_exists('current_user_can') &&
			 !current_user_can('manage_options') )
				die( _e( 'Error: You do not have the permission to update the value' , 'db-tagcloud-for-woocommerce' ) );


		// Columns
		$cols = (int) esc_html ( sanitize_text_field ( $_POST['cols'] ) );
		update_option( 'db_tagcloud_cols', $cols );

		// Font size
		if ( !empty ( $_POST['fontsize'] ) )
			$fontsize = (float) esc_html ( sanitize_text_field ( $_POST['fontsize'] ) );
		else
			$fontsize = '';
		update_option ( 'db_tagcloud_fontsize', $fontsize );

		// Font weight
		$fontweight = (int) esc_html ( sanitize_text_field ( $_POST['fontweight'] ) );
		update_option ( 'db_tagcloud_fontweight', $fontweight );

		// Border width
		if ( !empty ( $_POST['borderwidth'] ) )
			$borderwidth = (float) esc_html ( sanitize_text_field ( $_POST['borderwidth'] ) );
		else
			$borderwidth = '';
		update_option ( 'db_tagcloud_borderwidth', $borderwidth );

		// Underlined
		$underlined = (int) esc_html ( sanitize_text_field ( $_POST['underlined'] ) );
		update_option ( 'db_tagcloud_underlined', $underlined );

		// Underlined on Hover
		$underlined_hover = (int) esc_html ( sanitize_text_field ( $_POST['underlined_hover'] ) );
		update_option ( 'db_tagcloud_underlined_hover', $underlined_hover );

		// Color
		$color = esc_html ( sanitize_hex_color ( $_POST['color'] ) );
		update_option( 'db_tagcloud_color', $color );

		// Color on Hover
		$color_hover = esc_html ( sanitize_hex_color ( $_POST['color_hover'] ) );
		update_option( 'db_tagcloud_color_hover', $color_hover );

		// Background Color
		$background = esc_html ( sanitize_hex_color ( $_POST['background'] ) );
		update_option( 'db_tagcloud_background', $background );

		// Background Color on Hover
		$background_hover = esc_html ( sanitize_hex_color ( $_POST['background_hover'] ) );
		update_option( 'db_tagcloud_background_hover', $background_hover );

		require_once('css/custom.php');

	}

?>
<div class='wrap db-tgcl-admin'>

	<h1><?php _e( 'DB Tag Cloud', 'db-tagcloud-for-woocommerce' ); ?></h1>

	<div class="db-tgcl-description">
		<p><?php _e( 'The plugin helps to easily make a tag cloud of pages for any Woocommerce attribute using a shortcode. This is highly beneficial for optimizing your website for Google, Bing, Yandex and other search engines (SEO).', $d ) ?></p>
	</div>

	<h2><?php _e( 'Settings', 'db-tagcloud-for-woocommerce' ); ?></h2>

	<form name="db-tagcloud" method="post" action="<?php echo esc_html ( $_SERVER['PHP_SELF'] ); ?>?page=<?php echo esc_html ( $d ) ?>&amp;updated=true">

		<?php
			if (function_exists ('wp_nonce_field') )
				wp_nonce_field('db_tagcloud_form');
		?>

		<table class="form-table db-tgcl-table" width="100%">
			<tr valign="top">
				<th scope="row" width="15%">
					<?php _e( 'Default number of columns' , 'db-tagcloud-for-woocommerce' ) ?>
					<div class="db-tgcl-field-description"><?php _e( 'The default number of columns will appear in the shortcode', 'db-tagcloud-for-woocommerce' ) ?></div>
				</th>
				<td width="15%">
					<input type="text" name="cols" id="db_tgcl_cols"
							size="5" value="<?php echo esc_html ( sanitize_text_field ( $cols ) ) ?>" />
				</td>
				<th scope="col" width="70%">
					<?php _e( 'Preview' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
			</tr>
			<tr valign="top">
				<th scope="colgroup" colspan="2">
					<?php _e( 'Styling' , 'db-tagcloud-for-woocommerce' ) ?>
					<div class="db-tgcl-field-description"><?php _e( 'Customization of the appearance of the DB Tagcloud', 'db-tagcloud-for-woocommerce' ) ?></div>
				</th>
				<td rowspan="10" id="db_tgcl_preview">
					<div id="db_tgcl_preloader">
						<img src="/wp-content/plugins/db-tagcloud-for-woocommerce/img/spinner.gif" width="42" height="42" alt="<?php _e( 'Wait a second...' , 'db-tagcloud-for-woocommerce' ) ?>" title="<?php _e( 'Wait a second...' , 'db-tagcloud-for-woocommerce' ) ?>" />
					</div>
					<ul class="db-tagcloud db-cols-<?php echo esc_html ( sanitize_text_field ( $cols ) ) ?> db-hidden">
						<li><a href="#"><?php _e( 'Square' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Rectangular' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Round' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Oval' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Semicircular' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'L-Shape' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Cushion Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Pillow Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Tufted Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Split Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Loose Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
						<li><a href="#"><?php _e( 'Tight Back' , 'db-tagcloud-for-woocommerce' ) ?></a></li>
					</ul>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Font Size' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td>
					<input type="text" name="fontsize" id="db_tgcl_fontsize"
							size="3" value="<?php echo esc_html ( sanitize_text_field ( $fontsize ) ) ?>" /> px
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Font Weight' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td>
					<select type="text" name="fontweight" id="db_tgcl_fontweight">
						<option value="0" <?php selected( $fontweight, '0' ); ?>><?php _e( 'normal' , 'db-tagcloud-for-woocommerce' ) ?></option>
						<option value="1" <?php selected( $fontweight, '1' ); ?>><?php _e( 'bold' , 'db-tagcloud-for-woocommerce' ) ?></option>
						<option value="2" <?php selected( $fontweight, '2' ); ?>><?php _e( 'italic' , 'db-tagcloud-for-woocommerce' ) ?></option>
						<option value="3" <?php selected( $fontweight, '3' ); ?>><?php _e( 'bold italic' , 'db-tagcloud-for-woocommerce' ) ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Border Width' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td>
					<input type="text" name="borderwidth" id="db_tgcl_borderwidth"
							size="3" value="<?php echo esc_html ( sanitize_text_field ( $borderwidth ) ) ?>" /> px
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Underlined' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td>
					<select type="text" name="underlined" id="db_tgcl_underlined">
						<option value="1" <?php selected( $underlined, '1' ); ?>><?php _e( 'Yes' , 'db-tagcloud-for-woocommerce' ) ?></option>
						<option value="0" <?php selected( $underlined, '0' ); ?>><?php _e( 'No' , 'db-tagcloud-for-woocommerce' ) ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Underlined' , 'db-tagcloud-for-woocommerce' ) ?> <?php _e( 'on Hover' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td>
					<select type="text" name="underlined_hover" id="db_tgcl_underlined_hover">
						<option value="1" <?php selected( $underlined_hover, '1' ); ?>><?php _e( 'Yes' , 'db-tagcloud-for-woocommerce' ) ?></option>
						<option value="0" <?php selected( $underlined_hover, '0' ); ?>><?php _e( 'No' , 'db-tagcloud-for-woocommerce' ) ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Color' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td id="db_tgcl_color_inner">
					<input type="text" name="color" id="db_tgcl_color" class="db-tgcl-color"
							size="7" value="<?php echo esc_html ( sanitize_hex_color ( $color ) ) ?>" data-default-color="#333333" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Color' , 'db-tagcloud-for-woocommerce' ) ?> <?php _e( 'on Hover' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td id="db_tgcl_color_hover_inner">
					<input type="text" name="color_hover" id="db_tgcl_color_hover" class="db-tgcl-color-hover"
							size="7" value="<?php echo esc_html ( sanitize_hex_color ( $color_hover ) ) ?>" data-default-color="#666666" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Background Color' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td id="db_tgcl_background_inner">
					<input type="text" name="background" id="db_tgcl_background" class="db-tgcl-background"
							size="7" value="<?php echo esc_html ( sanitize_hex_color ( $background ) ) ?>" data-default-color="#ffffff" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<?php _e( 'Background Color' , 'db-tagcloud-for-woocommerce' ) ?> <?php _e( 'on Hover' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<td id="db_tgcl_background_hover_inner">
					<input type="text" name="background_hover" id="db_tgcl_background_hover" class="db-tgcl-background-hover"
							size="7" value="<?php echo esc_html ( sanitize_hex_color ( $background_hover ) ) ?>" data-default-color="#ffffff" />
				</td>
			</tr>
		</table>

		<input type="hidden" name="action" value="update" />

		<?php $nonce = wp_create_nonce( $d ); ?>

		<input type="hidden" name="<?php echo esc_html( sanitize_text_field( $d ) ) ?>_nonce" value="<?php echo esc_html( sanitize_text_field( $nonce ) ) ?>" />

		<?php submit_button(); ?>

	</form>

	<h2><?php _e( 'Shortcode', 'db-tagcloud-for-woocommerce' ); ?></h2>


	<div class="db-tgcl-description">

		<p class="db-center"><?php _e( 'Example:', 'db-tagcloud-for-woocommerce' ); ?></p>

		<div id="db_tgcl_shortcode">[tagcloud attr="<span class="db-highlighted">color</span>" cols="<span class="db-highlighted"><?php echo ( $cols > 0 ? $cols : '4' ); ?></span>"]</div>

	<p><?php _e( 'In this example you will want to change the name of a woocommerce attribute and the number of columns.', 'db-tagcloud-for-woocommerce' ); ?></p>

	</div>

	<h2><?php _e( 'Woocommerce Attributes', 'db-tagcloud-for-woocommerce' ); ?></h2>

	<div class="db-tgcl-description">

		<p><?php _e( 'The list of Woocommerce Attributes on your website.', 'db-tagcloud-for-woocommerce' ); ?></p>

		<table id="db_tgcl_woo_attr_table" class="db-tgcl-table" width="100%">
			<tr>
				<th scope="col" width="50%">
					<?php _e( 'Name of Attribute' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
				<th scope="col" width="50%">
					<?php _e( 'Parameter for Shortcode' , 'db-tagcloud-for-woocommerce' ) ?>
				</th>
			</tr>
			<?php
			$db_woo_attributes =  wc_get_attribute_taxonomies();
			if ( $db_woo_attributes )
				foreach ( $db_woo_attributes as $db_woo_attribute )
					echo "<tr><td>{$db_woo_attribute->attribute_label}</td><td><code>{$db_woo_attribute->attribute_name}</code></td></tr>";
			?>
		</table>

	</div>

	<h2><?php _e( 'Examples', 'db-tagcloud-for-woocommerce' ); ?></h2>

	<div class="db-tgcl-description">

		<p><?php _e( 'There are two DB taglouds in this picture. The first one is an 8-columns tagclound. The second one has 4 columns.', 'db-tagcloud-for-woocommerce' ); ?></p>

		<p class="db-center"><img class="db-roundborder" src="/wp-content/plugins/db-tagcloud-for-woocommerce/img/example.png" width="700" height="475" alt="<?php _e( '2 examples of tag clouds', 'db-tagcloud-for-woocommerce' ); ?>" /></p>

	</div>

</div>