<?php
/* Smarty version 3.1.39, created on 2021-05-20 10:42:18
  from 'D:\phpLearning2\resources\views\studentEdit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a5cc8a4b0f53_79749171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28114c718578b9a892057afbfec463607f337bb9' => 
    array (
      0 => 'D:\\phpLearning2\\resources\\views\\studentEdit.html',
      1 => 1621476312,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a5cc8a4b0f53_79749171 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>编辑学生信息</h2>
  <form action="/student/save" method="post">
    <div>
      <label for="name">姓名：</label>
      <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['student']->value['name'];?>
" />
    </div>
    <div>
      <label for="gender">性别：</label>
      <input type="text" name="gender" id="gender" value="<?php echo $_smarty_tpl->tpl_vars['student']->value['gender'];?>
" />
    </div>
    <div>
      <label for="email">邮箱：</label>
      <input type="text" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['student']->value['email'];?>
" />
    </div>
    <div>
      <label for="mobile">电话号码：</label>
      <input type="text" name="mobile" id="mobile" value="<?php echo $_smarty_tpl->tpl_vars['student']->value['mobile'];?>
" />
    </div>
    <div>
      <input type="hidden" name="id" value=<?php echo $_smarty_tpl->tpl_vars['student']->value['id'];?>
>
    </div>
    <div>
      <input type="submit" value="提交" />
    </div>
  </form>
</body>
</html><?php }
}
