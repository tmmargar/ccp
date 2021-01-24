<?php
/* Smarty version 3.1.36, created on 2020-12-15 12:01:13
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd8ebd93f16a2_81461560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1838f06b04f23e51873742a18f4b1091bc808646' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\home.tpl',
      1 => 1588535123,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd8ebd93f16a2_81461560 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8769284925fd8ebd93dde28_71476940', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16470618545fd8ebd93e5b26_95721716', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19541800605fd8ebd93e99a5_12659890', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2675458635fd8ebd93ed822_30961339', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_8769284925fd8ebd93dde28_71476940 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_8769284925fd8ebd93dde28_71476940',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_16470618545fd8ebd93e5b26_95721716 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_16470618545fd8ebd93e5b26_95721716',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_19541800605fd8ebd93e99a5_12659890 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_19541800605fd8ebd93e99a5_12659890',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/top5.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'content'} */
class Block_2675458635fd8ebd93ed822_30961339 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2675458635fd8ebd93ed822_30961339',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['content']->value;
}
}
/* {/block 'content'} */
}
