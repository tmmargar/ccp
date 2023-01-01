{extends file="base.tpl"}
{block name=title}{$title}{/block}
{block name=style}<link href="css/championship.css" rel="stylesheet">{$style}{/block}
{block name=script}{/block}
{block name=content}
 <form action="{$action}" method="post" id="{$formName}" name="{$formName}">
  {$content}
 </form>
{/block}