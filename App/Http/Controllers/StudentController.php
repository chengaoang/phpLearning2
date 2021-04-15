<?php
namespace App\Http\Controllers;

use App\StudentModel;
use myFrame\Request;

class StudentController
{
    protected $model;
    protected $request;
    public function __construct(StudentModel $model, Request $request)
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
            exit('参数传递有误');
        }
        $data = $this->model->getOne($id);
        require "../resources/views/studentEdit.php";
    }
    public function save()
    {
        $id = $this->request->post('id');
        if (!$id) {
            exit('参数传递有误');
        }
        $data['name'] = $this->request->post('name');
        $data['gender'] = $this->request->post('gender');
        $data['email'] = $this->request->post('email');
        $data['mobile'] = $this->request->post('mobile');
        $res = $this->model->update($id, $data);
        if ($res) {
            echo '编辑成功,三秒跳回主页';
        } else {
            echo '编辑失败,三秒跳回主页';
        }
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=/student/index\">";
    }
}
