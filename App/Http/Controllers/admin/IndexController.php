<?php
namespace App\Http\Controllers\admin;

use myFrame\DB;

class IndexController extends CommonController
{
    public function index()
    {
        $this->assign('serverInfo', [
            '服务器版本'=>$this->request->server('SERVER_SOFTWARE'),
            '数据库版本'=>$this->getMysqlServer(),
            '文件上传限制'=>ini_get('file_uploads')?ini_get('upload_max_filesize'):'已禁用',
            '脚本执行时限'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date('Y-m-d H:i:s',time())
        ]);

        return $this->fetch('admin/index');
    }

    protected function getMysqlServer(){
        $db = DB::getInstance();
        $dbVersion = $db->fetch('select version()');
        return $dbVersion['version()'];
    }
}