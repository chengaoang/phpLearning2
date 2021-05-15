<?php
namespace App\Http\Controllers;

use App\student;
use myFrame\Request;

class StudentController
{
    protected $model;
    protected $request;
    public function __construct(student $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->model->get(['id','name','gender']);
        require "../resources/views/student.php"; // 此路径是相对与app的路径，因为dispatch在app里写的。
    }
    public function update()
    {
        $id = $this->request->get('id');
        if (!$id) {
            throw new \Exception(__CLASS__.'的'.__FUNCTION__.'参数传递有误');
        }
        // $data = $this->model->getOne($id);
        $data = $this->model->where('id',$id)->first();
        require "../resources/views/studentEdit.php";
    }
    public function save()
    {
        $id = $this->request->post('id');
        if (!$id) {
            throw new \Exception(__FUNCTION__.'的'.__FUNCTION__.'参数传递有误');
        }
        $data['name'] = $this->request->post('name');
        $data['gender'] = $this->request->post('gender');
        $data['email'] = $this->request->post('email');
        $data['mobile'] = $this->request->post('mobile');
        $data['id'] = $id;
        // $res = $this->model->update($data);
        $res = $this->model->where('id',$id)->update($data);
        if ($res !== true) {
            echo '更新成功,三秒跳回主页';
        } else {
            echo '更新失败,三秒跳回主页';
        }
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=/student/index\">";
    }
}
