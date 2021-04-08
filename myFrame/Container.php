<?php
namespace myFrame;

class Container
{
    /**
     * 采用单例模式返回对象实例
     */
    protected $instances = [];
    public function make($className)
    {
        // if ($instance[$className] == null) {
        if (!isset($instance[$className])) {
            $instance[$className] = new $className;
        }
        return $instance[$className];
    }
    /**
     * 采用单例模式返回一个后期静态绑定的当前类对象
     */
    protected static $instance;
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
