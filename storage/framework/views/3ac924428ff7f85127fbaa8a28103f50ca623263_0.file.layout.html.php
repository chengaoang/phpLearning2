<?php
/* Smarty version 3.1.39, created on 2021-05-22 17:09:42
  from 'C:\My_php\phpLearning2\resources\views\admin\layout.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60a8ca564f14d9_31177495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ac924428ff7f85127fbaa8a28103f50ca623263' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\admin\\layout.html',
      1 => 1621674581,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60a8ca564f14d9_31177495 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/static/common/bootstrap@5.0.1/bootstrap.min.css" rel="stylesheet">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <?php echo '<script'; ?>
 src="/static/common/bootstrap@5.0.1/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>

    <style>
        html { height: 100%; }
        body { height: 100%; margin: 0%;}
        .container{
            height: 100%;
            display: flex;
            justify-content: center; /* 弹性项目沿主轴如何排布 */
            align-items: center; /* 弹性项目沿侧轴默认如何排布 */
        }
    </style>
    <title>登出</title>
</head>
<body>

<div class="container">
    <a class="btn btn-primary btn-lg" href="/admin/login/loginOut">logout</a>
</div>

</body>
</html><?php }
}
