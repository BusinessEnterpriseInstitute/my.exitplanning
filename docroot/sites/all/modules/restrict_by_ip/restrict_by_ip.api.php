<?php

/**
 * @file
 * Documentation of restrict_by_ip hooks.
 */

/**
 * Alter the IP address of the user.
 *
 * In some cases it may desirable to use alternative methods to determine the
 * users IP address. This will alter the IP address that is compared with the
 * configured IP whitelists.
 *
 * Warning: Using this hook has security implications. Providing a wrong IP
 * address could allow users to bypass IP restrictions.
 *
 * @param $ip_address
 *   IP address of user.
 */
function hook_restrict_by_ip_get_ip_alter(&$ip_address) {
  // Use drupal core ip_address() instead.
  $ip_address = ip_address();
}
