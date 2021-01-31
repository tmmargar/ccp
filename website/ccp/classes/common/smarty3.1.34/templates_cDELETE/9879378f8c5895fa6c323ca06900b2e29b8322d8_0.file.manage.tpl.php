<?php
/* Smarty version 3.1.36, created on 2020-04-25 22:48:06
  from 'C:\Program Files\Ampps\www\ccp\new\classes\common\smarty\templates\manage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ea4f666747482_72406989',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9879378f8c5895fa6c323ca06900b2e29b8322d8' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\new\\classes\\common\\smarty\\templates\\manage.tpl',
      1 => 1547433295,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ea4f666747482_72406989 (Smarty_Internal_Template $_smarty_tpl) {
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

 <div id="content">
  <p id="date-stamp"><?php echo $_smarty_tpl->tpl_vars['lastModified']->value;?>
</p>
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
 </div>
</body>
</html><?php }
}
