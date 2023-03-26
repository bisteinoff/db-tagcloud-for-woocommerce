<?php
/*
Plugin Name: DB Tagcloud for Woocommerce
Plugin URI: http://bisteinoff.com
Description: The plugin helps to make a tag cloud for Woocommerce category pages using a shortcode that is highly beneficial for optimizing your website for Google, Bing, Yandex and other search engines (SEO)
Version: 1.0
Author: Denis Bisteinov
Author URI: http://seogio.ru
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

		function dbTagCloud() {

			if (function_exists ('add_shortcode') )
				add_shortcode('tagcloud', array(&$this, 'tag_cloud') );

			}

		function tag_cloud($db_attribute) {

			$db_attribute = shortcode_atts( [
				'attr' => 'none',
				'cols' => '8',
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

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

				$db_html .= "<ul class=\"db-tagcloud db-cols-{$db_cols}\">";
				foreach ( $terms as $term )
					$db_html .= "<li><a href=\"/katalog/{$db_attr}/{$term->slug}/\">{$term->name}</a> </li>";
				$db_html .= "</ul>";

			}

			return $db_html;

		}

	}

	$db_tagcloud = new dbTagCloud();