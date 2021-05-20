<?php
namespace App\Http\Controllers\admin;

use myFrame\Controller;

/**
 * 为了方便判断用户的登录状态，将判断的代码写在控制器的构造方法中，在控制器被实例化的时候自动判断。
 * 判断状态的代码不适合放在myFrame/Controller.php&LoginController.php中，故产生了CommonController.php。
 *
 * 由于子类如果定义了构造方法，其实例化时不会执行父类的构造，虽然可以使用parent::__construct()，但很麻烦。
 * 故诞生了controller类的空initalize()方法，并在controller类的构造中调用，
 * initalize由子类具体实现，在控制器初始化的时候执行。
 */
class CommonController extends Controller
{
    public function initalize()
    {
        // TODO：判断登录状态
    }
}
