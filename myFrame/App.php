<?php
namespace myFrame;

/**
 * Class App
 * @package myframe
 * App 类负责应用的启动
 * 1-路由检测
 * 2-请求分发
 */
class App
{
    protected $pathInfo;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->pathInfo = (new Request())->pathInfo();
    }
    public function run()
    {
        $classAndMethod = $this->routerCheck($this->pathInfo);
        $this->dispatch($classAndMethod);
    }
    /**
     * @param $checkStr
     * @return array
     * 对$pathInfo进行检测
     */
    public function routerCheck($checkStr)
    {
        $controller = dirname($checkStr);
        $action = basename($checkStr);
        $arr = explode('/', ucwords($controller, '/'));
        $controller = implode("\\", $arr)."Controller";
        $arr[] = $action;
        foreach ($arr as $value) {
            // \var_dump($value);
            // echo  "<br>";
            if (!preg_match('/^[A-Za-z]\w{0,20}$/', $value)) {
                exit("请求包含特殊字符！");
            }
        }
        return ["controller"=>$controller,"action"=>$action];
    }

    /**
     * @param array $pathInfo
     * 请求分发
     */
    public function dispatch(array $pathInfo)
    {
        // 调用controller方法实例化控制器对象
        $instance = $this->controller($pathInfo['controller']);
        // 调用控制器方法
        $action = $pathInfo['action'];
        $instance->$action();
    }

    /**
     * @param $controllerName
     * @return mixed
     * 实例化控制器对象
     */
    public function controller($controllerName)
    {
        $controller = '\\App\\Http\\Controllers\\'.$controllerName;
        if (\class_exists($controller)) {
            return new $controller;
        } else {
            exit("请求的控制器：".$controller."有误！");
        }
    }
}
