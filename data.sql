# 创建数据库
CREATE DATABASE `myframe`;
USE `myframe`;

# 创建学生表
CREATE TABLE `cms_student` (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '学生id',
  `name` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `gender` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '性别',
  `email` VARCHAR(128) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '手机号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

# 添加测试数据
INSERT INTO `cms_student` VALUES
(1, 'Allen', '男', 'allen@myframe.test', '12300004567'),
(2, 'James', '男', 'james@myframe.test', '12311114567'),
(3, 'Rose', '女', 'rose@myframe.test', '12322224567'),
(4, 'Mary', '女', 'mary@myframe.test', '12333334567');


# 管理员表
CREATE TABLE `cms_user`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(32) DEFAULT '' NOT NULL UNIQUE COMMENT '用户名',
  `password` CHAR(32) DEFAULT '' NOT NULL COMMENT '密码',
  `salt` CHAR(32) DEFAULT '' NOT NULL COMMENT '密码salt'
) DEFAULT CHARSET=utf8mb4;

# 添加管理员记录
INSERT INTO `cms_user` VALUES
(1, 'admin', MD5(CONCAT(MD5('123456'), 'salt')), 'salt');
