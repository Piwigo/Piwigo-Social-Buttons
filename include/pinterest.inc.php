<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_pinterest($basename, $root_url, &$tpl_vars, &$buttons)
{
  // only on picture page
  if ($basename != 'picture')
  {
    return;
  }
  
  global $conf, $template;
  
  // config
  $tpl_vars['PINTEREST'] = $conf['SocialButtons']['pinterest'];
  
  $template->set_filename('pinterest_button', realpath(SOCIALBUTT_PATH .'template/pinterest.tpl'));
  $buttons[] = 'pinterest_button';
}
