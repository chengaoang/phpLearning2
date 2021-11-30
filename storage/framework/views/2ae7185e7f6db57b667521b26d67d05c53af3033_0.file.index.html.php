<?php
/* Smarty version 3.1.39, created on 2021-05-29 19:23:38
  from 'C:\My_php\phpLearning2\resources\views\admin\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b2243a142911_27663132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ae7185e7f6db57b667521b26d67d05c53af3033' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\admin\\index.html',
      1 => 1622287417,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b2243a142911_27663132 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="list-group list-group-flush" style="margin-top: 30px;">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['serverInfo']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
        <li class="list-group-item fw-bold bg-dark text-white "><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 : <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</li> <br>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
