<?php
  $auth_key="dayi_Owo_owo_owo";
  if(isset($_GET['token'])){
    if($_GET['token']==$auth_key)echo "owo";
    else exit(0);
    echo $_GET['token'];
  }
  else exit(0);
?>

<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";
 
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }
 
    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
 
    function beginChildren() { 
        echo "<tr>"; 
    } 
 
    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

include 'serverinfo.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id,event,start_time,end_time,iscountdown FROM events"); 
    $stmt->execute();
    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>