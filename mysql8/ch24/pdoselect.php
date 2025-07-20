<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "SELECT * FROM user";
$result = $dbconnect->query($sqlquery);
foreach ($result as $row){
   $name = $row['name'];
   $gender = $row['gender'];
   $age = $row['age'];
   echo "user $name , is $gender ,and is $age years old. <br />";
}
?>
