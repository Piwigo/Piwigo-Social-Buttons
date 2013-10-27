{strip}
{if not $SOCIALBUTT.light && $SOCIALBUTT.REDDIT.type == 'interactive'}
  <script type="text/javascript">
  reddit_url = "{$SOCIALBUTT.share_url|escape:javascript}";
  reddit_title = "{$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|escape:javascript}";
  reddit_target = "{$SOCIALBUTT.REDDIT.community|escape:javascript}";
  reddit_newwindow = 1;
  </script>
  <script type="text/javascript" src="http://{$SOCIALBUTT.REDDIT.lang}.reddit.com/static/button/button1.js"></script>
{else}
  <a title="Share on reddit" href="http://{$SOCIALBUTT.REDDIT.lang}.reddit.com/submit?url={$SOCIALBUTT.share_url|urlencode}&title={$PAGE_TITLE|cat:' | '|cat:$GALLERY_TITLE|urlencode}&target={$SOCIALBUTT.REDDIT.community|urlencode}" rel="nofollow" target="_blank">
    <img src="http://www.reddit.com/static/{$SOCIALBUTT.REDDIT.type}.gif" alt="reddit"></a>
{/if}
{/strip}