{strip}
<a title="Share on Twitter" href="https://twitter.com/share?url={$SOCIALBUTT.share_url|urlencode}&text={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}{if $SOCIALBUTT.TWITTER.via}&via={$SOCIALBUTT.TWITTER.via}{/if}"
{if $SOCIALBUTT.light}
  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=470,width=600');return false;" target="_blank" rel="nofollow"
{else}
  data-url="{$SOCIALBUTT.share_url}" data-lang="{$SOCIALBUTT.TWITTER.lang}" data-via="{$SOCIALBUTT.TWITTER.via}"
  data-size="{$SOCIALBUTT.TWITTER.size}" data-count="{$SOCIALBUTT.TWITTER.count}" class="twitter-share-button" rel="nofollow"
  {combine_script id='twitter_widgets' load='footer' path='https://platform.twitter.com/widgets.js'}
{/if}
><img src="{$ROOT_URL}{$SOCIALBUTT_PATH}template/images/twitter_{$SOCIALBUTT.TWITTER.size}.png" alt="Twitter"></a>
{/strip}