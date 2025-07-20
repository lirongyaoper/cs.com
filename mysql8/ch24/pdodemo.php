<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root',' ');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
?>