<?php
/*
 * @Author: your name
 * @Date: 2021-04-06 08:46:54
 * @LastEditTime: 2021-04-06 09:49:06
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \phpLearning2\myFrame\Response.php
 */
namespace myFrame;

/**
 * 处理http响应
 */
class Response
{
    protected $data = '';
    protected $header = [];
    protected $code = 200;
    public function __construct($data, $header, $code)
    {
        $this->data=$data;
        $this->header=\array_merge($this->header, $header);
        $this->code=$code;
    }
    public function send()
    {
        \http_response_code($this->code);
        foreach ($this->header as $key => $value) {
            header($key.(isset($value) ? ":$value" : ''));
        }
        echo $this->data;
    }
    // static表示运行时最初调用的类（后期静态绑定）
    public static function create($data = '', $header = [], $code = 200)
    {
        return new static($data, $header, $code);
    }
}
