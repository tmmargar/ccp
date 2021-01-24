<?php
/* Smarty version 3.1.36, created on 2020-12-21 21:09:45
  from 'C:\Program Files\Ampps\www\ccp\templates\smarty\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe15569dccd24_80562275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4de1185631bc8472d4f324b3d333e077f3fefa18' => 
    array (
      0 => 'C:\\Program Files\\Ampps\\www\\ccp\\templates\\smarty\\login.tpl',
      1 => 1588727980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe15569dccd24_80562275 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11548461645fe15569da9aa8_28937462', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4910970605fe15569db94a4_53758929', 'style');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2733168555fe15569dbd321_50914975', 'script');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7536430905fe15569dc11a0_24046508', 'navigation');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_840106915fe15569dc5026_89880690', 'content');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17908007775fe15569dc8ea6_15723182', 'footer');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "base.tpl");
}
/* {block 'title'} */
class Block_11548461645fe15569da9aa8_28937462 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_11548461645fe15569da9aa8_28937462',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['title']->value;
}
}
/* {/block 'title'} */
/* {block 'style'} */
class Block_4910970605fe15569db94a4_53758929 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'style' => 
  array (
    0 => 'Block_4910970605fe15569db94a4_53758929',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['style']->value;
}
}
/* {/block 'style'} */
/* {block 'script'} */
class Block_2733168555fe15569dbd321_50914975 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_2733168555fe15569dbd321_50914975',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="scripts/login.js" type="text/javascript"><?php echo '</script'; ?>
><?php
}
}
/* {/block 'script'} */
/* {block 'navigation'} */
class Block_7536430905fe15569dc11a0_24046508 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'navigation' => 
  array (
    0 => 'Block_7536430905fe15569dc11a0_24046508',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'navigation'} */
/* {block 'content'} */
class Block_840106915fe15569dc5026_89880690 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_840106915fe15569dc5026_89880690',
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
class Block_17908007775fe15569dc8ea6_15723182 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_17908007775fe15569dc8ea6_15723182',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'footer'} */
}
