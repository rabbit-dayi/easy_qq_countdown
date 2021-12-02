<?php
$filename=dirname(dirname(__FILE__))."/serverinfo.php";
include $filename;
#echo __FILE__ ;
#echo dirname(dirname(__FILE__));
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

//创建数据库
$sql = "CREATE DATABASE IF NOT EXISTS " . $database; //创建数据库
if ($conn->query($sql) === TRUE) {
  echo "数据库创建成功/或者已经存在啦！<br>";
} else {
  echo "出现了奇怪的问题。";
  echo "Error creating database: " . $conn->error;
}
//数据表创建


$sql = "CREATE TABLE IF NOT EXISTS ".$database.".`groups` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `groupid` INT NULL DEFAULT -2,
  `isallowed` INT NULL DEFAULT 1,
  `link_groupid` INT NULL DEFAULT -233,
  `priority` INT NULL DEFAULT 1,
  `json` JSON NULL DEFAULT NULL, 
  PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;";  

if ($conn->query($sql) === TRUE) {
    echo "数据表创建成功/或者已经存在啦！<br>";
} else {
    echo "创建数据表错误: " . $conn->error;
}

//660322680
//795258518

$sql="INSERT INTO `groups` (`id`, `groupid`, `isallowed`, `priority`, `json`,`link_groupid`) VALUES (1, '-1', '1', '1', NULL,'-233')";
if ($conn->query($sql) === TRUE) {
  echo "创建默认群组-1，并设置为允许查询(-1群组为全部群组的记录）<br>";
}else {
  echo "创建数据表错误: " . $conn->error;
}


//
//使用数据库
$sql="use ".$database;
if ($conn->query($sql) === TRUE) {
  echo "选择数据库成功\n<br>";
}else{
  echo "选择数据库错误: " . $conn->error;
}




?>