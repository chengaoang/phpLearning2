<?php
/* Smarty version 3.1.39, created on 2021-05-28 20:42:12
  from 'C:\My_php\phpLearning2\resources\views\admin\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b0e524586503_88853304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc21d2c5bf94d5af976f8feae2adfdc1718b5427' => 
    array (
      0 => 'C:\\My_php\\phpLearning2\\resources\\views\\admin\\login.html',
      1 => 1622205730,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0e524586503_88853304 (Smarty_Internal_Template $_smarty_tpl) {
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
 src="/static/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/static/admin/js/main.js"><?php echo '</script'; ?>
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
        .alert{
            position: fixed;
            z-index: 1;
            top: 1px;
            right: 10px;
            margin-top: 10px;
            padding: 10px;
        }
    </style>
    <title>登录</title>
</head>
<body class="bg-dark bg-gradient">
<div class="container">
    <form action="/admin/login/login" method="post" id="loginForm">
        <div class="card mb-2 bg-light" style="padding: 100px">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/static/images/demo1.jpg" alt="Demo image" style="width: 90%;height: 90%">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="captcha">
                                <img src="/admin/login/captcha" alt="captcha" title="click refresh captcha!">
                            </span>
                            <input type="text" class="form-control" name="Captcha" placeholder="Captcha" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
                        </label>
                    </div>

                    <div class="card-body" style="text-align:center">
                        <input class="btn btn-primary btn-lg" type="submit" onclick="login()" value="Login">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
<?php echo '<script'; ?>
>
$('.input-group-text img').click(
    function () {
        $(this).attr('src','/admin/login/captcha?_=' + Math.random());
    }
);
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
