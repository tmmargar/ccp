<?php
/* Smarty version 3.1.36, created on 2020-04-26 16:38:58
  from 'C:\Program Files\Ampps\www\ccp\new\classes\common\smarty\templates\championship.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ea5f162dee688_60736429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72647ba1e15f9cea9c25bb99a0f789383c0d9a76' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\new\\classes\\common\\smarty\\templates\\championship.tpl',
      1 => 1587859538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ea5f162dee688_60736429 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
  @import url("css/jquery.datetimepicker.css");
  @import url("css/menu.css");
  @import url("css/datatables.css");
  @import url("css/display.css");
 </style>
 <?php echo $_smarty_tpl->tpl_vars['style']->value;?>

 <?php echo '<script'; ?>
 src="scripts/jquery/jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery-ui.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/datatables.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery.datetimepicker.full.min.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/jquery/jquery-migrate-3.0.0.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/scripts.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo $_smarty_tpl->tpl_vars['script']->value;?>

</head>
<body>
 <?php echo $_smarty_tpl->tpl_vars['navigation']->value;?>

 <form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" id="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['formName']->value;?>
">
  <fieldset>
  <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

  </fieldset>
 </form>
</body>
</html><?php }
}
