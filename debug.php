
<?php
  function my_sort($x,$y){
    //left_time=$x['end_time']-$y['end_time'];
    return $x['end_time']<$y['end_time'];
  }
?>

<?php
  include "./config/serverinfo.php";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("连接到数据库失败: " . $conn->connect_error);
  }
  $sql = "SELECT id, event, start_time,end_time FROM events";
  $result = $conn->query($sql);

  $c_id="";
  $c_event="";
  $c_start="";$c_end="";
  $cnt=0;
  //查询
  echo "---咕咕咕倒计时---by.dayi";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "\n";
        $c_id=$row["id"];
        $c_event=$row["event"];
        $c_start=$row["start_time"];
        $c_now_time=time();
        $c_end=$row["end_time"];
        $left=$c_end-$c_now_time;
        $left_d=(int)($left/(24*60*60));
        $left_h=(int)(($left)%(24*3600)/3600);//(int)($left/(24*60)-$left_d*24);
        $left_m=(int)(($left)%(3600)/60);
        $left_s=$left%60;
        if($cnt>=-3600){
          $cnt++;
          
          //if($left<=0)echo $cnt.".".$c_event." [似乎已经截止了]"." 剩余:".$left_d."d".$left_h."h".$left_m."m".$left_s."s";
          //else {echo $cnt.".".$c_event." 剩余:".$left_d."d".$left_h."h".$left_m."m".$left_s."s";}
        }
        print_r($row);
        echo "<br>";
    }
  } else {
    echo "0 结果";
  }
  echo "------<br>";
  
?>