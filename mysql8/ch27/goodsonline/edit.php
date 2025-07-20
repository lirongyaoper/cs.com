<?
//打开session
session_start();
include("conn.php");
$id=$_GET['id'];
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
<li ><a href="search.php">订单管理</a></li>
</ul> 
</div>
<div id="contain">
  <div id="contain-left">
<form name="input" method="post" action="editDo.php?id=<?=$id?>">
  <p>修改状态：<br/>
    <input name="state" type="radio" value="0" />
    已经提交！<br/>
    <input name="state" type="radio" value="1" />
    已经接纳！<br/>
    <input name="state" type="radio" value="2" />
    正在派送！<br/>
    <input name="state" type="radio" value="3" />
    已经签收！<br/>
    <input name="state" type="radio" value="4" />
  意外，不能供应！</p>
    </p>
    <button name="button" class="button" type="submit">提交</button>
</form>
  </div>
</div>
<body>
</body>
</html>
