{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}{$style}{/block}
{block name=script}<script src="scripts/manageSignupApproval.js" type="text/javascript"></script>{/block}
{block name=content}
 <form action="{$action}" method="POST" id="{$formName}" name="{$formName}">{$content}</form>
{/block}