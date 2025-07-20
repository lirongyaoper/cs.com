<?php
//打开session
session_start();
include("conn.php");
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
    <?php	
	$result=mysqli_query($con," SELECT * FROM `form` ORDER BY `oid` DESC " );	
	 while($row=mysqli_fetch_row($result))
   {	
      $x = $row[0];
   ?>
   
   <table width="640" border="1" cellspacing="0" cellpadding="3" class="gridtable">
  <tr>
    <td width="116">
    编号:<?=$row[0]?></td>
    <td width="82">昵称:<?=$row[1]?></td>

    <td width="135">商品种类:    <?
        switch ($row[2]) {
	case '0' :$tp='智能';echo $tp;
		break;
	case '1' :$tp='传统';echo $tp; 
		break;
}
	?></td>
    <td width="160">下单时间:<?=$row[9]?></td>
  </tr>
  <tr>
    <td colspan="2">商品名称:<?=$row[3]?></td>
    <td>价格:<?=$row[4]?>元</td>
    <td>数量:<?=$row[5]?></td>
  </tr>
  <tr>
      <td >总价:<?=$row[4]*$row[5]?></td>
    <td >联系电话:<?=$row[6]?></td>
	 <td colspan="3" bgcolor="#EEEEEE">下单ip:<?=$row[8]?></td>
	</tr>
  <tr>
    <td colspan="4" bgcolor="#EEEEEE">附加说明:<?=$row[10]?></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#EEEEEE">地址:<?=$row[7]?></td>
  </tr>
  <tr>
   
    <td bgcolor="#EEEEEE">下单状态: 已经下单<?
        switch ($row[11]) {
	case '0' :echo '已经下单';
		break;
	case '1' :echo '已经接纳';
		break;
	case '2' :echo '正在派送';
		break;
	case '3' :echo '已经签收';
		break;
	case '4' :echo '意外，不能供应！';
	    break;
	}?>
</td>
<td><?PHP echo "<a href=edit.php?id=".$x.">修改状态</a>";?></td>
</tr>
</table>
<hr  />
   <?PHP
   }
   mysqli_free_result($result);
   ?>
  </div>

</div>
<body>
</body>
</html>
