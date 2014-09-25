<?php
defined('SOCIALBUTT_PATH') or die('Hacking attempt!');

global $conf, $template, $page;

load_language('plugin.lang', SOCIALBUTT_PATH);


if (isset($_POST['submit']))
{
  $conf['SocialButtons'] = array(
    'position' => $_POST['position'],
    'on_index' => get_boolean($_POST['on_index']),
    'img_size' => $_POST['img_size'],
    'light' => isset($_POST['light']),
    'twitter' => array(
      'enabled' => isset($_POST['twitter']['enabled']),
      'size' => $_POST['twitter']['size'],
      'count' => $_POST['twitter']['count'],
      'via' => trim($_POST['twitter']['via']),
      ),
    'google' => array(
      'enabled' => isset($_POST['google']['enabled']),
      'size' => $_POST['google']['size'],
      'annotation' => $_POST['google']['annotation'],
      ),
    'tumblr' => array(
      'enabled' => isset($_POST['tumblr']['enabled']),
      'type' => $_POST['tumblr']['type'],
      ),
    'facebook' => array(
      'enabled' => isset($_POST['facebook']['enabled']),
      'layout' => $_POST['facebook']['layout'],
      ),
    'pinterest' => array(
      'enabled' => isset($_POST['pinterest']['enabled']),
      'layout' => $_POST['pinterest']['layout'],
      ),
    'reddit' => array(
      'enabled' => isset($_POST['reddit']['enabled']),
      'type' => $_POST['reddit']['type'],
      'community' => $_POST['reddit']['community'],
      ),
    'linkedin' => array(
      'enabled' => isset($_POST['linkedin']['enabled']),
      'counter' => $_POST['linkedin']['counter'],
      ),
    );
  
  conf_update_param('SocialButtons', $conf['SocialButtons']);
  $page['infos'][] = l10n('Information data registered in database');
  
  // the prefilter changes, we must delete compiled templatess
  $template->delete_compiled_templates();
}


$template->assign($conf['SocialButtons']);
$template->assign(array(
  'SOCIALBUTT_PATH' => SOCIALBUTT_PATH,
  'img_sizes' => array_merge(ImageStdParams::get_all_types(), array('Original')),
  ));

$template->set_filename('socialbutt_content', realpath(SOCIALBUTT_PATH . 'template/admin.tpl'));
$template->assign_var_from_handle('ADMIN_CONTENT', 'socialbutt_content');
