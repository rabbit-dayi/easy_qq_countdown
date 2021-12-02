<?php
function insert($event,$start,$end,$group,$iscountdown){
  $filename=dirname(dirname(__FILE__))."/serverinfo.php";
  include $filename;
  #echo __FILE__ ;
  #echo dirname(dirname(__FILE__));
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("连接失败: " . $conn->connect_error);
  }

  echo "<br>\n";
  echo"---------------------"."<br>\n";
  echo "event:".$event."<br>\n";
  echo "start:".$start."<br>\n";
  echo "end:".  $end."<br>\n";
  echo "group:".$group."<br>\n";
  echo "iscountdown:".$iscountdown."<br>\n";
  echo"---------------------"."<br>\n";
  try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO `events` (`id`, `event`, `start_time`, `end_time`,`iscountdown`,`groupid`) 
                            VALUES (NULL,:c_event,:c_start_time,:c_end_time,:c_iscountdown,:c_groupid)");
    $stmt->bindParam(':c_event', $c_event);
    $stmt->bindParam(':c_start_time', $c_start_time);
    $stmt->bindParam(':c_end_time', $c_end_time);
    $stmt->bindParam(':c_iscountdown', $c_iscountdown);
    $stmt->bindParam(':c_groupid', $c_groupid);

    $c_event="冲";
    $c_start_time=1637985422;
    $c_end_time=1638085422;
    $c_iscountdown=0;
    $c_groupid=-1;

    $c_event=$event;
    $c_start_time=$start;
    $c_end_time=$end;
    $c_iscountdown=$iscountdown;
    $c_groupid=$group;
    $stmt->execute();
    echo "插入成功！";
  }
  catch(PDOException $e){
    echo "错误:" . $e->getMessage();
  }
}
  
?>