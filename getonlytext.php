<?php
  include "./config/serverinfo.php";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("连接到数据库失败: " . $conn->connect_error);
  }

  //默认群组-1
  $query_group=-1;
  if(isset($_GET['group']))$query_group=$_GET['group'];
  if($query_group=="")$query_group=-1;

  $input_query_group=$query_group;
  //下面咱，对重定向进行处理
  include "./group/redirect.php";//引入
  $query_group=dayi_get_the_father_group($query_group);
  //好了，处理完了


  $sql = "SELECT id, event, start_time,end_time,groupid,priority,the_group_only FROM events";
  

  $c_id="";
  $c_event="";
  $c_start="";$c_end="";
  $cnt=0;
  //查询
  echo "---咕咕咕倒计时---by.dayi ver:beta0.048\n";


  include "./lib/lib_dayi_numcute.php";
  if($query_group!=-1)echo "当前群组:".dayi_let_num_become_cute(substr($input_query_group , 0 , 3))."\n";
  //if($query_group!=-1)echo "当前群组:".dayi_let_num_become_cute(substr($input_query_group , 0 , 5))."\n";
  //if($query_group!=-1)echo "当前群组:".substr($input_query_group , 0 , 5)."\n";
  if($input_query_group!=$query_group)echo "当前信息已经重定向到:".($query_group==-1 ? "【全局群组】":dayi_let_num_become_cute(substr($query_group , 0 , 3)))."\n";





  $arry1=array();
  
  //开始处理本群特别事件！
  $arry2=array();//这个是本群特别的，不参与link的事件
  include "./lib/lib_dayi_group_only.php";
  include "./lib/lib_dayi_print.php";

  $arry2=dayi_get_the_group_only($conn,$input_query_group);
  //echo "de:".$input_query_group."<br>\n";
  //print_r($arry2);

  if(sizeof($arry2)!=0){
    //意味着本群有单独的特别事件
    echo "------------\n";
    $cnt_tmp=0;
    foreach ($arry2 as &$ii) {
      $cnt_tmp++;
      $c_id=$ii["id"];$c_event=$ii["event"];
      $c_start=$ii["start_time"];$c_now_time=time();
      $c_end=$ii["end_time"];$c_priority=$ii['priority'];

      
      dayi_print_test1($cnt_tmp,$c_id,$c_event,$c_start,$c_end,$c_priority);
      //if($cnt_tmp!=sizeof($arry2))
      echo "\n";
    }
    echo "------------\n";
  }
  //处理完了本群的特别事件！


  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
     // if($input_query_group==)
      if($query_group!=-1){
        if($row["groupid"]!=$query_group)continue;
      }
      if($row["the_group_only"]==1)continue;

      $c_id=$row["id"];
      $c_event=$row["event"];
      $c_start=$row["start_time"];
      $c_now_time=time();
      $c_end=$row["end_time"];
      $left=$c_end-$c_now_time;
      if((int)$left>=-(24*60*60)){
        $cnt++;
        //print_r($row);
        array_push($arry1,$row);
      }
    }
  }
  else {
    print("0结果");
  }
  //print_r($arry1);

  if($cnt==0){echo"\n---------\n";exit("当前群组并没有找到倒计时.");}

  //排序
  include "./lib/lib_dayi_sort.php";
  uasort($arry1,'cmp_dayi_test1');
  
  //print("\n");
  //print_r($arry1);

  //include "./lib/lib_dayi_print.php";
  $cnt2=0;
  foreach ($arry1 as &$ii) {
    $cnt2++;
    $c_id=$ii["id"];
    $c_event=$ii["event"];
    $c_start=$ii["start_time"];
    $c_now_time=time();
    $c_end=$ii["end_time"];
    $c_priority=$ii['priority'];

    dayi_print_test1($cnt2,$c_id,$c_event,$c_start,$c_end,$c_priority);
    if($cnt2!=$cnt)echo "\n";
    //$value = $value * 2;
    //echo print_r($ii)."<br>";
  }

  
  // if ($result->num_rows > 0) {
    
  //   while ($row = $result->fetch_assoc()) {
  //       echo "\n";
  //       $c_id=$row["id"];
  //       $c_event=$row["event"];
  //       $c_start=$row["start_time"];
  //       $c_now_time=time();
  //       $c_end=$row["end_time"];
  //       $left=$c_end-$c_now_time;
  //       $left_d=(int)($left/(24*60*60));
  //       $left_h=(int)(($left)%(24*3600)/3600);//(int)($left/(24*60)-$left_d*24);
  //       $left_m=(int)(($left)%(3600)/60);
  //       $left_s=$left%60;
  //       //echo "de:".$left;
  //       if((int)$left>=-(24*60*60)){
  //         //$cnt++;
  //         if(abs((int)$left)>=(25*60*60))echo $cnt.".".$c_event." 剩余:".round($left/(24*60*60),3)."d";
  //         else {
  //           if((int)$left<=0)echo $cnt."."."【似乎已经截止了】".$c_event." 剩余:".round($left/(24*60*60),3)."d";
  //           else {//一天之内
  //             echo $cnt.".".$c_event." 剩余:".$left_d."d".$left_h."h".$left_m."m".$left_s."s";
  //           }
  //         }
  //       }
  //   }
  // } else {
  //   echo "0 结果";
  // }
?>