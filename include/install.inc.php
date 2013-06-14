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
        'img_size' => 'Original',
        ),
      'facebook' => array(
        'enabled' => true,
        'color' => 'light',
        'layout' => 'button_count',
        ),
      'pinterest' => array(
        'enabled' => true,
        'layout' => 'horizontal',
        'img_size' => 'Original',
        ),
      );
    
    if (isset($conf['TumblrShare']))
    {
      $temp = is_string($conf['TumblrShare']) ? unserialize($conf['TumblrShare']) : $conf['TumblrShare'];
      $default_config['tumblr']['type'] = $temp['type'];
      $default_config['tumblr']['img_size'] = $temp['img_size'];
    }
    if (isset($conf['TweetThis']))
    {
      $temp = is_string($conf['TweetThis']) ? unserialize($conf['TweetThis']) : $conf['TweetThis'];
      $default_config['twitter']['size'] = $temp['size'];
      $default_config['twitter']['count'] = $temp['count'] ? 'bubble' : 'none';
      $default_config['twitter']['via'] = $temp['via'];
    }
    if (isset($conf['GooglePlusOne']))
    {
      $temp = is_string($conf['GooglePlusOne']) ? unserialize($conf['GooglePlusOne']) : $conf['GooglePlusOne'];
      $default_config['google']['size'] = $temp['size'];
      $default_config['google']['annotation'] = $temp['annotation'];
    }
    
    $conf['SocialButtons'] = serialize($default_config);
    conf_update_param('SocialButtons', $conf['SocialButtons']);
  }
  else
  {
    $new_conf = unserialize($conf['SocialButtons']);
    
    if (empty($new_conf['pinterest']))
    {
      $new_conf['pinterest'] = array(
        'enabled' => true,
        'layout' => 'horizontal',
        'img_size' => 'Original',
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
    
    $conf['SocialButtons'] = serialize($new_conf);
    conf_update_param('SocialButtons', $conf['SocialButtons']);
  }
}

?>