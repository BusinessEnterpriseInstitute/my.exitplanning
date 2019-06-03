<?php

use Lockr\SecretInfoInterface;

class LockrDrupal7SecretInfo implements SecretInfoInterface {

  private $data;

  public function __construct() {
    $this->data = variable_get('lockr_secret_info') ?: [];
  }

  /**
   * {@inheritdoc}
   */
  public function getSecretInfo($name) {
    if (isset($this->data[$name])) {
      return $this->data[$name];
    }
    elseif ($key = key_get_key($name)) {
      if (isset($key['key_provider_settings']['encoded'])) {
        return ['wrapping_key' => $key['key_provider_settings']['encoded']];
      }
    }
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function setSecretInfo($name, array $info) {
    $this->data[$name] = $info;
    variable_set('lockr_secret_info', $this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function getAllSecretInfo() {
    return $this->data;
  }

}
