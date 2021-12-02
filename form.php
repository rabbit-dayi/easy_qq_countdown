<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <title>dayi-插入</title>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>

<body>

  <?php
  // 定义变量并默认设置为空值
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";

  $event = "";
  $start_time = "23333333";
  $end_time = "";
  $group = "-1";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #$name=$_POST["name"];
    #$email=$_POST["email"];
    $event = $_POST['event'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];
    $group = $_POST['group'];
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <h2>PHP 表单验证实例</h2>
  <p><span class="error">* 必需字段。</span></p>
  <a href="https://tool.chinaz.com/tools/unixtime.aspx">unix</a>
  https://tool.chinaz.com/tools/unixtime.aspx
  https://tool.lu/timestamp/
  <a href="https://tool.lu/timestamp/">https://tool.lu/timestamp/</a>
  <br><br>
  <br><br>


  <p>这里是现在的时间:</p><input id="dayi_now_time" name="dayi_now_time_1" type="text" value="123" /><br>
  <p>这里是你输入的时间:</p><input id="dayi_now_time2" name="dayi_now_time_2" type="text" /><br>
  <p>这里是转换出来的时间:</p><input id="dayi_con_time" name="dayi_con_time" type="text" /><br>
  <input onclick="dayi_change_to_unix()" value="我是按鈕,点我转换" type="button">
  <!-- <button id="con1" type="button" onclick="dayi_change_to_unix()" value="点我转换"></button> -->


  <br><br>
  <hr />
  <p>这里是分割线啦，下面填表格哦</p>
  <hr />
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    事件信息:<input type="text" name="event" value="<?php echo $event; ?>">
    <br><br>
    结束时间:<input id="end_time1" type="text" name="end-time" value="<?php echo $end_time; ?>">
    <br><br>

    组:<input type="text" name="group" value="<?php echo $group; ?>">
    <br><br>

    开始时间:<input type="text" name="start-time" value="<?php echo $start_time; ?>">
    <br><br>

    <!--
   名字: <input type="text" name="name" value="<?php echo $name; ?>">
   <span class="error">* <?php echo $nameErr; ?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
   <span class="error">* <?php echo $emailErr; ?></span>
   <br><br>
   网址: <input type="text" name="website" value="<?php echo $website; ?>">
   <span class="error"><?php echo $websiteErr; ?></span>
   <br><br>
   备注: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
   <br><br>
   性别:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>  value="female">女
   <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>  value="male">男
   <span class="error">* <?php echo $genderErr; ?></span>
   <br><br>-->

    <input type="submit" name="submit" value="Submit">
  </form>


  <?php

  echo "----------------" . "<br>";
  echo "<h2>您输入的内容是:</h2>";
  echo $event;
  echo "<br>";
  echo $start_time;
  echo "<br>";
  echo $end_time;
  echo "<br>";
  echo $group;
  echo "<br>";


  if ($event != "" && $end_time != "") {
    #include "./lib_insertfun.php";
    include "./lib/lib_insertfun.php";
    insert($event, $start_time, $end_time, -1, 0);
  }



  echo "----------------" . "<br>\n";
  ?>


  <!-- 这里是js -->
  <script>
    function dayi_change_to_unix(){
      str=document.getElementById("dayi_now_time2").value;
      str = str.replace(/-/g, "/" );
      var  date = new  Date(str); 
      var  humanDate = new  Date(Date.UTC(date.getFullYear(),date.getMonth(),date.getDate(),date.getHours(),date.getMinutes(), date.getSeconds())); 
      //alert(humanDate.getTime()/1000 - 8*60*60);
      str=humanDate.getTime()/1000 - 8*60*60
      
      document.getElementById("end_time1").value=str;
      document.getElementById("dayi_con_time").value=str;
    }

    let dayi_now_time_text=document.getElementById("dayi_now_time").value;
    document.getElementById("dayi_now_time").value=Math.round(new Date() / 1000);
    var  date = new  Date(str); 
    var  humanDate = new  Date(Date.UTC(date.getFullYear(),date.getMonth(),date.getDate(),date.getHours(),date.getMinutes(), date.getSeconds())); 
    
    var myDate=new Date();
    var dayi_date=myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate();
    var  str = dayi_date+" 12:00:00" ;
    document.getElementById("dayi_now_time2").value=str;

    //let theText = document.getElementById("dayi_now_time").value;

    //alert(theText);
    

    //str = str.replace(/-/g, "/" );
    //var  date = new  Date(str); 
    //var  humanDate = new  Date(Date.UTC(date.getFullYear(),date.getMonth(),date.getDate(),date.getHours(),date.getMinutes(), date.getSeconds())); 
    //alert(humanDate.getTime()/1000 - 8*60*60);   

  </script>

</body>

</html>