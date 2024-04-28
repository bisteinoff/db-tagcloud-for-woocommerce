<?php

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$db_css = "";

	$db_tagcloud = new DBPL_TagCloud();
	$multisite = $db_tagcloud -> tag_multisite_id();
	$prefix = $multisite[prefix];
	$db_link = plugin_dir_path( __FILE__ ) . "custom{$prefix}.min.css";

	$fontweight_values = array ( '400', '700', '400', '700' );
	$fontstyle_values = array ( 'normal', 'normal', 'italic', 'italic' );

	$db_css .=

		".db-tagcloud li a {" .

			( $fontsize > 0 ? "font-size:{$fontsize}px;" : "" ) .

			( $fontweight >= 0 && $fontweight <= 3 ? "font-weight:{$fontweight_values[$fontweight]};font-style:{$fontstyle_values[$fontweight]};" : "" ) .

			( $borderwidth !== '' && $borderwidth >= 0 ? "border-width:{$borderwidth}px;" : "" ) .

			( $underlined === 1 ? "text-decoration:underline;" : "text-decoration:none;" ) .

			( $color !== '' ? "border-color:{$color};color:{$color};" : "") .

			( $background !== '' ? "background:{$background};" : "") .

		"}" .

		".db-tagcloud li a:hover {" .

			( $underlined_hover === 1 ? "text-decoration:underline;" : "text-decoration:none;" ) .

			( $color_hover !== '' ? "border-color:{$color_hover};color:{$color_hover};" : "") .

			( $background_hover !== '' ? "background:{$background_hover};" : "") .

		"}";

	if ( file_exists ( $db_link ) )
		wp_delete_file ( $db_link );

	$db_css_file = fopen( $db_link, "w" );
	fwrite( $db_css_file, $db_css );
	fclose( $db_css_file );