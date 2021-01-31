{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}<script src="scripts/registration.js" type="text/javascript"></script>{/block}
{block name=content}
 <h1>{$heading}</h1>
 <form action="{$action}" method="post" id="{$formName}" name="{$formName}">
  <fieldset>{$content}</fieldset>
 </form>
{/block}