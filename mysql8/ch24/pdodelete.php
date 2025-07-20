<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "DELETE FROM user WHERE name = 'zhangdaguang'";
if($dbconnect->exec($sqlquery)){
  echo "A new record has been deleted.";
}
?>
