{strip}
{footer_script}jQuery('body').prepend('<div id="fb-root"></div>');{/footer_script}
{combine_script id='facebook_jssdk' load='footer' path='https://connect.facebook.net/'|cat:$SOCIALBUTT.FACEBOOK.lang|cat:'/all.js#xfbml=1'}

<div style="display:inline-block;" class="fb-like" data-send="false" data-show-faces="false" 
  data-href="{$SOCIALBUTT.share_url}" data-layout="{$SOCIALBUTT.FACEBOOK.layout}" data-colorscheme="{$SOCIALBUTT.FACEBOOK.color}"></div>
{/strip}