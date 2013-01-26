{strip}
{combine_script id='pinterest_pinit' path='http://assets.pinterest.com/js/pinit.js'}

<a href="http://pinterest.com/pin/create/button/?url={$SOCIALBUTT.share_url|urlencode}&media={$SOCIALBUTT.PINTEREST.source|urlencode}&description={$SOCIALBUTT.PINTEREST.title|cat:$SOCIALBUTT.copyright|urlencode}" 
  class="pin-it-button" count-layout="{$SOCIALBUTT.PINTEREST.layout}"><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It"/></a>
{/strip}