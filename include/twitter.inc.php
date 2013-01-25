<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_twitter($basename, $root_url, &$tpl_vars, &$buttons) 
{
  global $conf, $template, $user;
  
 $twitter_langs = array(
    'fr','en','ar','ja','es','de','it','id','pt','ko','tr','ru','nl','fil','msa','zh-tw',
    'zh-cn','hi','no','sv','fi','da','pl','hu','fa','he','ur','th','uk','ca','el','eu','cs'
    );
  
  
  // config
  $tpl_vars['TWITTER'] = $conf['SocialButtons']['twitter'];
  
  // button language
  if ( in_array(str_replace('_','-',strtolower($user['language'])), $twitter_langs) )
  {
    $tpl_vars['TWITTER']['lang'] = str_replace('_','-',strtolower($user['language']));
  }
  if ( in_array(substr($user['language'],0,2), $twitter_langs) )
  {
    $tpl_vars['TWITTER']['lang'] = substr($user['language'],0,2);
  }
  else
  {
    $tpl_vars['TWITTER']['lang'] = 'en';
  }
  
  
  $template->set_filename('twitter_button', realpath(SOCIALBUTT_PATH .'template/twitter.tpl'));
  $buttons[] = 'twitter_button';
}

?>