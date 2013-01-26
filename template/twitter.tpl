{strip}
{combine_script id='twitter_widgets' load='footer' path='http://platform.twitter.com/widgets.js'}

<a href="https://twitter.com/share?url={$SOCIALBUTT.share_url}&text={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE}{if $SOCIALBUTT.TWITTER.via}&via={$SOCIALBUTT.TWITTER.via}{/if}" 
  data-url="{$SOCIALBUTT.share_url}" data-lang="{$SOCIALBUTT.TWITTER.lang}" data-via="{$SOCIALBUTT.TWITTER.via}"
  data-size="{$SOCIALBUTT.TWITTER.size}" data-count="{$SOCIALBUTT.TWITTER.count}" class="twitter-share-button">
  <img src="{$ROOT_PATH}{$SOCIALBUTT_PATH}template/images/twitter_{$SOCIALBUTT.TWITTER.size}.png" alt="Share on Twitter"></a>
{/strip}