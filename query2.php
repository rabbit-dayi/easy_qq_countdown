<?php
include "serverinfo.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}


$sql = "SELECT id, event, start_time,end_time,priority,groupid FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Event: " . $row["event"]  ." - endtime:" . $row["end_time"];
        echo " -group:".$row['groupid']." -priority:".$row["priority"]." -starttime:" . $row["start_time"] ;
        echo "<a href=\"./delete.php?dayi_token=123&id=".$row["id"]."\" target=\"_blank\">删除id:".$row["id"]."</a>";
        echo "";
        echo "<br>";
    }
} else {
    echo "0 结果";
}
$conn->close();
?>
