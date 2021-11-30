<?php
namespace App;

use MySQLi;

class _StudentModel
{
    private $link;
    public function __construct()
    {
        $this->link = new MySQLi('localhost', 'root', 'root', 'myframe');
        $this->link->set_charset('utf8mb4');
    }
    public function getAll()
    {
        $sql = 'select * from `student`';
        $res = $this->link->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function getOne($id)
    {
        $sql = "select * from `student` where `id` = $id";
        $res = $this->link->query($sql);
        $data = $res->fetch_assoc();
        return $data;
    }
    public function update($id, $data)
    {
        $name = $data['name'];
        $gender = $data['gender'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $sql = "update `student` set `name` = '$name', `gender` = '$gender', `email` = '$email', `mobile` = '$mobile' where `id` = $id";
        $res = $this->link->query($sql);
        if (!$res) {
            echo $sql;
            echo '</br>';
            exit($this->link->error);
        }
        return $res;
    }
}
