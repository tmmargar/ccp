<?php
/* Smarty version 3.1.36, created on 2021-01-01 18:27:44
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\base.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fefaff04d56e2_98939528',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a476a44fdcbd59ee1170cd377f61c64e18714974' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\base.tpl',
      1 => 1609543662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fefaff04d56e2_98939528 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10839954805fefaff04bdfe8_28170513', 'title');
?>
</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
  @import url("css/jquery.datetimepicker.css");
  @import url("css/datatables.css");
  @import url("css/display.css");
  @import url("css/sm-core-css.css");
  @import url("css/sm-blue.css");
 </style>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1174635175fefaff04c1e69_90662393', 'style');
?>

 <?php echo '<script'; ?>
 src="scripts/jquery/jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery-ui.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery-migrate-3.0.0.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/datatables.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery.datetimepicker.full.min.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery.smartmenus.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/scripts.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20798391915fefaff04c5ce0_80123591', 'script');
?>

</head>
<body>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6301140825fefaff04c9b68_45557750', 'navigation');
?>

 <div id="content">
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5095170285fefaff04cd9e4_18808376', 'content');
?>

 </div>
 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17921170455fefaff04d1868_21635247', 'footer');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_10839954805fefaff04bdfe8_28170513 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_10839954805fefaff04bdfe8_28170513',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Default Title<?php
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_1174635175fefaff04c1e69_90662393 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_1174635175fefaff04c1e69_90662393',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_20798391915fefaff04c5ce0_80123591 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_20798391915fefaff04c5ce0_80123591',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'script'} */
/* {block 'navigation'} */
class Block_6301140825fefaff04c9b68_45557750 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'navigation' => 
  array (
    0 => 'Block_6301140825fefaff04c9b68_45557750',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['navigation']->value;
}
}
/* {/block 'navigation'} */
/* {block 'content'} */
class Block_5095170285fefaff04cd9e4_18808376 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_5095170285fefaff04cd9e4_18808376',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['content']->value;
}
}
/* {/block 'content'} */
/* {block 'footer'} */
class Block_17921170455fefaff04d1868_21635247 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_17921170455fefaff04d1868_21635247',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
<footer class="footer"><a href="changeLog.php">Change Log</a></footer><?php
}
}
/* {/block 'footer'} */
}
