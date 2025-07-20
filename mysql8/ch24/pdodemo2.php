<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "SELECT * FROM users";
$dbconnect->exec($sqlquery);
echo $dbconnect->errorCode()."<br />";
print_r($dbconnect->errorInfo());
?>
