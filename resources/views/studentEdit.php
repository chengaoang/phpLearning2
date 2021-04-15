<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>编辑学生信息</h2>
  <form action="/student/save" method="post">
    <div>
      <label for="name">姓名：</label>
      <input type="text" name="name" id="name" value="<?=$data['name'] ?>" />
    </div>
    <div>
      <label for="gender">性别：</label>
      <input type="text" name="gender" id="gender" value="<?=$data['gender'] ?>" />
    </div>
    <div>
      <label for="email">邮箱：</label>
      <input type="text" name="email" id="email" value="<?=$data['email'] ?>" />
    </div>
    <div>
      <label for="mobile">电话号码：</label>
      <input type="text" name="mobile" id="mobile" value="<?=$data['mobile'] ?>" />
    </div>
    <div>
      <input type="hidden" name="id" value="<?=$id ?>">
    </div>
    <div>
      <input type="submit" value="提交" />
    </div>
  </form>
</body>
</html>