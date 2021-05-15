<?php
/* Smarty version 3.1.39, created on 2021-05-15 14:02:54
  from 'C:\My_php\phpLearning2\resources\views\student.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_609f640ee50686_71892178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0973aa648bc38c09352e4d52c19738f2adb26003' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\student.html',
      1 => 1621058567,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_609f640ee50686_71892178 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>学生列表</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>姓名</th>
      <th>性别</th>
      <th>操作</th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['student']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
    <tr>
     <td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
     <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
     <td><?php echo $_smarty_tpl->tpl_vars['v']->value['gender'];?>
</td>
     <td><a href="/student/update?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">编辑</a></td>
    </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </table>
</body>
</html>
<?php }
}
