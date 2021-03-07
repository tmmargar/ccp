{extends file="base.tpl"}
{block name=title}Chip Chair and a Prayer {$title}{/block}
{block name=style}{$style}{/block}
{block name=script}{$script}{/block}
{block name=content}
 <span id="modeDisplay">Mode: {$mode}</span>
 <br />
 <form action="{$action}" method="post" id="frmManage" name="frmManage">
  <fieldset>{$content}</fieldset>
 </form>
{/block}