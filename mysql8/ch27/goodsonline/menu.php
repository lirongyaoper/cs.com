<?php
//打开session
session_start();
include("conn.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="css/main.css" media="screen" />
<title>网上商城</title>
</head>
<h1 align="center">网上商城</h1>
<div style="margin-left:30%;margin-top:20px;">
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="#">主页</a></li>	
</ul>	
<ul style="float:left;margin-left:30px;font-size:20px;">      
<li ><a href="add.php">添加商品</a></li>	
</ul>
<ul style="float:left;margin-left:30px;font-size:20px;">		
<li ><a href="search.php">订单管理</a></li>
</ul> 
</div>
</div>
<div id="contain">
<div id="contain-left">
<?php
$result=mysqli_query($con," SELECT * FROM `product` " );	
while($row=mysqli_fetch_row($result))
  {		  
?>

<table class="intable" width="543" border="0">
  <tr>
    <td class="td1" >   
     <?php
      if(true)
	  {	  
         echo '【<a href="del.php?id='.$row[0].'" onclick=return(confirm("你确定要删除此条商品吗？"))><font color=#FF00FF>删除商品</font></a>】';
	  }
	?>
    商品名称：<?=$row[1]?></td>
    <td class="showimg" width="173" rowspan="2"><img src='upload/<?=$row[4]?>' width="120" height="90" border="0" /><span><img src="upload/<?=$row[4]?>" alt="big" /></span></td>
  </tr>
  <tr>
    <td class="td2">价格： ￥<font color="#FF0000" ><?=$row[2]?></font></td>
  </tr>
</table>
<TD bgColor=#ffffff><br>
</TD>
<?php 
  }
mysqli_free_result($result);
?>

</div>
</div>
<body>
</body>
</html>
