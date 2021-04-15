<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>学生列表</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>姓名</th>
      <th>性别</th>
      <th>操作</th>
    </tr>
    <?php foreach ($data as $item) { ?>
    <tr>
     <td><?php echo $item['id'] ?></td>
     <td><?=$item['name'] ?></td>
     <td><?=$item['gender'] ?></td>
     <td><a href="/student/update?id=<?=$item['id'] ?>">编辑</a></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>