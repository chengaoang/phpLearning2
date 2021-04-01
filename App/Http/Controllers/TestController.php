<?php

namespace App\Http\Controllers;

use Parsedown;

class TestController
{
    public function index()
    {
        echo "<br>this is my first commit test!";
    }
    public function fuck()
    {
        echo "<br>Hello world!";
    }
    public function parsedown()
    {
        # ----------------codetest parsedown----------------
        $Parsedown = new Parsedown();
        echo $Parsedown->text('- Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>
    }
}
