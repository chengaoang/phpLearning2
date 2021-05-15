<?php

namespace App\Http\Controllers;

use Parsedown;
use myFrame\Request;
use App\student;

class TestController
{
    // public function index()
    // {
    //     echo "<br>this is my first commit test!";
    // }
    // public function fuck()
    // {
    //     echo "<br>Hello world!";
    // }
    // public function parsedown()
    // {
    //     # ----------------codetest parsedown----------------
    //     $Parsedown = new Parsedown();
    //     echo $Parsedown->text('- Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>
    // }
    public $req;
    public function __construct(Request $req)
    {
        $this->req = $req;
    }
    public function responseTest()
    {
        return json_encode(['name'=>'Sven']);
    }
    public function reflectionConstruct()
    {
        // $req = new Request(); 依赖注入后就不用到处new了
        return json_encode(["Reflection method!"=>$this->req->get('id')]);
    }
    public function reflectionMethod(Request $req2)
    {
        return json_encode(["Reflection method!"=>$req2->get('id')]);
    }
    public function test()
    {
        return strtolower(basename(get_class($this)));
    }
    public function testgettable()
    {
        return (new student())->getTable();
    }
    public function modelGet()
    {
        // $data = (new student())->get();
        // $data = (new student())->first(['id','name']);
        $data = (new student())->value('name');
        echo "<pre>";
        return print_r($data);
    }
    public function modelWhere()
    {
        // $data = (new student())->first(['id','name']);
        // $data = (new student())->where('id', '>', 2)->orWhere('id', '=', 1)->get();
        $data = (new student())->where(['id'=> 1])->get();
        echo "<pre>";
        return print_r($data);
    }
    public function modelOrderByAndLimit()
    {
        // $data = (new student())->orderBy('id', 'DESC ')->limit(1, 2)->get();
        $data = (new student())->limit(1, 2)->orderBy('id', 'DESC ')->get();
        // TODO：咋先分页再排序/对limit的数据按id排序
        echo "<pre>";
        return print_r($data);
    }
    public function test1(){
        echo "<pre>";
        $a = 2;
        if (true)
            $a = 1;
        echo $a;
    }

    public function test2(){
        return (new student())->insert(['name'=>'Svne']);
    }
    public function testUpdate(){
        return (new student())->where('id',5)->update(['name'=>'foobar']);
    }
    public function testDelete(){
        return (new student())->where('id',5)->delete();
    }
}
