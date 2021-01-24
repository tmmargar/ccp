<?php
/* Smarty version 3.1.36, created on 2021-01-14 19:47:15
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\resetPassword.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_6000e6137aaec3_37163831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57c98238f5c4c643fe0aee795edfc6e15b675d1d' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\resetPassword.tpl',
      1 => 1610671629,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6000e6137aaec3_37163831 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14102967836000e61378bac1_40189558', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20753613066000e613797643_62110529', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17449109556000e61379b4c6_49710552', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7294552066000e61379f342_00763851', 'navigation');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15053061046000e6137a31c0_66324719', 'content');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4766382186000e6137a7040_04383786', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_14102967836000e61378bac1_40189558 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_14102967836000e61378bac1_40189558',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_20753613066000e613797643_62110529 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_20753613066000e613797643_62110529',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_17449109556000e61379b4c6_49710552 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_17449109556000e61379b4c6_49710552',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/resetPassword.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'navigation'} */
class Block_7294552066000e61379f342_00763851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'navigation' => 
  array (
    0 => 'Block_7294552066000e61379f342_00763851',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['navigation']->value;
}
}
/* {/block 'navigation'} */
/* {block 'content'} */
class Block_15053061046000e6137a31c0_66324719 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_15053061046000e6137a31c0_66324719',
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
class Block_4766382186000e6137a7040_04383786 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_4766382186000e6137a7040_04383786',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'footer'} */
}
