<?php
/* Smarty version 3.1.36, created on 2020-12-29 22:02:25
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\manageSignupApproval.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5febedc16c3942_26810510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bb9ea4f240f64e12d8248ecb397638926922d29' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\manageSignupApproval.tpl',
      1 => 1590118751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5febedc16c3942_26810510 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17888778135febedc16b00c2_20397129', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12669905435febedc16b7dc5_50115425', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3739642025febedc16bbc40_33729573', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11483386655febedc16bfac5_57215023', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_17888778135febedc16b00c2_20397129 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_17888778135febedc16b00c2_20397129',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_12669905435febedc16b7dc5_50115425 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_12669905435febedc16b7dc5_50115425',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_3739642025febedc16bbc40_33729573 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_3739642025febedc16bbc40_33729573',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/manageSignupApproval.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'content'} */
class Block_11483386655febedc16bfac5_57215023 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_11483386655febedc16bfac5_57215023',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 <h1><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
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
}
