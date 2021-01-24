<?php
/* Smarty version 3.1.36, created on 2020-04-26 19:45:53
  from 'C:\Program Files\Ampps\www\ccp\new\classes\common\smarty\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ea5e4f1b56587_91956100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0e1b4649f8be807a3449a0ef331251c4e1a9c99' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\new\\classes\\common\\smarty\\templates\\login.tpl',
      1 => 1587930320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ea5e4f1b56587_91956100 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
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
 src="scripts/jquery/jquery-migrate-3.0.0.js"><?php echo '</script'; ?>
>
 <?php echo '<script'; ?>
 src="scripts/scripts.js" type="text/javascript"><?php echo '</script'; ?>
>
 <?php echo $_smarty_tpl->tpl_vars['script']->value;?>

</head>
<body>
 <?php echo $_smarty_tpl->tpl_vars['navigation']->value;?>

 <div id="content">
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
 </div>
</body>
</html><?php }
}
