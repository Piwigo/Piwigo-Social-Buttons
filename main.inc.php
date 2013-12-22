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

// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
define('SOCIALBUTT_ID',      basename(dirname(__FILE__)));
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
    $menu[] = array(
      'NAME' => 'Social Buttons',
      'URL' => SOCIALBUTT_ADMIN,
      );
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

  include_once(SOCIALBUTT_PATH . 'maintain.inc.php');
  $maintain = new SocialButtons_maintain(SOCIALBUTT_ID);
  $maintain->autoUpdate(SOCIALBUTT_VERSION, 'install');

  $conf['SocialButtons'] = unserialize($conf['SocialButtons']);
}


/**
 * add buttons
 */
function socialbutt_add_button()
{
  global $conf, $template, $picture;
  
  set_make_full_url();
  $basename = script_basename();
  $root_url = get_absolute_root_url();
  
  if ($basename == 'picture')
  {
    // global $picture;
    
    // if ($picture['current']['level'] > 0) return;
    
    $share_url = duplicate_picture_url();
  }
  else if ($basename == 'index' and $conf['SocialButtons']['on_index'])
  {
    $conf['SocialButtons']['position'] = 'index';
    $share_url = duplicate_index_url(array(), array('start'));
  }
  else
  {
    return;
  }
  
  
  $tpl_vars = array(
    'share_url' => $share_url,
    'basename' => $basename,
    'position' => $conf['SocialButtons']['position'],
    'light' => $conf['SocialButtons']['light'],
    'copyright' => '(from <a href="'.$share_url.'">'.$conf['gallery_title'].'</a>)',
    );
  
  if ($basename == 'picture')
  {
    if ($conf['SocialButtons']['img_size'] == 'Original')
    {
      $tpl_vars['source'] = $picture['current']['src_image']->get_url();
    }
    else
    {
      $tpl_vars['source'] = DerivativeImage::url($conf['SocialButtons']['img_size'], $picture['current']['src_image']);
    }
  }
  
  
  $buttons = array();
  $services = array('google', 'twitter', 'facebook', 'tumblr', 'pinterest', 'reddit', 'linkedin');
  
  foreach ($services as $service)
  {
    if ($conf['SocialButtons'][$service]['enabled'])
    {
      if ($service=='pinterest' && $basename!='picture')
      {
        continue;
      }
      include_once(SOCIALBUTT_PATH . 'include/'. $service .'.inc.php');
      call_user_func_array('socialbutt_'.$service, array($basename, $root_url, &$tpl_vars, &$buttons));
    }
  }
  
  unset_make_full_url();
  
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
      foreach ($buttons as $button)
      {
        $template->add_index_button($button, 100);
      }
      break;
    case 'toolbar':
      foreach ($buttons as $button)
      {
        $template->add_picture_button($button, 100);
      }
      break;
    default;
      define('SOCIALBUTT_POSITION', $conf['SocialButtons']['position']);
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
      $add = '<div id="socialButtons">{foreach from=$SOCIALBUTT_BUTTONS item=BUTTON}{$BUTTON} {/foreach}</div>';
      break;
      
    case 'bottom':
      $search = '{$ELEMENT_CONTENT}';
      $add = '<div id="socialButtons">{foreach from=$SOCIALBUTT_BUTTONS item=BUTTON}{$BUTTON} {/foreach}</div>';
      break;
  }

  return str_replace($search, $search.$add, $content);
}

?>