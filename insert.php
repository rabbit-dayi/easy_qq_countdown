<?php
  include "serverinfo.php";
  // if(isset($_GET['dayi_token'])){
  //   if($_GET['dayi_token']==$auth_key)echo "owo";
  //   else exit(0);
  //   echo $_GET['token'];
  // }
  // else exit(0);
?>
<?php
  include "serverinfo.php";
  $group=-1;
  $iscountdown=0;
  
  
  if(isset($_GET['event'])==0) {echo "错误，事件信息未定义。\n<br>";exit(0);}
  if(isset($_GET['start'])==0) {echo "错误，开始时间未定义。\n<br>";exit(0);}
  if(isset($_GET['end'])==0) {echo "错误，截止时间未定义。\n<br>";exit(0);}

  if(isset($_GET['event']))$event=$_GET['event'];
  if(isset($_GET['start']))$start=$_GET['start'];
  if(isset($_GET['end']))$end=$_GET['end'];
  if(isset($_GET['group']))$group=$_GET['group'];
  if(isset($_GET['iscountdown']))$iscountdown=$_GET['iscountdown'];
  
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
  

?>