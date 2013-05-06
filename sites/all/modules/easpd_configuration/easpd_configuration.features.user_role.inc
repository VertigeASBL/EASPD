<?php
/**
 * @file
 * easpd_configuration.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function easpd_configuration_user_default_roles() {
  $roles = array();

  // Exported role: administrator.
  $roles['administrator'] = array(
    'name' => 'administrator',
    'weight' => 2,
  );

  // Exported role: developer.
  $roles['developer'] = array(
    'name' => 'developer',
    'weight' => 3,
  );

  // Exported role: staff.
  $roles['staff'] = array(
    'name' => 'staff',
    'weight' => 4,
  );

  return $roles;
}
