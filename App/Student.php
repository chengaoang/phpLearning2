<?php
namespace App;
use myFrame\Model;
class student extends Model{
    public function getTable(){
        return $this->table;
    }
}