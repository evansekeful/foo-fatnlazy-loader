<?php
/**
 * FooGallery FatnLazy Loader Extension
 *
 * Lazy load gallery as a list large thumbnails.
 *
 * @package   FatnLazy_Loader_Template_FooGallery_Extension
 * @author     Elizabeth Evans
 * @license   GPL-2.0+
 * @link      http://solnimbus.com
 * @copyright 2014  Elizabeth Evans
 *
 * @wordpress-plugin
 * Plugin Name: FooGallery - FatnLazy Loader
 * Description: Lazy load gallery as a list large thumbnails.
 * Version:     1.0.0
 * Author:       Elizabeth Evans
 * Author URI:  http://solnimbus.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( !class_exists( 'FatnLazy_Loader_Template_FooGallery_Extension' ) ) {

	define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_FILE', __FILE__ );
	define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL', plugin_dir_url( __FILE__ ));
	define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_VERSION', '1.0.0');
	define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_PATH', plugin_dir_path( __FILE__ ));
	define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_SLUG', 'foogallery-fatnlazy-loader');
	//define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_UPDATE_URL', 'http://fooplugins.com');
	//define('FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_UPDATE_ITEM_NAME', 'FatnLazy Loader');

	require_once( 'foogallery-fatnlazy-loader-init.php' );

	class FatnLazy_Loader_Template_FooGallery_Extension {
		/**
		 * Wire up everything we need to run the extension
		 */
		function __construct() {
			add_filter( 'foogallery_gallery_templates', array( $this, 'add_template' ) );
			add_filter( 'foogallery_gallery_templates_files', array( $this, 'register_myself' ) );
			add_filter( 'foogallery_located_template-fatnlazy-loader', array( $this, 'enqueue_dependencies' ) );
			add_filter( 'foogallery_template_js_ver-fatnlazy-loader', array( $this, 'override_version' ) );
			add_filter( 'foogallery_template_css_ver-fatnlazy-loader', array( $this, 'override_version' ) );

			//used for auto updates and licensing in premium extensions. Delete if not applicable
			//init licensing and update checking
			//require_once( FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_PATH . 'includes/EDD_SL_FooGallery.php' );

			//new EDD_SL_FooGallery_v1_1(
			//	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_FILE,
			//	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_SLUG,
			//	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_VERSION,
			//	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_UPDATE_URL,
			//	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_UPDATE_ITEM_NAME,
			//	'FatnLazy Loader');
		}

		/**
		 * Register myself so that all associated JS and CSS files can be found and automatically included
		 * @param $extensions
		 *
		 * @return array
		 */
		function register_myself( $extensions ) {
			$extensions[] = __FILE__;
			return $extensions;
		}

		/**
		 * Override the asset version number when enqueueing extension assets
		 */
		function override_version( $version ) {
			return FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_VERSION;
		}

		/**
		 * Enqueue any script or stylesheet file dependencies that your gallery template relies on
		 */
		function enqueue_dependencies() {
			//$js = FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL . 'js/jquery.fatnlazy-loader.js';
			//wp_enqueue_script( 'fatnlazy-loader', $js, array('jquery'), FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_VERSION );

			//$css = FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL . 'css/fatnlazy-loader.css';
			//foogallery_enqueue_style( 'fatnlazy-loader', $css, array(), FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_VERSION );
		}

		/**
		 * Add our gallery template to the list of templates available for every gallery
		 * @param $gallery_templates
		 *
		 * @return array
		 */
		function add_template( $gallery_templates ) {

			$gallery_templates[] = array(
				'slug'        => 'fatnlazy-loader',
				'name'        => __( 'FatnLazy Loader', 'foogallery-fatnlazy-loader'),
				'preview_css' => FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL . 'css/gallery-fatnlazy-loader.css',
				'admin_js'	  => FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL . 'js/admin-gallery-fatnlazy-loader.js',
				'fields'	  => array(
					array(
						'id'      => 'thumbnail_size',
						'title'   => __('Thumbnail Size', 'foogallery-fatnlazy-loader'),
						'desc'    => __('Choose the size of your thumbs.', 'foogallery-fatnlazy-loader'),
						'type'    => 'thumb_size',
						'default' => array(
							'width' => get_option( 'thumbnail_size_w' ),
							'height' => get_option( 'thumbnail_size_h' ),
							'crop' => true
						)
					),
					array(
						'id'      => 'thumbnail_link',
						'title'   => __('Thumbnail Link', 'foogallery-fatnlazy-loader'),
						'default' => 'image' ,
						'type'    => 'thumb_link',
						'spacer'  => '<span class="spacer"></span>',
						'desc'	  => __('You can choose to either link each thumbnail to the full size image or to the image\'s attachment page.', 'foogallery-fatnlazy-loader')
					),
					array(
						'id'      => 'lightbox',
						'title'   => __('Lightbox', 'foogallery-fatnlazy-loader'),
						'desc'    => __('Choose which lightbox you want to use in the gallery.', 'foogallery-fatnlazy-loader'),
						'type'    => 'lightbox'
					),
					array(
						'id'      => 'alignment',
						'title'   => __('Gallery Alignment', 'foogallery-fatnlazy-loader'),
						'desc'    => __('The horizontal alignment of the thumbnails inside the gallery.', 'foogallery-fatnlazy-loader'),
						'default' => 'alignment-center',
						'type'    => 'select',
						'choices' => array(
							'alignment-left' => __( 'Left', 'foogallery-fatnlazy-loader' ),
							'alignment-center' => __( 'Center', 'foogallery-fatnlazy-loader' ),
							'alignment-right' => __( 'Right', 'foogallery-fatnlazy-loader' )
						)
					)
					//available field types available : html, checkbox, select, radio, textarea, text, checkboxlist, icon
					//an example of a icon field used in the default gallery template
					//array(
					//	'id'      => 'border-style',
					//	'title'   => __('Border Style', 'foogallery-fatnlazy-loader'),
					//	'desc'    => __('The border style for each thumbnail in the gallery.', 'foogallery-fatnlazy-loader'),
					//	'type'    => 'icon',
					//	'default' => 'border-style-square-white',
					//	'choices' => array(
					//		'border-style-square-white' => array('label' => 'Square white border with shadow', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-square-white.png'),
					//		'border-style-circle-white' => array('label' => 'Circular white border with shadow', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-circle-white.png'),
					//		'border-style-square-black' => array('label' => 'Square Black', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-square-black.png'),
					//		'border-style-circle-black' => array('label' => 'Circular Black', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-circle-black.png'),
					//		'border-style-inset' => array('label' => 'Square Inset', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-square-inset.png'),
					//		'border-style-rounded' => array('label' => 'Plain Rounded', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-plain-rounded.png'),
					//		'' => array('label' => 'Plain', 'img' => FOOGALLERY_DEFAULT_TEMPLATES_EXTENSION_URL . 'assets/border-style-icon-none.png'),
					//	)
					//),
				)
			);

			return $gallery_templates;
		}
	}
}