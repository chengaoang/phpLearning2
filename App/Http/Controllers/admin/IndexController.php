<?php
namespace App\Http\Controllers\admin;

class IndexController extends CommonController
{
    public function index(){
        return $this->fetch('admin/layout');
    }
}