{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}<link href="css/login.css" rel="stylesheet">{$style}{/block}
{block name=script}<script src="scripts/login.js"></script>{/block}
{block name=navigation}{/block}
{block name=content}
 <form action="{$action}" method="POST" id="{$formName}" name="{$formName}">{$content}</form>
{/block}
{block name=footer}{/block}