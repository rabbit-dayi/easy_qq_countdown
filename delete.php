<?php
include "serverinfo.php";
if(isset($_GET['dayi_token'])){
    if($_GET['dayi_token']==$auth_key)echo "owo<br>";
    else exit(0);
    echo $_GET['dayi_token']."<br>";
  }
else exit(0);

$conn = new mysqli($servername, $username, $password);
// 检测连接
if (mysqli_connect_errno()) {
  echo "连接失败: " . mysqli_connect_error();
}

if(!isset($_GET['id']))die( "nmd,id呢？");
$id=$_GET['id'];
$sql="use ".$database;
if ($conn->query($sql) === TRUE) {
  echo "选择数据库成功\n<br>";
}else{
  echo "选择数据库错误: " . $conn->error;
}

mysqli_query($conn,$sql);

mysqli_query($conn, "DELETE FROM events WHERE id=".$id);
if ($conn->query($sql) === TRUE) {echo "id:".$id."删了！";}
mysqli_close($conn);
?>