<?php
namespace myFrame;

use Smarty;

class Controller
{
    protected $app;
    protected $request;
    protected $smarty;
    public function __construct(App $app, Request $request, Smarty $smarty)
    {
        $this->app = $app;
        $this->request = $request;
        $this->smarty = $smarty;
        $templateDir = $this->app->getRootPath().'resources/views/';
        $compileDir = $this->app->getRootPath().'storage/framework/views/';
        $this->smarty->setTemplateDir($templateDir);
        $this->smarty->setCompileDir($compileDir);

        $this->initalize();
    }

    // 封装 assign 为模板中的变量赋值
    protected function assign($name, $value = '')
    {
        $this->smarty->assign($name, $value);
    }
    // 封装 fetch 渲染模板文件，返回渲染的 html 字符串
    protected function fetch($template = '')
    {
        return $this->smarty->fetch($template.'.html');
    }

    // 抛出HttpException，用于response一个JSON格式的提示信息
    public function success($msg = '')
    {
        // TODO
    }
    public function error($msg = '')
    {
        // TODO
    }

    protected function initalize()
    {
    }
}
