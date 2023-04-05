<?php
/*
Plugin Name: DB Tagcloud for Woocommerce
Plugin URI: https://github.com/bisteinoff/db-tagcloud-for-woocommerce
Description: The plugin helps to make a tag cloud for Woocommerce category pages using a shortcode that is highly beneficial for optimizing your website for Google, Bing, Yandex and other search engines (SEO)
Version: 1.3
Author: Denis Bisteinov
Author URI: https://bisteinoff.com
License: GPL2
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : bisteinoff@gmail.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

	// Example: [tagcloud attr="color" cols="8"]

	class dbTagCloud

	{

		public $baseUrl;

		function pluginUrl()
		{

			if (function_exists (plugins_url) )
				$this->baseUrl = plugins_url ('/db-tagcloud/');
			else
				$this->baseUrl = get_option('siteurl') . '/wp-content/plugins/db-tagcloud/';

			return $this->baseUrl;
		}

		function dbTagCloud()
		{

			add_option('db_tagcloud_cols', '8');
			add_option('db_tagcloud_fontsize');
			add_option('db_tagcloud_fontweight');


			if (function_exists ('add_shortcode') )
			{
				add_shortcode('tagcloud', array(&$this, 'tag_cloud') );

				add_filter( 'mce_buttons_2', array(&$this, 'mce_buttons') );
				add_filter( 'mce_external_plugins', array(&$this, 'mce_external_plugins') );


				wp_register_style('db-tagcloud', $this->pluginUrl() . 'css/style.css');
				wp_enqueue_style( 'db-tagcloud');

				add_action( 'admin_menu', array (&$this, 'admin') );
				add_action( 'admin_enqueue_scripts', function() {
								wp_register_style('db-tagcloud-admin', $this->pluginUrl() . 'css/admin.css');
								wp_enqueue_style( 'db-tagcloud-admin' );
							},
							99
				);
				add_action( 'admin_footer', array (&$this, 'admin_footer_js') );
			}

		}

		function tag_cloud($db_attribute)
		{

			$db_attribute = shortcode_atts( [
				'attr' => 'none',
				'cols' => get_option('db_tagcloud_cols'),
			], $db_attribute );

			$db_attr = $db_attribute['attr'];
			$db_cols = $db_attribute['cols'];

			$db_html = '';
			$terms = get_terms(
				array( 
					'taxonomy' => 'pa_' . $db_attr ,
					'hide_empty' => false,
				)
			);

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
			{

				$db_html .= "<ul class=\"db-tagcloud db-cols-{$db_cols}\">";
				foreach ( $terms as $term )
					$db_html .= "<li><a href=\"/katalog/{$db_attr}/{$term->slug}/\">{$term->name}</a> </li>";
				$db_html .= "</ul>";

			}

			return $db_html;

		}

		function mce_buttons($buttons)
		{
			array_push($buttons, "tagcloud");
			return $buttons;
		}

		function mce_external_plugins($plugin_array)
		{
			$plugin_array['db-tagcloud'] = $this->pluginUrl() . 'js/editor_plugin.min.js';

			return $plugin_array;
		}

		function admin() {

			if ( function_exists('add_menu_page') )
			{

				$icon = '<svg id="icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path style="fill:white;" d="M16,7h0a8.0233,8.0233,0,0,1,7.8649,6.4935l.2591,1.346,1.3488.244A5.5019,5.5019,0,0,1,24.5076,26H7.4954a5.5019,5.5019,0,0,1-.9695-10.9165l1.3488-.244.2591-1.346A8.0256,8.0256,0,0,1,16,7m0-2a10.0244,10.0244,0,0,0-9.83,8.1155A7.5019,7.5019,0,0,0,7.4911,28H24.5076a7.5019,7.5019,0,0,0,1.3213-14.8845A10.0229,10.0229,0,0,0,15.9883,5Z" transform="translate(0)"/></svg>';

				add_menu_page(
					'DB Tag Cloud Settings',
					'DB Tag Cloud',
					'manage_options',
					'db-tagcloud',
					array (&$this, 'admin_page_callback'),
					'data:image/svg+xml;base64,' . base64_encode( $icon ),
					27
					);

			}

		}

		function admin_page_callback()
		{

			require_once('bisteinoff-tagcloud-settings.php');

		}

		function admin_footer_js()
		{
			$cols = get_option('db_tagcloud_cols'); ?>
			
<script type="text/javascript">var dbTagCloudCols = <?php echo $cols; ?></script><?php
			
		}

	}

	$db_tagcloud = new dbTagCloud();