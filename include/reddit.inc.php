<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_reddit($basename, $root_url, &$tpl_vars, &$buttons) 
{
  global $conf, $template, $user;
  
  $reddit_langs = array(
    'en','ar','be','bg','ca','cs','da','de','el','en-au','en-ca','en-gb','en-us','eo',
    'es','es-ar','et','eu','fa','fi','fr','he','hi','hr','hu','hy','id','is','it','ja',
    'ko','la','leet','lol','lt','lv','nl','nn','no','pir','pl','pt','pt-pt','ro','ru',
    'sk','sl','sr','sr-la','sv','ta','th','tr','uk','vi','zh'
    );
  
  
  // fallback to simple image if JS not enabled
  if ($conf['SocialButtons']['light'] && $conf['SocialButtons']['reddit']['type'] == 'interactive')
  {
    $conf['SocialButtons']['reddit']['type'] = 'spreddit7';
  }
  
  
  // config
  $tpl_vars['REDDIT'] = $conf['SocialButtons']['reddit'];
  
  // button language
  if ( in_array(str_replace('_','-',strtolower($user['language'])), $reddit_langs) )
  {
    $tpl_vars['REDDIT']['lang'] = str_replace('_','-',strtolower($user['language']));
  }
  if ( in_array(substr($user['language'],0,2), $reddit_langs) )
  {
    $tpl_vars['REDDIT']['lang'] = substr($user['language'],0,2);
  }
  else
  {
    $tpl_vars['REDDIT']['lang'] = 'en';
  }
  
  
  $template->set_filename('reddit_button', realpath(SOCIALBUTT_PATH .'template/reddit.tpl'));
  $buttons[] = 'reddit_button';
}

?>