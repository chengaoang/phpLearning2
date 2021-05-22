<?php

namespace App\Http\Controllers\admin;

use App\User;
use myFrame\Captcha;
use myFrame\HttpException;

/**
 * TODO: 管理后台登陆的控制器
 */
class LoginController extends CommonController
{
    // 保存不需要验证用户登录状态的方法
    protected $checkLoginExclude = ['index','login','captcha','logout'];

    /**
     * 显示登陆页面
     */
    public function index()
    {
        return $this->fetch("admin/login");
    }

    /**
     * 接受登录表单的数据
     * @param User $user
     * @throws HttpException
     */
    public function login(User $user)
    {
        $captcha = $this->request->post('Captcha');
        if (!$this->checkCaptcha($captcha))
            $this->error('验证码错误！');

        $userName = $this->request->post('username');
        $passWord = $this->request->post('password');
        $data = $user->where('username',$userName)->first();
        if (!$data)
            $this->error('用户不存在！');
        else if ($data['password'] == $this->passwordMD5($passWord, $data['salt']))
            $this->setLogin(['id'=>$data['id'], 'name'=>$data['username']]);
            $this->success('登录成功！');
    }

    /**
     * 密码加盐
     * @param string $password
     * @param string $salt
     * @return string
     */
    public function passwordMD5(string $password, string $salt): string
    {
        return md5(md5($password).$salt);
    }

    /**
     * 在登录成功之后在session里保存用户信息
     * @param array $user
     */
    public function setLogin(array $user = []){
        $_SESSION['cms']['admin'] = $user;
    }

    /**
     * 退出登录
     * @throws HttpException
     */
    public function loginOut()
    {
        $this->setLogin([]);
        $this->redirect('/admin/login/index');
    }

    /**
     * 显示验证码
     * @param Captcha $captcha
     * @throws HttpException
     */
    public function captcha(Captcha $captcha)
    {
        $code = $captcha->create();
        $_SESSION['cms']['captcha'] = $code;
        $captcha->show($code);
    }

    /**
     * 验证captcha
     * @param string $code
     * @return bool
     */
    public function checkCaptcha(string $code): bool
    {
        if (isset($_SESSION['cms']['captcha'])) {
            $captcha = $_SESSION['cms']['captcha'];
            unset($_SESSION['cms']['captcha']);
            return strtolower($code) == strtolower($captcha);
        }
        return false;
    }

}
