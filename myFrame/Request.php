<?php

namespace myFrame;

class Request
{
    protected $pathInfo;

    // 为了在CommonController中判断当前访问的方法是否需要检查登录，需要在请求分发的时候，将方法名记录下来。
    protected string $action;
    public function getAction(): string
    {
        return $this->action ?: '';
    }
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     * 返回一个对路径信息进行过滤后的字符串
     * eg： uri = /controller/action
     *      pathinfo() : controller/action
     */
    public function pathInfo()
    {
        // maybe use is_null function to replay '==null'.
        if ($this->pathInfo === null) {
            $this->pathInfo = $this->server('PATH_INFO') != null
            ? $this->server('PATH_INFO')
            : $this->server('REDIRECT_PATH_INFO');
        }
        return \ltrim($this->pathInfo, '/');
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function server($name)
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
    }

    public function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : '';
    }

    public function post($key){
        return isset($_POST[$key]) ? $_POST[$key] : '';
    }

    public function isAjaxFetch(){
        return $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }
}
