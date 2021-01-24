<?php
/* Smarty version 3.1.36, created on 2020-12-14 23:57:28
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\reports.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd8423839f621_83923040',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62b0405dba131aae830abfadfc8d836c156bbcc3' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\reports.tpl',
      1 => 1588547213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd8423839f621_83923040 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18509495175fd8423838bda4_59273218', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19576512455fd84238393aa9_35695673', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15330670915fd84238397921_72518696', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12684644125fd8423839b7a0_20541943', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_18509495175fd8423838bda4_59273218 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18509495175fd8423838bda4_59273218',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_19576512455fd84238393aa9_35695673 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_19576512455fd84238393aa9_35695673',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_15330670915fd84238397921_72518696 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_15330670915fd84238397921_72518696',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/reports.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'content'} */
class Block_12684644125fd8423839b7a0_20541943 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_12684644125fd8423839b7a0_20541943',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 <form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" id="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
">
  <fieldset>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

  </fieldset>
 </form>
<?php
}
}
/* {/block 'content'} */
}
