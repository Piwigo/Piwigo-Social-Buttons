<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_tumblr($basename, $root_url, &$tpl_vars, &$buttons)
{
  global $conf, $template;
  
  // config
  $tpl_vars['TUMBLR'] = $conf['SocialButtons']['tumblr'];
  
  // button on piture page
  if ($basename == 'picture')
  {
    global $picture;
    
    $tpl_vars['TUMBLR']['mode'] = 'photo';
    $tpl_vars['TUMBLR']['title'] = $picture['current']['TITLE'];
    
    if ($conf['SocialButtons']['tumblr']['img_size'] == 'Original')
    {
      $tpl_vars['TUMBLR']['source'] = $root_url.ltrim($picture['current']['src_image']->get_url(), './');
    }
    else
    {
      $tpl_vars['TUMBLR']['source'] = $root_url.ltrim(DerivativeImage::url($conf['SocialButtons']['tumblr']['img_size'], $picture['current']['src_image']), './');
    }
  }
  // button on other pages
  else if ($basename == 'index')
  {
    global $page;
    
    $tpl_vars['TUMBLR']['mode'] = 'link';
    $tpl_vars['TUMBLR']['title'] = strip_tags($page['title']);
  }
  
  
  $template->set_filename('tumblr_button', realpath(SOCIALBUTT_PATH .'template/tumblr.tpl'));
  $buttons[] = 'tumblr_button';
}

?>  