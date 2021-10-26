<?php

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\AuthnRequest;

class saml_sp_Auth extends Auth {
  public $auth_callback;

  protected $AuthnRequest;

  /**
   * Set the auth callback for after the response is returned
   */
  public function setAuthCallback($callback) {
    $this->auth_callback = $callback;
  }

  /**
   * {@inheritdoc}
   */
  public function login($returnTo = null, array $parameters = array(), $forceAuthn = FALSE, $isPassive = FALSE, $stay = FALSE, $setNameIdPolicy = TRUE, $nameIdValueReq = NULL) {

    $settings = $this->getSettings();
    $security = $settings->getSecurityData();
    if (variable_get('saml_sp__debug', FALSE)) {
      watchdog('saml_sp', '$security => <pre>' . print_r($security, TRUE) . '</pre>');
    }

    // get this necessary information for this IdP
    $idp = (object) $settings->getIdPData();
    $all_idps = saml_sp__load_all_idps();
    if (variable_get('saml_sp__debug', FALSE)) {
      watchdog('saml_sp', 'saml_sp_Auth::login $all_idps => <pre>@idps</pre>', array('@idps' => print_r($all_idps, TRUE)), WATCHDOG_DEBUG);
    }
    foreach ($all_idps AS $this_idp) {
      if (
          ($this_idp->entity_id == $idp->entityId) ||
          ($this_idp->app_name == $idp->entityId)
        ) {
        $idp->machine_name = $this_idp->machine_name;
      }
    }
    if (!isset($idp->machine_name) || empty($idp->machine_name)) {
      // ensure there is an $idp->machine_name as it won't function otherwise
      $idp->machine_name = variable_get('saml_sp_drupal_login__idp', '');
    }
    if (variable_get('saml_sp__debug', FALSE)) {
      watchdog('saml_sp', 'saml_sp_Auth::login $idp => <pre>@idp</pre>', array('@idp' => print_r($idp, TRUE)), WATCHDOG_DEBUG);
    }

    $redirect_page = parent::login($returnTo, $parameters, $forceAuthn, $isPassive, $stay, $setNameIdPolicy, $nameIdValueReq);

    if (variable_get('saml_sp__debug', FALSE)) {
      watchdog('saml_sp', 'samlp:AuthnRequest =><br/><pre>@request</pre>', array('@request' => $this->getLastRequestXML()), WATCHDOG_DEBUG);
      if (function_exists('dpm')) {
        dpm($this->getLastRequestXML(), 'samlp:AuthnRequest');
      }
      else {
        drupal_set_message('samlp:AuthnRequest => ' . $this->getLastRequestXML());
      }
    }

    // record the outbound Id of the request
    $id = $this->getLastRequestID();
    saml_sp__track_request($id, $idp, $this->auth_callback);
    if (variable_get('saml_sp__debug', FALSE)) {
      watchdog('saml_sp', 'Using $parameters => <pre>@parameters</pre>', array('@parameters' => print_r($parameters, TRUE)), WATCHDOG_DEBUG);
      return t('This is a debug page, <a href="!url">you can proceed by clicking this link.</a> (this might not work, because "/" chars are encoded differently when the link is made by Drupal as opposed to redirected, as it is when debugging is turned off)', array('!url' => url($redirect_page, array('query' => $parameters))));
    }

    return $redirect_page;
  }

  /**
   * {@inheritdoc}
   */
  public function buildAuthnRequest($settings, $forceAuthn, $isPassive, $setNameIdPolicy, $nameIdValueReq = null)
  {
    $this->AuthnRequest =  new AuthnRequest($settings, $forceAuthn, $isPassive, $setNameIdPolicy, $nameIdValueReq);
    return $this->AuthnRequest;
  }
}
