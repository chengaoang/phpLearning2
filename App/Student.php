<?php
namespace App;

use MySQLi;
use PDO;
use myFrame\DB;

class Student
{
    private $pdo;
    public function __construct(DB $db)
    {
        $this->pdo = $db;
    }
    public function getAll()
    {
        $sql = 'select * from `student`';
        return $this->pdo->fetchAll($sql);
    }
    public function getOne($id)
    {
        $sql = "select * from `student` where `id` = :id";
        return $this->pdo->fetch($sql, ['id'=>$id]);
    }
    public function update($data)
    {
        $args = ['name','gender','email','mobile','id'];
        $args2 = [];
        foreach ($args as $foo) {
            $args2[$foo] = $data[$foo] ? $data[$foo] : '';
        }
        $sql = "update `student` set 
               `name` = :name, `gender` = :gender, `email` = :email, `mobile` = :mobile where `id` = :id";
        $rowCount = $this->pdo->execute($sql, $args2);
        return $rowCount;
    }
}
