<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "INSERT INTO user (id,name,age,gender,info )VALUES (NULL,'zhangdaguang', '39', 'male', 'he is a middle-age male.')";
if($dbconnect->exec($sqlquery)){
  echo "A new record has been inserted.<br />";
}
$sqlquery2 = "UPDATE user SET age='45' WHERE name='zhangdaguang'";
if($dbconnect->exec($sqlquery2)){
  echo "The record has been updated.";
}
?>
