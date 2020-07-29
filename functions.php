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
  $path = CRM_Utils_System::getUrlPath();
  $item = CRM_Core_Menu::get($path);

  if (empty(CRM_Utils_Request::retrieveValue('snippet', 'String'))) {
    $path = CRM_Utils_System::getUrlPath();
    $item = CRM_Core_Menu::get($path);
    $classname = 'page-' . strtr($item['path'], '/', '-');

    return "$classes $classname page-civicrm";
  }

  return "$classes";
}

