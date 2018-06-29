jQuery(document).ready(function() {
	
	/* If there are required actions, add an icon with the number of required actions in the About Hat Bazar page -> Actions required tab */
    var hat_bazar_nr_actions_required = hatBazarWelcomeScreenObject.nr_actions_required;

    if ( (typeof hat_bazar_nr_actions_required !== 'undefined') && (hat_bazar_nr_actions_required != '0') ) {
        jQuery('li.hat-bazar-w-red-tab a').append('<span class="hat-bazar-actions-count">' + hat_bazar_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".hat-bazar-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'hat_bazar_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : hatBazarWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.hat-bazar-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + hatBazarWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var hat_bazar_actions_count = jQuery('.hat-bazar-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof hat_bazar_actions_count !== 'undefined' ) {
                    if( hat_bazar_actions_count == '1' ) {
                        jQuery('.hat-bazar-actions-count').remove();
                        jQuery('.hat-bazar-tab-pane#actions_required').append('<p>' + hatBazarWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.hat-bazar-actions-count').text(parseInt(hat_bazar_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
	
	/* Tabs in welcome page */
	function hat_bazar_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".hat-bazar-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}
	
	var hat_bazar_actions_anchor = location.hash;
	
	if( (typeof hat_bazar_actions_anchor !== 'undefined') && (hat_bazar_actions_anchor != '') ) {
		hat_bazar_welcome_page_tabs('a[href="'+ hat_bazar_actions_anchor +'"]');
	}
	
    jQuery(".hat-bazar-nav-tabs a").click(function(event) {
        event.preventDefault();
		hat_bazar_welcome_page_tabs(this);
    });
	
});