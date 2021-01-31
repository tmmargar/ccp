{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}<script src="scripts/signup.js" type="text/javascript"></script>{/block}
{block name=navigation}{/block}
{block name=content}
 <h1>{$title}</h1>
 <div class="hide" id="infoPersist">
  <span class="hide" id="errorsPersist"></span>
  <br />
 </div>
 <div class="hide" id="info">
  <span class="hide" id="errors"></span>
  <br />
  <span class="hide" id="messages"></span>
 </div>
 <form action="{$action}" method="POST" id="{$formName}" name="{$formName}">{$content}</form>
{/block}
{block name=footer}{/block}