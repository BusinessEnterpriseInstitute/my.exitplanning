<?php
/**
 * This file is part of miniOrange SAML plugin.
 *
 * miniOrange SAML plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * miniOrange SAML plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with miniOrange SAML plugin.  If not, see <http://www.gnu.org/licenses/>.
 */

class Utilities
{


    public static function generateCertificate($dn, $digest_algo, $private_key_bits, $valid_days)
    {
        $opensslConfigPath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'openssl.cnf';

        $config = array(
            "config" => $opensslConfigPath,
            "digest_alg" => "$digest_algo",
            "private_key_bits" => $private_key_bits,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $private_key = openssl_pkey_new($config);
        $csr = openssl_csr_new($dn, $private_key, $config);
        if($csr===FALSE){
             drupal_set_message(t('Facing issues while generating custom certificate. Please check if country code is correct.'), 'error');
                return FALSE;
        }
        $csr_signed = openssl_csr_sign($csr, null, $private_key, $valid_days, $config, time());
        openssl_x509_export($csr_signed, $public_key_out);
        openssl_pkey_export($private_key, $private_key_out, null, $config);
        openssl_csr_export($csr, $csrout);

        while (($e = openssl_error_string()) !== false) {
            error_log($e);
        }

        $certificates = array(
            'public_key' => $public_key_out,
            'private_key' => $private_key_out,
        );
        variable_set('miniorange_saml_publ_certificate', $certificates['public_key']);
        variable_set('miniorange_saml_private_certificate', $certificates['private_key']);
        
        file_put_contents(self::getCertificatePath(), $certificates['public_key']);
        
        file_put_contents(self::getKeyPath(), $certificates['private_key']);
        return TRUE;

        
    }

    public static function isCustomerRegistered(&$form, $form_state) {
        global $base_url;
        $register_url = $base_url . '/admin/config/people/miniorange_saml/customer_setup/';
        if (variable_get('miniorange_saml_customer_admin_email', NULL) == NULL
            || variable_get('miniorange_saml_customer_id', NULL) == NULL
            || variable_get('miniorange_saml_customer_admin_token', NULL) == NULL
            || variable_get('miniorange_saml_customer_api_key', NULL) == NULL)
        {
           
            $form['markup_reg_msg'] = array(
                '#markup' => '<div class="mo_saml_register_message">You need to <a href="'.$register_url.'" >Login</a> with miniOrange account before using this module.</center></div>',
            );
            return TRUE;
        }
        else if(variable_get('miniorange_saml_license_key') == NULL &&
            variable_get('miniorange_saml_customer_admin_email') != NULL)
        {
            $form['markup_msg'] = array(
                '#markup' => '<div class="mo_saml_register_message"><p>You need to <a href="'.$register_url.'"  >verify </a> your license key before using this module.</a></p></div>'
            );
            return TRUE;
        }
        if(variable_get('miniorange_saml_license_key') != NULL &&
            variable_get('miniorange_saml_customer_admin_email') != NULL){
            return FALSE;
        }

    }
    /* Upgrade utility
     *
     * */
    public static function createUpdateUrl($code,$licensePlanName,$licenseType,$apiKey,$customerId,$hostName){
        $plaintext = "1111111111111111".$code;
        $url = $hostName.'/moas/api/plugin/drupalJoomlaUpdate/'.$customerId.'/'.$licensePlanName.'/'.$licenseType.'/';
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($plaintext, $cipher, $apiKey, $options=OPENSSL_RAW_DATA, $iv);
        return $url.str_replace(['+','/','='], ['-','_',''], base64_encode($ciphertext));
    }

    public static function AddsupportTab(&$form, $form_state)
    {
        $form['markup_idp_attr_header_top_support'] = array(
            '#markup' => '<div class="mo_saml_table_layout_support_1">',
        );

        $form['markup_support_1'] = array(
            '#markup' => '<h3>Feature Request/Contact Us:</h3><div>Need any help? We can help you with configuring your Service Provider. Just send us a query and we will get back to you soon.<br /></div><br>',
        );

        $form['miniorange_saml_email_address'] = array(
            '#type' => 'textfield',
            '#attributes' => array('style' => 'width:100%', 'placeholder' => 'Enter your Email'),
            '#default_value' => variable_get('miniorange_saml_customer_admin_email', ''),
        );

        $form['miniorange_saml_phone_number'] = array(
            '#type' => 'textfield',
            '#attributes' => array('style' => 'width:100%', 'placeholder' => 'Enter your phone number with country code eg.(+1)'),
            '#default_value' => variable_get('miniorange_saml_customer_admin_phone', ''),
        );

        $form['miniorange_saml_support_query'] = array(
            '#type' => 'textarea',
            '#cols' => '10',
            '#rows' => '5',
            '#attributes' => array('style' => 'width:100%;border-radius:2px;background:#fcfcfa;box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.125);font-family: Helvetica Neue, Helvetica, Arial, sans-serif;','placeholder' => 'Write your query here.'),
            '#resizable' => False,
        );

        $form['miniorange_saml_support_submit_click'] = array(
            '#type' => 'submit',
            '#value' => t('Submit Query'),
            '#submit' => array('Utilities::send_support_query'),
            '#attributes' => array('style' => 'background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;display:block;margin-left:auto;margin-right:auto;'),
        );

        $form['miniorange_saml_support_note'] = array(
            '#markup' => '<div>If you want custom features in the plugin, just drop an email to <a href="mailto:drupalsupport@xecurify.com">drupalsupport@xecurify.com</a></div>'
        );
         $form['miniorange_faq'] = array(
            '#markup' => '<br><div style="text-align: center;"><a class="mo_saml_btn mo_saml_btn-primary-faq mo_saml_btn-large mo_saml_btn_faq_buttons" style="float: inherit;padding: 3px 6px !important;color: #48a0dc;border: 2px solid #48a0dc;" href="https://faq.miniorange.com/kb/drupal/saml-drupal/" target="_blank">'
                . 'FAQs</a>',
        );
        $form['miniorange_guide'] = array(
            '#markup' => '<a class="mo_saml_btn mo_saml_btn-primary-faq mo_saml_btn-large mo_saml_btn_faq_buttons" style="float: inherit;padding: 3px 6px !important;color: #48a0dc;border: 2px solid #48a0dc;" href="https://plugins.miniorange.com/configure-drupal-saml-single-sign-on" target="_blank">'
                . 'Setup Guides</a>',
        );

       

        $form['miniorange_forum'] = array(
            '#markup' => '<b></b><a class="mo_saml_btn mo_saml_btn-primary-faq mo_saml_btn-large mo_saml_btn_faq_buttons" style="margin-left: 10px; float: inherit;padding: 3px 6px !important;color: #48a0dc;border: 2px solid #48a0dc;" href="https://forum.miniorange.com/" target="_blank">'
                . 'Ask questions on forum</a></div></div>',
        );
    }
       /* check if domain is restricted or not*/
    public static function Is_Restricted_Domain($email_domain){
        $enable_domain_restriction=variable_get('miniorange_saml_enable_domain_restriction');
        if($enable_domain_restriction===FALSE){
                return FALSE;
        }
        $domain=explode('@', $email_domain)[1];
        if(is_null($domain) || empty($domain)){
            return FALSE;
        }

        $alldomains=variable_get('miniorange_saml_domains');
        $white_or_black=variable_get('miniorange_saml_domains_are_white_or_black');
        $alldomains=explode(';',$alldomains);
        if($white_or_black==='white'){
            if(array_search($domain, $alldomains)===FALSE){
                 return TRUE;
            }
            else return FALSE;
        }
        elseif ($white_or_black=='black') {
               if(array_search($domain, $alldomains)===FALSE){
                 return FALSE;
                }
            else return TRUE;
        }
        
    }

    public static function send_support_query(&$form, $form_state) {
        $email = trim($form['miniorange_saml_email_address']['#value']);
        $phone = trim($form['miniorange_saml_phone_number']['#value']);
        $query = trim($form['miniorange_saml_support_query']['#value']);
        Utilities::send_query( $email, $phone, $query );
    }

    public static function send_query($email, $phone, $query)
    {
        if ( empty( $email ) || empty( $query ) ) {
            drupal_set_message(t('The <b><u>Email</u></b> and <b><u>Query</u></b> fields are required.'), 'error');
            return;
        } elseif ( !valid_email_address( $email ) ) {
            drupal_set_message(t('The email address <b><i>' . $email . '</i></b> is not valid.'), 'error');
            return;
        }
        $support = new MiniOrangeSamlSupport($email, $phone, $query);
        $support_response = $support->sendSupportQuery();
        if ($support_response) {
            drupal_set_message(t('Support query successfully sent'));
        } else {
            drupal_set_message(t('Error sending support query'), 'error');
        }
    }

    public static function miniorange_get_baseURL()
    {
        global $base_url;
        $url = variable_get('miniorange_saml_base_url', '');
        $b_url = isset($url) && !empty($url) ? $url : $base_url;
        return $b_url;
    }
    public static function getIssuer(){
        $issuer = variable_get('miniorange_saml_entity_id', '');
        $b_url = Utilities::miniorange_get_baseURL();
        $issuer_id = isset($issuer) && !empty($issuer) ? $issuer : $b_url;
        return $issuer_id;
    }
    public static function getCertificatePath($isdownload=false){
        $b_url='';
        if($isdownload){
            $b_url=self::miniorange_get_baseURL().'/';
        }
        $module_path = drupal_get_path('module', 'miniorange_saml');
        return $b_url.$module_path.'/resources/'.self::getCertficateName();
    }
    public static function  getCertficateName(){
        $custom_public_cert=variable_get('miniorange_saml_publ_certificate', '');
        if(empty($custom_public_cert)){
            return MiniorangeSAMLConstants::DEFAULT_PUBLIC_CERT_NAME;
        }
        else{
            return MiniorangeSAMLConstants::CUSTOM_PUBLIC_CERT_NAME;
        }

    }
    public static function getKeyPath(){
        $module_path=drupal_get_path('module', 'miniorange_saml');
        return $module_path.'/resources/'.self::getKeyName();
    }
    public static function getKeyName(){
        $custom_key = variable_get('miniorange_saml_private_certificate', '');
        if(empty($custom_key)){
             return MiniorangeSAMLConstants::DEFAULT_PRIVATE_KEY_NAME;
        }
        else{
            return MiniorangeSAMLConstants::CUSTOM_PRIVATE_KEY_NAME;
        }

    }


    public static function getTabNames()
    {
        $tab_class_name = array(
            "Identity_Provider" => 'mo_options_enum_identity_provider',
            "Service_Provider" => 'mo_options_enum_service_provider',
            "Mapping" => 'mo_options_enum_mapping',
            "Sign_In_Settings" => 'mo_options_enum_sign_in_settings',
            "Custom_Certificate" => 'mo_options_enum_custom_certificate',
        );
        return $tab_class_name;
    }

    Public static function getVariableNames($class_name)
    {

        if ($class_name == "mo_options_enum_identity_provider") {
            $class_object = array(
                'Broker_service' => 'mo_saml_enable_cloud_broker',
                'SP_Base_Url' => 'miniorange_saml_base_url',
                'SP_Entity_ID' => 'miniorange_saml_entity_id',
            );
        } else if ($class_name == "mo_options_enum_service_provider") {
            $class_object = array(
                'Identity_name' => 'miniorange_saml_idp_name',
                'Issuer' => 'miniorange_saml_idp_issuer',
                'Enable_Signed_SSO_and_SLO' => 'miniorange_saml_request_signed',
                'Name_ID_format' => 'miniorange_nameid_format',
                'Binding_SSO' => 'miniorange_saml_http_binding',
                'Binding_SLO' => 'miniorange_saml_http_binding_slo',
                'Login_URL' => 'miniorange_saml_idp_login_url',
                'Enable_logout_without_response' => 'miniorange_saml_enable_logout',
                'Logout_URL' => 'miniorange_saml_idp_logout_url',
                'X509_certificate' => 'miniorange_saml_idp_x509_certificate',
                'Enable_login_with_SAML' => 'miniorange_saml_enable_login',
                'Signature_Algo'=>'security_signature_algorithm',
            );
        } else if ($class_name == "mo_options_enum_mapping") {
            $class_object = array(
                'Username_attr' => 'miniorange_saml_username_attribute',
                'Email_attr' => 'miniorange_saml_email_attribute',
                'Role' => 'miniorange_saml_idp_attr1_name',
                'Role_mapping' => 'miniorange_saml_enable_rolemapping',
                'Disable_auto_create_user' => 'miniorange_saml_disable_autocreate_users',
                'Default_role' => 'miniorange_saml_default_role',
                'Do_not_update_user_roles' => 'miniorange_saml_disable_role_update',


            );
        } else if ($class_name == "mo_options_enum_sign_in_settings") {
            $class_object = array(
                'Protect_whole_site' => 'miniorange_saml_force_auth',
                'Auto_redirect' => 'miniorange_saml_auto_redirect_to_idp',
                'Backdoor_Login' => 'miniorange_saml_enable_backdoor',
                'Default_redirect_url' => 'miniorange_saml_default_relaystate',
                'backdoorQuery'=>'miniorange_backdoor_query',
                'enable_domain_restriction'=>'miniorange_saml_enable_domain_restriction',
                'miniorange_saml_domains_are_white_or_black'=>'miniorange_saml_domains_are_white_or_black',
                'miniorange_saml_domains'=>'miniorange_saml_domains'

            );
        } else if ($class_name == "mo_options_enum_custom_certificate") {
            $class_object = array(
                'Custom_private_cert' => 'miniorange_saml_private_certificate',
                'Custom_public_cert' => 'miniorange_saml_publ_certificate',
            );
        }
        return $class_object;
    }

    public static function isCurlInstalled()
    {
        if (in_array('curl', get_loaded_extensions())) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function generateID()
    {
        return '_' . self::stringToHex(self::generateRandomBytes(21));
    }

    public static function stringToHex($bytes)
    {
        $ret = '';
        for ($i = 0; $i < strlen($bytes); $i++) {
            $ret .= sprintf('%02x', ord($bytes[$i]));
        }
        return $ret;
    }

    public static function generateRandomBytes($length, $fallback = TRUE)
    {
        return openssl_random_pseudo_bytes($length);
    }

    public static function insertSignature(XMLSecurityKey $key, array $certificates, DOMElement $root = NULL, DOMNode $insertBefore = NULL)
    {
        $objXMLSecDSig = new XMLSecurityDSig();
        $objXMLSecDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        switch ($key->type) {
            case XMLSecurityKey::RSA_SHA256:
                $type = XMLSecurityDSig::SHA256;
                break;
            case XMLSecurityKey::RSA_SHA384:
                $type = XMLSecurityDSig::SHA384;
                break;
            case XMLSecurityKey::RSA_SHA512:
                $type = XMLSecurityDSig::SHA512;
                break;
            default:
                $type = XMLSecurityDSig::SHA1;
        }

        $objXMLSecDSig->addReferenceList(
            array($root),
            $type,
            array('http://www.w3.org/2000/09/xmldsig#enveloped-signature', XMLSecurityDSig::EXC_C14N),
            array('id_name' => 'ID', 'overwrite' => FALSE)
        );

        $objXMLSecDSig->sign($key);

        foreach ($certificates as $certificate) {
            $objXMLSecDSig->add509Cert($certificate, TRUE);
        }

        $objXMLSecDSig->insertSignature($root, $insertBefore);
    }


    public static function signXML($xml, $publicCertPath, $privateKeyPath, $insertBeforeTagName = "", $sign_algo)
    {

    //     if (libraries_get_path('xmlseclibs')) {
    //         $xmlseclibs_file = libraries_get_path('xmlseclibs') . '/xmlseclibs.php';
    //     } else {
    //         // Trying alternate library path.
    //         $xmlseclibs_file = libraries_get_path('xmlseclibs-master') . '/xmlseclibs.php';
    //     }

    //     libraries_load('xmlseclibs');

    //     if (!class_exists('XMLSecurityKey') && !@include($xmlseclibs_file)) {
    //         echo "<div>
				// <p><font class='alert' background-color='crimson' color='red'>Error: xmlseclibs not loaded properly</font></p>
				// <p>You can download xmlseclibs from <a href='https://github.com/robrichards/xmlseclibs/tree/1.4' target='_blank'>here</a>.
				// <br>Extract the archive and place it under <b>sites/all/libraries/</b> in your Drupal directory.</p>
				// <div>";
    //         exit();
    //     }

        $param = array('type' => 'private');

        if ($sign_algo == 'RSA_SHA256') {
            $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $param);
        } elseif ($sign_algo == 'RSA_SHA384') {
            $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $param);
        } elseif ($sign_algo == 'RSA_SHA512') {
            $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $param);
        } elseif ($sign_algo == 'RSA_SHA1') {
            $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $param);
        }

        //$key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $param);
        $key->loadKey($privateKeyPath, TRUE);
        $publicCertificate = file_get_contents($publicCertPath);
        $document = new DOMDocument();

        $document->loadXML($xml);
        $element = $document->firstChild;
        if (!empty($insertBeforeTagName)) {
            $domNode = $document->getElementsByTagName($insertBeforeTagName)->item(0);

            self::insertSignature($key, array($publicCertificate), $element, $domNode);
        } else {
            self::insertSignature($key, array($publicCertificate), $element);
        }
        $requestXML = $element->ownerDocument->saveXML($element);
        $base64EncodedXML = base64_encode($requestXML);
        return $base64EncodedXML;
    }

    public static function postSAMLRequest($url, $samlRequestXML, $relayState)
    {
        echo "<html><head>
                  <script src='https://code.jquery.com/jquery-1.11.3.min.js'></script>
                  <script type=\"text/javascript\">$(function(){document.forms['saml-request-form'].submit();});</script></head>
                  <body>Please wait...<form action=\"" . $url . "\" method=\"post\" id=\"saml-request-form\">
                    <input type=\"hidden\" name=\"SAMLRequest\" value=\"" . $samlRequestXML . "\" />
                    <input type=\"hidden\" name=\"RelayState\" value=\"" . htmlentities($relayState) . "\" /></form>
                    </body>
              </html>";
        exit;
    }

    public static function createAuthnRequest($acsUrl, $issuer, $destination, $nameid_format, $force_authn = 'false', $sso_binding_type)
    {
        $requestXmlStr = '<?xml version="1.0" encoding="UTF-8"?>' .
            '<samlp:AuthnRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol" xmlns="urn:oasis:names:tc:SAML:2.0:assertion" ID="' . self::generateID() .
            '" Version="2.0" IssueInstant="' . self::generateTimestamp() . '"';
        if ($force_authn == 'true') {
            $requestXmlStr .= ' ForceAuthn="true"';
        }
        $requestXmlStr .= ' ProtocolBinding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" AssertionConsumerServiceURL="' . $acsUrl .
            '" Destination="' . $destination . '"><saml:Issuer xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion">' . $issuer . '</saml:Issuer><samlp:NameIDPolicy AllowCreate="true" Format="' . $nameid_format . '"
                        /></samlp:AuthnRequest>';

        if (empty($sso_binding_type) || $sso_binding_type == 'HTTP-Redirect') {
            $deflatedStr = gzdeflate($requestXmlStr);
            $base64EncodedStr = base64_encode($deflatedStr);
            $urlEncoded = urlencode($base64EncodedStr);
            $requestXmlStr = $urlEncoded;
        }
        return $requestXmlStr;
    }

    public static function createSAMLRequest($acsUrl, $issuer, $destination, $nameid_format, $force_authn = 'false')
    {
        $requestXmlStr = '<?xml version="1.0" encoding="UTF-8"?>' .
            '<samlp:AuthnRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol" ID="' . self::generateID() .
            '" Version="2.0" IssueInstant="' . self::generateTimestamp() . '"';
        if ($force_authn == 'true') {
            $requestXmlStr .= ' ForceAuthn="true"';
        }
        $requestXmlStr .= ' ProtocolBinding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" AssertionConsumerServiceURL="' . $acsUrl .
            '" Destination="' . $destination . '"><saml:Issuer xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion">' . $issuer . '</saml:Issuer><samlp:NameIDPolicy AllowCreate="true" Format="' . $nameid_format . '"
                        /></samlp:AuthnRequest>';

        return $requestXmlStr;
    }

    public static function mo_saml_logout()
    {
        $logout_url = variable_get("miniorange_saml_idp_logout_url", "");
        $logout_binding_type = variable_get("miniorange_saml_http_binding_slo", "");
        $sign_algo = variable_get('security_signature_algorithm');
        if (!empty($logout_url)) {
            if (!session_id() || session_id() == '' || !isset($_SESSION)) {
                session_start();
            }
            if (isset($_SESSION['mo_saml_logout_request'])) {
                //Utilities::createLogoutResponseAndRedirect($logout_url, $logout_binding_type);
                //exit();
            } elseif (isset($_SESSION['mo_saml']['logged_in_with_idp'])) {
                global $base_url;
                unset($_SESSION['mo_saml']);
                $sessionIndex = $_SESSION['sessionIndex'];
                $nameId = $_SESSION['NameID'];

                $logout_url_test = variable_get('miniorange_saml_enable_logout');
                if ($logout_url_test == 1 || $logout_url_test == true) {
                    session_destroy();
                }
                if (isset($_SESSION['logout']) && !empty($_SESSION['logout'])) {
                    $sp_base_url = $_SESSION['logout'];
                } else {
                    $sp_base_url = Utilities::miniorange_get_baseURL();
                }

                
                $sp_entity_id = Utilities::getIssuer();
                $request_signed = variable_get('miniorange_saml_request_signed');
                $destination = $logout_url;
                $sendRelayState = $sp_base_url;
                $samlRequest = Utilities::createLogoutRequest($nameId, $sessionIndex, $sp_entity_id, $destination, $logout_binding_type);
                $module_path = drupal_get_path('module', 'miniorange_saml');

                if (empty($logout_binding_type) || $logout_binding_type == 'HttpRedirect') {
                    $redirect = $logout_url;
                    if (strpos($logout_url, '?') !== false) {
                        $redirect .= '&';
                    } else {
                        $redirect .= '?';
                    }
                    if (!$request_signed) {
                        $redirect .= 'SAMLRequest=' . $samlRequest . '&RelayState=' . urlencode($sendRelayState);
                        header('Location: ' . $redirect);
                        exit();
                    }

                    if ($sign_algo == 'RSA_SHA256') {
                        $samlRequest = 'SAMLRequest=' . $samlRequest . '&RelayState=' . urlencode($sendRelayState) . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA256);
                    } elseif ($sign_algo == 'RSA_SHA384') {
                        $samlRequest = 'SAMLRequest=' . $samlRequest . '&RelayState=' . urlencode($sendRelayState) . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA384);
                    } elseif ($sign_algo == 'RSA_SHA512') {
                        $samlRequest = 'SAMLRequest=' . $samlRequest . '&RelayState=' . urlencode($sendRelayState) . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA512);
                    } elseif ($sign_algo == 'RSA_SHA1') {
                        $samlRequest = 'SAMLRequest=' . $samlRequest . '&RelayState=' . urlencode($sendRelayState) . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA1);
                    }

                  

                    $param = array('type' => 'private');

                    if ($sign_algo == 'RSA_SHA256') {
                        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $param);
                    } elseif ($sign_algo == 'RSA_SHA384') {
                        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $param);
                    } elseif ($sign_algo == 'RSA_SHA512') {
                        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $param);
                    } elseif ($sign_algo == 'RSA_SHA1') {
                        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $param);
                    }
                   

                   
                        $certFilePath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . self::getKeyName();
                   
                    $key->loadKey($certFilePath, FALSE);
                    $objXmlSecDSig = new XMLSecurityDSig();
                    $signature = $key->signData($samlRequest);
                    $signature = base64_encode($signature);
                    $redirect .= $samlRequest . '&Signature=' . urlencode($signature);
                    header('Location: ' . $redirect);
                    exit();
                } else {
                    if (!$request_signed) {
                        $base64EncodedXML = base64_encode($samlRequest);
                        Utilities::postSAMLRequest($logout_url, $base64EncodedXML, $sendRelayState);
                        exit();
                    }
                  
                   
                    $privateKeyPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . Utilities::getKeyName();
                    
                   
                    $publicCertPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . self::getCertficateName();
                    
                    $base64EncodedXML = Utilities::signXML($samlRequest, $publicCertPath, $privateKeyPath, 'NameID', $sign_algo);
                    Utilities::postSAMLRequest($logout_url, $base64EncodedXML, $sendRelayState);
                }
            }
            else{
                session_destroy();
                if(isset($_REQUEST['RelayState'])&&!empty($_REQUEST['RelayState']))
               {
                 drupal_goto($_REQUEST['RelayState']);
                exit;
               }
            }
        }
    }

    public static function createLogoutRequest($nameId, $sessionIndex = '', $issuer, $destination, $slo_binding_type = 'HttpRedirect')
    {
        $requestXmlStr = '<?xml version="1.0" encoding="UTF-8"?>' .
            '<samlp:LogoutRequest xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol" xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion" ID="' . self::generateID() .
            '" IssueInstant="' . self::generateTimestamp() .
            '" Version="2.0" Destination="' . $destination . '">
						<saml:Issuer xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion">' . $issuer . '</saml:Issuer>
						<saml:NameID xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion">' . $nameId . '</saml:NameID>';
        if (!empty($sessionIndex)) {
            $requestXmlStr .= '<samlp:SessionIndex>' . $sessionIndex . '</samlp:SessionIndex>';
        }
        $requestXmlStr .= '</samlp:LogoutRequest>';

        if (empty($slo_binding_type) || $slo_binding_type == 'HttpRedirect') {
            $deflatedStr = gzdeflate($requestXmlStr);
            $base64EncodedStr = base64_encode($deflatedStr);
            $urlEncoded = urlencode($base64EncodedStr);
            $requestXmlStr = $urlEncoded;
        }
        return $requestXmlStr;
    }

    /*public static function createLogoutResponseAndRedirect( $logout_url, $logout_binding_type ) {
        global $base_url;
        $sp_base_url = $base_url;
        $logout_request = $_SESSION['mo_saml_logout_request'];
        $relay_state = $_SESSION['mo_saml_logout_relay_state'];
        unset($_SESSION['mo_saml_logout_request']);
        unset($_SESSION['mo_saml_logout_relay_state']);
        $document = new DOMDocument();
        $document->loadXML($logout_request);
        $logout_request = $document->firstChild;
        if( $logout_request->localName == 'LogoutRequest' ) {
            $logoutRequest = new SAML2SPLogoutRequest( $logout_request );
            $sp_entity_id = get_option('mo_saml_sp_entity_id');
            if(empty($sp_entity_id)) {
                $sp_entity_id = $sp_base_url.'/wp-content/plugins/miniorange-saml-20-single-sign-on/';
            }
            //$sp_entity_id = $sp_base_url.'/wp-content/plugins/miniorange-saml-20-single-sign-on/';
            $destination = $logout_url;
            $logoutResponse = SAMLSPUtilities::createLogoutResponse($logoutRequest->getId(), $sp_entity_id, $destination, $logout_binding_type);

            if(empty($logout_binding_type) || $logout_binding_type == 'HttpRedirect') {
                $redirect = $logout_url;
                if (strpos($logout_url,'?') !== false) {
                    $redirect .= '&';
                } else {
                    $redirect .= '?';
                }
                $redirect .= 'SAMLResponse=' . $logoutResponse . '&RelayState=' . urlencode($relay_state);
                //echo $redirect.'<br/>';
                header('Location: '.$redirect);
                exit();
            } else {
                $privateKeyPath = plugin_dir_path(__FILE__) . 'resources' . DIRECTORY_SEPARATOR . 'sp-key.key';
                $publicCertPath = plugin_dir_path(__FILE__) . 'resources' . DIRECTORY_SEPARATOR . 'sp-certificate.crt';

                $base64EncodedXML = SAMLSPUtilities::signXML( $logoutResponse, $publicCertPath, $privateKeyPath, 'Status' );

                SAMLSPUtilities::postSAMLResponse($logout_url, $base64EncodedXML, $relay_state);
            }
        }
    }*/

    public static function upload_metadata($file, $msg = false)
    {
        if ( !empty( variable_get('miniorange_saml_idp_name' ) ) ) {
            variable_set('miniorange_saml_idp_name', 'Identity Provider');
        }
        global $base_url;
        require_once drupal_get_path('module', 'miniorange_saml') . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'MetadataReader.php';

        $document = new DOMDocument();
        $document->loadXML($file);
        restore_error_handler();
        $first_child = $document->firstChild;

        if (!empty($first_child)) {
            $metadata = new IDPMetadataReader($document);
            $identity_providers = $metadata->getIdentityProviders();
            if (empty($identity_providers)) {
                drupal_set_message(t('Please provide a valid metadata file.'), 'error');
                return;
            }

            foreach ($identity_providers as $key => $idp) {

                $saml_login_url = $idp->getLoginURL('HTTP-Redirect');
                $logout_url = $idp->getLogoutURL('HTTP-Redirect');

                if (empty($saml_login_url)) {
                    $saml_login_url = $idp->getLoginURL('HTTP-POST');
                }

                if (empty($logout_url)) {
                    $logout_url = $idp->getLogoutURL('HTTP-POST');
                }

                $saml_issuer = $idp->getEntityID();
                $saml_x509_certificate = $idp->getSigningCertificate();
                $sp_issuer = $base_url;
                if ($msg == true) {
                 
                    variable_set('miniorange_saml_idp_login_url', $saml_login_url);
                    variable_set('miniorange_saml_idp_logout_url', $logout_url);
                }
                variable_set('miniorange_saml_idp_issuer', $saml_issuer);
                variable_set('miniorange_saml_idp_x509_certificate', $saml_x509_certificate);
            }

            if ($msg == true) {
                drupal_set_message(t('Identity Provider Configuration successfully saved.'));
                return;
            }
        } else {
            drupal_set_message(t('Please provide a valid metadata file.'), 'error');
            return;
        }
    }

    public static function generateTimestamp($instant = NULL)
    {
        if ($instant === NULL) {
            $instant = time();
        }
        return gmdate('Y-m-d\TH:i:s\Z', $instant);
    }

    public static function xpQuery(DOMNode $node, $query)
    {
        static $xpCache = NULL;

        if ($node instanceof DOMDocument) {
            $doc = $node;
        } else {
            $doc = $node->ownerDocument;
        }

        if ($xpCache === NULL || !$xpCache->document->isSameNode($doc)) {
            $xpCache = new DOMXPath($doc);
            $xpCache->registerNamespace('soap-env', 'http://schemas.xmlsoap.org/soap/envelope/');
            $xpCache->registerNamespace('saml_protocol', 'urn:oasis:names:tc:SAML:2.0:protocol');
            $xpCache->registerNamespace('saml_assertion', 'urn:oasis:names:tc:SAML:2.0:assertion');
            $xpCache->registerNamespace('saml_metadata', 'urn:oasis:names:tc:SAML:2.0:metadata');
            $xpCache->registerNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');
            $xpCache->registerNamespace('xenc', 'http://www.w3.org/2001/04/xmlenc#');
        }

        $results = $xpCache->query($query, $node);
        $ret = array();
        for ($i = 0; $i < $results->length; $i++) {
            $ret[$i] = $results->item($i);
        }

        return $ret;
    }

    public static function parseNameId(DOMElement $xml)
    {
        $ret = array('Value' => trim($xml->textContent));

        foreach (array('NameQualifier', 'SPNameQualifier', 'Format') as $attr) {
            if ($xml->hasAttribute($attr)) {
                $ret[$attr] = $xml->getAttribute($attr);
            }
        }
        return $ret;
    }

    public static function xsDateTimeToTimestamp($time)
    {
        $matches = array();

        // We use a very strict regex to parse the timestamp.
        $regex = '/^(\\d\\d\\d\\d)-(\\d\\d)-(\\d\\d)T(\\d\\d):(\\d\\d):(\\d\\d)(?:\\.\\d+)?Z$/D';
        if (preg_match($regex, $time, $matches) == 0) {
            echo sprintf("nvalid SAML2 timestamp passed to xsDateTimeToTimestamp: " . $time);
            exit;
        }

        // Extract the different components of the time from the  matches in the regex.
        // intval will ignore leading zeroes in the string.
        $year = intval($matches[1]);
        $month = intval($matches[2]);
        $day = intval($matches[3]);
        $hour = intval($matches[4]);
        $minute = intval($matches[5]);
        $second = intval($matches[6]);

        // We use gmmktime because the timestamp will always be given
        //in UTC.
        $ts = gmmktime($hour, $minute, $second, $month, $day, $year);

        return $ts;
    }

    public static function extractStrings(DOMElement $parent, $namespaceURI, $localName)
    {

        $ret = array();
        for ($node = $parent->firstChild; $node !== NULL; $node = $node->nextSibling) {
            if ($node->namespaceURI !== $namespaceURI || $node->localName !== $localName) {
                continue;
            }
            $ret[] = trim($node->textContent);
        }

        return $ret;
    }

    public static function validateElement(DOMElement $root)
    {
        //$data = $root->ownerDocument->saveXML($root);

        /* Create an XML security object. */
        $objXMLSecDSig = new XMLSecurityDSig();

        /* Both SAML messages and SAML assertions use the 'ID' attribute. */
        $objXMLSecDSig->idKeys[] = 'ID';


        /* Locate the XMLDSig Signature element to be used. */
        $signatureElement = self::xpQuery($root, './ds:Signature');

        if (count($signatureElement) === 0) {
            /* We don't have a signature element to validate. */
            return FALSE;
        } elseif (count($signatureElement) > 1) {
            echo sprintf("XMLSec: more than one signature element in root.");
            exit;
        }/*  elseif ((in_array('Response', $signatureElement) && $ocurrence['Response'] > 1) ||
            (in_array('Assertion', $signatureElement) && $ocurrence['Assertion'] > 1) ||
            !in_array('Response', $signatureElement) && !in_array('Assertion', $signatureElement)
        ) {
            return false;
        } */

        $signatureElement = $signatureElement[0];
        $objXMLSecDSig->sigNode = $signatureElement;

        /* Canonicalize the XMLDSig SignedInfo element in the message. */
        $objXMLSecDSig->canonicalizeSignedInfo();

        /* Validate referenced xml nodes. */
        if (!$objXMLSecDSig->validateReference()) {
            echo sprintf("XMLsec: digest validation failed");
            exit;
        }

        /* Check that $root is one of the signed nodes. */
        $rootSigned = FALSE;
        /** @var DOMNode $signedNode */
        foreach ($objXMLSecDSig->getValidatedNodes() as $signedNode) {
            if ($signedNode->isSameNode($root)) {
                $rootSigned = TRUE;
                break;
            } elseif ($root->parentNode instanceof DOMDocument && $signedNode->isSameNode($root->ownerDocument)) {
                /* $root is the root element of a signed document. */
                $rootSigned = TRUE;
                break;
            }
        }

        if (!$rootSigned) {
            echo sprintf("XMLSec: The root element is not signed.");
            exit;
        }

        /* Now we extract all available X509 certificates in the signature element. */
        $certificates = array();
        foreach (self::xpQuery($signatureElement, './ds:KeyInfo/ds:X509Data/ds:X509Certificate') as $certNode) {
            $certData = trim($certNode->textContent);
            $certData = str_replace(array("\r", "\n", "\t", ' '), '', $certData);
            $certificates[] = $certData;
        }

        $ret = array(
            'Signature' => $objXMLSecDSig,
            'Certificates' => $certificates,
        );

        return $ret;
    }

    public static function validateSignature(array $info, XMLSecurityKey $key)
    {
        /** @var XMLSecurityDSig $objXMLSecDSig */
        $objXMLSecDSig = $info['Signature'];

        $sigMethod = self::xpQuery($objXMLSecDSig->sigNode, './ds:SignedInfo/ds:SignatureMethod');
        if (empty($sigMethod)) {
            echo sprintf('Missing SignatureMethod element');
            exit();
        }
        $sigMethod = $sigMethod[0];
        if (!$sigMethod->hasAttribute('Algorithm')) {
            echo sprintf('Missing Algorithm-attribute on SignatureMethod element.');
            exit;
        }
        $algo = $sigMethod->getAttribute('Algorithm');

        if ($key->type === XMLSecurityKey::RSA_SHA1 && $algo !== $key->type) {
            $key = self::castKey($key, $algo);
        }

        /* Check the signature. */
        if (!$objXMLSecDSig->verify($key)) {
            echo sprintf('Unable to validate Sgnature');
            exit;
        }
    }

    public static function castKey(XMLSecurityKey $key, $algorithm, $type = 'public')
    {
        // do nothing if algorithm is already the type of the key
        if ($key->type === $algorithm) {
            return $key;
        }
        $keyInfo = openssl_pkey_get_details($key->key);
        if ($keyInfo === FALSE) {
            echo sprintf('Unable to get key details from XMLSecurityKey.');
            exit;
        }
        if (!isset($keyInfo['key'])) {
            echo sprintf('Missing key in public key details.');
            exit;
        }
        $newKey = new XMLSecurityKey($algorithm, array('type' => $type));
        $newKey->loadKey($keyInfo['key']);

        return $newKey;
    }

    public static function processResponse($currentURL, $certFingerprint, $signatureData, SAML2_Response $response, $relayState)
    {

        /* Validate Response-element destination. */
        $msgDestination = $response->getDestination();
        if ($msgDestination !== NULL && $msgDestination !== $currentURL) {
            echo sprintf('Destination in response doesn\'t match the current URL. Destination is "' .
                $msgDestination . '", current URL is "' . $currentURL . '".');
            exit;
        }

        $responseSigned = self::checkSign($certFingerprint, $signatureData, $relayState);
        /* Returning boolean $responseSigned */
        return $responseSigned;
    }

    public static function checkSign($certFingerprint, $signatureData, $relayState)
    {

        $certificates = $signatureData['Certificates'];

        if (count($certificates) === 0) {
            return FALSE;
        }

        $pemCert = self::findCertificate($certFingerprint, $certificates, $relayState);

        $lastException = NULL;
        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type' => 'public'));
        $key->loadKey($pemCert);

        try {
            /* Make sure that we have a valid signature */
            self::validateSignature($signatureData, $key);
            return TRUE;
        } catch (Exception $e) {
            $lastException = $e;
        }

        /* We were unable to validate the signature with any of our keys. */
        if ($lastException !== NULL) {
            throw $lastException;
        } else {
            return FALSE;
        }
    }

    private static function findCertificate(array $certFingerprints, array $certificates, $relayState)
    {

        $ResCert = $certificates[0];
        $ResCert = chunk_split($ResCert, 80);

        /*$candidates = array();                         //Shree
        foreach ($certificates as $cert) {
            $fp = strtolower(sha1(base64_decode($cert)));
            if (!in_array($fp, $certFingerprints, TRUE)) {
                $candidates[] = $fp;
                continue;
            }
            // We have found a matching fingerprint.
            $pem = "-----BEGIN CERTIFICATE-----\n" .
                chunk_split($cert, 64) .
                "-----END CERTIFICATE-----\n";

           return $pem;
        }*/

        foreach ($certificates as $cert) {
            $fp = strtolower(sha1(base64_decode($cert)));
            if (in_array($fp, $certFingerprints, TRUE)) {

                /* We have found a matching fingerprint. */
                $pem = "-----BEGIN CERTIFICATE-----\n" . chunk_split($cert, 64) . "-----END CERTIFICATE-----\n";

                return $pem;
            }
        }

        if ($relayState == 'testValidate') {
            echo '<div style="font-family:Calibri;padding:0 3%;">';
            echo '<div style="color: #a94442;background-color: #f2dede;padding: 15px;margin-bottom: 20px;text-align:center;border:1px solid #E6B3B2;font-size:18pt;"> ERROR</div>
            <div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>Unable to find a certificate matching the configured fingerprint.</p>
            <p><strong>Possible Cause: </strong>Content of \'X.509 Certificate\' field in Service Provider Settings is incorrect</p>
			<p><b>Expected value: </b>' . $ResCert . '</p>';
            echo str_repeat('&nbsp;', 15);
            echo '</div>
                <div style="margin:3%;display:block;text-align:center;">
                <form action="index.php">
                <div style="margin:3%;display:block;text-align:center;"><input style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="button" value="Done" onClick="self.close();"></div>';
            exit;
        } else {
            echo ' <div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>We could not sign you in. Please contact your Administrator.</p></div>';
            exit;
        }
    }

    public static function validateIssuerAndAudience($samlResponse, $spEntityId, $issuerToValidateAgainst, $base_url, $relayState)
    {
        $issuer = current($samlResponse->getAssertions())->getIssuer();
        $audience = current(current($samlResponse->getAssertions())->getValidAudiences());
        if (strcmp($issuerToValidateAgainst, $issuer) === 0) {
            if (strcmp($audience, $spEntityId) === 0) {
                return TRUE;
            } else {
                echo sprintf('Invalid audience');
                exit;
            }
        } else {
            if ($relayState == 'testValidate') {
                ob_end_clean();

                echo '<div style="font-family:Calibri;padding:0 3%;">';
                echo '<div style="color: #a94442;background-color: #f2dede;padding: 15px;margin-bottom: 20px;text-align:center;border:1px solid #E6B3B2;font-size:18pt;"> ERROR</div>
                <div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>Issuer cannot be verified.</p>
                <p>Please contact your administrator and report the following error:</p>
                <p><strong>Possible Cause: </strong>The value in \'IdP Entity ID or Issuer\' field in Service Provider Settings is incorrect</p>
                <p><strong>Expected Entity ID: </strong>' . $issuer . '<p>
                <p><strong>Entity ID Found: </strong>' . $issuerToValidateAgainst . '</p>
                </div>
                <div style="margin:3%;display:block;text-align:center;">
                <div style="margin:3%;display:block;text-align:center;"><input style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="button" value="Done" onClick="self.close();"></div>';
                exit;
            } else {
                echo ' <div style="color: #a94442;font-size:14pt; margin-bottom:20px;"><p><strong>Error: </strong>We could not sign you in. Please contact your Administrator.</p></div>
                  <div style="margin:3%;display:block;text-align:center;">';
                exit;
            }
        }
    }

    /*
     * Decrypt an encrypted element.
     *
     * This is an internal helper function.
     *
     * @param  DOMElement     $encryptedData The encrypted data.
     * @param  XMLSecurityKey $inputKey      The decryption key.
     * @param  array          &$blacklist    Blacklisted decryption algorithms.
     * @return DOMElement     The decrypted element.
     * @throws Exception
     */
    private static function doDecryptElement(DOMElement $encryptedData, XMLSecurityKey $inputKey, array &$blacklist)
    {
        $enc = new XMLSecEnc();
        $enc->setNode($encryptedData);

        $enc->type = $encryptedData->getAttribute("Type");
        $symmetricKey = $enc->locateKey($encryptedData);
        if (!$symmetricKey) {
            echo sprintf('Could not locate key algorithm in encrypted data.');
            exit;
        }

        $symmetricKeyInfo = $enc->locateKeyInfo($symmetricKey);
        if (!$symmetricKeyInfo) {
            echo sprintf('Could not locate <dsig:KeyInfo> for the encrypted key.');
            exit;
        }
        $inputKeyAlgo = $inputKey->getAlgorithm();
        if ($symmetricKeyInfo->isEncrypted) {
            $symKeyInfoAlgo = $symmetricKeyInfo->getAlgorithm();
            if (in_array($symKeyInfoAlgo, $blacklist, TRUE)) {
                echo sprintf('Algorithm disabled: ' . var_export($symKeyInfoAlgo, TRUE));
                exit;
            }
            if ($symKeyInfoAlgo === XMLSecurityKey::RSA_OAEP_MGF1P && $inputKeyAlgo === XMLSecurityKey::RSA_1_5) {
                /*
                 * The RSA key formats are equal, so loading an RSA_1_5 key
                 * into an RSA_OAEP_MGF1P key can be done without problems.
                 * We therefore pretend that the input key is an
                 * RSA_OAEP_MGF1P key.
                 */
                $inputKeyAlgo = XMLSecurityKey::RSA_OAEP_MGF1P;
            }
            /* Make sure that the input key format is the same as the one used to encrypt the key. */
            if ($inputKeyAlgo !== $symKeyInfoAlgo) {
                echo sprintf('Algorithm mismatch between input key and key used to encrypt ' .
                    ' the symmetric key for the message. Key was: ' .
                    var_export($inputKeyAlgo, TRUE) . '; message was: ' .
                    var_export($symKeyInfoAlgo, TRUE));
                exit;
            }
            /** @var XMLSecEnc $encKey */
            $encKey = $symmetricKeyInfo->encryptedCtx;
            $symmetricKeyInfo->key = $inputKey->key;
            $keySize = $symmetricKey->getSymmetricKeySize();
            if ($keySize === NULL) {
                /* To protect against "key oracle" attacks, we need to be able to create a
                 * symmetric key, and for that we need to know the key size.
                 */
                echo sprintf('Unknown key size for encryption algorithm: ' . var_export($symmetricKey->type, TRUE));
                exit;
            }
            try {
                $key = $encKey->decryptKey($symmetricKeyInfo);
                if (strlen($key) != $keySize) {
                    echo sprintf('Unexpected key size (' . strlen($key) * 8 . 'bits) for encryption algorithm: ' .
                        var_export($symmetricKey->type, TRUE));
                    exit;
                }
            } catch (Exception $e) {
                /* We failed to decrypt this key. Log it, and substitute a "random" key. */

                /* Create a replacement key, so that it looks like we fail in the same way as if the key was correctly padded. */
                /* We base the symmetric key on the encrypted key and private key, so that we always behave the
                 * same way for a given input key.
                 */
                $encryptedKey = $encKey->getCipherValue();
                $pkey = openssl_pkey_get_details($symmetricKeyInfo->key);
                $pkey = sha1(serialize($pkey), TRUE);
                $key = sha1($encryptedKey . $pkey, TRUE);
                /* Make sure that the key has the correct length. */
                if (strlen($key) > $keySize) {
                    $key = substr($key, 0, $keySize);
                } elseif (strlen($key) < $keySize) {
                    $key = str_pad($key, $keySize);
                }
            }
            $symmetricKey->loadkey($key);
        } else {
            $symKeyAlgo = $symmetricKey->getAlgorithm();
            /* Make sure that the input key has the correct format. */
            if ($inputKeyAlgo !== $symKeyAlgo) {
                echo sprintf('Algorithm mismatch between input key and key in message. ' .
                    'Key was: ' . var_export($inputKeyAlgo, TRUE) . '; message was: ' .
                    var_export($symKeyAlgo, TRUE));
                exit;
            }
            $symmetricKey = $inputKey;
        }
        $algorithm = $symmetricKey->getAlgorithm();
        if (in_array($algorithm, $blacklist, TRUE)) {
            echo sprintf('Algorithm disabled: ' . var_export($algorithm, TRUE));
            exit;
        }
        /** @var string $decrypted */
        $decrypted = $enc->decryptNode($symmetricKey, FALSE);
        /*
         * This is a workaround for the case where only a subset of the XML
         * tree was serialized for encryption. In that case, we may miss the
         * namespaces needed to parse the XML.
         */
        $xml = '<root xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion" ' .
            'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">' .
            $decrypted .
            '</root>';
        $newDoc = new DOMDocument();
        if (!@$newDoc->loadXML($xml)) {
            //echo sprintf('Failed to parse decrypted XML. Maybe the wrong sharedkey was used?');
            throw new Exception('Failed to parse decrypted XML. Maybe the wrong sharedkey was used?');
        }
        $decryptedElement = $newDoc->firstChild->firstChild;
        if ($decryptedElement === NULL) {
            echo sprintf('Missing encrypted element.');
            throw new Exception('Missing encrypted element.');
        }

        if (!($decryptedElement instanceof DOMElement)) {
            echo sprintf('Decrypted element was not actually a DOMElement.');
        }

        return $decryptedElement;
    }

    /**
     * Decrypt an encrypted element.
     *
     * @param DOMElement $encryptedData The encrypted data.
     * @param XMLSecurityKey $inputKey The decryption key.
     * @param array $blacklist Blacklisted decryption algorithms.
     * @return DOMElement     The decrypted element.
     * @throws Exception
     */
    public static function decryptElement(DOMElement $encryptedData, XMLSecurityKey $inputKey, array $blacklist = array(), XMLSecurityKey $alternateKey = NULL)
    {
        try {
            return self::doDecryptElement($encryptedData, $inputKey, $blacklist);
        } catch (Exception $e) {
            //Try with alternate key
            try {
                return self::doDecryptElement($encryptedData, $alternateKey, $blacklist);
            } catch (Exception $t) {

            }
            /*
             * Something went wrong during decryption, but for security
             * reasons we cannot tell the user what failed.
             */
            //print_r($e->getMessage());
            //echo sprintf('Failed to decrypt XML element.');
            exit;
        }
    }

    /**
     * Generates the metadata of the SP based on the settings
     *
     * @param string $sp The SP data
     * @param string $authnsign authnRequestsSigned attribute
     * @param string $wsign wantAssertionsSigned attribute
     * @param DateTime $validUntil Metadata's valid time
     * @param Timestamp $cacheDuration Duration of the cache in seconds
     * @param array $contacts Contacts info
     * @param array $organization Organization ingo
     *
     * @return string SAML Metadata XML
     */
    public static function metadata_builder($siteUrl)
    {
        $xml = new DOMDocument();
        $url = plugins_url() . '/miniorange-saml-20-single-sign-on/sp-metadata.xml';

        $xml->load($url);

        $xpath = new DOMXPath($xml);
        $elements = $xpath->query('//md:EntityDescriptor[@entityID="http://{path-to-your-site}/wp-content/plugins/miniorange-saml-20-single-sign-on/"]');

        if ($elements->length >= 1) {
            $element = $elements->item(0);
            $element->setAttribute('entityID', $siteUrl . '/wp-content/plugins/miniorange-saml-20-single-sign-on/');
        }

        $elements = $xpath->query('//md:AssertionConsumerService[@Location="http://{path-to-your-site}"]');
        if ($elements->length >= 1) {
            $element = $elements->item(0);
            $element->setAttribute('Location', $siteUrl . '/');
        }

        //re-save
        $xml->save(plugins_url() . "/miniorange-saml-20-single-sign-on/sp-metadata.xml");
    }

    public static function get_mapped_groups($saml_params, $saml_groups)
    {
        $groups = array();

        if (!empty($saml_groups)) {
            $saml_mapped_groups = array();
            $i = 1;
            while ($i < 10) {
                $saml_mapped_groups_value = $saml_params->get('group' . $i . '_map');

                $saml_mapped_groups[$i] = explode(';', $saml_mapped_groups_value);
                $i++;
            }
        }

        foreach ($saml_groups as $saml_group) {
            if (!empty($saml_group)) {
                $i = 0;
                $found = false;

                while ($i < 9 && !$found) {
                    if (!empty($saml_mapped_groups[$i]) && in_array($saml_group, $saml_mapped_groups[$i])) {
                        $groups[] = $saml_params->get('group' . $i);
                        $found = true;
                    }
                    $i++;
                }
            }
        }

        return array_unique($groups);
    }


    public static function getEncryptionAlgorithm($method)
    {
        switch ($method) {
            case 'http://www.w3.org/2001/04/xmlenc#tripledes-cbc':
                return XMLSecurityKey::TRIPLEDES_CBC;
                break;

            case 'http://www.w3.org/2001/04/xmlenc#aes128-cbc':
                return XMLSecurityKey::AES128_CBC;

            case 'http://www.w3.org/2001/04/xmlenc#aes192-cbc':
                return XMLSecurityKey::AES192_CBC;
                break;

            case 'http://www.w3.org/2001/04/xmlenc#aes256-cbc':
                return XMLSecurityKey::AES256_CBC;
                break;

            case 'http://www.w3.org/2001/04/xmlenc#rsa-1_5':
                return XMLSecurityKey::RSA_1_5;
                break;

            case 'http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p':
                return XMLSecurityKey::RSA_OAEP_MGF1P;
                break;

            case 'http://www.w3.org/2000/09/xmldsig#dsa-sha1':
                return XMLSecurityKey::DSA_SHA1;
                break;

            case 'http://www.w3.org/2000/09/xmldsig#rsa-sha1':
                return XMLSecurityKey::RSA_SHA1;
                break;

            case 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256':
                return XMLSecurityKey::RSA_SHA256;
                break;

            case 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha384':
                return XMLSecurityKey::RSA_SHA384;
                break;

            case 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha512':
                return XMLSecurityKey::RSA_SHA512;
                break;

            default:
                echo sprintf('Invalid Encryption Method: ' . $method);
                exit;
                break;
        }
    }

    public static function sanitize_certificate($certificate)
    {
        $certificate = preg_replace("/[\r\n]+/", "", $certificate);
        $certificate = str_replace("-", "", $certificate);
        $certificate = str_replace("BEGIN CERTIFICATE", "", $certificate);
        $certificate = str_replace("END CERTIFICATE", "", $certificate);
        $certificate = str_replace(" ", "", $certificate);
        $certificate = chunk_split($certificate, 64, "\r\n");
        $certificate = "-----BEGIN CERTIFICATE-----\r\n" . $certificate . "-----END CERTIFICATE-----";
        return $certificate;
    }

    public static function sanitize_private_key($private_key)
    {
        $private_key = preg_replace("/[\r\n]+/", "", $private_key);
        $private_key = str_replace("-", "", $private_key);
        $private_key = str_replace("BEGIN PRIVATE KEY", "", $private_key);
        $private_key = str_replace("END PRIVATE KEY", "", $private_key);
        $private_key = str_replace(" ", "", $private_key);
        $private_key = chunk_split($private_key, 64, "\r\n");
        $private_key = "-----BEGIN PRIVATE KEY-----\r\n" . $private_key . "-----END PRIVATE KEY-----";

        return $private_key;
    }

    public static function desanitize_certificate($certificate)
    {
        $certificate = preg_replace("/[\r\n]+/", "", $certificate);
        $certificate = str_replace("-----BEGIN CERTIFICATE-----", "", $certificate);
        $certificate = str_replace("-----END CERTIFICATE-----", "", $certificate);
        $certificate = str_replace(" ", "", $certificate);

        return $certificate;
    }

    public static function Print_SAML_Request($samlRequestResponceXML, $type)
    {
        header("Content-Type: text/html");
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($samlRequestResponceXML);
        if ($type == 'displaySAMLRequest')
            $show_value = 'SAML Request';
        else
            $show_value = 'SAML Response';
        $out = $doc->saveXML();

        $out1 = htmlentities($out);
        $out1 = rtrim($out1);

        $xml = simplexml_load_string($out);

        $url = drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css';

        echo '<link rel=\'stylesheet\' id=\'mo_saml_admin_settings_style-css\'  href=\'' . $url . '\' type=\'text/css\' media=\'all\' />
            
			<div class="mo-display-logs" ><p type="text"   id="SAML_type">' . $show_value . '</p></div>
			
			<div type="text" id="SAML_display" class="mo-display-block"><pre class=\'brush: xml;\'>' . $out1 . '</pre></div>
			<br>
			<div style="margin:3%;display:block;text-align:center;">
            
			<div style="margin:3%;display:block;text-align:center;" >
	
            </div>
			<button id="copy" onclick="copyDivToClipboard()"  style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;" >Copy</button>
			&nbsp;
               <input id="dwn-btn" style="padding:1%;width:100px;background: #0091CD none repeat scroll 0% 0%;cursor: pointer;font-size:15px;border-width: 1px;border-style: solid;border-radius: 3px;white-space: nowrap;box-sizing: border-box;border-color: #0073AA;box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset;color: #FFF;"type="button" value="Download" 
               ">
			</div>
			</div>
			
		';

        ob_end_flush(); ?>

        <script>

            function copyDivToClipboard() {
                var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById("SAML_display").textContent);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");
                document.body.removeChild(aux);
                document.getElementById('copy').textContent = "Copied";
                document.getElementById('copy').style.background = "grey";
                window.getSelection().selectAllChildren(document.getElementById("SAML_display"));
            }

            function download(filename, text) {
                var element = document.createElement('a');
                element.setAttribute('href', 'data:Application/octet-stream;charset=utf-8,' + encodeURIComponent(text));
                element.setAttribute('download', filename);

                element.style.display = 'none';
                document.body.appendChild(element);

                element.click();

                document.body.removeChild(element);
            }

            document.getElementById("dwn-btn").addEventListener("click", function () {

                var filename = document.getElementById("SAML_type").textContent + ".xml";
                var node = document.getElementById("SAML_display");
                htmlContent = node.innerHTML;
                text = node.textContent;
                console.log(text);
                download(filename, text);
            }, false);

        </script>
        <?php
        exit;
    }

    public static function drupal_is_cli(){

        if(!isset($_SERVER['SERVER_SOFTWARE']) && (php_sapi_name() == 'cli' || (is_numeric($_SERVER['argc']) && $_SERVER['argc'] > 0)))
            return TRUE;
        else
            return FALSE;
    }
}