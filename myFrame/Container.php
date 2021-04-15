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
            // 反射实现构造方法的依赖注入
            $reflectObject = new \ReflectionClass($className); // 创建反射对象
            $constructor = $reflectObject->getConstructor(); // 获取反射对象的构造方法
            $args = $constructor ? $this->bindParamter($constructor) : []; // 获取构造方法依赖的对象
            $instance[$className] = $reflectObject->newInstanceArgs($args);
        }
        return $instance[$className];
    }
    public function bindParamter(\ReflectionMethod $reflectionMethod)
    {
        // 绑定参数
        $args = [];
        $parameters = $reflectionMethod->getParameters();
        foreach ($parameters as $foo) {
            $class = $foo->getClass();
            if ($class) {
                $args[] = $this->make($class->getName());
            }
        }
        return $args;
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
