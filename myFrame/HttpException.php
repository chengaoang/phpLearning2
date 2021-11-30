<?php
namespace myFrame;

use Exception;

/**
 * http异常 用于返回一个response对象。
 * 在app类的run方法中捕获http异常，由public/index.php类调用http异常返回的response对象的send方法。
 * 采用异常而不采用exit、die是为了让框架保持完整的生命周期(启动->执行控制器的方法->响应结果),
 *     如果随意停止脚本，会对框架将来的功能扩充带来很多问题【这是书上的描述，会出啥问题我还没体会到】。
 */
class HttpException extends Exception
{
    protected $response;
    public function __construct(Response $res)
    {
        $this->response = $res;
    }
    public function getResponse()
    {
        return $this->response;
    }
}
