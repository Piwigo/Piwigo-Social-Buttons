<?php
defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

defined('SOCIALBUTT_ID') or define('SOCIALBUTT_ID', basename(dirname(__FILE__)));
include_once(PHPWG_PLUGINS_PATH . SOCIALBUTT_ID . '/include/install.inc.php');


function plugin_install() 
{
  socialbutt_install();
  define('socialbutt_installed', true);
}


function plugin_activate()
{
  if (!defined('socialbutt_installed'))
  {
    socialbutt_install();
  }
}


function plugin_uninstall() 
{
  pwg_query('DELETE FROM `'. CONFIG_TABLE .'` WHERE param = "SocialButtons" LIMIT 1;');
}

?>