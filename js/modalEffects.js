var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.sp-overlay' );

		[].slice.call( document.querySelectorAll( '.sp-trigger' ) ).forEach( function( el, i ) {

			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
				close = modal.querySelector( '.sp-close' );

			function removeModal( hasPerspective ) {
				classie.remove( modal, 'sp-show' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'sp-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'sp-setperspective' ) ); 
			}

			el.addEventListener( 'click', function( ev ) {
				classie.add( modal, 'sp-show' );
				//overlay.removeEventListener( 'click', removeModalHandler );
				//overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'sp-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'sp-perspective' );
					}, 25 );
				}
			});

			close.addEventListener( 'click', function( ev ) {
				ev.stopPropagation();
				removeModalHandler();
			});

		} );

	}

	init();

})();