<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_pinterest($basename, $root_url, &$tpl_vars, &$buttons)
{
  // only on piture page
  if ($basename != 'picture')
  {
    return;
  }
  
  global $conf, $template, $picture;
  
  // config
  $tpl_vars['PINTEREST'] = $conf['SocialButtons']['pinterest'];
  $tpl_vars['PINTEREST']['title'] = $picture['current']['TITLE'];
  
  if ($conf['SocialButtons']['pinterest']['img_size'] == 'Original')
  {
    $tpl_vars['PINTEREST']['source'] = $picture['current']['src_image']->get_url();
  }
  else
  {
    $tpl_vars['PINTEREST']['source'] = DerivativeImage::url($conf['SocialButtons']['pinterest']['img_size'], $picture['current']['src_image']);
  }
  
  
  $template->set_filename('pinterest_button', realpath(SOCIALBUTT_PATH .'template/pinterest.tpl'));
  $buttons[] = 'pinterest_button';
}

?>  