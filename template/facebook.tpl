{strip}
{if $SOCIALBUTT.light}
  {if $SOCIALBUTT.basename=='picture'}
    <a href="http://www.facebook.com/sharer.php?s=100&p[url]={$SOCIALBUTT.share_url|urlencode}&p[title]={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}&p[summary]={$COMMENT_IMG|cat:$SOCIALBUTT.copyright|urlencode}&p[images][0]={$SOCIALBUTT.source|urlencode}"
  {else}
    <a href="http://www.facebook.com/sharer.php?s=100&p[url]={$SOCIALBUTT.share_url|urlencode}&p[title]={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}&p[summary]={$CONTENT_DESCRIPTION|cat:$SOCIALBUTT.copyright|urlencode}"
  {/if}
    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=500');return false;" target="_blank"  rel="nofollow">
    <img src="{$ROOT_PATH}{$SOCIALBUTT_PATH}template/images/facebook_{$SOCIALBUTT.FACEBOOK.color}.png" alt="Share on Facebook"></a>
{else}
  {footer_script}jQuery('body').prepend('<div id="fb-root"></div>');{/footer_script}
  {combine_script id='facebook_jssdk' load='footer' path='https://connect.facebook.net/'|cat:$SOCIALBUTT.FACEBOOK.lang|cat:'/all.js#xfbml=1'}
  <div style="display:inline-block;" class="fb-like" data-send="false" data-show-faces="false" 
    data-href="{$SOCIALBUTT.share_url}" data-layout="{$SOCIALBUTT.FACEBOOK.layout}" data-colorscheme="{$SOCIALBUTT.FACEBOOK.color}"></div>
{/if}
{/strip}