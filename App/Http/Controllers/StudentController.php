<?php
namespace App\Http\Controllers;

use App\Student;
use myFrame\Request;

class StudentController
{
    protected $model;
    protected $request;
    public function __construct(Student $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function index()
    {
        $data = $this->model->getAll();
        require "../resources/views/student.php"; // 此路径是相对与app的路径，因为dispatch在app里写的。
    }
    public function update()
    {
        $id = $this->request->get('id');
        if (!$id) {
            throw new \Exception(__CLASS__.'的'.__FUNCTION__.'参数传递有误');
        }
        $data = $this->model->getOne($id);
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
        $res = $this->model->update($id, $data);
        if ($res) {
            echo '更新成功,三秒跳回主页';
        } else {
            echo '更新失败,三秒跳回主页';
        }
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=/student/index\">";
    }
}
