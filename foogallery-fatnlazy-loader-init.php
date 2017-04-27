<?php
//This init class is used to add the extension to the extensions list while you are developing them.
//When the extension is added to the supported list of extensions, this file is no longer needed.

if ( !class_exists( 'FatnLazy_Loader_Template_FooGallery_Extension_Init' ) ) {
	class FatnLazy_Loader_Template_FooGallery_Extension_Init {

		function __construct() {
			add_filter( 'foogallery_available_extensions', array( $this, 'add_to_extensions_list' ) );
		}

		function add_to_extensions_list( $extensions ) {
			$extensions[] = array(
				'slug'=> 'fatnlazy-loader',
				'class'=> 'FatnLazy_Loader_Template_FooGallery_Extension',
				'title'=> __('FatnLazy Loader', 'foogallery-fatnlazy-loader'),
				'file'=> 'foogallery-fatnlazy-loader-extension.php',
				'description'=> __('Lazy load gallery as a list large thumbnails.', 'foogallery-fatnlazy-loader'),
				'author'=> ' Elizabeth Evans',
				'author_url'=> 'http://solnimbus.com',
				'thumbnail'=> FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION_URL . '/assets/extension_bg.png',
				'tags'=> array( __('template', 'foogallery') ),	//use foogallery translations
				'categories'=> array( __('Build Your Own', 'foogallery') ), //use foogallery translations
				'source'=> 'generated'
			);

			return $extensions;
		}
	}

	new FatnLazy_Loader_Template_FooGallery_Extension_Init();
}