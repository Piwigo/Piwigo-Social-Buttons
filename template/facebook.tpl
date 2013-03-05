{strip}
{footer_script}jQuery('body').prepend('<div id="fb-root"></div>');{/footer_script}
{combine_script id='facebook_jssdk' load='footer' path='https://connect.facebook.net/'|cat:$SOCIALBUTT.FACEBOOK.lang|cat:'/all.js#xfbml=1'}

{if $SOCIALBUTT.FACEBOOK.layout=='none'}
{html_style}{literal}
.fb-like span { height: 22px !important; overflow: hidden !important; }
.fb-like iframe { top: -41px; }
{/literal}{/html_style}
{assign var=facebook_layout value='box_count'}
{else}
{assign var=facebook_layout value=$SOCIALBUTT.FACEBOOK.layout}
{/if}

<div style="display:inline-block;" class="fb-like" data-send="false" data-show-faces="false" 
  data-href="{$SOCIALBUTT.share_url}" data-layout="{$facebook_layout}" data-colorscheme="{$SOCIALBUTT.FACEBOOK.color}"></div>
{/strip}