<?php
/* Smarty version 3.1.36, created on 2020-12-29 21:53:08
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\signup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5febeb940dfc45_73235799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f964bd477878e0487552eba998c96ed734181ef6' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\signup.tpl',
      1 => 1590274954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5febeb940dfc45_73235799 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18433650075febeb940c0843_70295362', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20414724395febeb940cc3c1_45236897', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18002113985febeb940d0240_02874116', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18175671355febeb940d40c5_47265354', 'navigation');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19239862225febeb940d7f41_06839871', 'content');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19018948665febeb940dbdc3_92321269', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_18433650075febeb940c0843_70295362 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18433650075febeb940c0843_70295362',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_20414724395febeb940cc3c1_45236897 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_20414724395febeb940cc3c1_45236897',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_18002113985febeb940d0240_02874116 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_18002113985febeb940d0240_02874116',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/signup.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'navigation'} */
class Block_18175671355febeb940d40c5_47265354 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'navigation' => 
  array (
    0 => 'Block_18175671355febeb940d40c5_47265354',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'navigation'} */
/* {block 'content'} */
class Block_19239862225febeb940d7f41_06839871 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_19239862225febeb940d7f41_06839871',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
 <div id="infoPersist" style="display:none">
  <span id="errorsPersist" style="display: none"></span>
  <br />
 </div>
 <div id="info" style="display:none">
  <span id="errors" style="display: none"></span>
  <br />
  <span id="messages" style="display: none"></span>
 </div>
 <form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="POST" id="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
">
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

 </form>
<?php
}
}
/* {/block 'content'} */
/* {block 'footer'} */
class Block_19018948665febeb940dbdc3_92321269 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_19018948665febeb940dbdc3_92321269',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'footer'} */
}
