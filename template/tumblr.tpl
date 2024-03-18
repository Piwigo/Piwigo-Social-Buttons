{strip}
{if $SOCIALBUTT.basename=='picture'}
  {if isset($related_tags)}
  {capture assign="inline_tags"}{foreach from=$related_tags item=tag name=tag_loop}{if !$smarty.foreach.tag_loop.first},{/if}{$tag.name}{/foreach}{/capture}
  {/if}
  <a title="Share on tumblr" href="https://www.tumblr.com/share/photo?source={$SOCIALBUTT.source|urlencode}&caption={$PAGE_TITLE|cat:' '|cat:$SOCIALBUTT.copyright|urlencode}&clickthru={$SOCIALBUTT.share_url|urlencode}{if isset($inline_tags)}&tags={$inline_tags|urlencode}{/if}"
{else}
  <a title="Share on tumblr" href="https://www.tumblr.com/share/link?url={$SOCIALBUTT.share_url|urlencode}&name={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}&description={if isset($CONTENT_DESCRIPTION)}{$CONTENT_DESCRIPTION|urlencode}{/if}{$SOCIALBUTT.copyright|urlencode}"
{/if}
{if $SOCIALBUTT.light}
  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=430,width=500');return false;" target="_blank" rel="nofollow" 
{else}
  {combine_script id='tumblr_share' load='footer' path='https://platform.tumblr.com/v1/share.js'}
{/if}
><img src="https://platform.tumblr.com/v1/{$SOCIALBUTT.TUMBLR.type}.png" alt="Tumblr"></a>
{/strip}
