<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>恭喜，站点创建成功！</title>
  <style>
    .container {
      width: 60%;
      margin: 10% auto 0;
      background-color: #f0f0f0;
      padding: 2% 5%;
      border-radius: 10px
    }

    ul {
      padding-left: 20px;
    }

    ul li {
      line-height: 2.3
    }

    a {
      color: #20a53a
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>恭喜, 站点创建成功！</h1>
    <h3>这是默认index.html，本页面由系统自动生成</h3>
    <ul>
      <li>本页面在FTP根目录下的index.html</li>
      <li>您可以修改、删除或覆盖本页面</li>
      <li>FTP相关信息，请到“面板系统后台 > FTP” 查看</li>
    </ul>
  </div>
</body>

</html>


<?php
  include "./config/serverinfo.php";
  // 创建连接
  $conn = new mysqli($servername, $username, $password);
  // 检测连接

  if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
  }
  echo "连接成功";
  echo "wa<br>";

  $table = "time";
  $sql = "create table if not exists like old_table_name;";

  //创建数据库
  $sql = "CREATE DATABASE IF NOT EXISTS " . $database; //创建数据库
  if ($conn->query($sql) === TRUE) {
    echo "数据库创建成功/或者已经存在啦！<br>";
  } else {
    echo "出现了奇怪的问题。";
    echo "Error creating database: " . $conn->error;
  }
  //数据表创建
  $sql = "CREATE TABLE IF NOT EXISTS ".$database.".`events` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `event` TEXT NOT NULL , 
    `start_time` BIGINT NOT NULL , 
    `end_time` BIGINT NOT NULL , 
    `isfinished` INT NULL DEFAULT 0,
    `iscountdown` INT NULL DEFAULT 0,
    `priority` INT NULL DEFAULT 1,
    `the_group_only` INT NULL DEFAULT 0,
    `groupid` INT NULL DEFAULT -1,
    `start_time_see` DATETIME NULL DEFAULT NULL, 
    `end_time_see` DATETIME NULL DEFAULT NULL, 
    `json` JSON NULL DEFAULT NULL, 
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;";  

  if ($conn->query($sql) === TRUE) {
      echo "数据表创建成功/或者已经存在啦！<br>";
  } else {
      echo "创建数据表错误: " . $conn->error;
  }
  
  //使用数据库
  $sql="use ".$database;
  if ($conn->query($sql) === TRUE) {
    echo "选择数据库成功\n<br>";
  }else{
    echo "选择数据库错误: " . $conn->error;
  }

  //尝试插入数据
  // $sql="INSERT INTO `events` (`id`, `event`, `start_time`, `end_time`) 
  //       VALUES (NULL, '心理', '1637985422', '1638085422')";
  // if (mysqli_query($conn, $sql)) {
  //   echo "新记录插入成功";
  // } else {
  //   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  // }
?>