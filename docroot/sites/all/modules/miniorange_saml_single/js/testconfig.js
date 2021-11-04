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

function show_gen_cert_form() {
    jQuery('#generate_certificate_form').show();
    jQuery('#mo_gen_cert').hide();
    jQuery('#mo_gen_tab').hide();
}

function hide_gen_cert_form() {
    jQuery('#generate_certificate_form').hide();
    jQuery('#mo_gen_cert').show();
    jQuery('#mo_gen_tab').show();
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

// Ping the specific url for removing license key
function removeLicenseKey(url) {
    if(confirm("Are you sure you want to remove the license key?")){
       window.location = url;
    }
   
}


