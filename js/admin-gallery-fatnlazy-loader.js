//Use this file to inject custom javascript behaviour into the foogallery edit page
//For an example usage, check out wp-content/foogallery/extensions/default-templates/js/admin-gallery-default.js

(function (FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION, $, undefined) {

	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION.doSomething = function() {
		//do something when the gallery template is changed to fatnlazy-loader
	};

	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION.adminReady = function () {
		$('body').on('foogallery-gallery-template-changed-fatnlazy-loader', function() {
			FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION.doSomething();
		});
	};

}(window.FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION = window.FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION || {}, jQuery));

jQuery(function () {
	FATNLAZY_LOADER_TEMPLATE_FOOGALLERY_EXTENSION.adminReady();
});