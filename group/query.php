<?php
$filename=dirname(dirname(__FILE__))."/serverinfo.php";
include $filename;
#echo __FILE__ ;
#echo dirname(dirname(__FILE__));
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$query_group=-1;
if(isset($_GET['group']))$query_group=$_GET['group'];

$sql="SELECT * FROM `groups` WHERE `groupid` = ".$query_group;
$result = $conn->query($sql);


//输出查询结果
if($result->num_rows > 0){
  while ($row = $result->fetch_assoc()){
    exit($row['isallowed']);//exit("1");
  }
}
else {
  exit("-1");
}


?>