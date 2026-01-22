{combine_css path=$SOCIALBUTT_PATH|@cat:"template/style.css"}

{html_style}
.socialbutt.disabled thead img {
  -webkit-filter: grayscale(100%);
  filter: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg'><filter id='grayscale'><feColorMatrix type='saturate' values='0'/></filter></svg>#grayscale");
  filter: gray;
}
{if $light}
.not-light { display:none; }
{/if}
{/html_style}

{footer_script}
jQuery("input.enable").change(function() {
  $parent = $(this).closest("div.socialbutt");
  if (!$(this).is(":checked")) {
    $parent.find("thead label").attr("title", "{'Enable'|translate|escape:javascript}");
    $parent.addClass('disabled');
    $parent.removeClass('enabled');
  }
  else {
    $parent.find("thead label").attr("title", "{'Disable'|translate|escape:javascript}");
    $parent.addClass('enabled');
    $parent.removeClass('disabled');
  }
});

jQuery("input#light_mode").on('change', function() {
  if ($(this).is(":checked")) {
    $('.not-light').hide();
  }
  else {
    $('.not-light').show();
  }
});

jQuery(".showInfo").tipTip({
  delay: 0,
  fadeIn: 200,
  fadeOut: 200,
  maxWidth: '300px',
  defaultPosition: 'bottom'
});
{/footer_script}


<div class="titrePage">
	<h2>Social Buttons</h2>
</div>


<form method="post" action="" class="properties" style="text-align:center;">

<div class="socialbutt">
<table>
  <tr class="property">
    <td>
      {'Button position on picture page'|translate}
    </td>
    <td>
      <label><input type="radio" name="position" value="top" {if $position=='top'}checked="checked"{/if}/> {'Top'|translate}</label>
      <label><input type="radio" name="position" value="bottom" {if $position=='bottom'}checked="checked"{/if}/> {'Bottom'|translate}</label>
      <label><input type="radio" name="position" value="toolbar" {if $position=='toolbar'}checked="checked"{/if}/> {'Toolbar'|translate}</label>
    </td>
  </tr>
  <tr class="property">
    <td>
      {'Display buttons'|translate}
    </td>
    <td>
      <label><input type="radio" name="on_index" value="true" {if $on_index}checked="checked"{/if}/> {'on photo and album'|translate}</label><br>
      <label><input type="radio" name="on_index" value="false" {if not $on_index}checked="checked"{/if}/> {'only on photo'|translate}</label>
    </td>
  </tr>
  <tr class="property">
    <td>
      {'Shared picture size'|translate}
    </td>
    <td>
      {html_options name="img_size" values=$img_sizes output=$img_sizes_labels selected=$img_size}
    </td>
  </tr>
  <tr class="property">
    <td>
      <label for="light_mode">{'Light mode'|translate}</label>
    </td>
    <td>
      <input type="checkbox" id="light_mode" name="light" {if $light}checked="checked"{/if}/>
      <a class="icon-info-circled-1 showInfo" title="{'When light mode is activated no external script is loaded, it <b>speeds up the load of the page and disables user tracking</b> but also disables annotations and in-page popups.'|translate}"></a>
    </td>
  </tr>
</table>
</div>

<br>


<div class="socialbutt {if not $twitter.enabled}disabled{else}enabled{/if}"> {* <!-- twitter --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $twitter.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/twitter_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="twitter[enabled]" {if $twitter.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property">
      <td>
        {'Button type'|translate}
      </td>
      <td></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="{$SOCIALBUTT_PATH}template/images/twitter_small.png"/>
        <input type="radio" name="twitter[size]" value="small" {if $twitter.size=='small'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="twitter[size]" value="large" {if $twitter.size=='large'}checked="checked"{/if}/>
        <img src="{$SOCIALBUTT_PATH}template/images/twitter_large.png"/>
      </label></td>
    </tr>
    <tr class="property not-light">
      <td>
        {'Annotation'|translate}
      </td>
      <td>
        <label><input type="radio" name="twitter[count]" value="none" {if $twitter.count=='none'}checked="checked"{/if}/> {'None'|translate}</label><br>
        <label><input type="radio" name="twitter[count]" value="bubble" {if $twitter.count=='bubble'}checked="checked"{/if}/> {'Bubble'|translate}</label><br>
      </td>
    </tr>
    <tr class="property">
      <td>
        <label for="twitter_via">{'Via'|translate}</label>
      </td>
      <td>
        @ <input type="text" id="twitter_via" name="twitter[via]" value="{$twitter.via}"/>
      </td>
    </tr>
  </tbody>
</table>
</div> {* <!-- twitter --> *}


<br>

<div class="socialbutt {if not $facebook.enabled}disabled{else}enabled{/if}"> {* <!-- facebook --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $facebook.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/facebook_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="facebook[enabled]" {if $facebook.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property not-light">
      <td>
        {'Annotation'|translate}
      </td>
    
        <!-- <label><input type="radio" name="facebook[layout]" value="none" {if $facebook.layout=='none'}checked="checked"{/if}/> {'None'|translate}</label><br> -->
        <label><input type="radio" name="facebook[layout]" value="button_count" {if $facebook.layout=='button_count'}checked="checked"{/if}/> {'Right bubble'|translate}</label><br>
        <label><input type="radio" name="facebook[layout]" value="box_count" {if $facebook.layout=='box_count'}checked="checked"{/if}/> {'Top bubble'|translate}</label><br>
        <label><input type="radio" name="facebook[layout]" value="standard" {if $facebook.layout=='standard'}checked="checked"{/if}/> {'Inline text'|translate}</label>
      </td>
    </tr>
  </tbody>
</table>
</div> {* <!-- facebook --> *}

<div class="socialbutt {if not $pinterest.enabled}disabled{else}enabled{/if}"> {* <!-- pinterest --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $pinterest.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/pinterest_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="pinterest[enabled]" {if $pinterest.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property not-light">
      <td>
        {'Annotation'|translate}
      </td>
      <td>
        <label><input type="radio" name="pinterest[layout]" value="none" {if $pinterest.layout=='none'}checked="checked"{/if}/> {'None'|translate}</label><br>
        <label><input type="radio" name="pinterest[layout]" value="horizontal" {if $pinterest.layout=='horizontal'}checked="checked"{/if}/> {'Right bubble'|translate}</label><br>
        <label><input type="radio" name="pinterest[layout]" value="vertical" {if $pinterest.layout=='vertical'}checked="checked"{/if}/> {'Top bubble'|translate}</label>
      </td>
    </tr>
  </tbody>
</table>
</div> {* <!-- pinterest --> *}

<br>

<div class="socialbutt {if not $tumblr.enabled}disabled{else}enabled{/if}"> {* <!-- tumblr --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $tumblr.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/tumblr_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="tumblr[enabled]" {if $tumblr.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property">
      <td>
        {'Button type'|translate}
      </td>
      <td></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://platform.tumblr.com/v1/share_1.png"/>
        <input type="radio" name="tumblr[type]" value="share_1" {if $tumblr.type=='share_1'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="tumblr[type]" value="share_1T" {if $tumblr.type=='share_1T'}checked="checked"{/if}/>
        <img src="https://platform.tumblr.com/v1/share_1T.png"/>
      </label></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://platform.tumblr.com/v1/share_2.png"/>
        <input type="radio" name="tumblr[type]" value="share_2" {if $tumblr.type=='share_2'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="tumblr[type]" value="share_2T" {if $tumblr.type=='share_2T'}checked="checked"{/if}/>
        <img src="https://platform.tumblr.com/v1/share_2T.png"/>
      </label></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://platform.tumblr.com/v1/share_3.png"/>
        <input type="radio" name="tumblr[type]" value="share_3" {if $tumblr.type=='share_3'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="tumblr[type]" value="share_3T" {if $tumblr.type=='share_3T'}checked="checked"{/if}/>
        <img src="https://platform.tumblr.com/v1/share_3T.png"/>
      </label></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://platform.tumblr.com/v1/share_4.png"/>
        <input type="radio" name="tumblr[type]" value="share_4" {if $tumblr.type=='share_4'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="tumblr[type]" value="share_4T" {if $tumblr.type=='share_4T'}checked="checked"{/if}/>
        <img src="https://platform.tumblr.com/v1/share_4T.png"/>
      </label></td>
    </tr>
  </tbody>
</table>
</div> {* <!-- tumblr --> *}

<div class="socialbutt {if not $reddit.enabled}disabled{else}enabled{/if}"> {* <!-- reddit --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $reddit.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/reddit_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="reddit[enabled]" {if $reddit.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property">
      <td>
        {'Button type'|translate}
      </td>
      <td></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://reddit.com/static/spreddit7.gif"/>
        <input type="radio" name="reddit[type]" value="spreddit7" {if $reddit.type=='spreddit7'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="reddit[type]" value="spreddit6" {if $reddit.type=='spreddit6'}checked="checked"{/if}/>
        <img src="https://reddit.com/static/spreddit6.gif"/>
      </label></td>
    </tr>
    <tr class="button">
      <td><label>
        <img src="https://reddit.com/static/spreddit1.gif"/>
        <input type="radio" name="reddit[type]" value="spreddit1" {if $reddit.type=='spreddit1'}checked="checked"{/if}/>
      </label></td>
      <td><label>
        <input type="radio" name="reddit[type]" value="interactive" {if $reddit.type=='interactive'}checked="checked"{/if}/>
        <img src="{$SOCIALBUTT_PATH}template/images/reddit_interactive.png"/>
      </label></td>
    </tr>
    <tr class="property">
      <td>
        <label for="reddit_community">{'Community'|translate}</label>
      </td>
      <td>
        <input type="text" id="reddit_community" name="reddit[community]" value="{$reddit.community}"/>
      </td>
    </tr>
  </tbody>
</table>
</div> {* <!-- reddit --> *}

<div class="socialbutt {if not $linkedin.enabled}disabled{else}enabled{/if}"> {* <!-- linkedin --> *}
<table>
  <thead>
    <tr><td colspan="2">
      <label title="{if $linkedin.enabled}{'Disable'|translate}{else}{'Enable'|translate}{/if}">
        <img src="{$SOCIALBUTT_PATH}template/images/linkedin_logo.png"/>
        <input class="enable" style="display:none;" type="checkbox" name="linkedin[enabled]" {if $linkedin.enabled}checked="checked"{/if}/>
      </label>
    </td></tr>
  </thead>
  <tbody>
    <tr class="property not-light">
      <td>
        {'Annotation'|translate}
      </td>
      <td>
        <label><input type="radio" name="linkedin[counter]" value="none" {if $linkedin.counter=='none'}checked="checked"{/if}/> {'None'|translate}</label><br>
        <label><input type="radio" name="linkedin[counter]" value="right" {if $linkedin.counter=='right'}checked="checked"{/if}/> {'Right bubble'|translate}</label><br>
        <label><input type="radio" name="linkedin[counter]" value="top" {if $linkedin.counter=='top'}checked="checked"{/if}/> {'Top bubble'|translate}</label>
      </td>
    </tr>
  </tbody>
</table>
</div> {* <!-- linkedin --> *}

<br>

<div class="submit">
  <input type="submit" value="{'Save Settings'|translate}" name="submit"/>
</div>

</form>
