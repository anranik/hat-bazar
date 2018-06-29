jQuery(document).ready(function() {
    var hat_bazar_aboutpage = hatBazarWelcomeScreenCustomizerObject.aboutpage;
    var hat_bazar_nr_actions_required = hatBazarWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof hat_bazar_aboutpage !== 'undefined') && (typeof hat_bazar_nr_actions_required !== 'undefined') && (hat_bazar_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + hat_bazar_aboutpage + '"><span class="hat-bazar-actions-count">' + hat_bazar_nr_actions_required + '</span></a>');
    }

});