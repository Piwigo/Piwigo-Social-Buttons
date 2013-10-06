<?php
defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

function socialbutt_install() 
{
  global $conf;
  
  if (empty($conf['SocialButtons']))
  {
    $default_config = array(
      'position' => 'toolbar',
      'on_index' => true,
      'img_size' => 'Original',
      'light' => false,
      'twitter' => array(
        'enabled' => true,
        'size' => 'small',
        'count' => 'bubble',
        'via' => null,
        ),
      'google' => array(
        'enabled' => true,
        'size' => 'medium',
        'annotation' => 'bubble',
        ),
      'tumblr' => array(
        'enabled' => true,
        'type' => 'share_1',
        ),
      'facebook' => array(
        'enabled' => true,
        'color' => 'light',
        'layout' => 'button_count',
        ),
      'pinterest' => array(
        'enabled' => true,
        'layout' => 'horizontal',
        ),
      'reddit' => array(
        'enabled' => true,
        'type' => 'interactive',
        'community' => null,
        ),
      );
    
    if (isset($conf['TumblrShare']))
    {
      $temp = is_string($conf['TumblrShare']) ? unserialize($conf['TumblrShare']) : $conf['TumblrShare'];
      if (!empty($temp['type']))      $default_config['tumblr']['type'] = $temp['type'];
      if (!empty($temp['img_size']))  $default_config['img_size'] =       $temp['img_size'];
    }
    if (isset($conf['TweetThis']))
    {
      $temp = is_string($conf['TweetThis']) ? unserialize($conf['TweetThis']) : $conf['TweetThis'];
      if (!empty($temp['type']))  $default_config['twitter']['size'] =  $temp['size'];
      if (!empty($temp['count'])) $default_config['twitter']['count'] = $temp['count'] ? 'bubble' : 'none';
      if (!empty($temp['via']))   $default_config['twitter']['via'] =   $temp['via'];
    }
    if (isset($conf['GooglePlusOne']))
    {
      $temp = is_string($conf['GooglePlusOne']) ? unserialize($conf['GooglePlusOne']) : $conf['GooglePlusOne'];
      if (!empty($temp['size']))        $default_config['google']['size'] =       $temp['size'];
      if (!empty($temp['annotation']))  $default_config['google']['annotation'] = $temp['annotation'];
    }
    
    $conf['SocialButtons'] = serialize($default_config);
    conf_update_param('SocialButtons', $conf['SocialButtons']);
  }
  else
  {
    $new_conf = is_string($conf['SocialButtons']) ? unserialize($conf['SocialButtons']) : $conf['SocialButtons'];
    
    if (empty($new_conf['pinterest']))
    {
      $new_conf['pinterest'] = array(
        'enabled' => true,
        'layout' => 'horizontal',
        );
    }
    
    if (empty($new_conf['reddit']))
    {
      $new_conf['reddit'] = array(
        'enabled' => false,
        'type' => 'interactive',
        'community' => null,
        );
    }
    
    if (!isset($new_conf['on_index']))
    {
      $new_conf['on_index'] = true;
    }
    
    if ($new_conf['facebook']['layout'] == 'none')
    {
      $new_conf['facebook']['layout'] = 'button_count';
    }
    
    if (!isset($new_conf['light']))
    {
      $new_conf['light'] = false;
    }
    
    if (!isset($new_conf['img_size']))
    {
      $new_conf['img_size'] = isset($new_conf['tumblr']['img_size']) ? $new_conf['tumblr']['img_size'] : 'Original';
      unset($new_conf['tumblr']['img_size'], $new_conf['pinterest']['img_size']);
    }
    
    $conf['SocialButtons'] = serialize($new_conf);
    conf_update_param('SocialButtons', $conf['SocialButtons']);
  }
}

?>