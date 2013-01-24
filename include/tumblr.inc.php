<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_tumblr($basename, $root_url, &$tpl_vars)
{
  global $conf, $template, $user;
  
  $tumblr_css = array(
    'share_1' => 'width:81px; height:20px;',
    'share_2' => 'width:61px; height:20px;',
    'share_3' => 'width:129px; height:20px;',
    'share_4' => 'width:20px; height:20px;',
    'share_1T' => 'width:81px; height:20px;',
    'share_2T' => 'width:61px; height:20px;',
    'share_3T' => 'width:129px; height:20px;',
    'share_4T' => 'width:20px; height:20px;',
    );
  
  
  // config
  $tpl_vars['TUMBLR'] = $conf['SocialButtons']['tumblr'];
  $tpl_vars['TUMBLR']['css'] = $tumblr_css[ $conf['SocialButtons']['tumblr']['type'] ];
  $tpl_vars['TUMBLR']['copyright'] = ' (from <a href="'.$root_url.'">'.$conf['gallery_title'].'</a>)';
  
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
  return 'tumblr_button';
}

?>  