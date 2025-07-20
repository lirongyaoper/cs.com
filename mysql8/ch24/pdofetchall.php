<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "SELECT * FROM user";
$result = $dbconnect->query($sqlquery);
$rownum = $result->rowCount();
echo "There are total ".$rownum." users:<br />";

$rowall = $result->fetchAll();
foreach ($rowall as $row){
   $id = $row[0];
   $name = $row[1];
   $gender = $row[3];
   $age = $row[2];
   $info = $row['info'];
   echo "ID: $id . User $name , is $gender ,and is $age years old. and info: $info<br />";
}
?>
