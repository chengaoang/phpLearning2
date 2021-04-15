<?php

namespace App\Http\Controllers;

use Parsedown;
use myFrame\Request;

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
}
