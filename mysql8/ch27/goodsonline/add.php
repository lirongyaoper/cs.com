<?php

  session_start();
  //设置中国时区
 date_default_timezone_set("PRC");
 $cname = $_POST["cname"];
 $cprice = $_POST["cprice"];
 if (is_uploaded_file($_FILES['upfile']['tmp_name']))
 {
$upfile=$_FILES["upfile"];
}
$type = $upfile["type"];
$size = $upfile["size"];
$tmp_name = $upfile["tmp_name"];
switch ($type) {
	case 'image/jpg' :$tp='.jpg';
		break;
	case 'image/jpeg' :$tp='.jpeg';
		break;
	case 'image/gif' :$tp='.gif';
		break;
	case 'image/png' :$tp='.png';
		break;
}

$path=md5(date("Ymdhms").$name).$tp;
$res = move_uploaded_file($tmp_name,'upload/'.$path);
include("conn.php");
if($res){
  $sql = "INSERT INTO `caidan` (`cid` ,`cname` ,`cprice` ,`cspic` ,`cpicpath` )VALUES (NULL , '$cname', '$cprice', '', '$path')";	
$result = mysqli_query($con,$sql);
$id = mysqli_insert_id($con);
echo "<script >location.href='menu.php'</script>"; 
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="css/main.css" media="screen" />
<title>网上商城</title>
</head>
<h1 align="center">网上商城</h1>
<div style="margin-left:35%;margin-top:20px;">
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="menu.php">主页</a></li>	
</ul>	
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="add.php">添加商品</a></li>	
</ul>
<ul style="float:left;margin-left:30px;font-size:20px;">		
<li ><a href="search.php">订单管理</a></li>
</ul> 
</div>
<div style="margin-top:100px;margin-left:35%;">
<div>
<form action="add.php" method="post" enctype="multipart/form-data" name="add">
商品名称：<input name="cname" type="text" size="40"/><br /><br />
价格：<input name="cprice" type="text" size="10"/>元<br/><br />
缩略图上传：<input name="upfile" type="file" /><br /><br />
<input type="submit" value="添加商品" style="margin-left:10%;font-size:16px"/>
</form>
</div>
</div>
<body>
</body>
</html>
