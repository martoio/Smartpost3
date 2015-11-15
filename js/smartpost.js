jQuery(document).ready(function($) {
    $('ul#ui-sortable').sortable();

    $('div#sp-accordion').accordion();

    //======================
    //====== Modal section jQuery
    //==================

    $('h4').on('click', function() {
    	var arrow = $(this).find('div.sp-arrow');

    	var anim_dur = 200;
    	
    	if(arrow.hasClass('sp-arrow-down')) {
    		arrow.removeClass('sp-arrow-down').addClass('sp-arrow-up'); // changes down arrow to up arrow;
    		$(this).siblings('div.sp-modal-section-options').slideUp(anim_dur); // condenses the options panel;
    	} else if (arrow.hasClass('sp-arrow-up')) {
			arrow.removeClass('sp-arrow-up').addClass('sp-arrow-down'); // up --> down arrow
    		$(this).siblings('div.sp-modal-section-options').slideDown(anim_dur, function() {
                var modalHeight = $('div.sp-modal').outerHeight(false);
            }); // expands options panel
    	}

        
    });

    var component = [];
    component['elements'] = [];

    $('input[data="elements"]').on('change', function() {
        
        var newElem = $(this).attr('element');

        if($(this).is(':checked')) {
            component['elements'].push(newElem);
        } else {
            var location = component['elements'].indexOf(newElem);
            component['elements'].splice(location, 1);
            if($('#'+newElem+'-settings').is(':visible')) {
                $('#'+newElem+'-settings').slideUp();
            }
        }
        
        if(component['elements'].length > 0) {
            $('#element-settings .sp-modal-section-options p').slideUp();
            for(elemIndex in component['elements']) {
                
                var elem = component['elements'][elemIndex];
                var settingsCont = $('#'+elem+'-settings');
                if(settingsCont.is(':hidden')) {
                    settingsCont.slideDown();
                }

            }
        } else {
            $('#element-settings .sp-modal-section-options p').slideDown();
        }

    });

    $('input.sp-elements-primary').on('click', function() {
        var secondary = $(this).parent('label').siblings('label.secondary-options');

        if(secondary.is(':hidden')) {
            secondary.slideDown();
        }

    });

    $('div#attachment-settings input[type="radio"]').on('click', function() {
        
        var disabledInput = $('div#attachment-settings input[type="text"]');
        var isDisabled = disabledInput.is(':disabled');

        if(isDisabled) {
            if($(this).attr('value') == 'other') {
                disabledInput.attr('disabled', false);
            }
        } else {
            if($(this).attr('value') != 'other') {
                disabledInput.attr('disabled', true);
            }
        }

    });

});