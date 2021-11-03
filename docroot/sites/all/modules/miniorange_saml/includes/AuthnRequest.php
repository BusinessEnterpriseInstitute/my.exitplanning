<?php
/**
 * @file
 * The AuthnRequest.php file for the miniorange_samlauth module.
 *
 * @package miniOrange
 *
 * @license GNU/GPLv3
 *
 * @copyright Copyright 2015 miniOrange. All Rights Reserved.
 *
 * This file is part of miniOrange SAML plugin.
 */

/**
 * The MiniOrangeAuthnRequest class.
 */
class MiniOrangeAuthnRequest {

  /**
   * The function initiateLogin.
   */
  public function initiateLogin($acs_url, $sso_url, $issuer,$nameid_format, $relay_state, $sso_binding_type, $saml_request_sign, $sign_algo) {
    //print_r($relay_state);exit;
      $saml_request = Utilities::createAuthnRequest($acs_url, $issuer , $sso_url,$nameid_format ,'false', $sso_binding_type);
      $this->sendSamlRequestByBindingType($saml_request, $sso_binding_type, $relay_state, $sso_url, $saml_request_sign, $sign_algo);
  }

  function sendSamlRequestByBindingType($samlRequest, $sso_binding_type, $sendRelayState, $ssoUrl,$saml_request_sign, $sign_algo){

		 if (libraries_get_path('xmlseclibs')) {
		     $xmlseclibs_file = libraries_get_path('xmlseclibs') . '/xmlseclibs.php';
		 }
		 else {
		     // Trying alternate library path.
             $xmlseclibs_file = libraries_get_path('xmlseclibs-master') . '/xmlseclibs.php';
		 }

		 libraries_load('xmlseclibs');

		 if (!class_exists('XMLSecurityKey') && !@include($xmlseclibs_file)) {
		     echo "<div>
			<p><font class='alert' background-color='crimson' color='red'>Error: xmlseclibs not loaded properly</font></p>
			<p>You can download xmlseclibs from <a href='https://github.com/robrichards/xmlseclibs/tree/1.4' target='_blank'>here</a>.
			<br>Extract the archive and place it under <b>sites/all/libraries/</b> in your Drupal directory.</p>				<div>";
		     exit();
		 }
		 $custom_cert = "";
		 $custom_cert = variable_get( 'miniorange_saml_publ_certificate' );
		 $private_cert = "";
		 $private_cert = variable_get( 'miniorange_saml_private_certificate' );

		 $module_path = drupal_get_path('module', 'miniorange_saml');

		 // $sign_algo = 'RSA_SHA256';

		 if(empty($sso_binding_type) || $sso_binding_type == 'HTTP-Redirect')
		 {

		     $samlRequest = "SAMLRequest=" . $samlRequest . "&RelayState=" . $sendRelayState;
		     $param =array( 'type' => 'private');

		     if($sign_algo == 'RSA_SHA256'){
                 $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $param);
		     }
		     elseif($sign_algo == 'RSA_SHA384'){
                 $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA384, $param);
		     }
		     elseif ($sign_algo == 'RSA_SHA512'){
                 $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA512, $param);
		     }
		     elseif($sign_algo == 'RSA_SHA1'){
                 $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, $param);
		     }

		     if( $private_cert != '')
		     {
		        $certFilePath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'Custom_Private_Certificate.key';
		     }
		     else {
		        $certFilePath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'sp-key.key';
		     }

		     $key->loadKey($certFilePath, TRUE);
		     $objXmlSecDSig = new XMLSecurityDSig();
		     $signature = $key->signData($samlRequest);

		     $signature = base64_encode($signature);

		     $redirect = $ssoUrl;
		     if (strpos($ssoUrl,'?') !== false) {
			      $redirect .= '&';
		     } else {
			      $redirect .= '?';
		     }
		     if($saml_request_sign) {
		          if($sign_algo == 'RSA_SHA256'){
		              $redirect .= $samlRequest . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA256) . '&Signature=' . urlencode($signature);
		          }
		          elseif($sign_algo == 'RSA_SHA384'){
		              $redirect .= $samlRequest . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA384) . '&Signature=' . urlencode($signature);
		          }
		          elseif ($sign_algo == 'RSA_SHA512'){
		              $redirect .= $samlRequest . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA512) . '&Signature=' . urlencode($signature);
		          }
		          elseif($sign_algo == 'RSA_SHA1'){
		              $redirect .= $samlRequest . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA1) . '&Signature=' . urlencode($signature);
		          }
		          // $redirect .= $samlRequest . '&SigAlg=' . urlencode(XMLSecurityKey::RSA_SHA256) . '&Signature=' . urlencode($signature);
		     }
		     else {
			      $redirect .= $samlRequest;
		     }
		     header('Location: '.$redirect);
		     exit();
		 }
		 else
		 {
		     if(!$saml_request_sign)
			    {
			       $base64EncodedXML = base64_encode($samlRequest);
				     Utilities::postSAMLRequest($ssoUrl, $base64EncodedXML, $sendRelayState);
				    exit();
			    }

		      if( $private_cert != "")
		      {
  		        $privateKeyPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'Custom_Private_Certificate.key';
  		    }
  		    else {
  		        $privateKeyPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'sp-key.key';
  		    }
  		    if( $custom_cert != "")
  		    {
  		        $publicCertPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'Custom_Public_Certificate.crt';
  		    }
  		    else {
  		        $publicCertPath = DRUPAL_ROOT . DIRECTORY_SEPARATOR . $module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'sp-certificate.crt';
  		    }

  			  $base64EncodedXML = Utilities::signXML( $samlRequest, $publicCertPath, $privateKeyPath, 'NameIDPolicy', $sign_algo );
  			  Utilities::postSAMLRequest($ssoUrl, $base64EncodedXML, $sendRelayState);
		 }
  }
 }
