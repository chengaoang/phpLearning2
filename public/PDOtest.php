<?php
namespace pdo;

use PDO;

/*
PDO
    - query
    - exec
返回的结果集：PDOstatement [statement:声明]
    - fetch
    - fetchColumn
    - fetchAll
    - fetchObject （不常用）
    * fetch(PDO::FETCH_BOUND) + bindColumn
预编译sql语句：prepare [准备] (？占位符绑定参数时使用位序)
    - PDO::prepare ( string $statement , array $driver_options = array() ) : PDOStatement
    - PDOStatement::execute ( array $input_parameters = ? ) : bool
    - bindParam
    - bindValue
*/
echo "<pre>";

$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=myframe;charset=utf8",
    "root",
    "root"
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "select * from student";
$resultSet = $pdo->query($sql);
// 用fetch获取PDOstatementObject里的全部行。
while ($data = $statementObj->fetch(PDO::FETCH_ASSOC)) {
    \var_dump($data);
}
// or 把resultSet当数组用
foreach ($statementObj as $key => $value) {
    echo '-------第'.($key+1).'名选手--------<br>';
    echo ">".$value['id'].'<br>';
    echo ">".$value['name'].'<br>';
    echo ">".$value['gender'].'<br>';
    echo ">".$value['email'].'<br>';
    echo ">".$value['mobile'].'<br>';
}
