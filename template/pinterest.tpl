{strip}
<a href="http://pinterest.com/pin/create/button/?url={$SOCIALBUTT.share_url|urlencode}&media={$SOCIALBUTT.source|urlencode}&description={$PAGE_TITLE|cat:' '|cat:$SOCIALBUTT.copyright|urlencode}" rel="nofollow"
{if $SOCIALBUTT.light}
  {' '}onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=470,width=600');return false;" target="_blank"
{else}
  {' '}class="pin-it-button" count-layout="{$SOCIALBUTT.PINTEREST.layout}"
  {combine_script id='pinterest_pinit' load='footer' path='https://assets.pinterest.com/js/pinit.js'}
{/if}
><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It"/></a>
{/strip}