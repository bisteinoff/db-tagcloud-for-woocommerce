<?php
/*
Plugin Name: DB Tagcloud for Woocommerce
Plugin URI: https://github.com/bisteinoff/db-tagcloud-for-woocommerce
Description: The plugin helps to make a tag cloud for Woocommerce category pages using a shortcode that is highly beneficial for optimizing your website for Google, Bing, Yandex and other search engines (SEO)
Version: 1.9
Author: Denis Bisteinov
Author URI: https://bisteinoff.com
Text Domain: db-tagcloud-for-woocommerce
License: GPL2
*/

/*  Copyright 2025  Denis BISTEINOV  (email : bisteinoff@gmail.com)
 
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

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'DBPL_TagCloud' ) ) :

	if ( !defined( 'DBPL_TAGCLOUD_PLUGIN_VERSION' ) )
		define( 'DBPL_TAGCLOUD_PLUGIN_VERSION', '1.9' );

	class DBPL_TagCloud

	{

		public function __construct()
		{

			add_option( 'db_tagcloud_cols',             '0' );
			add_option( 'db_tagcloud_fontsize',         '14');
			add_option( 'db_tagcloud_fontweight',       '0' );
			add_option( 'db_tagcloud_borderwidth',      '1' );
			add_option( 'db_tagcloud_underlined',       '0' );
			add_option( 'db_tagcloud_underlined_hover', '0' );
			add_option( 'db_tagcloud_color',            '#333333' );
			add_option( 'db_tagcloud_color_hover',      '#666666' );
			add_option( 'db_tagcloud_background',       '#ffffff' );
			add_option( 'db_tagcloud_background_hover', '#ffffff' );


			if ( function_exists( 'add_shortcode' ) ) :

				$multisite = $this -> tag_multisite_id();
				$prefix = $multisite[ 'prefix' ];

				add_shortcode( 'tagcloud', array( &$this, 'tag_cloud' ) );

				add_filter( 'mce_buttons_2', array( &$this, 'mce_buttons' ) );
				add_filter( 'mce_external_plugins', array( &$this, 'mce_external_plugins' ) );
				add_filter( 'plugin_action_links_' . $this -> thisdir() . '/bisteinoff-tagcloud.php', array( &$this, 'db_settings_link' ) );

				add_action( 'wp_enqueue_scripts', function() use ( $prefix ) {

					wp_enqueue_style(
						$this -> thisdir(),
						plugin_dir_url( __FILE__ ) . 'css/style.min.css',
						[],
						DBPL_TAGCLOUD_PLUGIN_VERSION,
						'all'
					);
	
					wp_enqueue_style(
						$this -> thisdir() . '-custom',
						plugin_dir_url( __FILE__ ) . 'css/custom' . $prefix . '.min.css',
						[],
						DBPL_TAGCLOUD_PLUGIN_VERSION,
						'all'
					);

				});

				add_action( 'admin_menu', array( &$this, 'admin' ) );

				add_action( 'admin_enqueue_scripts', function() {

						wp_enqueue_style(
							$this -> thisdir() . '-admin',
							plugin_dir_url( __FILE__ ) . 'css/admin.min.css',
							[],
							DBPL_TAGCLOUD_PLUGIN_VERSION,
							'all'
						);

					},
					99
				);

				add_action( 'admin_footer', array( &$this, 'admin_footer_js' ) );

				add_action( 'admin_footer', function() {

						wp_enqueue_script(
							$this -> thisdir() . '-admin',
							plugin_dir_url( __FILE__ ) . 'js/admin.min.js',
							array( 'wp-color-picker' ),
							DBPL_TAGCLOUD_PLUGIN_VERSION,
							true
						);

						wp_enqueue_style(
							$this -> thisdir(),
							plugin_dir_url( __FILE__ ) . 'css/style.min.css',
							[],
							DBPL_TAGCLOUD_PLUGIN_VERSION,
							'all'
						);

						wp_enqueue_style( 'wp-color-picker' );

						wp_enqueue_style(
							$this -> thisdir() . '-custom',
							plugin_dir_url( __FILE__ ) . 'css/custom' . $prefix . '.min.css',
							[],
							gmdate( "d.g.is" ),
							'all'
						);

					},
					99
				);

			endif;

		}

		public function thisdir()
		{
			return basename( __DIR__ );
		}

		public function tag_multisite_id()
		{
			$sep = '-';
			$data = array();

			if ( is_multisite() )
				{
					$data[ 'id' ] = get_current_blog_id();
					$data[ 'prefix' ] = $sep . $data[ 'id' ];
				}

			return $data;
		}

		public function tag_cloud( $db_attribute )
		{

			$db_attribute = shortcode_atts( [
				'attr' => 'none',
				'cols' => get_option( 'db_tagcloud_cols' ),
			], $db_attribute );

			$db_attr = $db_attribute[ 'attr' ];
			$db_cols = $db_attribute[ 'cols' ];

			$db_html = '';
			$terms = get_terms(
				array( 
					'taxonomy' => 'pa_' . $db_attr,
					'hide_empty' => false,
				)
			);

			if ( ! empty( $terms ) && !is_wp_error( $terms ) )
			{

				$db_html .= "<ul class=\"db-tagcloud db-cols-{$db_cols}\">";
				foreach ( $terms as $term )
					$db_html .= "<li><a href=\"/katalog/{$db_attr}/{$term->slug}/\">{$term->name}</a> </li>";
				$db_html .= "</ul>";

			}

			return $db_html;

		}

		public function mce_buttons( $buttons )
		{
			array_push( $buttons, "tagcloud" );
			return $buttons;
		}

		public function mce_external_plugins( $plugin_array )
		{
			$plugin_array[ $this -> thisdir() ] = plugin_dir_url( __FILE__ ) . 'js/editor_plugin.min.js';
			return $plugin_array;
		}

		public function admin() {

			if ( function_exists( 'add_menu_page' ) ) :

				if ( class_exists( 'DOMDocument' ) ) :

					$svg = new DOMDocument();
					$svg -> load( plugin_dir_path( __FILE__ ) . 'img/icon2.svg' );
					$icon = $svg -> saveHTML( $svg -> getElementsByTagName( 'svg' )[ 0 ] );
					$icon = 'data:image/svg+xml;base64,' . base64_encode( $icon );

				else:

					$icon = 'dashicons-welcome-widgets-menus';

				endif;

				add_menu_page(
					esc_html__( 'DB Tag Cloud Settings', 'db-tagcloud-for-woocommerce' ),
					esc_html__( 'DB Tag Cloud', 'db-tagcloud-for-woocommerce' ),
					'manage_options',
					$this -> thisdir(),
					array( &$this, 'admin_page_callback' ),
					$icon,
					27
					);

			endif;

		}

		public function admin_page_callback()
		{

			require_once( 'bisteinoff-tagcloud-settings.php' );

		}

		public function db_settings_link( $links )
		{

			$url = esc_url( add_query_arg(
				'page',
				$this -> thisdir(),
				get_admin_url() . 'admin.php'
			) );

			$settings_link = "<a href='$url'>" . esc_html__( 'Settings', 'db-tagcloud-for-woocommerce' ) . '</a>';

			array_push(
				$links,
				$settings_link
			);

			return $links;

		}

		public function admin_footer_js()
		{
			$cols = get_option( 'db_tagcloud_cols' );

			?>
				<script type="text/javascript">
					let dbTagCloudPluginFolder = '<?php echo esc_html( sanitize_text_field( $this -> thisdir() ) ) ?>';
					let dbTagCloudCols = <?php echo esc_html( sanitize_text_field( $cols ) ) ?>;
				</script>
			<?php
			
		}

	}

	$db_tagcloud = new DBPL_TagCloud();

endif;