{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}<script src="scripts/manageSignupApproval.js" type="text/javascript"></script>{/block}
{block name=content}
 <h1>{$heading}</h1>
 <div id="infoPersist" style="display:none">
  <span id="errorsPersist" style="display: none"></span>
  <br />
 </div>
 <div id="info" style="display:none">
  <span id="errors" style="display: none"></span>
  <br />
  <span id="messages" style="display: none"></span>
 </div>
 <form action="{$action}" method="POST" id="{$formName}" name="{$formName}">
  {$content}
 </form>
{/block}