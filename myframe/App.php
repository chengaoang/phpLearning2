<?php
namespace myframe;

/**
 * App 类负责应用的启动
 * 1-路由检测
 * 2-请求分发
 */
class App
{
    protected $pathinfo;

    public function __construct()
    {
        $this->pathinfo = (new Request())->pathinfo();
    }
    public function run()
    {
        $classAndMethod = $this->routerCheck($this->pathinfo);
        $this->dispatch($classAndMethod);
    }
    public function routerCheck($pathinfo)
    {
        // 对$pathinfo进行检测
        $controller = "test";
        $action = "index";
        return [$controller,$action];
    }
    public function dispatch(array $pathinfo)
    {
        // 调用controller方法实例化控制器对象
        $instance = $this->controller($pathinfo['controller']);
        // 调用控制器方法
        $instance->$pathinfo['action']();
    }

    public function controller($controllerName)
    {
        // 实例化控制器对象
        $controller = '\\App\\Http\\Controllers\\'.$controllerName;
        if (\class_exists($controller)) {
            return new $controller;
        } else {
            exit("请求的控制器：".$controller."有误！");
        }
    }
}
