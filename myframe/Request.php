<?php

namespace myframe;

class Request
{
    protected $pathinfo;

    /**
     * 返回一个对路径信息进行过滤后的字符串
     * eg： uri = /controller/action
     *      pathinfo() : controller/action
     */
    public function pahtinfo()
    {
        // maybe use is_null function to replay '==null'.
        if ($this->pahtinfo === null) {
            $pathinfo = $this->server('PATH_INFO') != null
            ? $this->server('PATH_INFO')
            : $this->server('REDIRECT_PATH_INFO');
        }
        return \ltrim($this->pahtinfo, '/');
    }

    public function server($name)
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : null;
    }
}
