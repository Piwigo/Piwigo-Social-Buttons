<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_linkedin($basename, $root_url, &$tpl_vars, &$buttons) 
{
  global $conf, $template, $user;
  
  $linkedin_langs = array(
    'en_US','fr_FR','es_ES','ru_RU','de_DE','it_IT','pt_BR','ro_RO','tr_TR','ja_JP',
    'in_ID','ms_MY','ko_KR','sv_SE','cs_CZ','nl_NL','pl_PL','no_NO','da_DK'
    );
  
  
  // if the link is in the toolbar, we must use smaller buttons
  if ($conf['SocialButtons']['position'] == 'index' or $conf['SocialButtons']['position'] == 'toolbar')
  {
    if ($conf['SocialButtons']['linkedin']['counter'] == 'top')
    {
      $conf['SocialButtons']['linkedin']['counter'] = 'right';
    }
  }
  
  
  // config
  $tpl_vars['LINKEDIN'] = $conf['SocialButtons']['linkedin'];
  
  // button language
  if ( in_array($user['language'], $linkedin_langs) )
  {
    $tpl_vars['LINKEDIN']['lang'] = $user['language'];
  }
  else
  {
    $tpl_vars['LINKEDIN']['lang'] = 'en_US';
  }
  
  
  $template->set_filename('linkedin_button', realpath(SOCIALBUTT_PATH .'template/linkedin.tpl'));
  $buttons[] = 'linkedin_button';
}
