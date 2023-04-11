<?php

	$db_css = '';
	$db_link = plugin_dir_path( __FILE__ ) . 'custom.min.css';
	$fontsize = esc_html ( get_option('db_tagcloud_fontsize') );
	$fontweight = esc_html ( get_option('db_tagcloud_fontweight') );
	$borderwidth = esc_html ( get_option('db_tagcloud_borderwidth') );
	$color = sanitize_hex_color ( get_option('db_tagcloud_color') );

	$db_css .= ".db-tagcloud li a {";

	if ( $fontsize > 0 )
		$db_css .= "font-size:" . $fontsize . "px;";

	if ( $fontweight > 0 ) {

		switch ( $fontweight ) {

			case 1 : $db_css .= "font-weight:700;";
			break;

			case 2 : $db_css .= "font-style:italic;";
			break;

			case 3 : $db_css .= "font-weight:700;font-style:italic;";
			break;

		}

	}

	if ( $borderwidth !== '' && $borderwidth >= 0 )
		$db_css .= "border-width:" . $borderwidth . "px;";

	if ( $color !== '' )
		$db_css .= "border-color:{$color};color:{$color}";

	$db_css .= "}";

	if ( file_exists ( $db_link ) )
		wp_delete_file ( $db_link );

	$db_css_file = fopen( $db_link, "w" );
	fwrite( $db_css_file, $db_css );
	fclose( $db_css_file );