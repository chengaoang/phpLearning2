<?php
namespace App;

use MySQLi;
use PDO;

class Student
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=myframe;charset=utf8",
            "root",
            "root"
        );
        // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getAll()
    {
        $sql = 'select * from `student`';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // return $res->fetch_all(MYSQLI_ASSOC);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne($id)
    {
        $sql = "select * from `student` where `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        // $data = $res->fetch_assoc();
        // return $data;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $data)
    {
        $name = $data['name'];
        $gender = $data['gender'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $sql = "update `student` set `name` = :name, `gender` = :gender, `email` = :email, `mobile` = :mobile where `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt === false) {
            // Do something
        }
        return $stmt;
    }
}
