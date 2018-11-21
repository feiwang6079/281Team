<?php
//数据库服务器
define('DB_HOST', 'localhost');

//数据库用户名
define('DB_USER', 'root');

//数据库密码
define('DB_PWD', '');

//库名
define('DB_NAME', 'my_infrastructure');

//字符集
define('DB_CHARSET', 'utf8');

// 创建连接
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);

// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
