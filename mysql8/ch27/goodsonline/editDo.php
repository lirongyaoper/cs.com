<?php
//打开session
session_start();
include("conn.php");
$state=$_POST['state'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
<link type="text/css" rel="stylesheet" href="css/main.css" media="screen" />
<title>网上商城</title>
</head>
<h1 align="center">网上商城</h1>
<div style="margin-left:30%;margin-top:20px;">
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="menu.php">主页</a></li>	
</ul>	
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="add.php">添加商品</a></li>	
</ul>
<ul style="float:left;margin-left:30px;font-size:20px;">		
<li ><a href="search.php">订单查询</a></li>
</ul> 
</div>
<div id="contain">
  <div id="contain-left">
  <?php
  if(''==$state or null==$state) 
  {
            echo "请选择订单状态!";
            header('refresh:1; url= edit.php');
  }else
  {
            $oid=$_GET['id'];
            $sql = "UPDATE `form` SET state='$state' WHERE oid = '$oid'";
            $result = mysqli_query($con,$sql);
            echo "订单状态修改成功。";
            header('refresh:1; url= search.php');
  }
  ?>

  </div>

</div>
<body>
</body>
</html>
