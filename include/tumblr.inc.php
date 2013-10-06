<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_tumblr($basename, $root_url, &$tpl_vars, &$buttons)
{
  global $conf, $template;
  
  // config
  $tpl_vars['TUMBLR'] = $conf['SocialButtons']['tumblr'];
  
  $template->set_filename('tumblr_button', realpath(SOCIALBUTT_PATH .'template/tumblr.tpl'));
  $buttons[] = 'tumblr_button';
}

?>