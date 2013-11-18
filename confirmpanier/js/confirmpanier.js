/*
 * Confirmation panier
 *
 * Copyright 2013
 * Author : Thomas Beaumont (thomasbmnt@gmail.com)
 */
 

( function ( $ ) {
	"use strict";
	
 		
 		
	var chooseAction = function(e) {
		var logo = $('.logo'),
 			blocConfirm = $('#confirmPanier');
 		
 		/* Prevent defaut action of a link */
		e.preventDefault();
		
		/* Display the logo */
		$("#cpLogo").find('img').attr('src', logo.attr('src'));
		
		/* Display pop-up bloc */
		blocConfirm.fadeIn('fast');
		
	};


	$( function () {
		$('a.ajax_add_to_cart_button').on( 'click', chooseAction );
		
		$('#confirmPanier').on('click', function(e) {
			$(this).hide();
		})
		
		
	} );

}( jQuery ) );
