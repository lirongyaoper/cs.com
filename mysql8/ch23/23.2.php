<?php
$db=@mysqli_connect('localhost','root','666666','adatabase')
or die("无法连接到服务器"); //连接数据库
print("成功连接到服务器");
mysqli_close($db);
?>
