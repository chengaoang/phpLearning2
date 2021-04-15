<?php

namespace myFrame;

class Request
{
    protected $pathInfo;

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
}
