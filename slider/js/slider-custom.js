// Created by ronyortiz on 28/01/17
jQuery(window).load(function() {
	jQuery('#slider').flexslider({
		animation: 'fade',
		sync: '#carousel',
		slideshow: true,
		slideshowSpeed: 10000,
		animationSpeed: 600,
		initDelay: 300,
	});
});