<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_google($basename, $root_url, &$tpl_vars, &$buttons)
{
  global $conf, $template, $user;
  
  $google_langs = array(
    'af','am','ar','eu','bn','bg','ca','zh-HK','zh-CN','zh-TW','h','cs','da','nl',
    'en-GB','en-US','et','fil','fi','fr','fr-CA','gl','de','el','gu','iw','hi','hu',
    'is','id','it','ja','kn','ko','lv','lt','ms','ml','mr','no','fa','pl','pt-BR','pt-PT',
    'ro','ru','sr','sk','sl','es','es-419','sw','sv','ta','te','th','tr','uk','ur','vi','zu'
    );
  
  
  // if the link is in the toolbar, we must use smaller buttons
  if ( $conf['SocialButtons']['position'] == 'index' or  $conf['SocialButtons']['position'] == 'toolbar')
  {
    if ($conf['SocialButtons']['google']['size'] == 'tall' and $conf['SocialButtons']['google']['annotation'] == 'bubble')
    {
      $conf['SocialButtons']['google']['size'] = 'standard';
    }
  }
  
  
  // config
  $tpl_vars['GOOGLE'] = $conf['SocialButtons']['google'];
  
  // button language
  if ( in_array(str_replace('_','-',$user['language']), $google_langs) )
  {
    $tpl_vars['GOOGLE']['lang'] = str_replace('_','-',$user['language']);
  }
  if ( in_array(substr($user['language'],0,2), $google_langs) )
  {
    $tpl_vars['GOOGLE']['lang'] = substr($user['language'],0,2);
  }
  else
  {
    $tpl_vars['GOOGLE']['lang'] = 'en-GB';
  }
  
  
  $template->set_filename('google_button', realpath(SOCIALBUTT_PATH .'template/google.tpl'));
  $buttons[] = 'google_button';
}

?>  