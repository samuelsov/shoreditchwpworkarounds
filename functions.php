<?php
/**
* Plugin Name: CiviCRM Shoreditch Admin Hack
* Plugin URI: 
* Description: Fix Shoreditch in CiviCRM backend
* Version: 1.0
* Author: Samuel Vanhove
**/


add_filter( 'admin_body_class', 'shoreditchwpworkarounds_body_class' );

/**
 * Adds one or more classes to the body tag in the dashboard.
 *
 * @link https://wordpress.stackexchange.com/a/154951/17187
 * @param  String $classes Current body classes.
 * @return String          Altered body classes.
 */
function shoreditchwpworkarounds_body_class( $classes ) {

  civicrm_initialize();
  $path = CRM_Utils_System::currentPath();
  $item = CRM_Core_Menu::get($path);

  if (!empty($item) && empty(CRM_Utils_Request::retrieveValue('snippet', 'String'))) {
    $items = explode('/', $item['path']);
    $cnt = count($items);

    $newclasses = [
      'page-civicrm',
      'page-' . implode('-', array_slice($items, 0, 2)),
      'page-' . implode('-', array_slice($items, 0, 3)),
    ];

    return "$classes " . implode(' ', $newclasses);
  }

  return "$classes";
}

