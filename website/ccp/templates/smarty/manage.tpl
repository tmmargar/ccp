{extends file="base.tpl"}
{block name=title}Chip Chair and a Prayer {$title}{/block}
{block name=style}{$style}{/block}
{block name=script}{$script}{/block}
{block name=content}
 <form action="{$action}" method="post" id="frmManage" name="frmManage">
  {$content}
 </form>
{/block}