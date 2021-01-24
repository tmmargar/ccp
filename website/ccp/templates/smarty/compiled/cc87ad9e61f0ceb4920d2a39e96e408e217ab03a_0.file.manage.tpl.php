<?php
/* Smarty version 3.1.36, created on 2020-12-15 16:26:05
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\manage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd929ed1518a2_14706768',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc87ad9e61f0ceb4920d2a39e96e408e217ab03a' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\manage.tpl',
      1 => 1588640277,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd929ed1518a2_14706768 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16379984205fd929ed13a1a9_71185744', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15017940405fd929ed145d28_13478946', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18536314335fd929ed149ba3_93743292', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16548876415fd929ed14da27_96143170', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_16379984205fd929ed13a1a9_71185744 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_16379984205fd929ed13a1a9_71185744',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_15017940405fd929ed145d28_13478946 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_15017940405fd929ed145d28_13478946',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_18536314335fd929ed149ba3_93743292 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_18536314335fd929ed149ba3_93743292',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['script']->value;
}
}
/* {/block 'script'} */
/* {block 'content'} */
class Block_16548876415fd929ed14da27_96143170 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_16548876415fd929ed14da27_96143170',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

 <h1><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
</h1>
 <div id="info" style="display:none">
  <span id="errors" style="display: none"></span>
  <br />
  <span id="messages" style="display: none"></span>
 </div>
 <span id="modeDisplay">Mode: <?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
</span>
 <br />
 <form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" id="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
">
  <fieldset>
   <div id="resize_wrapper">
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

   </div>
  </fieldset>
 </form>
<?php
}
}
/* {/block 'content'} */
}
