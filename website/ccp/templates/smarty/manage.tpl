{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}{$script}{/block}
{block name=content}
 <h1>{$heading}</h1>
 <div class="hide" id="info">
  <span class="hide" id="errors"></span>
  <br />
  <span class="hide" id="messages"></span>
 </div>
 <span id="modeDisplay">Mode: {$mode}</span>
 <br />
 <form action="{$action}" method="post" id="{$formName}" name="{$formName}">
  <fieldset>{$content}</fieldset>
 </form>
{/block}