{strip}
{if $SOCIALBUTT.light}
<a href="https://www.facebook.com/sharer.php?u={$SOCIALBUTT.share_url|urlencode}&t={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}" rel="nofollow"
  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=500');return false;" target="_blank">
  <img src="{$ROOT_PATH}{$SOCIALBUTT_PATH}template/images/facebook_{$SOCIALBUTT.FACEBOOK.color}.png" alt="Share on Facebook"></a>
{else}
{footer_script}jQuery('body').prepend('<div id="fb-root"></div>');{/footer_script}
{combine_script id='facebook_jssdk' load='footer' path='https://connect.facebook.net/'|cat:$SOCIALBUTT.FACEBOOK.lang|cat:'/all.js#xfbml=1'}
<div style="display:inline-block;" class="fb-like" data-send="false" data-show-faces="false" 
  data-href="{$SOCIALBUTT.share_url}" data-layout="{$SOCIALBUTT.FACEBOOK.layout}" data-colorscheme="{$SOCIALBUTT.FACEBOOK.color}"></div>
{/if}
{/strip}