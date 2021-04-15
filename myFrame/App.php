<?php
/*
 * @Author: your name
 * @Date: 2021-04-01 10:06:20
 * @LastEditTime: 2021-04-06 09:43:16
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \phpLearning2\myFrame\App.php
 */
namespace myFrame;

/**
 * Class App
 * @package myframe
 * App 类负责应用的启动
 * 1-路由检测
 * 2-请求分发
 */
class App extends Container
{
    protected $pathInfo;

    /**
     * App constructor.
     */
    public function __construct()
    {
        // $this->pathInfo = (new Request())->pathInfo();
        // $this->pathInfo = Container::getInstance()->make(Request::class)->pathInfo();
        $this->pathInfo = $this->make(Request::class)->pathInfo();
    }
    /**
     * 调用dispatch，其返回一个Response对象
     */
    public function run()
    {
        $classAndMethod = $this->routerCheck($this->pathInfo);
        $this->dispatch($classAndMethod)->send();
    }

    /**
     * @description 路由检测
     * @param $checkStr
     * @return array
     */
    public function routerCheck($checkStr)
    {
        $controller = dirname($checkStr);
        $action = basename($checkStr);
        $arr = explode('/', ucwords($controller, '/'));
        $controller = implode("\\", $arr)."Controller";
        $arr[] = $action;
        foreach ($arr as $value) {
            if (!preg_match('/^[A-Za-z]\w{0,20}$/', $value)) {
                exit("请求包含特殊字符！");
            }
        }
        return ["controller"=>$controller,"action"=>$action];
    }

    /**
     * @description: 请求分发
     * @param {array} $pathInfo
     * @return {Response}
     */
    public function dispatch(array $pathInfo)
    {
        // 调用controller方法实例化控制器对象
        $instance = $this->controller($pathInfo['controller']);
        if (is_callable([$instance, $pathInfo['action']])) {
            $reflect = new \ReflectionMethod($instance, $pathInfo['action']);
        } else {
            exit('操作不存在'. $pathInfo['action'] .'()');
        }
        // 调用控制器方法
        // $action = $pathInfo['action'];
        // $data = $instance->$action();
        $args = $this->bindParamter($reflect); // 创建反射方法依赖的对象，放在args数组中
        $data = $reflect->invokeArgs($instance, $args); // 调用action方法，传入args参数
        // return Response::create($data, ['Content-type' => 'application/json']);
        return Response::create($data);
    }

    /**
     * @description: 实例化控制器对象
     * @param $controllerName
     * @return mixed
     */
    public function controller($controllerName)
    {
        $controller = '\\App\\Http\\Controllers\\'.$controllerName;
        if (\class_exists($controller)) {
            // return new $controller;
            return $this->make($controller);
        } else {
            exit("请求的控制器：".$controller."有误！");
        }
    }
}
