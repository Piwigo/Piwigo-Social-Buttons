<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

function socialbutt_facebook($basename, $root_url, &$tpl_vars, &$buttons)
{
  global $conf, $template, $user;
  
  $facebook_langs = array(
    'af_ZA','ar_AR','az_AZ','be_BY','bg_BG','bn_IN','bs_BA','ca_ES','cs_CZ','cy_GB','da_DK',
    'de_DE','el_GR','en_GB','en_PI','en_UD','en_US','eo_EO','es_ES','es_LA','et_EE','eu_ES',
    'fa_IR','fb_LT','fi_FI','fo_FO','fr_CA','fr_FR','fy_NL','ga_IE','gl_ES','he_IL','hi_IN',
    'hr_HR','hu_HU','hy_AM','id_ID','is_IS','it_IT','ja_JP','ka_GE','km_KH','ko_KR','ku_TR',
    'la_VA','lt_LT','lv_LV','mk_MK','ml_IN','ms_MY','nb_NO','ne_NP','nl_NL','nn_NO','pa_IN',
    'pl_PL','ps_AF','pt_BR','pt_PT','ro_RO','ru_RU','sk_SK','sl_SI','sq_AL','sr_RS','sv_SE',
    'sw_KE','ta_IN','te_IN','th_TH','tl_PH','tr_TR','uk_UA','vi_VN','zh_CN','zh_HK','zh_TW'
    );
  
  
  // if the link is in the toolbar, we must use smaller buttons
  if ( $conf['SocialButtons']['position'] == 'index' or  $conf['SocialButtons']['position'] == 'toolbar')
  {
    if ($conf['SocialButtons']['facebook']['layout'] == 'box_count')
    {
      $conf['SocialButtons']['facebook']['layout'] = 'button_count';
    }
  }
  
  
  // config
  $tpl_vars['FACEBOOK'] = $conf['SocialButtons']['facebook'];
  
  // button language
  if ( in_array($user['language'], $facebook_langs) )
  {
    $tpl_vars['FACEBOOK']['lang'] = $user['language'];
  }
  else
  {
    $tpl_vars['FACEBOOK']['lang'] = 'en_GB';
  }
  
  
  $template->set_filename('facebook_button', realpath(SOCIALBUTT_PATH .'template/facebook.tpl'));
  $buttons[] = 'facebook_button';
}

?>  