<?php
/* Smarty version 3.1.39, created on 2021-05-29 21:04:44
  from 'C:\My_php\phpLearning2\resources\views\admin\layout.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b23beca70775_50953942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ac924428ff7f85127fbaa8a28103f50ca623263' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\admin\\layout.html',
      1 => 1622293386,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b23beca70775_50953942 (Smarty_Internal_Template $_smarty_tpl) {
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
    <?php echo '<script'; ?>
 src="/static/admin/js/main.js"><?php echo '</script'; ?>
>
    <style>
        body {
            height: 100%;
            min-height: 100vh;
            min-height: -webkit-fill-available;
        }
        html {
            height: -webkit-fill-available;
        }
        .alert{
            position: fixed;
            z-index: 1;
            top: 1px;
            right: 10px;
            margin-top: 10px;
            padding: 10px;
        }
    </style>
</head>
<body class="bg-dark">
<div class="d-flex flex-row" style="height: 100%">
    <!-- side bar 参考自：https://getbootstrap.com/docs/5.0/examples/sidebars/# -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="/admin/index/index" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">内容管理系统</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/admin/index/index" class="nav-link text-white" id="index" aria-current="page">
                    首页
                </a>
            </li>
            <li>
                <a href="/admin/category/index" class="nav-link text-white" id="category" aria-checked="true">
                    栏目管理
                </a>
            </li>
            <li>
                <a href="/admin/article/index" class="nav-link text-white" id="article">
                    文章管理
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <strong><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
                <li><a class="dropdown-item" href="/admin/login/loginOut">退出</a></li>
            </ul>
        </div>
    </div>
    <div id="main-content"></div>


</div>
</body>
<?php echo '<script'; ?>
>
    init();
    ajaxInnerHTML(); // 把给整个layout的a标签改成异步请求数据并innerHtml到#main-content
    active();
<?php echo '</script'; ?>
>
</html><?php }
}
