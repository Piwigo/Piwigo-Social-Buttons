<?php
defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');

class SocialButtons_maintain extends PluginMaintain
{
  private $installed = false;
  
  private $default_config = array(
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
      'enabled' => false,
      'type' => 'interactive',
      'community' => null,
      ),
    'linkedin' => array(
      'enabled' => false,
      'counter' => 'right',
      ),
    );

  function install($plugin_version, &$errors=array())
  {
    if (empty($conf['SocialButtons']))
    {
      if (isset($conf['TumblrShare']))
      {
        $temp = is_string($conf['TumblrShare']) ? unserialize($conf['TumblrShare']) : $conf['TumblrShare'];
        if (!empty($temp['type']))      $this->default_config['tumblr']['type'] = $temp['type'];
        if (!empty($temp['img_size']))  $this->default_config['img_size'] =       $temp['img_size'];
      }
      if (isset($conf['TweetThis']))
      {
        $temp = is_string($conf['TweetThis']) ? unserialize($conf['TweetThis']) : $conf['TweetThis'];
        if (!empty($temp['type']))  $this->default_config['twitter']['size'] =  $temp['size'];
        if (!empty($temp['count'])) $this->default_config['twitter']['count'] = $temp['count'] ? 'bubble' : 'none';
        if (!empty($temp['via']))   $this->default_config['twitter']['via'] =   $temp['via'];
      }
      if (isset($conf['GooglePlusOne']))
      {
        $temp = is_string($conf['GooglePlusOne']) ? unserialize($conf['GooglePlusOne']) : $conf['GooglePlusOne'];
        if (!empty($temp['size']))        $this->default_config['google']['size'] =       $temp['size'];
        if (!empty($temp['annotation']))  $this->default_config['google']['annotation'] = $temp['annotation'];
      }
      
      $conf['SocialButtons'] = serialize($this->default_config);
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
      
      if (empty($new_conf['linkedin']))
      {
        $new_conf['linkedin'] = array(
          'enabled' => false,
          'counter' => 'right',
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

    $this->installed = true;
  }

  function activate($plugin_version, &$errors=array())
  {
    if (!$this->installed)
    {
      $this->install($plugin_version, $errors);
    }
  }

  function deactivate()
  {
  }

  function uninstall()
  {
    conf_delete_param('SocialButtons');
  }
}

?>