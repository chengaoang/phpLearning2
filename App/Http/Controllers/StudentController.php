<?php
namespace App\Http\Controllers;

class StudentController
{
    const VIEW_PATH='../resources/views/';
    public function index(StudentModeln $model)
    {
        $model = new StudentModel();
        $data = $model->getAll();
        require VIEW_PATH.'student.php';
    }
    public function update()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if (!$id) {
            exit('参数传递有误');
        }
        $model = new StudentModel();
        $data = $model->getOne($id);
        require VIEW_PATH.'studentEdit.php';
    }
    public function save()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if (!$id) {
            exit('参数传递有误');
        }
        $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $data['gender'] = isset($_POST['gender']) ? $_POST['gender'] : '';
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['mobile'] = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $model = new StudentModel();
        $res = $model->update($id, $data);
        if ($res) {
            exit('编辑成功');
        } else {
            exit('编辑失败');
        }
    }
}
