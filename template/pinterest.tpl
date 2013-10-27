{strip}
<a title="Share on Pinterest" href="http://pinterest.com/pin/create/button/?url={$SOCIALBUTT.share_url|urlencode}&media={$SOCIALBUTT.source|urlencode}&description={$PAGE_TITLE|cat:' '|cat:$SOCIALBUTT.copyright|urlencode}"
{if $SOCIALBUTT.light}
  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=470,width=600');return false;" target="_blank" rel="nofollow"
{else}
  class="pin-it-button" count-layout="{$SOCIALBUTT.PINTEREST.layout}" rel="nofollow"
  {combine_script id='pinterest_pinit' load='footer' path='https://assets.pinterest.com/js/pinit.js'}
{/if}
><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It"/></a>
{/strip}