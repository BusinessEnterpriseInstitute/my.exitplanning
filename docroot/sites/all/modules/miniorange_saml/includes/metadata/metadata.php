<?php
/*    define('DRUPAL_ROOT', dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))));

    require_once DRUPAL_ROOT . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

    $base_url = chop($base_url,"sites/all/modules/miniorange_saml/includes/metadata");
    $base_site_url = Utilities::miniorange_get_baseURL();
    $module_path = drupal_get_path('module', 'miniorange_saml');
    $site_url = $base_site_url;
    $issuer = variable_get('miniorange_saml_entity_id','');
    $issuer_id = isset($issuer) && !empty($issuer)? $issuer:$base_site_url;
    if(substr($site_url, -1) == '/'){
        $acs_url = $site_url . '?q=samlassertion';
        $logout_url = $site_url . '?user/logout';
      }else{
        $acs_url = $site_url . '/?q=samlassertion';
        $logout_url = $site_url . '/user/logout';
      }

    $custom_cert = "";
    $custom_cert = variable_get( 'miniorange_saml_publ_certificate' );

    if( $custom_cert != "")
    {
        $cert_path = DRUPAL_ROOT . '/' . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'Custom_Public_Certificate.crt';
    }
    else
    {
        $cert_path = DRUPAL_ROOT . '/' . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'sp-certificate.crt';
    }
    $certificate_content = file_get_contents($cert_path);

    $certificate = utilities::desanitize_certificate($certificate_content);

    header('Content-Type: text/xml');
    echo '<?xml version="1.0"?>
    <md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata" validUntil="2020-10-28T23:59:59Z" cacheDuration="PT1446808792S" entityID="' . $issuer_id . '">
      <md:SPSSODescriptor AuthnRequestsSigned="true" WantAssertionsSigned="true" protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">
        <md:KeyDescriptor use="signing">
          <ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
            <ds:X509Data>
              <ds:X509Certificate>' . $certificate . '</ds:X509Certificate>
            </ds:X509Data>
          </ds:KeyInfo>
        </md:KeyDescriptor>
        <md:KeyDescriptor use="encryption">
          <ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
            <ds:X509Data>
              <ds:X509Certificate>' . $certificate . '</ds:X509Certificate>
            </ds:X509Data>
          </ds:KeyInfo>
        </md:KeyDescriptor>
        <md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" Location="' . $logout_url . '"/>
        <md:SingleLogoutService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect" Location="' . $logout_url . '"/>
        <md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress</md:NameIDFormat>
        <md:NameIDFormat>urn:oasis:names:tc:SAML:2.0:nameid-format:persistent</md:NameIDFormat>
        <md:NameIDFormat>urn:oasis:names:tc:SAML:2.0:nameid-format:transient</md:NameIDFormat>
        <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" Location="' . $acs_url . '" index="1"/>
      </md:SPSSODescriptor>
      <md:Organization>
        <md:OrganizationName xml:lang="en-US">miniOrange</md:OrganizationName>
        <md:OrganizationDisplayName xml:lang="en-US">miniOrange</md:OrganizationDisplayName>
        <md:OrganizationURL xml:lang="en-US">http://miniorange.com</md:OrganizationURL>
      </md:Organization>
      <md:ContactPerson contactType="technical">
        <md:GivenName>miniOrange</md:GivenName>
        <md:EmailAddress>info@xecurify.com</md:EmailAddress>
      </md:ContactPerson>
      <md:ContactPerson contactType="support">
        <md:GivenName>miniOrange</md:GivenName>
        <md:EmailAddress>info@xecurify.com</md:EmailAddress>
      </md:ContactPerson>
    </md:EntityDescriptor>';*/
