<?php 
/*
Plugin Name: Social Buttons
Version: auto
Description: Sharing functions for Facebook, Twitter, Google+ and Tumblr
Plugin URI: auto
Author: Mistic
Author URI: http://www.strangeplanet.fr
*/

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

global $prefixeTable;

// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
defined('SOCIALBUTT_ID') or define('SOCIALBUTT_ID', basename(dirname(__FILE__)));
define('SOCIALBUTT_PATH' ,   PHPWG_PLUGINS_PATH . SOCIALBUTT_ID . '/');
define('SOCIALBUTT_ADMIN',   get_root_url() . 'admin.php?page=plugin-' . SOCIALBUTT_ID);
define('SOCIALBUTT_VERSION', 'auto');


// +-----------------------------------------------------------------------+
// | Add event handlers                                                    |
// +-----------------------------------------------------------------------+
// init the plugin
add_event_handler('init', 'socialbutt_init');

if (defined('IN_ADMIN'))
{
  add_event_handler('get_admin_plugin_menu_links', 'socialbutt_admin_plugin_menu_links');
  
  function socialbutt_admin_plugin_menu_links($menu) 
  {
    array_push($menu, array(
      'NAME' => 'Social Buttons',
      'URL' => SOCIALBUTT_ADMIN,
    ));
    return $menu;
  }
}
else
{
  add_event_handler('loc_end_picture', 'socialbutt_add_button');
  add_event_handler('loc_end_index', 'socialbutt_add_button');
}


/**
 * plugin initialization
 */
function socialbutt_init()
{
  global $conf, $pwg_loaded_plugins;
  
  // apply upgrade if needed
  if (
    SOCIALBUTT_VERSION == 'auto' or
    $pwg_loaded_plugins[SOCIALBUTT_ID]['version'] == 'auto' or
    version_compare($pwg_loaded_plugins[SOCIALBUTT_ID]['version'], SOCIALBUTT_VERSION, '<')
  )
  {
    // call install function
    include_once(SOCIALBUTT_PATH . 'include/install.inc.php');
    socialbutt_install();
    
    // update plugin version in database
    if ( $pwg_loaded_plugins[SOCIALBUTT_ID]['version'] != 'auto' and SOCIALBUTT_VERSION != 'auto' )
    {
      $query = '
UPDATE '. PLUGINS_TABLE .'
SET version = "'. SOCIALBUTT_VERSION .'"
WHERE id = "'. SOCIALBUTT_ID .'"';
      pwg_query($query);
      
      $pwg_loaded_plugins[SOCIALBUTT_ID]['version'] = SOCIALBUTT_VERSION;
      
      if (defined('IN_ADMIN'))
      {
        $_SESSION['page_infos'][] = 'Social Buttons updated to version '. SOCIALBUTT_VERSION;
      }
    }
  }
  
  // prepare plugin configuration
  $conf['SocialButtons'] = unserialize($conf['SocialButtons']);
}


/**
 * add buttons
 */
function socialbutt_add_button()
{
  global $conf, $template;
  
  $basename = script_basename();
  $root_url = get_absolute_root_url();
  
  if ($basename == 'picture')
  {
    $share_url = $root_url.ltrim(duplicate_picture_url(), './');
  }
  else if ($basename == 'index')
  {
    $conf['SocialButtons']['position'] = 'index';
    $share_url = $root_url.ltrim(duplicate_index_url(array(), array('start')), './');
  }
  else
  {
    return;
  }
  
  
  define('SOCIALBUTT_POSITION', $conf['SocialButtons']['position']);
  $tpl_vars = array(
    'share_url' => $share_url,
    'position' => $conf['SocialButtons']['position'],
    'copyright' => ' (from <a href="'.$root_url.'">'.$conf['gallery_title'].'</a>)',
    );
  $buttons = array();
  
  
  if ($conf['SocialButtons']['google']['enabled'])
  {
    include_once(SOCIALBUTT_PATH . 'include/google.inc.php');
    socialbutt_google($basename, $root_url, $tpl_vars, $buttons);
  }
  if ($conf['SocialButtons']['twitter']['enabled'])
  {
    include_once(SOCIALBUTT_PATH . 'include/twitter.inc.php');
    socialbutt_twitter($basename, $root_url, $tpl_vars, $buttons);
  }
  if ($conf['SocialButtons']['facebook']['enabled'])
  {
    include_once(SOCIALBUTT_PATH . 'include/facebook.inc.php');
    socialbutt_facebook($basename, $root_url, $tpl_vars, $buttons);
  }
  if ($conf['SocialButtons']['tumblr']['enabled'])
  {
    include_once(SOCIALBUTT_PATH . 'include/tumblr.inc.php');
    socialbutt_tumblr($basename, $root_url, $tpl_vars, $buttons);
  }
  if ($conf['SocialButtons']['pinterest']['enabled'] and $basename=='picture')
  {
    include_once(SOCIALBUTT_PATH . 'include/pinterest.inc.php');
    socialbutt_pinterest($basename, $root_url, $tpl_vars, $buttons);
  }
  
  if (empty($buttons))
  {
    return;
  }
  
  
  $template->assign(array(
    'SOCIALBUTT' => $tpl_vars,
    'SOCIALBUTT_PATH' => SOCIALBUTT_PATH,
    ));
  
  // parse buttons
  foreach ($buttons as &$button)
  {
    $button = $template->parse($button, true);
  }
  unset($button);
  
  switch ($conf['SocialButtons']['position'])
  {
    case 'index':
      foreach ($buttons as $button) {
        // $template->add_index_button('<li>'.$button.'</li>', 100);
        $template->concat('PLUGIN_INDEX_ACTIONS', "\n<li>".$button."</li>");
      }
      break;
    case 'toolbar':
      foreach ($buttons as $button) {
        // $template->add_picture_button($button, 100);
        $template->concat('PLUGIN_PICTURE_ACTIONS', "\n".$button);
      }
      break;
    default;
      $template->assign('SOCIALBUTT_BUTTONS', $buttons);
      $template->set_prefilter('picture', 'socialbutt_add_button_prefilter');
  }
}

function socialbutt_add_button_prefilter($content)
{
  switch (SOCIALBUTT_POSITION)
  {
    case 'top':
      $search = '<div id="theImage">';
      $add = '<div>{foreach from=$SOCIALBUTT_BUTTONS item=BUTTON}{$BUTTON}{/foreach}</div>';
      break;
      
    case 'bottom':
      $search = '{$ELEMENT_CONTENT}';
      $add = '<div>{foreach from=$SOCIALBUTT_BUTTONS item=BUTTON}{$BUTTON}{/foreach}</div>';
      break;
  }

  return str_replace($search, $search.$add, $content);
}

?>