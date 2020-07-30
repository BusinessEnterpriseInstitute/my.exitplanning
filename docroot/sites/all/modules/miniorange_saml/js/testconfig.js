function testConfig(testUrl) {
	var myWindow = window.open(testUrl, "TEST SAML IDP", "scrollbars=1 width=800, height=600");
}

function show_metadata_form() {
	jQuery('#upload_metadata_form').show();
	jQuery('#idpdata').hide();
	jQuery('#tabhead').hide();

}

function hide_metadata_form() {
	jQuery('#upload_metadata_form').hide();
	jQuery('#idpdata').show();
	jQuery('#tabhead').show();
}

function showSAMLrequest(SAMLrequestUrl) {
    var myWindow = window.open(SAMLrequestUrl, "TEST SAML IDP", "scrollbars=1 width=800, height=600");
}

function showSAMLresponse(SAMLresponseUrl) {
    var myWindow = window.open(SAMLresponseUrl, "TEST SAML IDP", "scrollbars=1 width=800, height=600");
}

function exportConfiguration() {
	/* Dont Remove*/
}



(function($)
{
    Drupal.behaviors.moTour = {
        attach: function (context, settings) {
            moTour = settings.moTour;
            tryHere(settings.moTour);
        }
    };
})(jQuery);


function tryHere(moTour)
{   
    jQuery("#edit-miniorange-saml-idp-support-side-button").click(function (e) {
        e.preventDefault();
        if (jQuery("#mosaml-feedback-form").css("right") != "-460px") {
            jQuery("#mosaml-feedback-overlay").show();
            jQuery("#mosaml-feedback-form").animate({
                "right": "-460px"
            });
        }
        else {
            jQuery("#mosaml-feedback-overlay").hide();
            jQuery("#mosaml-feedback-form").animate({
                "right": "-851px"
            });
        }
    });
}
