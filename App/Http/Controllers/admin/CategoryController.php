<?php
namespace App\Http\Controllers\admin;

use App\Category;

class CategoryController extends CommonController {

    public function index(Category $category){
        $data = $category->orderBy('sort','ASC')->get();
        $this->assign('category', $data);
        return $this->fetch('admin/categoryList');
    }

    public function save(Category $category){
        // 若id存在则是修改，id不存在就是添加
        // echo "<pre>"; print_r($_POST);
        $id = $this->request->post('id');
        $data = [
            'name'=>$this->request->post('name'),
            'sort'=>$this->request->post('sort')
        ];
        if ($id){
            $category->where('id',$id)->update($data);
            $this->success('修改成功！');
        }else{
            $category->insert($data);
            $this->success('添加成功！');
        }
    }

    public function delete(Category $category){
        $id = $this->request->get('id');
        if ($category->where('id',$id)->delete())
            $this->success('删除成功！');
        else
            $this->error('删除失败！');
    }
}
