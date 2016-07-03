/* global alphaCentauriData */
/**
 * Alpha-Centauri.js
 *
 * Some custom scripts for this theme.
 */
( function( $ ) {

	/*--------------------------------------------------------------
	Back-To-Top.
	--------------------------------------------------------------*/

	// Check distance to top and display back-to-top.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 800) {
			$( '.back-to-top' ).addClass( 'show-back-to-top' );
		} else {
			$( '.back-to-top' ).removeClass( 'show-back-to-top' );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top, .search-toggle' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});


	/*--------------------------------------------------------------
	Hidden Header.
	--------------------------------------------------------------*/

	// Open hidden header to reveal mobile menu.
	$( '.menu-toggle' ).on( 'click' , function() {
		var open   = $(this).data( 'open' ),
			easing = open ? 'swing' : 'easeOutBounce',
			time   = open ? 1000 : 2000;

		$( '#hidden-header' )[open ? 'slideUp' : 'slideDown']( time, easing);

		$(this).data( 'open', !open );

		$( '.menu-toggle' ).toggleClass( 'menu-toggled' );

		// Change aria attritute.
		if ( $( this ).hasClass( 'menu-toggled' ) ) {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'true' );
		}
		else {
			$( '.menu-toggle' ).attr( 'aria-expanded' , 'false' );
		}
	});


	/*--------------------------------------------------------------
	Menu.
	--------------------------------------------------------------*/

	// Add a focus class to sub menu items with children.
	$( '.menu-item-has-children' ).on( 'focusin focusout', function() {
		$( this ).toggleClass( 'focus' );
	});

	// Make focus menu-toggle more intuitif.
	$( '.menu-toggle' ).click(function(){

		// Move focus to first menu item.
		$( '.menu-toggle' ).on( 'blur', function() {
			$( '#primary-navigation' ).find( 'a:eq(0)' ).focus();
		});

		// Move focus to menu-toggle.
		$( '#primary-navigation .search-submit' ).on( 'blur', function() {
			$( '.menu-toggle' ).focus();
		});

	});


	/*--------------------------------------------------------------
	Big image.
	--------------------------------------------------------------*/

	// Add .large class to the <p> parent of images wider than 680px.
	$( '.entry-content img' ).each( function() {
		var $this = $( this );
		if ( ( $this.attr( 'width' ) > 680 ) && ( $this.parent().is( 'p' ) ) ) {
			$this.parent().addClass( 'large xxl' );
		}
	});


	/*--------------------------------------------------------------
	Flickity.
	--------------------------------------------------------------*/

	if ( $( 'body' ).hasClass( 'flickity-enabled' ) ) {

		// Grab data from functions.php using wp_localize_script().
		var optionOneAlphaCentauri = parseInt( alphaCentauriData.alpha_centauri_autoplay );

		// Initialize Flickity.
		$( '.featured-area' ).flickity({
			// options
			cellSelector: '.slider-cell',
			prevNextButtons: false,
			wrapAround: true,
			autoPlay: optionOneAlphaCentauri,
		});

		// Get the custom prev/next buttons to work.
		var $carousel = $( '.featured-area' ).flickity();

		$('.flickity-prev-next-button.previous').on( 'click', function() {
			$carousel.flickity( 'previous' );
		});

		$('.flickity-prev-next-button.next').on( 'click', function() {
			$carousel.flickity( 'next' );
		});

		// Make the slider more accessible.
		$( '.skip-link' ).focus(function() {

			// Destroy original instance of Flickity.
			$carousel.flickity( 'destroy' );

			// Hide the prev/next buttons.
			$( '.flickity-prev-next-button' ).hide();

			// Start new instance of Flickity without autoplay.
			$( '.featured-area' ).flickity({
				// options
				cellSelector: '.slider-cell',
				prevNextButtons: false,
				wrapAround: true,
			});
		});

		// Add ARIA on slide changes.
		$( '.is-selected' ).attr( 'aria-hidden', 'false' );

		$carousel.on( 'cellSelect', function() {
			$( '.slider-cell' ).attr( 'aria-hidden', 'true' );
			$( '.is-selected' ).attr( 'aria-hidden', 'false' );
		});

		// Add ARIA on slide changes when tabbing.
		$( '.featured-title a, .featured-more' ).on( 'focusin', function() {
			$( this ).closest( '.slider-cell' ).attr( 'aria-hidden', 'false' );
		});

		$( '.featured-title a, .featured-more' ).on( 'focusout', function() {
			$( this ).closest( '.slider-cell' ).attr( 'aria-hidden', 'true' );
		});

	} // End If.


})( jQuery );