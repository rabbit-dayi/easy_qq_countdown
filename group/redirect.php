<?php

  /*
  -1代表不能再定向？
  但是-1代表全局啊。
  那就不用-1了
  那就-233代表没有下一个了

  */
  function dayi_get_the_father_group($query_group){
    //连接到数据库
    $filename=dirname(dirname(__FILE__))."/serverinfo.php";
    include $filename;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    $sql="SELECT * FROM `groups` WHERE `groupid` = ".$query_group;
    $result = $conn->query($sql);
    //$row;
    if($row = $result->fetch_assoc()){
      $re_cnt=0;
      $row2=$row;
      while($row2['link_groupid']!=-233){
       // echo "debug:".$row2['link_groupid']."<br>\n";
        $re_cnt++;
        $sql2="SELECT * FROM `groups` WHERE `groupid` = ".$row['link_groupid'];
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $row=$row2;
        if($re_cnt>=50)exit("【错误】重定向次数超过50次，你可能造了个环。");
      }
      return $row['groupid'];
    }
    return -1;
  }
?>