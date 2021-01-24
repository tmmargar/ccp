{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}{$script}{/block}
{block name=content}
 <h1>{$heading}</h1>
 <div id="info" style="display:none">
  <span id="errors" style="display: none"></span>
  <br />
  <span id="messages" style="display: none"></span>
 </div>
 <span id="modeDisplay">Mode: {$mode}</span>
 <br />
 <form action="{$action}" method="post" id="{$formName}" name="{$formName}">
  <fieldset>
   <div id="resize_wrapper">
    {$content}
   </div>
  </fieldset>
 </form>
{/block}