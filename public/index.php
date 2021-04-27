<?php
namespace phpLearning2;

use myFrame\App;

require "../vendor/autoload.php";


// (new App())->run();
App::getInstance()->run()->send();
