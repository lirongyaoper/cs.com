<?php
try {
   $dbconnect = new PDO('mysql:host=localhost;dbname=pdodatabase','root','753951');
} catch (PDOException $exception) {
   echo "Connection error message: " . $exception->getMessage();
}
$sqlquery = "INSERT INTO user SET id = :id, name = :name, age = :age,gender = :gender ,info = :info";
$prepareddb = $dbconnect->prepare($sqlquery);
if($prepareddb->execute(array(
  ':id'=> 'NULL',
  ':name'=> 'lixiaoyun',
  ':age'=> '16',
  ':gender'=> 'female',
  ':info'=> 'She is a school girl.'
  ))){
  echo "A new user, lixiaoyun, has been inserted.<br />";
}
if($prepareddb->execute(array(
  ':id'=> 'NULL',
  ':name'=> 'liuxiaoyu',
  ':age'=> '18',
  ':gender'=> 'male',
  ':info'=> 'he is a school boy.'
  ))){
  echo "A new user, liuxiaoyu, has been inserted.<br />";
}
?>

