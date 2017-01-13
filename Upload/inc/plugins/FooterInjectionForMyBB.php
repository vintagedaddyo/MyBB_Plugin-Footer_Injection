<?php
/*
 * MyBB: Header Injection For MyBB
 *
 * File: FooterInjectionForMyBB.php
 * 
 * Authors: Jimmy Peña, Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.0.1
 * 
 */

// disallow direct loading of this file

if (!defined("IN_MYBB")) {
  die("Direct loading of this file is not allowed.");
}

// hook into start function, to inject header code
//$plugins->add_hook('index_end', 'injectfootercode');

$plugins->add_hook('global_end','injectfootercode');

// required by MyBB
// info function must have same name as plugin file
function FooterInjectionForMyBB_info() { 

    global $lang;

    $lang->load("FooterInjectionForMyBB");
    
    $lang->FooterInjectionForMyBB_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->FooterInjectionForMyBB_Desc;

    return Array(
        'name' => $lang->FooterInjectionForMyBB_Name,
        'description' => $lang->FooterInjectionForMyBB_Desc,
        'website' => $lang->FooterInjectionForMyBB_Web,
        'author' => $lang->FooterInjectionForMyBB_Auth,
        'authorsite' => $lang->FooterInjectionForMyBB_AuthSite,
        'version' => $lang->FooterInjectionForMyBB_Ver,
        'guid' => $lang->FooterInjectionForMyBB_GUID,
        'compatibility' => $lang->FooterInjectionForMyBB_Compat
    );
}

// optional function that runs when plugin is activated
// must have same name as plugin file
function FooterInjectionForMyBB_activate() {
  global $db, $lang;

    $lang->load("FooterInjectionForMyBB");

  // ***********************************************
  // create plugin settings group
  // ***********************************************
  $fimybb_group = array(
    "gid" => "NULL", 
    "name" => $lang->FooterInjectionForMyBB_name_0,
    "title" => $lang->FooterInjectionForMyBB_title_0,
    "description" => $lang->FooterInjectionForMyBB_description_0, 
    "disporder" => "1", 
    "isdefault" => "no"
  );
  $db->insert_query("settinggroups", $fimybb_group);
  $gid = $db->insert_id();

  // ***********************************************
  // create plugin settings
  // ***********************************************

  $fimybb_setting = array(
    "sid" => "NULL", 
    "name" => $lang->FooterInjectionForMyBB_name_1,
    "title" => $lang->FooterInjectionForMyBB_title_1,
    "description" => $lang->FooterInjectionForMyBB_description_1, 
    "optionscode" => "yesno", 
    "value" => "1", 
    "disporder" => "1", 
    "gid" => intval($gid)
  );

  $db->insert_query("settings", $fimybb_setting);

  // code to be injected
  $fimybb_setting = array(
    "sid" => "NULL", 
    "name" => $lang->FooterInjectionForMyBB_name_2,
    "title" => $lang->FooterInjectionForMyBB_title_2,
    "description" => $lang->FooterInjectionForMyBB_description_2,  
    "optionscode" => "textarea", 
    "value" => '', 
    "disporder" => "2", 
    "gid" => intval($gid)
  );

  $db->insert_query("settings", $fimybb_setting);

  rebuild_settings();

} // end activate function

// optional function that runs when plugin is deactivated
// must have same name as plugin file
function FooterInjectionForMyBB_deactivate() {
  
  global $db;

  // delete settings first
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('fimybb_plugin_enabled')");
  $db->query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN ('fimybb_inject')");
  // delete settings group
  $db->query("DELETE FROM " . TABLE_PREFIX . "settinggroups WHERE name='fimybb_group'");

  rebuild_settings();
}

// main function that runs on hook
function injectfootercode() {
  global $mybb;
  global $footer;

  $isenabled = (bool)$mybb->settings['fimybb_plugin_enabled'];
  $codetoinsert = $mybb->settings['fimybb_inject'];
    
  if ($isenabled) { // plugin is enabled
    if (strlen($codetoinsert) > 0) { // code included, inject it
      $footer = $codetoinsert . $footer;
    } // end code check
  } // end enabled check
} // end injectfootercode function
?>